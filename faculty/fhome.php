<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/faculty/flogin.php');
    exit;
}
$userid=$_SESSION['user_id'];
$con=mysqli_connect("localhost","root","","apoint");
$sql2="SELECT * from faculty where id='$userid'";
$result = mysqli_query($con,$sql2);
$data = mysqli_fetch_array($result);
if(isset($_POST["editprofile"])){
    header("Location:/amcs/faculty/editprofile.php");
    echo mysqli_error($con);
}
$currentYear = (int)(new DateTime())->format('Y');

if (isset($_POST["submit"])) {
    // Retrieve dropdown values from POST data
    $_SESSION['yearj']  = $_POST['yearj'];
    $_SESSION['batch'] = $_POST['batch'];

    // Redirect to verifycertificates.php
    header("Location: verifycertificates.php");
    exit;
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
<style>
 .modal-overlay {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); / White with transparency /
            overflow: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); / Shadow effect /
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            width: 300px;
            margin: 0 auto;
        }
        .modal-dropdown {
            margin-bottom: 10px;
        }
</style>
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
                    </div>
                
        
                    <div class="container">
                    <div class="row">                        
                        <div class="item col-md-4">
                            <div class="tm-work-item-inner">
                                    <a href="#" style="text-decoration:none;" onclick="showModal(); return false;">
                                        <div class="icn"><i class="fas fa-2x fa-icons"></i></div>
                                        <h4>Verify Certificates</h4>
                                        <p>View and verify the certificates uploaded by students</p>
                                    </a>
                            </div>                        
                        </div>
                        <div class="item col-md-4 one">
                            <div class="tm-work-item-inner">
                                <a style="text-decoration:none;" href="frequest.php"> <div class="icn"><i class="fas fa-2x fa-tools"></i></div>
                                    <h4>Requests</h4>
                                    <p>Verify requests of unpopular events</p></a>
                            </div>
                        </div>
                        <div class="item col-md-4 two">
                            <div class="tm-work-item-inner">
                                <a style="text-decoration:none;" href="studentlist.php"> <div class="icn"><i class="fab fa-2x fa-phoenix-framework"></i></div>
                                    <h4>Students List</h4>
                                    <p>view detailed list of students with their current activity points</p></a>
									</div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

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
                                        <tr><th>Department</th><th><?php echo $data["department"] ?></th></tr>
                                        <tr><th></th><th></th></tr>
                                    </table>
                                    <!-- HTML !-->
      <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
<button class="button-91" role="button" name="editprofile">Edit Profile</button>  </form>
									</div>
                        </div>
                      
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
                                <li><a href="fhome.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                         
                                </ul>
                            </div>
   
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </main>
        <div class="modal-overlay" id="modalOverlay">
    <div class="modal-content">
        <h2>Enter Details</h2>

        <form id="dropdownForm" method="post" action="<?php $_SERVER['PHP_SELF']?>">
    <!-- Dropdowns -->
    <select class="modal-dropdown" id="dropdown1" name="yearj" required>
        <option value="" disabled selected>Select Year of Admission</option>
        <?php
        // Populate dropdown with years
        for ($year = 1996; $year <= $currentYear; $year++) {
            echo '<option value="' . $year . '">' . $year . '</option>';
        }
        ?>
    </select>
    <select class="modal-dropdown" id="dropdown2" name="batch" required>
        <option value="" disabled selected>Select Batch</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <!-- Add more options as needed -->
    </select>
    <!-- Submit Button --><br>
    <button type="submit" name="submit">View</button>
</form><br>
<form id="dropdownForm" method="post" action="">
    <button type="submit" name="back" onclick="loaction.href='fhome.php';">Back</button>
</form>
<?php
// Check if form is submitted

?>

    </div>
</div>
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
    function showModal() {
        document.getElementById('modalOverlay').style.display = 'block';
    }
    
    document.addEventListener("DOMContentLoaded", function() {
        // Get the Logout link element
        var logoutLink = document.querySelector('.navbar-nav .nav-item:last-child .nav-link');

        // Add click event listener
        logoutLink.addEventListener('click', function(event) {
            // Redirect the user to the login page
            window.location.href = "logout.html"; // Replace "login.html" with the actual URL of your login page
        });
    });
    // JavaScript to submit dropdown values and redirect
   
</script>