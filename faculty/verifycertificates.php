<?php
$userid=$_GET["userid"];
// Assuming you have a valid database connection $con
$con=mysqli_connect("localhost","root","","apoint");

$sql = "SELECT DISTINCT sid FROM files WHERE status = 0";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display PDF Icons</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        .container {
            width: 80%;
            background-color: #fff;
            margin: 20px auto;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .pdf-icon {
            margin-right: 10px;
            color: #3498db;
            font-size: 40px;
        }

        /* .request-container {
            margin: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
            display: flex;
            align-items: stretch;
        } */
        /* .buttons {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
            height: 100%; 
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
            width: 75%; 
            height: 30%; 
        }

        .accept-button {
            background-color: #2ecc71;
            color: #fff;
        }

        .reject-button {
            background-color: #e74c3c;
            color: #fff;
        } */

        .pdf-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .pdf-modal-content {
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
        .pdf-details-container {
            width: 60%;
        }

        .pdf-actions-container {
            width: 35%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .pdf-actions-container button {
            margin-top: 10px;
            padding: 10px;
            width: 80%;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        .reject-btn {
            background-color: #e74c3c;
        }

        .accept-btn {
            background-color: #2ecc71;
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
    $student_name_query = "SELECT * FROM student WHERE sid = $sid";
    $student_name_result = mysqli_query($con, $student_name_query);
    $student_name = mysqli_fetch_array($student_name_result)['name'];
    $current_points = $student_details['tpoints'];

    // Retrieve all id values for the current sid where status is 0
    $sql2 = "SELECT * FROM files WHERE sid = $sid AND status = 0";
    $result2 = mysqli_query($con, $sql2);
    $id_values = [];

    while ($row2 = mysqli_fetch_array($result2)) {
        $id_values[] = $row2['id'];
    }

    // Display container for each sid
    echo '<div class="container">';
    echo '<div>';
    echo '<h2>' . $student_name . '</h2>';
    echo '</div>';
    echo '<div>';
    echo '<p>Current Total Points: ' . $current_points . '</p>';
    echo '</div>';
    // Display PDF icons for each id value
    foreach ($id_values as $id) {
        // echo '<i class="fas fa-file-pdf pdf-icon"></i>';
        echo '<i class="fas fa-file-pdf pdf-icon" onclick="openPdfModal(\'' . $id['pathlink'] . '\', \'' . $student_name . '\', \'' . $id['id'] . '\')"></i>';
    }

    echo '</div>';
}
?>
<div class="pdf-modal" id="pdfModal">
    <div class="pdf-modal-content">
        <div class="pdf-details-container">
            <span class="close-btn" onclick="closePdfModal">&times;</span>
            <iframe id="pdfViewer" width="100%" height="500px" frameborder="0"></iframe>
            <!-- Display any 3 details about the PDF -->
            <p>Detail 1: ...</p>
            <p>Detail 2: ...</p>
            <p>Detail 3: ...</p>
        </div>
        <div class="pdf-actions-container">
            <button class="reject-btn" onclick="rejectPdf()">Reject</button>
            <button class="accept-btn" onclick="acceptPdf()">Accept</button>
        </div>
    </div>
</div>

<script>
    function openPdfModal(pdfPath, studentName, pdfId) {
        document.getElementById('pdfViewer').src = pdfPath;
        document.getElementById('pdfModal').style.display = 'flex';
        // Set the details about the PDF (replace with actual details)
        document.querySelector('.pdf-details-container').innerHTML = `
            <span class="close-btn" onclick="closePdfModal">&times;</span>
            <iframe id="pdfViewer" width="100%" height="500px" frameborder="0"></iframe>
            <p>Student: ${studentName}</p>
            <p>Section: ...</p>
            <p>Achievement: ...</p>
            <p>Allowable points: ...</p>
        `;
        document.getElementById('pdfId').value = pdfId;
    }

    function closePdfModal() {
        document.getElementById('pdfModal').style.display = 'none';
        document.getElementById('pdfViewer').src = ''; // Reset the PDF viewer src
    }
    function rejectPdf() {
        // Handle PDF rejection logic here
        alert('PDF Rejected!');
        closePdfModal();
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
        closePdfModal();
    }
</script>

</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
