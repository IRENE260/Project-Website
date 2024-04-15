<?php
$today=new DateTime('now');
$today=$today->format('Y-m-d');
$con=mysqli_connect("localhost","root","","apoint");
if($con)
{
	if(isset($_POST['signup']))
	{
		$name=$_POST['name'];
		$dob=$_POST['dob'];
		$reg=$_POST['regno'];
		$batch=$_POST['batch'];
		$branch=$_POST['branch'];
		$college=$_POST['college'];
		$year=$_POST['year'];
		$email=$_POST['email'];
		$password=$_POST['pswd'];
		$sql="insert into student(name,dob,regno,batch,branch,college,yearj,email,password) values('$name','$dob','$reg','$batch','$branch','$college','$year','$email','$password')";
		mysqli_query($con,$sql);
		$sql2="select id from student where regno='$reg'";
		$res=mysqli_query($con,$sql2);
		$value=mysqli_fetch_array($res);
		$sql3="insert into spoint values('$value[0]',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)";
		mysqli_query($con,$sql3);
		header("Location:/amcs/Student/sls.php");
		exit();
	}
	if(isset($_POST['login']))
	{
		$email=$_POST['email'];
		$password=$_POST['pswd'];
		$sql="select * from student where email='$email' and password='$password'";
		$res=mysqli_query($con,$sql);
		$value=mysqli_fetch_array($res);
    	if($res->num_rows==0)
    	{?>
        <script> 
		    alert("User not Found/Incorrect Email or Password ");
	        window.location.href = '../Student/sls.php';</script>
		<?php   }
		else{
			session_start();
			$_SESSION['user_id']=$value['id'];
			header("Location:/amcs/Student/homepage.php");
            exit();
		}
	}
	echo mysqli_error($con);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>AMCS</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/login_signup.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
					<label for="chk" aria-hidden="true">Sign up</label>
					<div class="user-details">
						<div class="input-box"><input type="text" name="name"  placeholder="Name" pattern="[a-zA-Z ]{1,32}" required=""></div>
						<div class="input-box"><input type="date" name="dob"  max=<?php echo $today;?> required=""></div>
						<div class="input-box"><input type="text" name="regno" placeholder="Register Number" pattern="[a-zA-Z0-9 ]{1,}" required=""></div>
						<div class="input-box">
							<select name="batch" id="batch" class="selectclass"  required>
								<option value="" disabled selected>Batch</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
								<option value="F">F</option>
								<option value="G">G</option>
							</select>
						</div>
						<div class="input-box">
							<select name="branch" id="branch" class="selectclass"  required>
								<option value="" disabled selected>Branch</option>
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
						<div class="input-box"><input type="number" min="2010" max="2099" step="1" name="year" placeholder="Year Of Joining" required=""></div>
						<div class="input-box"><input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required=""></div>
						<div class="input-box"><input type="password" name="pswd" placeholder="Password" id="pswd" required=""></div>
						<div class="input-box"><input type="password" name="cpswd" placeholder="Confirm Password" id="cpswd" required=""></div>
						<p id="errorMessage" class="errorMessage" style="color: red;"></p>
					</div>
					
					<button type="submit" name="signup" onclick="return checkPassword()">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
					<label for="chk" aria-hidden="true">Login</label>
					<input class="ip" type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
					<input class="ip" type="password" name="pswd" placeholder="Password" required="">
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