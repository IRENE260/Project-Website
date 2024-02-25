<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/Project_S8/certificateview.php');
    exit;
}
$con=mysqli_connect("localhost","root","","apoint");
if($con)
{
 
        $sql1="select * from files where status='Not Verified'";
        $result =$con->query($sql1); 

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
    <link rel="stylesheet" href="bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="all.min.css" type="text/css" /> 
    <link rel="stylesheet" href="slick.css" type="text/css" />   
    <link rel="stylesheet" href="tooplate-simply-amazed.css" type="text/css" />
    <style>
        body {
            background-image: url("images/i2.jpg"); 
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
            font-size: 50px;
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
            justify-items: center;
            margin-top: 20px;
        }
        .pdf-item img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header order-last" id="tm-header">
            <nav class="navbar">
                <div class="collapse navbar-collapse single-page-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#section-1"><span class="icn"><i class="fab fa-2x fa-battle-net"></i></span>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#section-2"><span class="icn"><i class="fas fa-2x fa-id-card"></i></span> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#section-3"><span class="icn"><i class="fas fa-2x fa-air-freshener"></i></span> Quick Links</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span class="icn"><i class="fas fa-2x fa-sign-out-alt"></i></span> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <h1>CERTIFICATES</h1>
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
