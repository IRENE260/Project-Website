<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/Student/homepage.php');
    exit;
}
$con=mysqli_connect("localhost","root","","apoint");
if($con)
{
        $id=$_SESSION['user_id'];
		$sql1="select * from files where sid='$id' and status='Not Verified'";
		$res=mysqli_query($con,$sql1);
        $value=mysqli_fetch_all($res);
        $sql2="select * from files where sid='$id' and status='Verified'";	
        $res2=mysqli_query($con,$sql2);
        $value2=mysqli_fetch_all($res2);
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

    <!--Upload button-->
    <button class="upload" role="button" onclick="location.href = 'supload.php';">
    <span class="text">Upload</span>
    </button>
   
    <!-- Tables Start -->
    <div class="table-container"> 
        <div class="t">
        <table class="table"> 
            <caption><b>UPLOADED CERTIFICATES</b></caption>
            <?php if ($value ==null){?>
                <tr>
                    <td>No files found...</td>
                </tr>
            <?php } 
            else{?>
            <tr>
                <th>FileName</th>
                <th>Points</th>
            </tr>
            <?php
             foreach($value as $data){?>
            <tr>
                <td><a href="view_pdf.php?file_id=<?php echo$data[0];?>" class="pdfa"><?php echo $data[2];?></a></td>
                <td><?php echo $data[3];?></td>
            </tr>
            <?php }} ?>
        </table> 
        </div>
        <div class="t">
        <table class="table"> 
            <caption><b>APPROVED CERTIFICATES</b></caption>
            <?php if ($value2 == null){?>
                <tr>
                    <td>No files found...</td>
                </tr>
            <?php } 
            else{?>
                <tr>
                    <th>FileName</th>
                    <th>Points</th>
                </tr>
            <?php
            foreach($value2 as $approved){?>
            <tr>
                <td><a href="view_pdf.php?file_id=<?php echo $approved[0];?>" class="pdfa"><?php echo $approved[2];?></a></td>
                <td><?php echo $approved[3];?></td>
            </tr>
            <?php }} ?>
        </table>
        </div> 
    </div>
    
    <!-- Tables End -->

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