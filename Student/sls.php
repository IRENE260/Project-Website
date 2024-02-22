<?php
$today=new DateTime('now');
$today=$today->format('Y-m-d');
$con=mysqli_connect("localhost","root","","apoint");
if($conn)
{
	session_start();
	if(isset($_POST['signup']))
	{
		$name=$_POST["name"];
		$dob=$_POST["dob"];
		$reg=$_POST['regno'];
		$branch=$_POST["branch"];
		$college=$_POST["college"];
		$year=$_POST['year'];
		$email=$_POST['email'];
		$password =$_POST['pswd'];
		$cpassword=$_POST['cpswd'];
		if ($password !== $cpassword) {
			$_SESSION['signup_error'] = 'Passwords do not match';
			$_SESSION['signup_values'] = [
				'name' => $name,
				'dob' =>$dob,
				'reg' =>$reg,
				
				'email' => $email,
			];
			header('Location: signup.php'); // Redirect back to the signup page
			exit;
		}
		$sql="insert into student(name,dob,regno,branch,college,yearj,email,password) values('$name','$dob','$reg','$branch','$college','$year','$email','$password')";
		mysqli_query($con,$sql);
		header("Location:/amcs/sls.php");
		exit();
	}
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
				<form method="post" action="<?php $_SERVER['PHP_SELF']?>"]>
					<label for="chk" aria-hidden="true">Sign up</label>
					<div class="user-details">
						<div class="input-box"><input type="text" name="name" placeholder="Name" pattern="[a-zA-Z ]{1,32}" required=""></div>
						<div class="input-box"><input type="date" name="dob" max=<?php echo $today;?> required=""></div>
						<div class="input-box"><input type="text" name="regno" placeholder="Register Number" pattern="[a-zA-Z0-9 ]{1,}" required=""></div>
						<div class="input-box"><input type="text" name="branch" placeholder="Branch" pattern="[a-zA-Z ]{1,}" required=""></div>
						<div class="input-box"><input type="text" name="college" placeholder="College" pattern="[a-zA-Z ]{1,}" required=""></div>
						<div class="input-box"><input type="number" min="2010" max="2099" step="1" name="year" placeholder="Year Of Joining" required=""></div>
						<div class="input-box"><input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required=""></div>
						<div class="input-box"><input type="password" name="pswd" placeholder="Password" required=""></div>
						<div class="input-box"><input type="password" name="cpswd" placeholder="Confirm Password" required=""></div>
					</div>
					
					<button><input type="submit" name="signup">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form>
					<label for="chk" aria-hidden="true">Login</label>
					<input class="ip" type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
					<input class="ip" type="password" name="pswd" placeholder="Password" required="">
					<button>Login</button><br>
					<a href="" ><p style="text-align:center">Forgot Password</p></a>
				</form>
			</div>
	</div>
</body>
</html>