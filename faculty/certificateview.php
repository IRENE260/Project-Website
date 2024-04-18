<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/faculty/flogin.php');
    exit;
}
$userid=$_SESSION['user_id'];
$studentid=$_SESSION['studentid'];

// Establish database connection
$con = mysqli_connect("localhost", "root", "", "apoint");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch accepted certificates
$acceptedCertificates = [];
// $studentid=$_GET['studentid'];
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
$sql="select * from student where id='$studentid'";
$result2 = mysqli_query($con, $sql);
$value=mysqli_fetch_array($result2);


// Fetch student data if ID is set
// $studentData = null;
// if (isset($_GET['studentid'])) {
//     $studentId = mysqli_real_escape_string($con, $_GET['studentid']);
//     $query = "SELECT * FROM student WHERE id = ?";
//     $stmt = mysqli_prepare($con, $query);
//     mysqli_stmt_bind_param($stmt, "i", $studentId);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);
//     $studentData = mysqli_fetch_assoc($result);
//     mysqli_stmt_close($stmt);
// }

// Close database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>View Certificates</title>
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
    max-width: 700px; /* Reduced width to make it smaller */
    margin: 20px auto; /* Keeps the container centered horizontally */
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
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






        h2 {
            font-size: 2.5rem;
            margin: 0.5em 0;
        }

        h3 {
            font-size: 0.5emrem;
            margin-top: 30px;
        }
        .header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }

        .navbar {
            display: flex;
            justify-content: flex-end; /* Aligns the navigation to the right */
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .certificate-actions {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 10px;
                }
                .action-button {
                    background-color: black;
                    color:white;
                    padding: 8px 12px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

        a {
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
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

    </style>
</head>
<body>
<div id="outer">
        <header class="header" >
            <nav class="navbar">
                <a  href="fhome.php">Home</a>&nbsp;|&nbsp;
                <a href="studentlist.php">BACK</a>
            </nav>
        </header>
    <div class="container">
           
    <h2 class="heading-left"><?php echo($value[1]);?></h2>
        <div class="certificate-actions">
            <button class="action-button" onclick="location.href='pointsview.php';"><i class="fas fa-eye"></i> View Points</button>
        </div>
        <h2 class="heading-left">Accepted</h2>
        <div class="pdf-grid">
            <?php foreach ($acceptedCertificates as $file): ?>
            <div class="pdf-item">
                <a href="http://localhost/amcs/Student/uploads/<?= htmlspecialchars($file['filelink']); ?>" target="_blank">
                    <img src="img/pdf_icon.png" height=50 width=50 alt="<?= htmlspecialchars($file['filelink']); ?>">
                </a>
                <p><?= htmlspecialchars($file['filelink']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <h2 class="heading-left">Rejected</h2>
        <div class="pdf-grid">
            <?php foreach ($rejectedCertificates as $file): ?>
            <div class="pdf-item">
                <a href="http://localhost/amcs/Student/uploads/<?= htmlspecialchars($file['filelink']); ?>" target="_blank">
                    <img src="img/pdf_icon.png" height=50 width=50 alt="<?= htmlspecialchars($file['filelink']); ?>">
                </a>
                <p><?= htmlspecialchars($file['filelink']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>