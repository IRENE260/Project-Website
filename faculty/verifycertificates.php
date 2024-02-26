<?php
$userid=$_GET["userid"];
$con=mysqli_connect("localhost","root","","apoint");
// $sql="SELECT * from faculty where id='$userid'";
// $result = mysqli_query($con,$sql);
// $data = mysqli_fetch_array($result);

$sql = "SELECT DISTINCT sid FROM files WHERE status = 0";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Request Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: rgba(52, 152, 219, 0.8);
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        header:hover {
            background-color: rgba(52, 152, 219, 1);
        }

        .header-links {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .header-links:hover {
            color: #ecf0f1;
            transform: scale(1.1);
        }

        .container {
            width: 80%;
            margin: 20px auto;
            overflow: hidden;
        }

        .request-container {
            margin: 26px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
            display: flex;
            align-items: stretch;
        }
        .top-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }
        .bottom-line {
            text-align: center;
            padding: 10px;
        }
        .icon,
        .details,
        .student-details,
        .buttons {
            flex: 1;
            padding: 20px;
            text-align: center;
        }

        .icon {
            background-color: rgba(52, 152, 219, 0.8);
            color: #fff;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .icon i {
            font-size: 3em;
        }

        .details,
        .student-details {
            text-align: left;
        }

        .buttons {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            height: 100%; /* Adjusted to take full height */
        }

        .accept-button,
        .reject-button {
            padding: 10px;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            width: 75%; /* Adjusted width */
            height: 30%; /* Adjusted height */
        }

        .accept-button {
            background-color: #2ecc71;
            color: #fff;
        }

        .reject-button {
            background-color: #e74c3c;
            color: #fff;
        }

        h3 {
            margin-top: 0;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 1000px;
            height: 920px;
            overflow: auto;
            position: relative;
            text-align: center;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h1>Certificate Verification</h1>
        <div class="header-links">
            <a href="fhome.php?userid=".$userid>Home</a> |
            <a href="flogin.php">Logout</a>
        </div>
    </header>
    <?php
while ($row = mysqli_fetch_array($result)) {
    $sid = $row['sid'];
    $student_details_query = "SELECT * FROM student WHERE id = $sid";
    $student_details_result = mysqli_query($con, $student_details_query);
    $student_details = mysqli_fetch_array($student_details_result, MYSQLI_ASSOC);

    $student_name = $student_details['name'];
    // $current_points = $student_details['tpoints'];
    
    // Retrieve all id values for the current sid where status is 0
    $sql2 = "SELECT * FROM files WHERE sid = $sid AND status = 0";
    $result2 = mysqli_query($con, $sql2);
    $id_values = [];

    while ($row2 = mysqli_fetch_array($result2)) {
        $id_values[] = $row2['id'];
    }
$n = count($id_values) + 1;

    ?>
    <div class="container">
        <div class="request-container" >
        <!-- <div class="top-line"> -->
    <div class="name" style="flex: 1;"><h2><?php echo $student_name; ?></h2></div>
    <!-- <div class="details">
        <h3>Certificate Details</h3>
        <p>Category: Achievement</p>
        <p>Achievement: </p>
    </div>
    <div class="buttons">
        <button class="accept-button">Accept</button>
        <button class="reject-button">Reject</button>
    </div> -->
    <!-- </div> -->
<?php
foreach ($id_values as $id ) {
             // Fetch filelink for the current ID
    $pdfPathQuery = "SELECT * FROM files WHERE id = $id";
    $pdfPathResult = mysqli_query($con, $pdfPathQuery);
    $pdfPathRow = mysqli_fetch_array($pdfPathResult);
    $pdfPath = $pdfPathRow['filelink'];
?>
<!-- <div class="bottom-line"> -->
<div style=" display: flex; flex-direction: row;">
   <div class="icon" onclick="openModal('pdf-content-<?php echo $id; ?>')"><i class="far fa-file-pdf"></i></div>
<!-- </div> -->
<!-- Details section -->
<div class="details" style="flex: 1; text-align: left;">
                        <h3>Certificate Details</h3>
                        <p>Category: Achievement</p>
                        <p>Issue Date: 2022-02-15</p>
                    </div>
                    <!-- Buttons section -->
                    <div class="buttons" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between; align-items: flex-end;">
                        <button class="accept-button" onclick="acceptPdf(<?php echo $id; ?>)">Accept</button>
                        <button class="reject-button"onclick="rejectPdf(<?php echo $id; ?>)">Reject</button>
                    </div>
                </div>
<?php //} ?>
            <!-- <div class="icon"><i class="far fa-file-pdf"></i></div> -->
            
        </div>

    </div>
    <?php
//foreach ($id_values as $id ) {
    ?>
    <div id="pdf-content-<?php echo $id; ?>" class="modal" onclick="closeModal('pdf-content-<?php echo $id; ?>')">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('pdf-content-<?php echo $id; ?>')">&times;</span>
        <iframe src="<?php echo $pdfPath; ?>" width="100%" height="100%"></iframe>
    </div>
</div>
<?php
 }
}
 ?>

<!-- Modal overlay -->
<!-- <div id="pdf-content-1" class="modal" onclick="closeModal('pdf-content-1')">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('pdf-content-1')">&times;</span>
        <iframe src="<?php //echo $pdfPath ?>" width="100%" height="100%"></iframe>
    </div>
</div> -->

<!-- Additional modal overlay for the second PDF -->


<script>
    function openModal(modalId) {
        console.log()
        document.getElementById(modalId).style.display = "flex";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
    function rejectPdf() {
            // Handle PDF rejection logic here
            alert('PDF Rejected!');
            window.history.back();

            // closePdfModal();
        }

        function acceptPdf() {
            // Handle PDF acceptance logic here
            var pdfId = document.getElementById('pdfId').value;

            <?php
            // Update the status value to 1 for the specified PDF id in PHP
            $updateQuery = "UPDATE files SET status = 1 WHERE id = $pdfId";
            mysqli_query($con, $updateQuery);
            ?>
            alert('PDF Accepted!');
            window.history.back();

            // closePdfModal();
        }
</script>
</body>

</html>
