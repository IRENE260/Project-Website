<?php
$userid=$_GET["userid"];
$con=mysqli_connect("localhost","root","","apoint");
$sql="SELECT * from faculty where id='$userid'";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_array($result);
$currentYear = (int)$today->format('Y');
// if(isset($_POST["applyfilter"])){
//     $branch = $_POST['branch'];
//     $year = $_POST['year'];
//     $sql2="SELECT * from student where branch='$branch' and yearj='$year'";
//     $result2 = mysqli_query($con, $sql2);
//     $data2 = mysqli_fetch_array($result2);

// }
?>
<!doctype html>
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

    .filter-result-table {
    margin-top: 20px auto;
    margin-left: 120px;
    width: 80%;
    border-collapse: collapse;
    background-color: rgba(255, 255, 255, 0.8); /* Set the background color to white with 80% opacity */
}

.filter-result-table th, .filter-result-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.filter-result-table th {
    background-color: #f2f2f2;
}

</style>
    <!--

Tooplate 2123 Simply Amazed

https://www.tooplate.com/view/2123-simply-amazed

-->
</head>

<body>
    <div id="outer">
         <!--<header class="header order-last" id="tm-header">
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
        </header>-->
        
        <!-- <button class="navbar-button collapsed" type="button">
            <span class="menu_icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button> -->
        
        
        <main id="content-boxl" class="order-first">
            <div class="banner-section section parallax-window" style="padding-top: 85px;" data-parallax="scroll" data-image-src="img/banner.jpg" id="section-1">
                <div class="container">
                    <div class="item">
                        <div class="bg-blue-transparent logo-fa"> Student List Management
                            <p text-indent: 26px;>View list of students along with their activity-point details...</p></div>
                        <!-- <div class="bg-blue-transparent simple"><p>Makes it easy for activity points management...</p></div> -->
                    </div>
                    <div class="filter-container">
                        <div class="filter-bar">
                            <select id="branch" name="branch">
                                <option value="" disabled selected>Select Branch</option>
                                <option value="branch1">CSE</option>
                                <option value="branch2">ECE</option>
                                <option value="branch1">EEE</option>
                                <option value="branch1">Mech.E</option>
                                <option value="branch1">EIE</option>
                                <option value="branch1">Civil</option>
                                <option value="branch1">MCA</option>
                                <!-- Add more options as needed -->
                            </select>
                            
                            <select id="year" name="year">
                                <option value="" disabled selected>Select Year of Admission</option>
                                <?php
    for ($year = 1980; $year <= $currentYear; $year++) {
        echo '<option value="' . $year . '">' . $year . '</option>';
    }
    ?>
                                <!-- Add more options as needed -->
                            </select>
                            <button onclick="applyFilter()" name="applyfilter">Apply Filter</button>
                        </div>
                        <form action="#" method="GET" class="search-form">
                            <input type="text" name="search" placeholder="Search..." />
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    
                <!-- <section class="work-section section" id="section-2"> -->
                  <!--  <div class="container">
                    <div class="row">                        
                        <div class="item col-md-4">
                            <div class="tm-work-item-inner">
                                     <figure class="effect-julia item">
                                        <img src="img/gallery-img-02.jpg" alt="Image" style="width: 200px; height: 200px;">
                                        <figcaption>
                                            <div>
                                                <p>Verification of certificates</p>
                                            </div>
                                           
                                        </figcaption>
                                    </figure> 
                                <a style="text-decoration:none;" href="#"><div class="icn"><i class="fas fa-2x fa-icons"></i></div>
                                    <h4>Verify Certificates</h4>
                                    <p>View and verify the certificates uploaded by students</p></a>
										 <a href="#"><i class="fa fa-long-arrow-right"></i></a> 
                            </div>                        
                        </div>
                        <div class="item col-md-4 one">
                            <div class="tm-work-item-inner">
                                <a style="text-decoration:none;" href="#"> <div class="icn"><i class="fas fa-2x fa-tools"></i></div>
                                    <h4>Requests</h4>
                                    <p>Verify requests of unpopular events</p></a>
                                 <a href="#"><i class="fa fa-long-arrow-right"></i></a> 
                            </div>
                        </div>
                         <div class="item col-md-4 two">
                            <div class="tm-work-item-inner">
                                <a style="text-decoration:none;" href="#"> <div class="icn"><i class="fab fa-2x fa-phoenix-framework"></i></div>
                                    <h4>Students List</h4>
                                    <p>view detailed list of students with their current activity points</p></a>
										
										 <a href="#"><i class="fa fa-long-arrow-right"></i></a> 
									</div>
                        </div> 
                    </div> -->
                    <!-- <div class="title">
                        <h2>Our Work</h2>
                    </div> -->
                    </div>
                </div>
            </div>
            <!-- </section> -->
            <!-- <section class="work-section section" id="section-2">
                <div class="container">
                    <div class="row">
                        <div class="item col-md-4">
                            <div class="tm-work-item-inner">
                                <div class="icn"><i class="fas fa-2x fa-images"></i></div>
                                <h3>Class.01 View Data</h3>
                                <p>Simply Amazed is free HTML template provided by Tooplate website. Please tell your friends about our website. Thank you.</p>
                            </div>                        
                        </div>
                        <div class="item col-md-4">
                            <div class="tm-work-item-inner">
                                <div class="icn"><i class="fas fa-2x fa-images"></i></div>
                                <h3>Class.01 View Data</h3>
                                <p>Simply Amazed is free HTML template provided by Tooplate website. Please tell your friends about our website. Thank you.</p>
                            </div>                        
                        </div>
                        <div class="item col-md-4">
                            <div class="tm-work-item-inner">
                                <div class="icn"><i class="fas fa-2x fa-images"></i></div>
                                <h3>Class.01 View Data</h3>
                                <p>Simply Amazed is free HTML template provided by Tooplate website. Please tell your friends about our website. Thank you.</p>
                            </div>                        
                        </div>
                    </div>
                    
                </div>
            </section> -->
            <!-- <section class="gallery-section section parallax-window" data-parallax="scroll" data-image-src="img/section-3-bg.jpg" id="section-3">
                <div class="container">
                    <div class="title text-right">
                        <h2>Our Gallery</h2>
                    </div>
                    <div class="mx-auto gallery-slider">
                        <figure class="effect-julia item">
                            <img src="img/banner.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-02.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-03.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-04.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-05.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-06.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-07.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-08.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                        <figure class="effect-julia item">
                            <img src="img/gallery-img-09.jpg" alt="Image">
                            <figcaption>
                                <div>
                                    <p>Julia dances in the deep dark</p>
                                </div>
                                <a href="#">View more</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </section> -->
            <!-- <section id="section-3">
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
        </section> -->
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
    <script>
        function applyFilter() {
            // Get the values from the filter inputs
            var branch = document.getElementById("branch").value;
            var year = document.getElementById("year").value;
    
            // Check if both inputs are filled
            if (branch && year) {
                <?php
                     $sql2="SELECT * from student where branch='$branch' and yearj='$year'";
                     $result2 = mysqli_query($con, $sql2);
                     $data2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
                ?>
                // Create a table element
                var table = document.createElement("table");
                table.classList.add("filter-result-table");
    
                // Create a table row for the header
                var headerRow = table.insertRow();
                var profileHeader = headerRow.insertCell(0);
                var pointsHeader = headerRow.insertCell(1);
                var buttonHeader = headerRow.insertCell(2);
    
                profileHeader.innerHTML = "<b>Profile</b>";
                pointsHeader.innerHTML = "<b>Current Points</b>";
                buttonHeader.innerHTML = "<b>Action</b>";
    
                // Create a table row for the data
                for (var i = 0; i < data2.length; i++) {
                    var dataRow = table.insertRow();
            
                    var nameCell = dataRow.insertCell(0);
                    nameCell.innerHTML = data2[i]['name'];

                    var pointsCell = dataRow.insertCell(1);
                    pointsCell.innerHTML = data2[i]['tpoints'];

                    var buttonCell = dataRow.insertCell(2);
                    buttonCell.innerHTML = "<button onclick='viewDetails()'>View Details</button>";
                }
                
                // Append the table to the document body
                document.body.appendChild(table);
            } else {
                alert("Please fill in both Branch and Year inputs.");
            }
        }
    
        function viewDetails() {
            // Replace this function with the action you want when the button is clicked
            alert("View Details button clicked!");
        }
    </script>
    
</body>
</html>
