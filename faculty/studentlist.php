<?php
$userid=$_GET["userid"];
$con=mysqli_connect("localhost","root","","apoint");

// $sql="SELECT * from faculty where id='$userid'";
// $result = mysqli_query($con,$sql);
// $data = mysqli_fetch_array($result);

$today = new DateTime('now'); 
$today = $today->format('Y-m-d');
$currentYear = (int)(new DateTime())->format('Y');

// $sqle="select student.name,student.regno,spoint.ncc,spoint.nss,spoint.sports,spoint.games,spoint.music,spoint.part,spoint.lart,spoint.techf_q,spoint.mooc,spoint.competition,spoint.sew_iit,spoint.pp_iit,spoint.pop_iit,spoint.internship,spoint.iv,spoint.fls,spoint.company,spoint.patentf,spoint.patentp,spoint.patenta,spoint.patentl,spoint.prototype,spoint.award,spoint.innovative_t,spoint.innovative_c,spoint.employment,spoint.societal_innovation,spoint.ieee,spoint.cac,spoint.tech_fest,spoint.club,spoint.initiatives,spoint.rep,spoint.tpoint from student RIGHT JOIN spoint ON student.id=spoint.sid;";
// $rese=mysqli_query($con,$sqle);
// $valuee=mysqli_fetch_all($rese);
// $currentYear = (int)$today->format('Y');
// if(isset($_POST["applyfilter"])){
//     $branch = $_POST['branchInput'];
//     $year = $_POST['yearInput'];
//     $sql2="SELECT * from student where branch='$branch' and yearj='$year'";
//     $result2 = mysqli_query($con, $sql2);
//     $data2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Student List-Automated Activity Metric Computation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css" /> 
    <link rel="stylesheet" href="css/slick.css" type="text/css" />   
    <link rel="stylesheet" href="css/tooplate-simply-amazed.css" type="text/css" />
