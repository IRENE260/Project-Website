<?php
$today=new DateTime('now');
$today=$today->format('Y-m-d');
$con=mysqli_connect("localhost","root","","apoint");
if(isset($_POST['signup'])){
    $name=$_POST['name'];
    $college=$_POST['college'];
    $uid=$_POST['uid'];
    $email=$_POST['email'];
    $password=$_POST['pswd'];
			mysqli_query($con,"insert into faculty(name,uid,college,email,password) values('$name','$uid','$college','$email','$password')");
            // $sql="INSERT INTO faculty(name,uid,college,email,password) VALUES('$name','$uid','$college',$email','$password') ";
            // mysqli_query($con,$sql);
            // echo mysqli_error($con);
            // $sql2="SELECT * from faculty where email='$email' and password='$password'";
            // $result = mysqli_query($con,$sql2);
            // $data = mysqli_fetch_array($result);
            header("Location:/amcs/flogin.php");
    }

if(isset($_POST['login']))
{
$password=$_POST['pswd'];
$email=$_POST['email'];
$sql="SELECT * from faculty where email='$email' and password='$password'";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_array($result);
if($result->num_rows != 0) {
  $userid=$data['id'];
  header("Location: /amcs/fhome.php?userid=".$data['id']);    
}else{?>
<script>
  alert("User not found");
</script>
<?php 
}
echo mysqli_error($con);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>AMCS</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="flogin.css">
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
                    <input type="text" name="college" placeholder="College" pattern="[a-zA-Z ]{1,}" required>
                    <input type="text" name="uid" placeholder="University ID" pattern="[a-zA-Z0-9 ]{1,}" required>
                    <input type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" onchange="emailCheck()" required>
                    <input type="password" name="pswd" id="pswd" placeholder="Password" required>
                    <input type="password" name="cpswd" id="cpswd" placeholder="Confirm Password" required>
					<p id="errorMessage" class="errorMessage" style="color: red;"></p>
					<button type="Submit" name="signup" onclick="return checkPassword()" >Sign Up</button>
					</div>
				</form>
			</div>

			<div class="login">
                <form  method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">   
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button type="submit" name="login">Login</button><br>
					<a href="" ><p style="text-align:center">Forgot Password</p></a>
				</form>
			</div>
	</div>
</body>
</html>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="ajax-script.js"></script>
<script>
	function emailCheck() {
  var email = document.getElementById('email').value;
  $.ajax({
    url: "emailcheck.php",
    method: "POST",
    data: {
        mail: email
    },
    success: function(result){
      if (result == "Failed") {
        document.getElementById('errmsg').style.display = "block";
        document.getElementById('email').value = "";
      } else {
        document.getElementById('errmsg').style.display = "none";
      }
  }});
}
</script> -->
<!-- <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" type="text/css" href="login_signup.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
  		<div class="container">
    		<div class="title">Registration</div>
    			<div class="content">
      				<form action="#">
        			<div class="user-details">
         				<div class="input-box">
           				 	<span class="details">Full Name</span>
           				 	<input type="text" placeholder="Enter your name" required>
          				</div>
          				<div class="input-box">
           					<span class="details">Username</span>
            				<input type="text" placeholder="Enter your username" required>
          				</div>
          				<div class="input-box">
							<span class="details">Email</span>
							<input type="text" placeholder="Enter your email" required>
						</div>
						<div class="input-box">
							<span class="details">Phone Number</span>
							<input type="text" placeholder="Enter your number" required>
						</div>
						<div class="input-box">
							<span class="details">Password</span>
							<input type="text" placeholder="Enter your password" required>
						</div>
						<div class="input-box">
							<span class="details">Confirm Password</span>
							<input type="text" placeholder="Confirm your password" required>
          				</div>
        			</div>
					<div class="gender-details">
						<input type="radio" name="gender" id="dot-1">
						<input type="radio" name="gender" id="dot-2">
						<input type="radio" name="gender" id="dot-3">
						<span class="gender-title">Gender</span>
						<div class="category">
							<label for="dot-1">
							<span class="dot one"></span>
							<span class="gender">Male</span>
							</label>
							<label for="dot-2">
							<span class="dot two"></span>
							<span class="gender">Female</span>
							</label>
							<label for="dot-3">
							<span class="dot three"></span>
							<span class="gender">Prefer not to say</span>
							</label>
						</div>
				    </div>
					<div class="button">
					<input type="submit" value="Register">
					</div>
      			</form>
			</div>
        </div>
        <div class="login">
				<form>
					<label class="title" for="chk" aria-hidden="true">Login</label>
					<input class="input-box" type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
					<input class="ip" type="password" name="pswd" placeholder="Password" required="">
					<button>Login</button><br>
					<a href="" ><p style="text-align:center">Forgot Password</p></a>
				</form>
		</div>
	</div>

</body>
</html> -->