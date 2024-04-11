<?php
$userid=$_GET["userid"];
$studentid=$_GET["studentid"];
$con=mysqli_connect("localhost","root","","apoint");
		$sql1="select * from spoint where sid='$studentid'";
		$res=mysqli_query($con,$sql1);
        $value=mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Points</title>
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
                <a href="fhome.php?userid=<?php echo $userid; ?>" class="nav-item nav-link active">Home</a>
                <a href="flogin.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Tables Start -->
    <div class="table-container"> 
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
