<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "apoint");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/faculty/flogin.php');
    exit;
}
$userid=$_SESSION['user_id'];
// Fetch accepted certificates
$acceptedCertificates = [];
$studentid= $_SESSION['student_id'];
$query = "SELECT * FROM files WHERE status = 'accepted' and sid='$studentid'";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $acceptedCertificates[] = $row;
}

// Fetch rejected certificates
$rejectedCertificates = [];
$query = "SELECT * FROM files WHERE status = 'rejected' and sid='$studentid'";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $rejectedCertificates[] = $row;
}

// Fetch student data if ID is set
$studentData = null;
if (isset( $_SESSION['student_id'])) {
    $studentId = mysqli_real_escape_string($con,  $_SESSION['student_id']);
    $query = "SELECT * FROM student WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $studentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $studentData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Close database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Certificates</title>
</head>
<body>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ca1717;
        background-image: url(img/course-1.jpg);
        background-size: cover;
        background-position: center;
        font-family: 'Source Sans Pro', sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        }
        .container {
            max-width: 1200px;
        margin: 20px auto;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .header {
        text-align: center;
        border-bottom: 2px solid #000;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    h1, h2 {
        font-size: 2em; 
        color: #333;
        width: 100%; 
        padding: 10px 0;
    }
    .heading-right {
        text-align: right;
        margin-right: 20px; ng */
    }
    .heading-left {
        text-align: left;
        margin-left: 20px; /
    }
    h1 {
        font-size: 2.5rem;
        margin: 0.5em 0;
    }
    h2 {
        font-size: 0.5emrem;
        margin-top: 30px;
    }
    a {
        text-decoration: none;
        color: #007bff;
    }
    a:hover {
        text-decoration: underline;
    }
    @media (max-width: 768px) {
        .header, .pdf-grid {
            padding: 10px;
        }
    }
    /* Adding responsiveness to font sizes and layout */
    @media (max-width: 480px) {
        h1 {
            font-size: 1.8rem;
        }
        h2 {
            font-size: 1.5rem;
        }
    }
    .pdf-item img {
        /* width: 150px; Adjust icon size as needed */
        height: 200px; /* Adjust icon size as needed */
        width: 150px; /* Adjust width of image as needed */
        border-radius: 20px; /* Add rounded corners to the image */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        transition: opacity 0.3s ease;
    }

    </style>

    <div class="container">
        <header class="header">
            <h1 class="heading-center">CERTIFICATES</h1>
            
        </header>
        <h2 class="heading-left">Accepted</h2>
        <div class="pdf-grid">
            <?php foreach ($acceptedCertificates as $file): ?>
            <div class="pdf-item">
                <?phpecho($file['filelink']);die?>
                <a href="amcs/Student/uploads/<?= htmlspecialchars($file['filelink']); ?>" target="_blank">
                    <img src="img/pdf_icon.png" alt="<?= htmlspecialchars($file['filelink']); ?>">
                </a>
                <p><?= htmlspecialchars($file['filelink']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <h2 class="heading-left">Rejected</h2>
        <div class="pdf-grid">
            <?php foreach ($rejectedCertificates as $file): ?>
            <div class="pdf-item">
                <a href=amcs/Student/uploads/<?= htmlspecialchars($file['filelink']); ?>" target="_blank">
                    <img src="img/pdf_icon.png" alt="<?= htmlspecialchars($file['filelink']); ?>">
                </a>
                <p><?= htmlspecialchars($file['filelink']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>