import shlex
import re
import subprocess
import sys
import os
from contextlib import contextmanager
from errno import ENOENT
from functools import wraps
from glob import iglob
from os import environ
from os import extsep
from os import remove
from os.path import normcase
from os.path import normpath
from os.path import realpath
from tempfile import NamedTemporaryFile
from time import sleep
from PIL import Image
import fitz

text_cmd = 'tesseract'

try:
    from numpy import ndarray

    numpy_installed = True
except ModuleNotFoundError:
    numpy_installed = False


DEFAULT_ENCODING = 'utf-8'
RGB_MODE = 'RGB'
SUPPORTED_FORMATS = {
    'JPEG',
    'JPEG2000',
    'PNG',
    'PBM',
    'PGM',
    'PPM',
    'TIFF',
    'BMP',
    'GIF',
    'WEBP',
}



class Error2(RuntimeError):
    def __init__(self, status, message):
        self.status = status
        self.message = message
        self.args = (status, message)


class ClassNotFoundError(EnvironmentError):
    def __init__(self):
        super().__init__(
            f" Error found"
        )




def kill(process, code):
    process.terminate()
    try:
        process.wait(1)
    except TypeError:  # python2 Popen.wait(1) fallback
        sleep(1)
    except Exception:  # python3 subprocess.TimeoutExpired
        pass
    finally:
        process.kill()
        process.returncode = code



@contextmanager
def timeout_manager(proc, seconds=None):
    try:
        if not seconds:
            yield proc.communicate()[1]
            return

        try:
            _, error_string = proc.communicate(timeout=seconds)
            yield error_string
        except subprocess.TimeoutExpired:
            kill(proc, -1)
            raise RuntimeError('Process timeout')
    finally:
        proc.stdin.close()
        proc.stdout.close()
        proc.stderr.close()



def get_errors(error_string):
    return ' '.join(
        line for line in error_string.decode(DEFAULT_ENCODING).splitlines()
    ).strip()


def cleanup(temp_name):
    """Tries to remove temp files by filename wildcard path."""
    for filename in iglob(f'{temp_name}*' if temp_name else temp_name):
        try:
            remove(filename)
        except OSError as e:
            if e.errno != ENOENT:
                raise


def prepare(image):
    if numpy_installed and isinstance(image, ndarray):
        image = Image.fromarray(image)

    if not isinstance(image, Image.Image):
        raise TypeError('Unsupported image object')

    extension = 'PNG' if not image.format else image.format
    if extension not in SUPPORTED_FORMATS:
        raise TypeError('Unsupported image format/type')

    if 'A' in image.getbands():
        # discard and replace the alpha channel with white background
        background = Image.new(RGB_MODE, image.size, (255, 255, 255))
        background.paste(image, (0, 0), image.getchannel('A'))
        image = background

    image.format = extension
    return image, extension


@contextmanager
def save(image):
    try:
        with NamedTemporaryFile(prefix='tess_', delete=False) as f:
            if isinstance(image, str):
                yield f.name, realpath(normpath(normcase(image)))
                return
            image, extension = prepare(image)
            input_file_name = f'{f.name}_input{extsep}{extension}'
            image.save(input_file_name, format=image.format)
            yield f.name, input_file_name
    finally:
        cleanup(f.name)


def subprocess_args(include_stdout=True):

    str1 = {
        'stdin': subprocess.PIPE,
        'stderr': subprocess.PIPE,
        'startupinfo': None,
        'env': environ,
    }

    if hasattr(subprocess, 'STARTUPINFO'):
        str1['startupinfo'] = subprocess.STARTUPINFO()
        str1['startupinfo'].dwFlags |= subprocess.STARTF_USESHOWWINDOW
        str1['startupinfo'].wShowWindow = subprocess.SW_HIDE

    if include_stdout:
        str1['stdout'] = subprocess.PIPE
    else:
        str1['stdout'] = subprocess.DEVNULL

    return str1


def run_textextraction(
    input_filename,
    output_filename_base,
    extension,
    lang,
    config='',
    nice=0,
    timeout=0,
):
    cmd_args = []
    not_windows = not (sys.platform == 'win32')

    if not_windows and nice != 0:
        cmd_args += ('nice', '-n', str(nice))

    cmd_args += (text_cmd, input_filename, output_filename_base)

    if lang is not None:
        cmd_args += ('-l', lang)

    if config:
        cmd_args += shlex.split(config, posix=not_windows)

    for _extension in extension.split():
        if _extension not in {'box', 'osd', 'tsv', 'xml'}:
            cmd_args.append(_extension)

    try:
        proc = subprocess.Popen(cmd_args, **subprocess_args())
    except OSError as e:
        if e.errno != ENOENT:
            raise
        else:
            raise ClassNotFoundError()

    with timeout_manager(proc, timeout) as error_string:
        if proc.returncode:
            raise Error2(proc.returncode, get_errors(error_string))


def _read_output(filename: str, return_bytes: bool = False):
    with open(filename, 'rb') as output_file:
        if return_bytes:
            return output_file.read()
        return output_file.read().decode(DEFAULT_ENCODING)



def run_and_get_output(
    image,
    extension='',
    lang=None,
    config='',
    nice=0,
    timeout=0,
    return_bytes=False,
):
    with save(image) as (temp_name, input_filename):
        str1 = {
            'input_filename': input_filename,
            'output_filename_base': temp_name,
            'extension': extension,
            'lang': lang,
            'config': config,
            'nice': nice,
            'timeout': timeout,
        }

        run_textextraction(**str1)
        return _read_output(
            f"{str1['output_filename_base']}{extsep}{extension}",
            return_bytes,
        )


def image_to_string(
    image,
    lang=None,
    config='',
    nice=0,
    output_type='string',
    timeout=0,
):
    """
    Returns the result of  image to string
    """
    args = [image, 'txt', lang, config, nice, timeout]

    return {
        'bytes': lambda: run_and_get_output(*(args + [True])),
        'dict': lambda: {'text': run_and_get_output(*args)},
        'string': lambda: run_and_get_output(*args),
    }[output_type]()


def string_to_word_array(input_string):
    # Remove escape sequences, symbols, and other non-word characters
    cleaned_string = re.sub(r'[^\w\s]', '', input_string)
    # Split the cleaned string into words
    words_array = cleaned_string.split()
    return words_array


def main():
    
    fname='uploads/'+sys.argv[1]
    # fname='uploads/Anna Ann Mathew.pdf'
    file_extension = os.path.splitext(fname)[1]
    # print(file_extension)
    if(file_extension=='.pdf'):
        dpi = 500  # choose desired dpi here
        zoom = dpi / 72  # zoom factor, standard: 72 dpi
        magnify = fitz.Matrix(zoom, zoom)  # magnifies in x, resp. y direction
        doc = fitz.open(fname)  # open document
        for page in doc:
            pix = page.get_pixmap(matrix=magnify)  # render page to an image
            pix.save(f"page-{page.number}.png")

        filename="page-0.png"
    else:
        filename=fname
    lang=None

    try:
        with Image.open(filename) as img:
            out=image_to_string(img, lang=lang)
            words_array = string_to_word_array(out)
            print(words_array)
            os.remove(filename)           

    except ClassNotFoundError as e:
        print(f'{str(e)}\n', file=sys.stderr)
        return 1
    except OSError as e:
        print(f'{type(e).__name__}: {e}', file=sys.stderr)
        return 1



if __name__ == '__main__':
    raise SystemExit(main())
