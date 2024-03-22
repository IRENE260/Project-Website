<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$con=mysqli_connect("localhost","root","","apoint");

//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$token = bin2hex(random_bytes(50)); // Generate a secure token
$email = $_POST["email"];

//Create an instance; passing `true` enables exceptions
if (isset($_POST["email"])) {
  $stmt = $con->prepare("SELECT * FROM `student` WHERE `email` = ?");
  $stmt->bind_param("s", $email); // 's' specifies the type => 'string'
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();


  if ($row) {
   $id = $row['id'];
  } else {
    echo "<script> 
      document.location.href = 'forgot?mailsent=false';
    </script>";
  }

  $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'aabdi79011@gmail.com';   //SMTP write your email
    $mail->Password   = 'dnmrtafdopbmnhdj';      //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Or just 'tls'
    $mail->Port       = 587;
                                     

    //Recipients
    $mail->setFrom('aabdi79011@gmail.com', 'Your Name');
    $mail->addAddress($_POST["email"]);     //Add a recipient email  
    $mail->addReplyTo($_POST["email"]); // reply to sender email

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Password Reset'; // Example subject
    $mail->Body    = 'Please use the below link to reset you password <br> <b>http://localhost/amcs/reset-password?id='.$id.'</b>'; // Example body    

    // Success sent message alert
    try {
        $mail->send();
        echo "<script> 
                document.location.href = 'forgot?mailsent=true';
              </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}
?>