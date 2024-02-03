<?php
$today=new DateTime('now');
$today=$today->format('Y-m-d');

?>
<!DOCTYPE html>
<html>
<head>
	<title>AMCS</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="login_signup.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form >
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="name" placeholder="Name" pattern="[a-zA-Z ]{1,32}" required="">
          			<input type="date" name="dob" max=<?php echo $today;?> required="">
					<input type="text" name="regno" placeholder="Register Number" pattern="[a-zA-Z0-9 ]{1,}" required="">
					<input type="text" name="branch" placeholder="Branch" pattern="[a-zA-Z ]{1,}" required="">
					<input type="text" name="college" placeholder="College" pattern="[a-zA-Z ]{1,}" required="">
					<input type="number" min="2010" max="2099" step="1" name="year" placeholder="Year Of Joining" required="">
					<input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<input type="password" name="cpswd" placeholder="Confirm Password" required="">
					<button>Sign up</button>
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