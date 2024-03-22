<?php
include('smtp/PHPMailerAutoload.php');

    //echo "hello";die;
    if(isset($_POST["send"])){
        
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jerinmathai14@gmail.com';
        $mail->password = 'yreifxxuzgrgliws'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('jerinmathai14@gmail.com');
        $mail->addAddress($_POST["usermail"]);
        
        $mail->isHTML(true);

        $mail->Subject = "OTP for password recovery";
        $mail->body = "Yor OTP to recover password is '284617'. It is valid only upto 5 mintues.";

        $mail->send();

        echo "
            <script>
                alert('Mail send Successfully');
                document.location.href= 'mail.php';
            </script>
        ";
    }
?>