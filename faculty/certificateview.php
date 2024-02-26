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
                            <td><button onclick="window.location.href = 'Project_S8/login.php';">Excel Sheet</button></td>
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
</body>
</html>
