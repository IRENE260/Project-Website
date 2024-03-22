<?php echo $_POST['pswd'];
$con=mysqli_connect("localhost","root","","apoint");

if (isset($_POST["pswd"])) {
    $id = $_POST['id'];
    $sql="UPDATE faculty SET Password='".$_POST['pswd']."' WHERE id = '$id'";
    mysqli_query($con,$sql);
    echo mysqli_error($con);
    header("Location: /activity_monitor/flogin.php");  
    exit();
}
?>