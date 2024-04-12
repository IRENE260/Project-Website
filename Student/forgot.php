<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // Adjust the path as needed if not using Composer

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "apoint";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Ensure the input is a valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        echo "No user found with that email address.";
        exit;
    }

    $token = bin2hex(random_bytes(50)); // Generate a secure token
    $expires = date("Y-m-d H", time() + 3600); // Token expires in 1 hour

    // Update user record with reset token and expiry
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
    $stmt->bind_param("sss", $token, $expires, $email);
    $stmt->execute();

    // Send email
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'mailto:your_email@example.com'; // SMTP username
        $mail->Password = 'your_password'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setfrom('from@example.com', 'Mailer');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $url = "http://yourwebsite.com/reset_password.php?token=$token"; // Adjust accordingly
        $mail->Body    = "Hi there, click on this <a href='$url'>link</a> to reset your password on our site.";

        $mail->send();
        echo 'Reset password link has been sent to your email.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Show a simple "Forgot your password" form
    ?>
    <!DOCTYPE html>
    <html>
        <body>
    <form action="forgot.php" method="post"> <!-- Adjust the action as needed -->
        Email address: <input type="email" name="email" required>
        <input type="submit" value="Send Reset Link">
    </form>
</body>
</html>
    <?php
}
?>
