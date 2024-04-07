<?php
$userid=$_GET["userid"];
$con=mysqli_connect("localhost","root","","apoint");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css" /> 
    <link rel="stylesheet" href="css/slick.css" type="text/css" />   
    <link rel="stylesheet" href="css/tooplate-simply-amazed.css" type="text/css" />
    <style>
    /* Add your custom styles here */
    .filter-container {
        background-color: rgba(65, 55, 111, 0.9); /* White container with transparency */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
    }
    .filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .filter-bar input {
        width: 42%;
        padding: 10px;
        margin-right: 10px;
    }

    .filter-bar button {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .search-form {
        display: flex;
        align-items: center;
    }

    .search-form input {
        width: 70%;
        margin-left: 80px;
        padding: 8px;
        margin-right: 10px;
    }

    .search-form button {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .tm-work-item-inner {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .item:hover .tm-work-item-inner {
        transform: translateY(-5px); /* Adjust the value to control the lift height */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adjust the shadow as needed */
    }

    .item:not(:hover) .tm-work-item-inner {
        transform: translateY(0);
        box-shadow: none;
    }

    .filter-result-table {
        margin-top: 20px auto;
        margin-left: 120px;
        width: 80%;
        border-collapse: collapse;
        background-color: rgba(255, 255, 255, 0.8); /* Set the background color to white with 80% opacity */
    }

    .filter-result-table th, .filter-result-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .filter-result-table th {
        background-color: #f2f2f2;
    }
</style>

</head>
<body>
    <div id="outer">   
        <main id="content-boxl" class="order-first">
            <div class="banner-section section parallax-window" style="padding-top: 85px;" data-parallax="scroll" data-image-src="img/banner.jpg" id="section-1">
                <div class="container">
                    <div class="item">
                        <div class="bg-blue-transparent logo-fa"> Student List Management
                            <p text-indent: 26px;>View list of students along with their activity-point details...</p>
                        </div>
                    </div>
                    <div class="filter-container">
                        <div class="filter-bar">
                            <form action="" method="POST" class="filter-bar">
                                <select id="branchInput" name="branchInput">
                                    <option value="" disabled selected>Select Branch</option>
                                    <option value="CSE">CSE</option>
                                    <option value="ECE">ECE</option>
                                    <option value="branch1">EEE</option>
                                <option value="branch1">Mech.E</option>
                                <option value="branch1">EIE</option>
                                <option value="branch1">Civil</option>
                                <option value="branch1">MCA</option>
                                    <!-- Add more options as needed -->
                                </select>
                                <select id="yearInput" name="yearInput">
                                    <option value="" disabled selected>Select Year of Admission</option>
                                    <?php
                                        $currentYear = date("Y");
                                        for ($year = 1986; $year <= $currentYear; $year++) {
                                            echo '<option value="' . $year . '">' . $year . '</option>';
                                        }
                                    ?>
                                </select>
                                <button type="submit" name="filter">Apply Filter</button>
                            </form>
                        </div>
                        <form action="" method="POST" class="search-form">
                            <input type="text" id="studentName" name="studentName" placeholder="Search..." required>
                            <button type="submit" name="searchByName"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div id="resultTable">
                        <?php
                            // Your PHP code for displaying the result table or alert goes here
                            
                            // Database connection
                            // $servername = "localhost";
                            // $username = "root";
                            // $password = "";
                            // $dbname = "apoint";

                            // // Create connection
                            // $con = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($con->connect_error) {
                                die("Connection failed: " . $con->connect_error);
                            }

                            // Handle form submission
                            if (isset($_POST['filter'])) {
                                $branch = $_POST['branchInput'];
                                $yearj = $_POST['yearInput'];

                                // Query to retrieve matching students
                                $queryf = "SELECT * FROM student WHERE branch = '$branch' AND yearj = '$yearj'";
                                $resultf = $con->query($queryf);

                                // Check if any matching data is found
                                if ($resultf->num_rows > 0) {
                                    echo "<table>";
                                    echo "<tr><th>Name</th><th>Year</th><th>Action</th></tr>";

                                    // Output data of each row
                                    while ($rowf = $resultf->fetch_assoc()) {
                                        echo "<tr><td>" . $rowf["name"] . "</td><td>" . $rowf["yearj"] . "</td><td><button>View Details</button></td></tr>";
                                    }

                                    echo "</table>";
                                } else {
                                    echo "<p>No matching data found.</p>";
                                }
                            }

                            if (isset($_POST['searchByName'])) {
                                $studentName = $_POST['studentName'];

                                // Query to retrieve matching students by name
                                $querys = "SELECT * FROM student WHERE name LIKE '%$studentName%'";
                                $results = $con->query($querys);

                                // Check if any matching data is found
                                if ($results->num_rows > 0) {
                                    echo "<table>";
                                    echo "<tr><th>Name</th><th>Year</th><th>Action</th></tr>";

                                    // Output data of each row
                                    while ($rows = $results->fetch_assoc()) {
                                        echo "<tr><td>" . $rows["name"] . "</td><td>" . $rows["yearj"] . "</td><td><button>View Details</button></td></tr>";
                                    }

                                    echo "</table>";
                                } else {
                                    echo "<p>No matching data found.</p>";
                                }
                            }

                            // Close connection
                            $con->close();
                        
                        
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        // Your JavaScript code goes here
    </script>
</body>
</html>
