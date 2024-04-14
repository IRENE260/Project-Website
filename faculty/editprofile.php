<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/faculty/flogin.php');
    exit;
}
$userid=$_SESSION['user_id'];
$today = new DateTime('now'); 
$today = $today->format('Y-m-d');
$con=mysqli_connect("localhost","root","","apoint");
if(isset($userid)){
    $query="select * from faculty where id=$userid";
    $value=mysqli_query($con,$query);
    $result=mysqli_fetch_array($value);
}
echo mysqli_error($con); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Profile - Automated Activity Metric Computation System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css" /> 
    <link rel="stylesheet" href="css/tooplate-simply-amazed.css" type="text/css" />
    <!-- Add your custom CSS styles for the profile editing page here -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Source Sans Pro', sans-serif;
            background: url('img/section-3-bg.jpg') center/cover;
            color: #fff;
        }

        header {
            background-color: #6699cc;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(119, 167, 233, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        } */
    </style>
</head>

<body>
    <header>
        <h1>Edit Profile</h1>
    </header>

    <main>
        <form  method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $result["name"] ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $result["email"] ?>">

            <label for="phone">College:</label>
            <input type="tel"  name="college" value="<?php echo $result["college"] ?>">

            <label for="designation">University Id:</label>
            <input type="text" name="uid" value="<?php echo $result["uid"] ?>">

            <label for="designation">Department:</label>
            <input type="text" name="dept" value="<?php echo $result["department"] ?>">

            <button class="button-91" role="button" name="save">Save</button>
            <button class="button-91" role="button" name="save" onclick="location.href = 'fhome.php';">Back To Home</button>
        </form>
    </main>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>

</html>
<?php
    if(isset($_POST["save"])){
        $name=$_POST['name'];
        $college=$_POST['college'];
        $uid=$_POST['uid'];
        $email=$_POST['email'];
        $dept=$_POST['dept'];
        $sql="update faculty set name='$name',college='$college',uid='$uid',email='$email',department='$dept' where id=$userid ";
        mysqli_query($con,$sql);
        header("Location:/amcs/faculty/fhome.php");
        echo mysqli_error($con);
        }
?>