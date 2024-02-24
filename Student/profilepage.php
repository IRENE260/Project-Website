<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/homepage.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
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
    <link href="css/profilepage.css" rel="stylesheet">
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
                <a href="homepage.php" class="nav-item nav-link ">Home</a>
                <a href="profilepage.php" class="nav-item nav-link active">Profile</a>
                <a href="logout.html" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!--Details-->
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <div class="file btn btn-lg btn-primary"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5><?php echo $_SESSION['user_name'];?></h5>  
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Change Password"/>
                </div>
            </div>
           
            <div class="col-md-6">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
            
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $_SESSION['email'];?></p> <!-- Replace with actual email -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $_SESSION['dob'];?></p> <!-- Replace with actual date of birth -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Branch</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $_SESSION['branch'];?></p> <!-- Replace with actual branch -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>College</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $_SESSION['college'];?></p> <!-- Replace with actual college name -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Year Of Joining</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $_SESSION['year'];?></p> <!-- Replace with actual college name -->
                            </div>
                        </div>
                    </div>
                    <!-- ... (Continue updating other tab panes) ... -->
                </div>
            </div>
        </form>
    </div>

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