<style>
     .filter-container {
            background-color: rgba(65, 55, 111, 0.9); /* White container with transparency */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
    .filter-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.filter-bar input {
    width: 42%;
    padding: 10px;
    margin-right: 10px;
}

.filter-bar button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}
.search-form {
            display: flex;
            align-items: center;
        }

        .search-form input {
            width: 70%;
            margin-left: 80px;
            padding: 8px;
            margin-right: 10px;
        }

        .search-form button {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .tm-work-item-inner {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .item:hover .tm-work-item-inner {
        transform: translateY(-5px); /* Adjust the value to control the lift height */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adjust the shadow as needed */
    }

    .item:not(:hover) .tm-work-item-inner {
        transform: translateY(0);
        box-shadow: none;
    }

   table {
    margin-top: 20px auto;
    margin-left: 120px;
    width: 80%;
    border-collapse: collapse;
    background-color: rgba(255, 255, 255, 0.8); /* Set the background color to white with 80% opacity */
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

.etable{
            display:none;
            border-collapse: separate;
            border-spacing: 10px;
            *border-collapse: expression('separate', cellSpacing='10px');
        }
/* .sl{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}
table{
    border-radius: 5px;
    font-size: 20px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}
table td, table th {
    text-align: center;
    padding: 8px;
}
table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}  */
</style>
    <!--

Tooplate 2123 Simply Amazed

https://www.tooplate.com/view/2123-simply-amazed

-->
</head>

<body>
    <div id="outer">   
        <main id="content-boxl" class="order-first">
            <div class="banner-section section parallax-window" style="padding-top: 85px;" data-parallax="scroll" data-image-src="img/banner.jpg" id="section-1">
                <div class="container">
                    <div class="item">
                        <div class="bg-blue-transparent logo-fa"> Student List Management
                            <p text-indent: 26px;>View list of students along with their activity-point details...</p>
                        </div>
                        <!-- <div class="bg-blue-transparent simple"><p>Makes it easy for activity points management...</p></div> -->
                    </div>
                    <div class="filter-container">
                        <div class="filter-bar">
                        <!-- <form  method="post" action="<?php //$_SERVER['PHP_SELF']?>" enctype="multipart/form-data"> -->
                        <form action="" method="POST" class="filter-bar">
                            <select id="branchInput"  name="branchInput">
                                <option value="" disabled selected>Select Branch</option>
                                <option value="CSE">CSE</option>
                                <option value="ECE">ECE</option>
                                <option value="EEE">EEE</option>
                                <option value="Mech">Mech.E</option>
                                <option value="EIE">EIE</option>
                                <option value="Civil">Civil</option>
                                <option value="MCA">MCA</option>
                                <!-- Add more options as needed -->
                            </select>
                            
                            <select id="yearInput" name="yearInput">
                                <option value="" disabled selected>Select Year of Admission</option>
                                <?php
                                for ($year = 1986; $year <= $currentYear; $year++) {
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                                ?>
                                <!-- Add more options as needed -->
                            </select>
                            <button type="submit" name="filter" >Apply Filter</button>
                        </form>
                    </div>
                    <!-- </form> -->

                    <form action="" method="POST" class="search-form">
                        <input type="text" id="studentName" name="studentName" placeholder="Search..." required>
                        <button type="submit" name="searchByName"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <div id="resultTable" >
                    <?php
                    if (isset($_POST['filter'])) {
                        $branch = $_POST['branchInput'];
                        $yearj = $_POST['yearInput'];
                        if(empty($branch) && empty($yearj)) {
                            $showAlert = true; // Set flag to true
                        } else {
                            echo '<button onclick="downloadExcel()">Download Data-sheet</button>';
                            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>';
                        
                            $sqle = "SELECT student.name, student.regno, spoint.ncc, spoint.nss, spoint.sports, spoint.games, spoint.music, spoint.part, spoint.lart, spoint.techf_q, spoint.mooc, spoint.competition, spoint.sew_iit, spoint.pp_iit, spoint.pop_iit, spoint.internship, spoint.iv, spoint.fls, spoint.company, spoint.patentf, spoint.patentp, spoint.patenta, spoint.patentl, spoint.prototype, spoint.award, spoint.innovative_t, spoint.innovative_c, spoint.employment, spoint.societal_innovation, spoint.ieee, spoint.cac, spoint.tech_fest, spoint.club, spoint.initiatives, spoint.rep, spoint.tpoint FROM student RIGHT JOIN spoint ON student.id = spoint.sid WHERE student.branch = '$branch' AND student.yearj = '$yearj'";
                            $rese=mysqli_query($con,$sqle);
                            $valuee=mysqli_fetch_all($rese);

                            // Query to retrieve matching students
                        $queryf = "SELECT * FROM student WHERE branch = '$branch' AND yearj = '$yearj'";
                        $resultf = $con->query($queryf);
?>
<table class="etable" id="demo" > 
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
            foreach($valuee as $data)
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
    
  <?php                      
                        // Check if any matching data is found
                        if ($resultf->num_rows > 0) {

                            echo "<table>";
                            echo "<tr><th>Name</th><th>Current Points</th><th>View Certificates</th></tr>";

                            // Output data of each row
                            while ($rowf = $resultf->fetch_assoc()) {
                                $sql3="select tpoint from spoint where sid=".$rowf["id"];
                                $res3=mysqli_query($con,$sql3);
                                $value3=mysqli_fetch_array($res3);                                
                                // echo "<tr><td>" . $rowf["name"] . "</td><td>" . $value2[0] . "</td><td><button>View Details</button></td></tr>";
                                echo "<tr><td>" . $rowf["name"] . "</td><td>" . $value3[0] . "</td><td><a href='viewcertificate.php?userid=" . $userid . "&id=" . $rowf["id"] . "'>View Details</a></td></tr>";

                            }

                            echo "</table>";
                        } else {
                            echo "<p>No matching data found.</p> <script>window.history.go(-1);</script>";
                        }
                    }
                    }

                    if (isset($_POST['searchByName'])) {
                        $studentName = $_POST['studentName'];
                        if(empty($studentName)) {
                            $showAlert = true; // Set flag to true
                        } else {
                        // Query to retrieve matching students by name
                        $querys = "SELECT * FROM student WHERE name LIKE '%$studentName%'";
                        $results = $con->query($querys);

                        // Check if any matching data is found
                        if ($results->num_rows > 0) {
                            echo "<table>";
                            echo "<tr><th>Name</th><th>Current Points</th><th>View Certificates</th></tr>";

                            // Output data of each row
                            while ($rows = $results->fetch_assoc()) {
                                $sql4="select tpoint from spoint where sid=".$rows["id"];
                                $res4=mysqli_query($con,$sql4);
                                $value4=mysqli_fetch_array($res4);                                
                                echo "<tr><td>" . $rowf["name"] . "</td><td>" . $value4[0] . "</td><td><a href='viewcertificate.php?userid=" . $userid . "&id=" . $rowf["id"] . "'>View Details</a></td></tr>";

                                // echo "<tr><td>" . $rows["name"] . "</td><td>" . $rows["yearj"] . "</td><td><button>View Details</button></td></tr>";
                            }

                            echo "</table>";
                        } else {
                            echo "<p>No matching data found.</p> <script>window.history.go(-1);</script>";
                        }
                    }
                    }
                    if (isset($showAlert) &&  $showAlert) {
                        echo "<script>alert('Enter details properly'); window.history.go(-1);</script>";
                    }
                    ?>
                </div>         
            </div>
        </div>
    </main>
</div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.singlePageNav.min.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/templatemo-script.js"></script>    
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
