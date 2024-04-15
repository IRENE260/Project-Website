<?php
   $dbHost = 'localhost';
   $dbUser = 'root';
   $dbPass = '';
   $dbName = 'apoint';
   $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   session_start();
   $sql1="select id,name from faculty where college='".$_SESSION['college']."'and department='".$_SESSION['branch']."'";
   $res=mysqli_query($conn,$sql1);
   if($res){
   $value=mysqli_fetch_all($res);
   }
   else{
    $value=null;
   }
   if (isset($_POST['submit'])){

        $studentId = $_POST['sid'];
        $studentName = $_POST['sname'];
        $fId = $_POST['fid'];
        $requestText = $_POST['requestText'];
        $pdfName = $_FILES['file']['name'];
        $pdfTmp = $_FILES['file']['tmp_name'];
        $targetDir = 'uploads/';
        $targetFile = $targetDir . basename($pdfName);
        move_uploaded_file($pdfTmp, $targetFile);
        // Insert request into the database
        $sql2="insert into files(sid,filelink) values('$studentId','$pdfName')";
		mysqli_query($conn,$sql2);
        $new_id = mysqli_insert_id($conn);
        // var_dump($new_id);die;
        $sql = "insert into request (sid,fid,sname,fileid,request) VALUES ('$studentId','$fId','$studentName','$new_id','$requestText')";
        mysqli_query($conn,$sql);
		header("Location:/amcs/Student/scertificate.php");
		exit();
   }

   $conn->close();
   ?>
   <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Request</title>
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
    <link href="css/form_req.css" rel="stylesheet">
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
    <!-- REQUEST FORM START -->
    <div class="testbox">
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post"  enctype="multipart/form-data">
        <h1>Request Form</h1>
        <div class="item">
          <p>Faculty Name</p>
            <div class="city-item">
            <select name="fid" required>
                <option value="">Name</option>
                <?php if($value==null){?>
                <option value="">No faculty found</option>
                <?php } else{
                 foreach($value as $data){?>
                    <option value="<?php echo $data[0];?>"><?php echo $data[1];?></option>
                <?php }}?>
            </select>
          </div>
          <input type="hidden" name="sid" value="<?php echo $_SESSION['user_id']?>">
          <input type="hidden" name="sname" value="<?php echo $_SESSION['user_name']?>">
        </div>
        <div class="item">
          <p>Your Request</p>
          <textarea rows="10" name="requestText" required></textarea>
        </div>
        <div class="item">
            <input type="file" name="file" id="file" value="Select file"required >
        </div>
        <div class="btn-block">
          <button type="submit" name="submit">SEND</button>
        </div>
      </form>
    </div>
    <!-- REQUEST FORM ENDS -->
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <footer><p style="color:red;font-size: 20px;">**Event not found / Name mismatch occured...please upload file to request for concerned Faculty...Point will be shown only after approval from Faculty</p></footer>
</body>

</html>