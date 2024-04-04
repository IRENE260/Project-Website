<?php
$userid=$_GET["userid"];
$con=mysqli_connect("localhost","root","","apoint");
// $sql="SELECT * from faculty where id='$userid'";
// $result = mysqli_query($con,$sql);
// $data = mysqli_fetch_array($result);

$sql = "SELECT DISTINCT sid FROM files WHERE status = 'notvisited'";
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
        <a href="fhome.php?userid=<?php echo $userid; ?>">Home</a>
        <a href="flogin.php">Logout</a>
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
    $sql2 = "SELECT * FROM files WHERE sid = $sid AND status = 0";
    $result2 = mysqli_query($con, $sql2);
    $id_values = [];

    while ($row2 = mysqli_fetch_array($result2)) {
        $id_values[] = $row2['id'];
    }
    ?>
<div class="container">

    <div class="student-info">
        <p><strong>Name:</strong> <?php echo $student_name; ?></p>
        <p><strong>Register Number:</strong> 123456</p>
        <p><strong>Current Total Points:</strong> 85</p>
    </div>

    <?php

foreach ($id_values as $id ) {
             // Fetch filelink for the current ID
    $pdfPathQuery = "SELECT * FROM files WHERE id = $id";
    $pdfPathResult = mysqli_query($con, $pdfPathQuery);
    $pdfPathRow = mysqli_fetch_array($pdfPathResult);
    $pathlink = $pdfPathRow['filelink'];
    $fileid=$id;
    // var_dump($pdfPath);die;
    echo '<div class="pdf-icon" onclick="openPdfModal(\'' . $pathlink . '\', ' . $fileid . ')">';
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
    <form id="statusForm" method="post" action="update_status.php">
        <button type="submit" name="status" onclick="acceptfile(this)" value="accepted" class="btn btn-success">Accept</button>
        <button type="submit" name="status" value="rejected" onclick="rejectfile(this)" class="btn btn-danger" data-dismiss="modal">Reject</button>
        <input type="hidden" id="fileid" name="fileid" value="">
    </form>
</div>

                <div class="details-container">
                    <p><strong>Allowable Points:</strong> 100</p>
                    <p><strong>Category:</strong> Category A</p>
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
    function openPdfModal(path,fileid) {
        // Set the src attribute of the iframe to the PDF path
        document.getElementById("pdfFrame").src = path;
        document.getElementById("fileid").value = fileid;
        // Open the modal
        $('#pdfModal').modal('show');
    }
    <script>
    function acceptfile(button) {
        // Get the value of the fileid input field
        var fileid = document.getElementById("fileid").value;
        // Set the value of the hidden input field
        document.getElementById("fileid").value = fileid;
        // Optionally, you can also submit the form programmatically
        // document.getElementById("statusForm").submit();
    }

    function rejectfile(button) {
        // Get the value of the fileid input field
        var fileid = document.getElementById("fileid").value;
        // Set the value of the hidden input field
        document.getElementById("fileid").value = fileid;
        // Optionally, you can also submit the form programmatically
        // document.getElementById("statusForm").submit();
    }
</script>

</script>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the fileid is set in the POST data
    if (isset($_POST["fileid"])) {
        $fileid = $_POST["fileid"];        
        // Run your queries using $fileid
        // For example:
        $status = $_POST["status"];
        $query = "UPDATE files SET status = '$status' WHERE id = '$fileid'";
        if (! mysqli_query($con, $query)) {
            echo "Query executed successfully.";
        }
        //  else {
        //     echo "Error executing query: " . mysqli_error($con);
        // }
        
        // Close database connection
        // mysqli_close($con);
        echo '<script>window.location.reload();</script>';

    } 
}
?>
