<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/faculty/flogin.php');
    exit;
}
$userid=$_SESSION['user_id'];
$con=mysqli_connect("localhost","root","","apoint");
// $sql="SELECT * from faculty where id='$userid'";
// $result = mysqli_query($con,$sql);
// $data = mysqli_fetch_array($result);

$sql = "SELECT DISTINCT sid FROM files WHERE status = 'notverified'";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Certificate</title>
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('img/bimg.jpg'); /* Replace 'your_background_image.jpg' with the path to your image */
    background-size: cover; /* Cover the entire background */
    background-repeat: no-repeat; /* Prevent background image from repeating */
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }
        .modal-header {
    padding: 10px 20px; /* Adjust padding as needed */
}

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            transition: box-shadow 0.3s ease-in-out;
            background-color: #fff; /* White background color for container */
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pdf-icon {
            margin: 10px;
            flex: 0 0 calc(25% - 20px); /* Adjust width and margin between icons */
            text-align: center;
            cursor: pointer;
        }

        .pdf-icon i {
            font-size: 50px; /* Adjust icon size as needed */
            color: #333; /* Adjust icon color */
        }

        .pdf-icon i:hover {
            color: blue; /* Change color on hover */
        }

        .student-info {
            width: 100%;
            text-align: left;
            margin-bottom: 20px;
        }

        .student-info p {
            margin: 10px 0;
        }

        .button-container {
    text-align: right; /* Align buttons to the left */
}
.details-container {
            position: absolute;
            bottom: 5px;
            left: 20px; /* Adjust the left position */
        }

        .details-container p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Verify Certificate</h1>
    <div>
        <a href="fhome.php">Home</a>
    </div>
</div>
<?php
while ($row = mysqli_fetch_array($result)) {
    $sid = $row['sid'];
    $student_details_query = "SELECT * FROM student WHERE id = $sid";
    $student_details_result = mysqli_query($con, $student_details_query);
    $student_details = mysqli_fetch_array($student_details_result, MYSQLI_ASSOC);

    $student_name = $student_details['name'];
    // $current_points = $student_details['tpoints'];
    
    // Retrieve all id values for the current sid where status is 0
    $sql2 = "SELECT * FROM files WHERE sid = $sid AND status = 'notverified'";
    $result2 = mysqli_query($con, $sql2);
    $id_values = [];

    while ($row2 = mysqli_fetch_array($result2)) {
        $id_values[] = $row2['id'];
    }
    ?>
<div class="container">

    <div class="student-info">
        <p><strong>Name:</strong> <?php echo $student_name; ?></p>
        <p><strong>Register Number:</strong>  <?php echo $student_details['regno']; ?></p>
        <!-- <p><strong>Current Total Points:</strong>  <?php //echo $student_details['name']; ?></p> -->
    </div>

    <?php

foreach ($id_values as $id ) {
             // Fetch filelink for the current ID
    $pdfPathQuery = "SELECT * FROM files WHERE id = $id";
    $pdfPathResult = mysqli_query($con, $pdfPathQuery);
    $pdfPathRow = mysqli_fetch_array($pdfPathResult);
    $link='../Student/uploads/';
    $pathlink = $pdfPathRow['filelink'];
    $points = $pdfPathRow['point'];
    $event = $pdfPathRow['event'];
    $fileid=$id;
    // var_dump($pdfPath);die;
    echo '<div class="pdf-icon" onclick="openPdfModal(\''. $link . $pathlink . '\', ' . $fileid . ', \'' . $event . '\', \'' . $points . '\')">';
    echo '<i class="fas fa-file-pdf"></i>'; // Font Awesome icon wrapped in anchor tag
        echo '</div>';
    }
    ?>

</div>

<!-- PDF Modal -->
<div class="modal" id="pdfModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">PDF Viewer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <iframe id="pdfFrame" src="" width="100%" height="500px" frameborder="0"></iframe>
                <!-- Buttons container -->
                <!-- Buttons container -->
<div class="button-container mt-3">
<form id="statusForm" method="post">
    <button type="submit" name="accepted" value="accepted" class="btn btn-success">Accept</button>
    <button type="submit" name="rejected" value="rejected" class="btn btn-danger" data-dismiss="modal">Reject</button>
    <input type="hidden" id="fileid" name="fileid" value="">
</form>

</div>

                <div class="details-container">
                    <p><strong>Allowable Points:</strong><span id="points"></p>
                    <p><strong>Category:</strong>  <span id="event"></p>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
//  }
}
 ?>
<script>
    function openPdfModal(path,fileid,event,points) {
        // Set the src attribute of the iframe to the PDF path
        document.getElementById("pdfFrame").src = path;
        document.getElementById("fileid").value = fileid;
        // Set the event and points in the modal
    document.getElementById("event").innerText = event;
    document.getElementById("points").innerText = points;
        // Open the modal
        $('#pdfModal').modal('show');
    }

</script>

</body>
</html>
<?php
// Assuming you have already established a database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if fileid and status are set in the POST request
    if (isset($_POST['fileid'], $_POST['rejected'])) {
        // Retrieve fileid and status from the POST request
        $fileid = $_POST['fileid'];
        $status = $_POST['rejected'];
        // Update the status in the 'files' table
        $sqlf = "UPDATE files SET status = '$status' WHERE id = '$fileid'";
        $stmt = $con->prepare($sqlf);
        mysqli_query($con,$sqlf);
        //echo '<script>window.location.reload();</script>';

    }
    if (isset($_POST['fileid'], $_POST['accepted'])) {
        // Retrieve fileid and status from the POST request
        $fileid = $_POST['fileid'];
        $status = $_POST['accepted'];
        // Update the status in the 'files' table
        $sqlf = "UPDATE files SET status = '$status' WHERE id = '$fileid'";
        $stmt = $con->prepare($sqlf);
        mysqli_query($con,$sqlf);

        $sqls="SELECT sid,event,point from files where id='$fileid'";
        $result3 = mysqli_query($con,$sqls);
        $value3=mysqli_fetch_array($result3);

        $sqls1="SELECT ".$value3[2]." from spoint where sid=".$value3[0];
        $result4 = mysqli_query($con,$sqls1);
        $value4=mysqli_fetch_array($result4);
        $newpoint=$value4[0]+$value3[2];

        $sqls2="SELECT maxpoint from points where events=".$value3[1];
        $result5 = mysqli_query($con,$sqls2);
        $value5=mysqli_fetch_array($result5);
        if($newpoint>=$value5[0]){
            $newpoint=$value5[0];
        }
        $sqlu="update spoint set ".$value3[1]."=".$value3[2]." where sid=".$value3[0];
        $result6=mysqli_query($con,$sqlu);
        //echo '<script>window.location.reload();</script>';


        $tableName = "spoint";


$query = "SELECT COLUMN_NAME
          FROM INFORMATION_SCHEMA.COLUMNS
          WHERE TABLE_NAME = '$tableName' AND COLUMN_NAME <> 'sid' AND COLUMN_NAME <> 'tpoint'";


$tp = mysqli_query($con, $query);


if ($tp) {
    $tpu = "UPDATE $tableName SET total_point = ";
    
    
    while ($rowu = mysqli_fetch_assoc($tp)) {
        $columnName = $rowu['COLUMN_NAME'];
        $tpu .= "COALESCE($columnName, 0) + ";
    }
    
    
    $tpu = rtrim($tpu, " + ");
    
    
    $tpu .= ";";
    $tp1=mysqli_query($con, $tpu);
    
} 

    }
}

?>