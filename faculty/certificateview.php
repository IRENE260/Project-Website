<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location:/Project_S8/certificateview.php');
//     exit;
// }
// if (!isset($_SESSION['studentid'])) {
//     header('Location:/Project_S8/certificateview.php');
//     exit;
// }
$con=mysqli_connect("localhost","root","","apoint");
if($con)
{
 
        $sql1="select * from files where status='Verified'";
        $result =$con->query($sql1);
        $studentid=$_GET["studentid"];
        // $name=$_POST['name']
        $sql2="select * from student where id=$studentid";
        //$sql2="select * from student where name='Anna'";
        $result1 =$con->query($sql2);
       // print_r($result1);die;
       $id=$_SESSION['user_id'];
		$sql1="select * from spoint where sid='$id'";
		$res=mysqli_query($con,$sql1);
        $value=mysqli_fetch_array($res);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewcertificate.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="all.min.css" type="text/css" /> 
    <link rel="stylesheet" href="slick.css" type="text/css" />   
    <link rel="stylesheet" href="tooplate-simply-amazed.css" type="text/css" />
    <style>
        body {
            background-image: url("images/i3.jpg"); 
            background-size: cover;
            background-position: center; 
            font-family: 'Source Sans Pro', sans-serif; 
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            color: rgb(102 153 204 /0.8); 
        }
        h1{
            text-align: center;
            font-size: 100px;
        }
        .header {
            text-align: center;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            padding: 20px 0; 
        }
        .larger-image {
            width: 400px; 
            height: auto; 
        }
        .pdf-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            justify-items: left;
            margin-top: 20px;
        }
        .pdf-item img {
            max-width: 100%;
            height: auto;
        }
        .excels{
            border-style: solid;
            border-color: lightblue;
            width: 200px;
            height: 150px;
            color:darkblue;
        }
        /* .file{
            padding-top:5px;

        } */
    </style>
