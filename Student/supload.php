<?php
function isArrayInSameOrder($array1, $array2) {
    $array1 = array_map('strtolower', $array1);
    $array2 = array_map('strtolower', $array2);
    $index1 = 0;
    $index2 = 0;
    $len1 = count($array1);
    $len2 = count($array2);

    while ($index1 < $len1 && $index2 < $len2) {
        if ($array1[$index1] === $array2[$index2]) {
            $index1++;
            $index2++;
        }
        else{
            $index2++;
            $index1=0;
        }
    }

    return $index1 === $len1;
}

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/Student/homepage.php');
    exit;
}
$con=mysqli_connect("localhost","root","","apoint");
if($con)
{
	if(isset($_POST['upload']))
	{
        

        $pdfName = $_FILES['file']['name'];
        $pdfTmp = $_FILES['file']['tmp_name'];
        $targetDir = 'uploads/';
        $targetFile = $targetDir . basename($pdfName);
        move_uploaded_file($pdfTmp, $targetFile);
        $name=escapeshellarg($pdfName);
        $command=escapeshellcmd("py ./ocr2.py $name");
        exec($command,$output,$resultCode);
        $sql1="select name from student where id=".$_SESSION['user_id'];
        $result=mysqli_query($con,$sql1);
        $value=mysqli_fetch_array($result);
        $arr = explode(" ", $value[0]);
        // print_r($output);
        // var_dump(explode("', '",$output[0]));die;
        $_SESSION['details']=explode("', '",$output[0]);
        // var_dump( $_SESSION['details']);die;
        if(isArrayInSameOrder($arr, $_SESSION['details']))
        {
            $_SESSION['file']=$pdfName;
            // var_dump($arr);die;
            header("Location:/amcs/Student/findpoint.php");
            exit();
        }
        else
        {
            header("Location:/amcs/Student/srequest.php");
            exit();
        }
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Upload Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/student.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class='fas fa-user-graduate' style='font-size:40px;'></i>&nbsp;<?php echo $_SESSION['user_name'];?></h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto  p-lg-0">
                <a href="homepage.php" class="nav-item nav-link active">Home</a>
                <a href="profilepage.php" class="nav-item nav-link">Profile</a>
                <a href="logout.html" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Upload Start -->
    <div class="zone">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <div id="dropZ">
                <i class="fa fa-cloud-upload"></i>
                <div>Drag and drop your file here</div>                    
                <span>OR</span>
                <div class="selectFile">                       
                    <input type="file" name="file" id="file" value="Select file"required ><br><br><br>
                </div>
            </div>
            <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id']?>">
            <input type="submit" value="Upload File" name="upload">
        </form>
                    
    </div>
    <!-- Upload End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>