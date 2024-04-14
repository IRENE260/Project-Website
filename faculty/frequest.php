<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/faculty/flogin.php');
    exit;
}

   $dbHost = 'localhost';
   $dbUser = 'root';
   $dbPass = '';
   $dbName = 'apoint';
   $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   // Fetch student requests
   $sql = "SELECT * FROM request LEFT JOIN student ON request.sid=student.id ";
   $result = $conn->query($sql);

//    $res=mysqli_query($con,$sq);
    $row=mysqli_fetch_all($result);
    // var_dump($row);
    // die;

//    $conn->close();
   if(isset($_POST['accept'])){
    $sid=$_POST['sid'];
    $category=$_POST['category'];
    $point=$_POST['point'];
    $np=0;
    $ntp=0;
    $sql1="SELECT $category,tpoint FROM spoint WHERE sid=$sid";
    $result1 = $conn->query($sql1);
    $row1=mysqli_fetch_array($result1);
        $np=strval($row1[0]+$point);
        // var_dump($np);die;
        $ntp=strval($row1[1]+$point);
    $sql2="update spoint set $category=:np where sid='1'";
    $result2 = mysqli_query($conn,$sql2);
    var_dump($result2);die;
    // mysqli_query($conn,"update spoint set $category='$np' and tpoint='$ntp' where sid='1'");
    // mysqli_query($con,"insert into faculty(name,uid,college,email,password) values('$name','$uid','$college','$email','$password')");
   }
   ?>

   






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Request Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/fstyles.css">
</head>

<body>
    <header>
        <h1>Notification</h1>
        <div class="header-links">
            <a href="fhome.php">Home</a> |
            <a href="flogin.php">Logout</a>
        </div>
    </header>
    <?php
                                foreach ($row as $data ) {
                            ?>
    <form action="frequest.php" method="post">
    <div class="container">
        <div class="request-container">
            <div class="icon" onclick="openModal('pdf-content-1')"><i class="far fa-file-pdf"></i></div>

            <!-- <div class="icon"><i class="far fa-file-pdf"></i></div> -->
            <div class="details">
                <h3>Certificate Details</h3>
                <p><select name="category" id="category" >
                    <option value="" disabled selected>Category</option>
                    <option value="ncc">NCC</option>
                    <option value="nss">NSS</option>
                    <option value="sports">Sports</option>
                    <option value="games">Games</option>
                    <option value="music">Music</option>
                    <option value="part">Performing arts</option>
                    <option value="lart">Literary arts</option>
                    <option value="techf_q">Tech Fest/Quiz</option>
                    <option value="mooc">MOOC</option>
                    <option value="competition">Competitions conducted by Professional Societies</option>
                    <option value="sew_iit">Conference/Seminars/Exhibitions/Workshop/ STTP conducted at IITs/NITs</option>
                    <option value="pp_iit">Paper presentation/publication at IITs/NITs</option>
                    <option value="pop_iit">Poster Presentation at IITs /NITs</option>
                    <option value="internship">Industrial Training/Internship</option>
                    <option value="iv">Industrial visits</option>
                    <option value="fls">Foreign Language Skill</option>
                    <option value="company">Start-up Company–Registered legally</option>
                    <option value="patentf">Patent-Filed</option>
                    <option value="patentp">Patent-Published</option>
                    <option value="patenta">Patent-Approved</option>
                    <option value="patentl">Patent-Licensed</option>
                    <option value="prototype">Prototype developed and tested</option>
                    <option value="award">Awards for Products developed</option>
                    <option value="innovative_t">Innovative technologies developed and used by industries/users</option>
                    <option value="innovative_c">Got venture capital funding for innovative ideas/products.</option>
                    <option value="employment">Startup Employment</option>
                    <option value="societal_innovation">Societal innovations</option>
                    <option value="ieee">Student Professional Societies</option>
                    <option value="cac">College Association Chapters</option>
                    <option value="tech_fest">Festival & Technical Events</option>
                    <option value="club">Hobby Clubs</option>
                    <option value="	initiatives">Special Initiatives</option>
                    <option value="rep">Elected student representatives</option>
                </select></p>
                <p><input type="number" class="point" id="point" name="point" placeholder="Point"></p>
                <p><input type="hidden" class="sid" id="sid" name="sid" value="<?php echo $data[0] ?>"></p>
            </div>
            <div class="student-details">
                <h3>Student Details</h3>
                <p>Name: <?php echo $data[2] ?></p>
                <p>Register No: <?php echo $data[11] ?></p>
                <p>Branch: <?php echo $data[12] ?></p>
            </div>
            <div class="buttons">
                <button class="accept-button" name="accept" value="accept">Accept</button>
                <button class="reject-button" name="reject">Reject</button>
            </div>
        </div>
    </div>
    </form>
    
    
<!-- Modal overlay -->
<div id="pdf-content-1" class="modal" onclick="closeModal('pdf-content-1')">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('pdf-content-1')">&times;</span>
        <iframe src="<?php echo $data[4] ?>" width="100%" height="100%"></iframe>
    </div>
</div>
<?php
                                }
                            ?>


<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "flex";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
</script>
</body>

</html>