</head>
<body>
    <div class="container">
        <h1>CERTIFICATES</h1>
        <!-- <ul>
            <li>
                <a href="http://localhost/Project_S8/login.php">
                    <i class="fa fa-sign-out" aria-hidden="true" style="width: 50px;;height:50px;"></i>
                </a>
            </li>
        </ul> -->
        <div class="excels">
        <table>
            <tbody class="file">
            <?php
                if($result1->num_rows > 0){ 
                    while($row = $result1->fetch_assoc()){ ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $row['name'];?></td>
                        </tr>
                        <tr>
                            <td><button onclick="downloadExcel()">Download Excel</button></td>
                        </tr>
                
                <?php }
                    }
                ?>   
            </tbody>
        </table>
        </div>
            <div class="pdf-grid">
                <?php
                    if($result->num_rows > 0){ 
                        while($row = $result->fetch_assoc()){ ?>
                            <div class="pdf-item">
                                <a href="http://localhost/Project_S8/images/<?php echo $row['filelink'];?>" target="_blank">
                                    <img src="images/pdf_icon.png" alt="<?php echo $data[2]; ?>">
                                </a>
                                <span style="color:#246c7d"><?php echo $row['filelink'];?></span>
                            </div>
                        <?php }
                    }
                ?>    
        </div>
    </div>
    <div class="container">
    <table class="table" > 
            <caption>CERTIFICATES AND POINTS</caption>
            <tr>
                <th>Sl. No</th>
                <th>Category</th>
                <th>Points</th>
            </tr>
            <tr>
                <td>1</td>
                <td>N C C </td>
                <td><?php echo $value[1];?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>N S S </td>
                <td><?php echo $value[2];?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Sports</td>
                <td><?php echo $value[3];?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Games</td>
                <td><?php echo $value[4];?></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Music</td>
                <td><?php echo $value[5];?></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Performing arts</td>
                <td><?php echo $value[6];?></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Literary arts</td>
                <td><?php echo $value[7];?></td>
            </tr>
            <tr>
                <td>8</td>
                <td>Tech Fest, Tech Quiz</td>
                <td><?php echo $value[8];?></td>
            </tr>
            <tr>
                <td>9</td>
                <td>MOOC</td>
                <td><?php echo $value[9];?></td>
            </tr>
            <tr>
                <td>10</td>
                <td>Competitions conducted by Professional Societies - (IEEE, IET, ASME, SAE, NASA etc.) </td>
                <td><?php echo $value[10];?></td>
            </tr>
            <tr>
                <td>11</td>
                <td>Attending Full time Conference/Seminars/Exhibitions/Workshop/STTP conducted at IITs/NITs </td>
                <td><?php echo $value[11];?></td>
            </tr>
            <tr>
                <td>12</td>
                <td>Paper presentation/publication at IITs/NITs </td>
                <td><?php echo $value[12];?></td>
            </tr>
            <tr>
                <td>13</td>
                <td>Poster Presentation at IITs /NITs </td>
                <td><?php echo $value[13];?></td>
            </tr>
            <tr>
                <td>14</td>
                <td>Industrial Training/ Internship</td>
                <td><?php echo $value[14];?></td>
            </tr>
            <tr>
                <td>15</td>
                <td>Industrial/Exhibition visits </td>
                <td><?php echo $value[15];?></td>
            </tr>
            <tr>
                <td>16</td>
                <td>Foreign Language Skill (TOFEL/IELTS/BEC exams etc.) </td>
                <td><?php echo $value[16];?></td>
            </tr>
            <tr>
                <td>17</td>
                <td>Start-up Company Registered legally </td>
                <td><?php echo $value[17];?></td>
            </tr>
            <tr>
                <td>18</td>
                <td>Patent-Filed </td>
                <td><?php echo $value[18];?></td>
            </tr>
            <tr>
                <td>19</td>
                <td>Patent - Published </td>
                <td><?php echo $value[19];?></td>
            </tr>
            <tr>
                <td>20</td>
                <td>Patent- Approved </td>
                <td><?php echo $value[20];?></td>
            </tr>
            <tr>
                <td>21</td>
                <td>Patent- Licensed</td>
                <td><?php echo $value[21];?></td>
            </tr>
            <tr>
                <td>22</td>
                <td>Prototype developed and tested </td>
                <td><?php echo $value[22];?></td>
            </tr>
            <tr>
                <td>23</td>
                <td>Awards for Products developed</td>
                <td><?php echo $value[23];?></td>
            </tr>
            <tr>
                <td>24</td>
                <td>Innovative technologies developed and used by industries/users</td>
                <td><?php echo $value[24];?></td>
            </tr>
            <tr>
                <td>25</td>
                <td>Got venture capital funding for innovative ideas/products. </td>
                <td><?php echo $value[25];?></td>
            </tr>
            <tr>
                <td>26</td>
                <td>Startup Employment </td>
                <td><?php echo $value[26];?></td>
            </tr>
            <tr>
                <td>27</td>
                <td>Societal innovations</td>
                <td><?php echo $value[27];?></td>
            </tr>
            <tr>
                <td>28</td>
                <td>Student Professional Societies (IEEE,IET,ASME,SAE,NASA etc.) </td>
                <td><?php echo $value[28];?></td>
            </tr>
            <tr>
                <td>29</td>
                <td>College Association Chapters </td>
                <td><?php echo $value[29];?></td>
            </tr>
            <tr>
                <td>30</td>
                <td>Festival & Technical Events (College approved) </td>
                <td><?php echo $value[30];?></td>
            </tr>
            <tr>
                <td>31</td>
                <td>Hobby Clubs </td>
                <td><?php echo $value[31];?></td>
            </tr>
            <tr>
                <td>32</td>
                <td>Special Initiatives (Approval from College and University is mandatory) </td>
                <td><?php echo $value[32];?></td>
            </tr>
            <tr>
                <td>33</td>
                <td>Elected student representatives </td>
                <td><?php echo $value[33];?></td>
            </tr>
            <tr>
                <th colspan="2">Total Points</th>
                <th><?php echo $value[34];?></th>
            </tr>
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
