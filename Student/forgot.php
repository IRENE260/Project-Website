<!DOCTYPE html>
    <html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forgot.css">
    
        <body>
        <div class="container">
    <form action="sendmail" method="post"> 
    <h2> Forgot Password </h2>
        Email address: <input type="email" name="email" required>
        <button type="submit" class="submit-btn">Send Reset Link</button><br><br>
        <button type="submit" class="submit-btn" onclick="location.href = 'sls.php';">Back To Login</button>
    </form><br>
        <?php if(isset($_GET['mailsent']) && $_GET['mailsent'] == 'true'): ?>
            <div class="success-message" style="color: green; margin-bottom: 15px;">Email sent successfully!</div>
        <?php elseif(isset($_GET['mailsent']) && $_GET['mailsent'] == 'false'):?>
            <div class="success-message" style="color: red; margin-bottom: 15px;">User doesn't exist</div>
        <?php endif; ?>
</body>
</html>
<style>
 .submit-btn{
    width: 50%;
 }
</style>