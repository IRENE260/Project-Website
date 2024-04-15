<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "apoint");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch accepted certificates
$acceptedCertificates = [];
$query = "SELECT * FROM files WHERE status = 'accepted'";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $acceptedCertificates[] = $row;
}

// Fetch rejected certificates
$rejectedCertificates = [];
$query = "SELECT * FROM files WHERE status = 'rejected'";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $rejectedCertificates[] = $row;
}

// Fetch student data if ID is set
$studentData = null;
if (isset($_GET['studentid'])) {
    $studentId = mysqli_real_escape_string($con, $_GET['studentid']);
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
    <link rel="stylesheet" href="viewcertificate.css">
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
    height: auto; /* You can adjust height as needed */
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






h2 {
    font-size: 2.5rem;
    margin: 0.5em 0;
}

h3 {
    font-size: 0.5emrem;
    margin-top: 30px;
}
.header {
    background-color: #343a40;
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

.navbar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.nav-item {
    margin-left: 20px; /* Spacing between items */
}

.nav-link {
    display: flex;
    align-items: center;
    
    text-decoration: none;
    font-size: 16px;
}

.nav-link i {
    margin-right: 10px;
}

.nav-link:hover, .nav-link:focus {
    background-color: #495057;
    border-radius: 5px; /* Optional: adds rounded corners to the hover/focus state */
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
</style>
<body>
<div id="outer">
        <header class="header order-last" id="tm-header">
            <nav class="navbar">
                <div class="collapse navbar-collapse single-page-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#section-1"><span class="icn"><i class="fab fa-2x fa-battle-net"></i></span>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#section-2"><span class="icn"><i class="fas fa-2x fa-id-card"></i></span> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#section-3"><span class="icn"><i class="fas fa-2x fa-air-freshener"></i></span> Quick Links</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.html"><span class="icn"><i class="fas fa-2x fa-sign-out-alt"></i></span>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    <div class="container">
        
            <h2 class="heading-left">S_NAME</h2>
            <div class="certificate-actions">
            <button class="action-button"><i class="fas fa-eye"></i> View Points</button>
</div>
        
        <h3 class="heading-left">Accepted</h3>
        <div class="pdf-grid">
            <?php foreach ($acceptedCertificates as $file): ?>
            <div class="pdf-item">
                <a href="http://localhost/activity_monitor/img/<?= htmlspecialchars($file['filelink']); ?>" target="_blank">
                    <img src="img/pdf_icon.png" alt="<?= htmlspecialchars($file['filename']); ?>">
                </a>
                <p><?= htmlspecialchars($file['filename']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <h3 class="heading-left">Rejected</h3>
        <div class="pdf-grid">
            <?php foreach ($rejectedCertificates as $file): ?>
            <div class="pdf-item">
                <a href="http://localhost/activity_monitor/img/<?= htmlspecialchars($file['filelink']); ?>" target="_blank">
                    <img src="img/pdf_icon.png" alt="<?= htmlspecialchars($file['filename']); ?>">
                </a>
                <p><?= htmlspecialchars($file['filename']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
