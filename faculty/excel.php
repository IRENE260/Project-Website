<?php
$con=mysqli_connect("localhost","root","","apoint");
if($con)
{
		$sql1="select student.name,student.regno,spoint.ncc,spoint.nss,spoint.sports,spoint.games,spoint.music,spoint.part,spoint.lart,spoint.techf_q,spoint.mooc,spoint.competition,spoint.sew_iit,spoint.pp_iit,spoint.pop_iit,spoint.internship,spoint.iv,spoint.fls,spoint.company,spoint.patentf,spoint.patentp,spoint.patenta,spoint.patentl,spoint.prototype,spoint.award,spoint.innovative_t,spoint.innovative_c,spoint.employment,spoint.societal_innovation,spoint.ieee,spoint.cac,spoint.tech_fest,spoint.club,spoint.initiatives,spoint.rep,spoint.tpoint from student RIGHT JOIN spoint ON student.id=spoint.sid;";
		$res=mysqli_query($con,$sql1);
        $value=mysqli_fetch_all($res);
        //print_r($value);die;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .table{
            display:none;
            border-collapse: separate;
            border-spacing: 10px;
            *border-collapse: expression('separate', cellSpacing='10px');
        }
        </style>
    </head>
<body>
<div class="excels">
        <button onclick="downloadExcel()">Download Excel</button></td>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
</div>
        <div class="container">
    <table class="table" id="demo" > 
            <caption>CERTIFICATES AND POINTS</caption>
            <tr>
                <th>SI. No</th>
                <th>Name</th>
                <th>Registeration Number</th>
                <th>N C C </th>
                <th>N S S </th>
                <th>Sports</th>
                <th>Games</th>
                <th>Music</th>
                <th>Performing arts</th>
                <th>Literary arts</th>
                <th>Tech Fest, Tech Quiz</th>
                <th>MOOC</th>
                <th>Competitions conducted by Professional Societies - (IEEE, IET, ASME, SAE, NASA etc.) </th>
                <th>Attending Full time Conference/Seminars/Exhibitions/Workshop/STTP conducted at IITs/NITs </th>
                <th>Paper presentation/publication at IITs/NITs </th>
                <th>Poster Presentation at IITs /NITs </th>
                <th>Industrial Training/ Internship</th>
                <th>Industrial/Exhibition visits </th>
                <th>Foreign Language Skill (TOFEL/IELTS/BEC exams etc.) </th>
                <th>Start-up Company Registered legally </th>
                <th>Patent-Filed </th>
                <th>Patent - Published </th>
                <th>Patent- Approved </th>
                <th>Patent- Licensed</th>
                <th>Prototype developed and tested </th>
                <th>Awards for Products developed</th>
                <th>Innovative technologies developed and used by industries/users</th>
                <th>Got venture capital funding for innovative ideas/products. </th>
                <th>Startup Employment </th>
                <th>Societal innovations</th>
                <th>Student Professional Societies (IEEE,IET,ASME,SAE,NASA etc.) </th>
                <th>College Association Chapters </th>
                <th>Festival & Technical Events (College approved) </th>
                <th>Hobby Clubs </th>
                <th>Special Initiatives (Approval from College and University is mandatory) </th>
                <th>Elected student representatives </th>
                <th>Total Points</th>
            </tr>
            <?php
            $i=1;
            foreach($value as $data)
            {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data[0] ?></td>
                    <td><?php echo $data[1] ?></td>
                    <td><?php echo $data[2] ?></td>
                    <td><?php echo $data[3] ?></td>
                    <td><?php echo $data[4] ?></td>
                    <td><?php echo $data[5] ?></td>
                    <td><?php echo $data[6] ?></td>
                    <td><?php echo $data[7] ?></td>
                    <td><?php echo $data[8] ?></td>
                    <td><?php echo $data[9] ?></td>
                    <td><?php echo $data[10] ?></td>
                    <td><?php echo $data[11] ?></td>
                    <td><?php echo $data[12] ?></td>
                    <td><?php echo $data[13] ?></td>
                    <td><?php echo $data[14] ?></td>
                    <td><?php echo $data[15] ?></td>
                    <td><?php echo $data[16] ?></td>
                    <td><?php echo $data[17] ?></td>
                    <td><?php echo $data[18] ?></td>
                    <td><?php echo $data[19] ?></td>
                    <td><?php echo $data[20] ?></td>
                    <td><?php echo $data[21] ?></td>
                    <td><?php echo $data[22] ?></td>
                    <td><?php echo $data[23] ?></td>
                    <td><?php echo $data[24] ?></td>
                    <td><?php echo $data[25] ?></td>
                    <td><?php echo $data[26] ?></td>
                    <td><?php echo $data[27] ?></td>
                    <td><?php echo $data[28] ?></td>
                    <td><?php echo $data[29] ?></td>
                    <td><?php echo $data[30] ?></td>
                    <td><?php echo $data[31] ?></td>
                    <td><?php echo $data[32] ?></td>
                    <td><?php echo $data[33] ?></td>
                    <td><?php echo $data[34] ?></td>
                    <td><?php echo $data[35] ?></td>
                </tr>
            <?php
            $i++;
            }
            ?>
        </table>
    </div>
</body>
</html>
<script>
    function downloadExcel() {
    // Select the table element
    var table = document.getElementById('demo'); // Replace 'your-table-id' with the actual ID of your table

    // Create a new Workbook
    var wb = XLSX.utils.table_to_book(table);

    // Convert the workbook to a binary string
    var wbBinary = XLSX.write(wb, { bookType: 'xlsx', bookSST: true, type: 'binary' });

    // Convert binary string to array buffer
    var s2ab = function(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    };

    // Create a Blob containing the Excel file
    var blob = new Blob([s2ab(wbBinary)], { type: 'application/octet-stream' });

    // Create a download link and trigger the download
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'table_data.xlsx'; // Specify the filename for the downloaded file
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    }

</script>