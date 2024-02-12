<?php
$today=new DateTime('now');
$today=$today->format('Y-m-d');

?>
<!DOCTYPE html>
<html>
<head>
	<title>AMCS</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="loginf.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form >
					<label for="chk" aria-hidden="true">Sign up</label>
					<div class="user-details">
                    <input type="text" name="name" placeholder="Name" pattern="[a-zA-Z ]{1,32}" required>
                    <input type="text" name="college" placeholder="College" pattern="[a-zA-Z ]{1,}" required>
                    <input type="text" name="ui" placeholder="University ID" pattern="[a-zA-Z0-9 ]{1,}" required>
                    <input type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    <input type="password" name="pswd" placeholder="Password" required>
                    <input type="password" name="pswd" placeholder="Confirm Password" required>
					<button type="Submit" name="Submit">Sign up</button>
					</div>
				</form>
			</div>

			<div class="login">
				<form>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Login</button><br>
					<a href="" ><p style="text-align:center">Forgot Password</p></a>
				</form>
			</div>
	</div>
</body>
</html>
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