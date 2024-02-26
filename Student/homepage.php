<?php
$today=new DateTime('now');
$today=$today->format('Y-m-d');
$con=mysqli_connect("localhost","root","","apoint");
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/Student/sls.php');
    exit;
}
if($con)
{
    $sql="select * from student where id=".$_SESSION['user_id'];
	$res=mysqli_query($con,$sql);
	$value=mysqli_fetch_array($res);
    $_SESSION['user_name']=$value['name'];
    $_SESSION['dob']=$value['dob'];
    $_SESSION['branch']=$value['branch'];
    $_SESSION['college']=$value['college'];
    $_SESSION['year']=$value['yearj'];
    $_SESSION['regno']=$value['regno'];
    $_SESSION['email']=$value['email'];
    $sql2="select tpoint from spoint where sid=".$_SESSION['user_id'];
    $res2=mysqli_query($con,$sql2);
    $value2=mysqli_fetch_array($res2);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Home</title>
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
         <h2 class="m-0 text-primary"><i class='fas fa-user-graduate' style='font-size:40px;'></i>&nbsp;<?php echo $value['name'];?></h2>
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
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/course-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown"></h5>
                                <h1 class="display-3 text-white animated slideInDown">Activity Metric Computation System</h1>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/course-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown"></h5>
                                <h1 class="display-3 text-white animated slideInDown">Activity Metric Computation System</h1>
                                 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="class3" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                            <a href="scertificate.php"><i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">CERTIFICATES</h5></a>
                    </div>
                </div>
                <div class="class3" data-wow-delay="0.3s">
                <div class="p-4">
                    <div class="service-item text-center pt-3">
                            <div role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $value2[0]?>"></div>
                            <a href="points.php"><h5 class="mb-3">POINTS</h5></a>
                    </div>
                </div></div>
                <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>
        </div>
    </div> 
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
  </body>

</html>