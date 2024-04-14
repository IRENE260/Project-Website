<?php
$con=mysqli_connect("localhost","root","","apoint");
if(isset($_POST['login']))
{
$password=$_POST['pswd'];
$email=$_POST['email'];
$sql="select * from faculty where email='$email' and password='$password'";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_array($result);
if($result->num_rows != 0) {
	session_start();
	$_SESSION['user_id']=$data['id'];
    header("Location: /amcs/faculty/fhome.php");    
}else{?>
<script>
  alert("User not found");
  window.location.href = '../faculty/flogin.php';
</script>
<?php 
}
echo mysqli_error($con);
}

if(isset($_POST['signup'])){
    $name=$_POST['name'];
	$department=$_POST['department'];
    $college=$_POST['college'];
    $uid=$_POST['uid'];
    $email=$_POST['email'];
    $password=$_POST['pswd']; 
    $rr=mysqli_query($con,"select * from faculty where email='$email' ");
    if($rr->num_rows != 0) { ?>
        <script> alert("registration failed....change your email"); </script>
    <?php }else{
            $sql="insert into faculty(name,uid,college,department,email,password) values('$name','$uid','$college','$department','$email','$password')";
            mysqli_query($con,$sql);
            header("Location:/amcs/faculty/flogin.php");
		    exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>AMCS</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/flogin.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
                <form  method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">   
					<label for="chk" aria-hidden="true">Sign up</label>
					<div class="user-details">
                    <input type="text" name="name" placeholder="Name" pattern="[a-zA-Z ]{1,32}" required>
					<div class="input-box">
					<select name="department" id="department" class="selectclass"  required>
						<option value="" disabled selected>Department</option>
						<option value="CSE">CSE</option>
						<option value="EC">EC</option>
						<option value="EEE">EEE</option>
						<option value="EI">EI</option>
					</select>
					</div>
					<div class="input-box">
					<select name="college" id="college" class="selectclass"  required>
						<option value="" disabled selected>College</option>
						<option value="CEA">College Of Engineering Adoor</option>
						<option value="AEC">College Of Engineering Aranmula</option>
						<option value="CEC">College Of Engineering Chengannur</option>
						<option value="CEK">College Of Engineering Kallooppara</option>
						<option value="CET">College Of Engineering Trivandrum</option>
					</select>
                    </div>
                    <input type="text" name="uid" placeholder="University ID" pattern="[a-zA-Z0-9 ]{1,}" required>
                    <input type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    <input type="password" id="pswd" name="pswd" placeholder="Password" required>
                    <input type="password" id="cpswd" name="cpswd" placeholder="Confirm Password" required>
					<p id="errorMessage" class="errorMessage" style="color: red;"></p>
					</div>
					<button type="Submit" name="signup" onclick="return checkPassword()">Sign up</button>
					
				</form>
			</div>

			<div class="login">
                <form  method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">   
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button type="submit" name="login">Login</button><br>
					<a href="forgot.php" ><p style="text-align:center">Forgot Password</p></a>
				</form>
			</div>
	</div>
</body>
<script>
function checkPassword(form){
  var pass1=document.getElementById("pswd");
  var pass2=document.getElementById("cpswd");
  var errorMessage = document.getElementById("errorMessage");
  if(pass1.value!=pass2.value){
	errorMessage.textContent = "Passwords do not match";
    return false;
  }
  return true;
}
</script>
</html>