<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:/amcs/Student/homepage.php');
    exit;
}
if(isset($_POST['reset'])){
    $con=mysqli_connect("localhost","root","","apoint");
    $pass=$_POST['password'];
    $sql="select password from student where id=".$_SESSION['user_id'];
    $res=mysqli_query($con,$sql);
    $value=mysqli_fetch_array($res);
    if($pass!=$value[0]){?>
    <script>alert("old password is incorrect try again ");
	        window.location.href = '../Student/changepassword.php';</script></script>
    <?php } 
    else{
        $np=$_POST['password1'];
        $sql1="update student set password='$np' where id=".$_SESSION['user_id'];
        $res=mysqli_query($con,$sql1);
        if($res){
            header('Location:/amcs/Student/sls.php');
            exit;
        }
        else{
            header('Location:/amcs/Student/profilepage.php');
            exit;
        }
    }
}
if(isset($_POST['noreset'])){
    header('Location:/amcs/Student/profilepage.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/changepassword.css">
    <title>Password Reset</title>
    <style>
        body{
            background-image: url(img/images11.jpg);
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <form action="changepassword.php" method="post">
            <h2> Change Password </h2>
            <label for="password">Old Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="password1"> New Password:</label>
            <input type="password" id="password1" name="password1" required>
            <label for="password1"> Confirm Password:</label>
            <input type="password" id="password2" name="password2" required>
            <p id="errorMessage" class="errorMessage" style="color: red;"></p>
            <input type="submit" name="reset" value="Reset Password" onclick="return checkPassword()">
        </form>
        <form action="changepassword.php" method="post">
            <input type="submit" name="noreset" value="Back To Profile">
        </form>
    </div>
</body>
<script>
	function checkPassword(form){
  var pass1=document.getElementById("password1");
  var pass2=document.getElementById("password2");
  var errorMessage = document.getElementById("errorMessage");
  if(pass1.value!=pass2.value){
	errorMessage.textContent = "Passwords do not match";
    return false;
  }
  return true;
}
</script>
</html>