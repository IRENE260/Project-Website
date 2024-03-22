<?php echo $_POST['pswd'];
$con=mysqli_connect("localhost","root","","apoint");

if (isset($_POST["pswd"])) {
    $id = $_POST['id'];
    $sql="UPDATE student SET Password='".$_POST['pswd']."' WHERE id = '$id'";
    mysqli_query($con,$sql);
    echo mysqli_error($con);
    header("Location: /amcs/sls.php");  
    exit();
}
?>