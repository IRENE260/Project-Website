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
   $sql = "SELECT * FROM request LEFT JOIN student ON request.sid=student.id where request.status='notverified'";
   $result = $conn->query($sql);

//    $res=mysqli_query($con,$sq);
    $row=mysqli_fetch_all($result);
    // var_dump($row);
    // die;

   if(isset($_POST['accept'])){
    $sid=$_POST['sid'];
    $fileid=$_POST['fileid'];
    //var_dump($sid);die;
    $category=$_POST['category'];
    $point=$_POST['point'];
    $np=0;
    $ntp=0;
    $sql1="SELECT $category,tpoint FROM spoint WHERE sid='$sid'";
    $result1 = mysqli_query($conn,$sql1);
    // var_dump($result1);die;
    $row1=mysqli_fetch_array($result1);
    // var_dump($row1);die;
    $np=$row1[0]+$point;
   
    $ntp=strval($row1[1]+$point);
    $sql2="update spoint set $category=$np,tpoint=$ntp where sid=$sid";
    $result2 = mysqli_query($conn,$sql2);
    $sql3="update request set category='$category',status='accepted' where fileid='$fileid'";
    $result3 = mysqli_query($conn,$sql3);
    $sql4="update files set event='$category',point='$point',status='accepted' where id='$fileid'";
    $result4 = mysqli_query($conn,$sql4);
    var_dump($result4);
    // mysqli_error($conn);die;
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
    <header class="header">
        <h1>Notification</h1>
        <div >
            <a class="navh" href="fhome.php">Home</a>
        </div>
    </header>
    <?php
                                foreach ($row as $data ) {
                            ?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <div class="container">
        <div class="request-container">
            <div class="icon" onclick="openModal('pdf-content-1')"><i class="far fa-file-pdf"></i></div>

            <!-- <div class="icon"><i class="far fa-file-pdf"></i></div> -->
            <div class="details">
                <h3>Certificate Details</h3>
                <p><select name="category" id="category" required>
                    <option value="" disabled selected>Category</option>
                    <option value="NCC">NCC</option>
                    <option value="NSS">NSS</option>
                    <option value="GAMES">GAMES</option>
                    <option value="ARTS">ARTS</option>
                    <option value="TECH FEST,TECH QUIZ">TECH FEST/TECH QUIZ</option>
                    <option value="MOOC">MOOC</option>
                    <option value="COMPETITIONS">COMPETITIONS</option>
                    <option value="WORKSHOP">WORKSHOP</option>
                    <option value="PAPER PRESENTATION/PUBLICATION">PAPER PRESENTATION/PUBLICATION</option>
                    <option value="POSTER PRESENTATION">POSTER PRESENTATION</option>
                    <option value="IV/EXHIBITION">IV/EXHIBITION</option>
                    <option value="INTERNSHIP">INTERNSHIP</option>
                    <option value="FOREIGN LANGUAGE SKILL">FOREIGN LANGUAGE SKILL</option>
                    <option value="START UP">START-UP</option>
                    <option value="PATENT FILED">PATENT FILED</option>
                    <option value="PATENT PUBLISHED">PATENT PUBLISHED</option>
                    <option value="PATENT APPROVED">PATENT APPROVED</option>
                    <option value="PATENT LICENSED">PATENT LICENSED</option>
                    <option value="PROTOTYPE DEVELOPED AND TESTED">PROTOTYPE DEVELOPED AND TESTED</option>
                    <option value="AWARDS FOR PRODUCTS DEVELOPED">AWARDS FOR PRODUCTS DEVELOPED</option>
                    <option value="INNOVATIVE TECHNOLOGIES">INNOVATIVE TECHNOLOGIES</option>
                    <option value="INNOVATIVE IDEAS/PRODUCTS">INNOVATIVE IDEAS/PRODUCTS</option>
                    <option value="STARTUP EMPLOYEMENT">STARTUP EMPLOYEMENT</option>
                    <option value="SOCIETAL INNOVATIONS">SOCIETAL INNOVATIONS</option>
                    <option value="CORE COORDINATOR">CORE COORDINATOR</option>
                    <option value="SUB COORDINATOR">SUB COORDINATOR</option>
                    <option value="CHAIRMAN">CHAIRMAN</option>
                    <option value="SECRETARY">SECRETARY</option>
                    <option value="COUNCIL MEMBERS">COUNCIL MEMBERS</option>
                    <option value="VOLUNTEER">	VOLUNTEER</option>
                </select></p>
                <p><input type="number" class="point" id="point" name="point" placeholder="Point" required></p>
                <p><input type="hidden" class="sid" id="sid" name="sid" value="<?php echo $data[0] ?>"></p>
                <p><input type="hidden" class="fileid" id="fileid" name="fileid" value="<?php echo $data[3] ?>"></p>
            </div>
            <?php
             $fsql="select filelink from files where id=".$data[3];
             $r=mysqli_query($conn,$fsql);
             $v=mysqli_fetch_array($r);
            //  var_dump($v);die;
             ?>
            <div class="student-details">
                <h3>Student Details</h3>
                <p>Name: <?php echo $data[2] ?></p>
                <p>Register No: <?php echo $data[10] ?></p>
                <p>Branch: <?php echo $data[12] ?></p>
                <p>Batch: <?php echo $data[11] ?></p>
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
        <iframe src="../Student/uploads/<?php echo $v[0] ?>" width="100%" height="100%"></iframe>
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