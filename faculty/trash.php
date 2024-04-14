<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Search</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Search Students</h2>

    <form method="post" action="">
        <label for="branch">Branch:</label>
        <input type="text" id="branch" name="branch" required>

        <label for="yearOfBirth">Year of Birth:</label>
        <input type="text" id="yearOfBirth" name="yearOfBirth" required>

        <button type="submit" name="search">Search</button>
    </form>

    <?php
    // Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "apoint";

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize variable to track whether to show the table or alert
    $showTable = false;

    // Handle form submission
    if (isset($_POST['search'])) {
        $branch = $_POST['branch'];
        $yearOfBirth = $_POST['yearOfBirth'];

        // Query to retrieve matching students
        $query = "SELECT name, yearj FROM student WHERE branch = '$branch' AND yearj = '$yearOfBirth'";
        $result = $conn->query($query);

        // Check if any matching data is found
        if ($result->num_rows > 0) {
            $showTable = true;
            echo "<table>";
            echo "<tr><th>Name</th><th>Age</th></tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["yearj"] . "</td></tr>";
            }

            echo "</table>";
        } else {
            // Set variable to show alert
            $showAlert = true;
        }
    }

    // Close connection
    $conn->close();

    // Display alert if no matching data is found
    if (isset($showAlert) && $showAlert) {
        echo "<script>alert('No matching data');</script>";
    }
    ?>

</body>
</html>
