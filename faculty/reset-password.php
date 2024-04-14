<?php
$con=mysqli_connect("localhost","root","","apoint");
$id=$_GET['id'];
if(isset($_GET['id']))
{
    $sql="SELECT `password` FROM `faculty` where id='$id'";
    $r=mysqli_query($con,$sql);
    $f=mysqli_fetch_array($r);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<style>

.errorMessage {
  color: red;
}
.container {
  width: 500%;
 
  margin: 0 auto;
  padding: 50px;
  border: 10px ;
  border-radius: 10px;
  background-color: rgba(255, 255, 255, 0.8); /* Adding a semi-transparent white background */
  font-family: Arial, sans-serif; /* Change the font family here */
  flex-direction: column;
  justify-content: center; /* Center vertically */
  align-items: center; 
}

body, html {
  height: 100%;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
form {
  display: flex;
  flex-direction: column;
}
body {
  background-image: url('img/images1.jpeg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

input[type="password"] {
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button[type="submit"] {
  padding: 10px 20px;
  background-color:black;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}



.errorMessage {
  color: red;
}

</style>
</head>
<body>
<div class="container">
  <form method="post" action="reset">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"><br>
    <input type="hidden" name="pass" id="pass" value="<?php echo $f["password"]; ?>"><br>
    <input type="password" name="pswd" id="pswd" placeholder="New Password" required>
    <input type="password" name="cpswd" id="cpswd" placeholder="Re-enter Password" required>
    <p id="errorMessage" class="errorMessage"></p>
    <button type="submit" name="reset" onclick="return checkPassword()">Submit</button>
  </form>
</div>

<script>
function checkPassword() {
  var p = document.getElementById("pass").value;
  var pass1 = document.getElementById("pswd").value;
  var pass2 = document.getElementById("cpswd").value;
  var errorMessage = document.getElementById("errorMessage");
  
  if (pass1 !== pass2) {
    errorMessage.textContent = "Passwords do not match";
    return false;
  }
  
  if (pass1 == p) {
    errorMessage.textContent = "Please enter a different password";
    return false;
  }
  
  return true;
}
</script>
</body>
</html>