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
 
        $sql1="select * from files where status='accepted'";
        $result =$con->query($sql1);
        $sql3="select * from files where status='rejected'";
        $result3 =$con->query($sql3);

        $studentid=$_GET["studentid"];
        // $name=$_POST['name']
        $sql2="select * from student where id=$studentid";
        //$sql2="select * from student where name='Anna'";
        $result1 =$con->query($sql2);
        // print_r($result1);die;
        $userid=$_GET['userid'];
		$sql1="select * from spoint where sid='$userid'";
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
    <style>
        body {
            background-image: url("img/i3.jpg"); 
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
            max-width: 30%;
            height: auto;
        }
        .excels{
            border-style: solid;
            border-color: lightblue;
            width: 300px;
            height: 150px;
            color:darkblue;
            margin:auto;
            font-size: 40px;
        }
        /* .button{
            font-size: 40px;
        } */

        /* .file{
            padding-top:5px;

        } */
        .table{
            display:none;
        }
        h1{
            font-size : 60px;
            text-align : left;
        }
    </style>
</head>
<body>
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
                            <td><button><a href="pointsview.php?userid=<?php echo $userid; ?>&studentid=<?php echo $studentid; ?>">View Points Achieved..</a> </button></td>
                            <!-- <td><button onclick="downloadExcel()">Download Excel</button></td> -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>                        
                        </tr>
                <?php }
                }
                ?>   
            </tbody>
        </table>
</div>
    <div class="container">
        <h1>ACCEPTED CERTIFICATES</h1>
        <!-- <ul>
            <li>
                <a href="http://localhost/Project_S8/login.php">
                    <i class="fa fa-sign-out" aria-hidden="true" style="width: 50px;;height:50px;"></i>
                </a>
            </li>
        </ul> -->
        
            <div class="pdf-grid">
                <?php
                    if($result->num_rows > 0){ 
                        while($row = $result->fetch_assoc()){ ?>
                            <div class="pdf-item">
                                <a href="http://localhost/activity_monitor/img/<?php echo $row['filelink'];?>" target="_blank">
                                    <img src="img/pdf_icon.png" alt="<?php echo $data[2]; ?>">
                                </a>
                                <span style="color:#246c7d"><?php echo $row['filelink'];?></span>
                            </div>
                        <?php }
                    }
                ?>    
        </div>
    </div>
    <div class="container">
        <h1>REJECTED CERTIFICATES</h1>
        <!-- <ul>
            <li>
                <a href="http://localhost/Project_S8/login.php">
                    <i class="fa fa-sign-out" aria-hidden="true" style="width: 50px;;height:50px;"></i>
                </a>
            </li>
        </ul> -->
        
            <div class="pdf-grid">
                <?php
                    if($result3->num_rows > 0){ 
                        while($row3 = $result3->fetch_assoc()){ ?>
                            <div class="pdf-item">
                                <a href="http://localhost/activity_monitor/img/<?php echo $row3['filelink'];?>" target="_blank">
                                    <img src="img/pdf_icon.png" alt="<?php echo $data[2]; ?>">
                                </a>
                                <span style="color:#246c7d"><?php echo $row3['filelink'];?></span>
                            </div>
                        <?php }
                    }
                ?>    
        </div>
    </div>
    
</body>
</html>
