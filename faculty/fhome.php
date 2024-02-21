<?php
$userid=$_GET["userid"];
$con=mysqli_connect("localhost","root","","apoint");
$sql2="SELECT * from faculty where email='$email' and password='$password'";
$result = mysqli_query($con,$sql2);
$data = mysqli_fetch_array($result);
if(isset($_POST["editprofile"])){
    header("Location:/activity_monitor/editprofile.php?userid=".$userid);
    echo mysqli_error($con);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Automated Activity Metric Computation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css" /> 
    <link rel="stylesheet" href="css/slick.css" type="text/css" />   
    <link rel="stylesheet" href="css/tooplate-simply-amazed.css" type="text/css" />
<!--

Tooplate 2123 Simply Amazed

https://www.tooplate.com/view/2123-simply-amazed

-->
</head>

<body>
    <div id="outer">
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
        
        <button class="navbar-button collapsed" type="button">
            <span class="menu_icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button>
        
        <main id="content-box" class="order-first">
            <div class="banner-section section parallax-window" data-parallax="scroll" data-image-src="img/section-1-bg.jpg" id="section-1">
                <div class="container">
                    <div class="item">
                        <div class="bg-blue-transparent logo-fa"><span><i class="fas fa-2x fa-atom"></i></span> Automated Activity Computation Metric System
                            <p text-indent: 26px;>Makes it easy for activity points management...</p></div>
                        <!-- <div class="bg-blue-transparent simple"><p>Makes it easy for activity points management...</p></div> -->
                    </div>
                
        
                <!-- <section class="work-section section" id="section-2"> -->
                    <div class="container">
                    <div class="row">                        
                        <div class="item col-md-4">
                            <div class="tm-work-item-inner">
                                    <!-- <figure class="effect-julia item">
                                        <img src="img/gallery-img-02.jpg" alt="Image" style="width: 200px; height: 200px;">
                                        <figcaption>
                                            <div>
                                                <p>Verification of certificates</p>
                                            </div>
                                           
                                        </figcaption>
                                    </figure> -->
                                <a style="text-decoration:none;" href="#"><div class="icn"><i class="fas fa-2x fa-icons"></i></div>
                                    <h4>Verify Certificates</h4>
                                    <p>View and verify the certificates uploaded by students</p></a>
										<!-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> -->
                            </div>                        
                        </div>
                        <div class="item col-md-4 one">
                            <div class="tm-work-item-inner">
                                <a style="text-decoration:none;" href="request.php?userid=".$userid> <div class="icn"><i class="fas fa-2x fa-tools"></i></div>
                                    <h4>Requests</h4>
                                    <p>Verify requests of unpopular events</p></a>
                                <!-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> -->
                            </div>
                        </div>
                        <div class="item col-md-4 two">
                            <div class="tm-work-item-inner">
                                <a style="text-decoration:none;" href="studentlist,php?userid=".$userid> <div class="icn"><i class="fab fa-2x fa-phoenix-framework"></i></div>
                                    <h4>Students List</h4>
                                    <p>view detailed list of students with their current activity points</p></a>
										
										<!-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> -->
									</div>
                        </div>
                    </div>
                    <!-- <div class="title">
                        <h2>Our Work</h2>
                    </div> -->
                    </div>
                </div>
            </div>
            <!-- </section> -->

            <section class="gallery-section section parallax-window" data-parallax="scroll" data-image-src="img/section-3-bg.jpg" id="section-2">
                <div class="container">
                    <div class="title text-left">
                        <h2>Profile</h2>
                    </div>
                    <div class="mx-auto gallery-slider">
                        <figure class="effect-julia item">
                            <img src="img/profile.jpg" alt="Image" style="width:100%; height:100%;">
                            <figcaption>
                                <div>
                                    <p>Profile</p>
                                </div>
                                <a href="#">Go now -></a>
                            </figcaption>
                        </figure>
                        <div class="item col-md-4 two">
                            <div class="tm-work-item-inner">
                                 
                                    <table style="text-align: center;width: 200%; margin-left: -170px;">
                                        <tr>
                                            <th>Name:</th><th><?php echo $data["name"] ?></th>
                                        </tr>
                                        <tr>
                                            <th>Email:</th><th><?php echo $data["email"] ?></th>
                                        </tr>
                                        <tr>
                                            <th>College:</th><th><?php echo $data["college"] ?></th>
                                        </tr>
                                        <tr>
                                            <th>University Id:</th><th><?php echo $data["uid"] ?></th>
                                        </tr>
                                        <tr><th></th><th></th></tr>
                                        <tr><th></th><th></th></tr>
                                    </table>
                                    <!-- HTML !-->
      <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
<button class="button-91" role="button" name="editprofile">Edit Profile</button>  </form>
                                    <!-- <a style="text-decoration:none"; href="#">edit profile</a> -->

										<!-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> -->
									</div>
                        </div>
                        <!-- <figure class="effect-julia item">
                            <img src="img/gallery-img-02.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Identify requests for unpopular event</p>
                                </div>
                                <a href="#">Go now -></a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-03.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>View student list</p>
                                </div>
                                <a href="#">Go now -></a>
                            </figcaption>
                        </figure>
                      -->
                    </div>
                </div>
            </section>
            <section id="section-3">
            <div class="container" style="background-color: #6699cc;">
                <div class="row set-row-pad"  >
                    <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 " data-scroll-reveal="enter from the bottom after 0.4s">
   
                        <div class="title">
                            <h2>Quick Links</h2>
                        </div>           
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                         
                                </ul>
                            </div>
   
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <!-- <section class="contact-section section" id="section-4" >
                <div class="container">
                    <div class="title">
                        <h2>Quick Links</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <ul>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                 <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li> 
                                 <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Cases</a></li> 
                                 <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Other Links</a></li>	 
                            </ul>
                        </div>
                        
                        <div class="col-lg-3 col-md-12 map">
                            <div class="map-outer tm-mb-40">
                                <div class="gmap-canvas">
                                    <iframe width="100%" height="400" id="gmap-canvas"
                                    src="img/section-1-bg.jpg"
                                                                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
                
            </section> -->
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
