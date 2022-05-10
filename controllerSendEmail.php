<?php
use PHPMailer\PHPMailer\PHPMailer;
		require_once "PHPMailer/PHPMailer.php";
		require_once "PHPMailer/SMTP.php";
		require_once "PHPMailer/Exception.php";

    class controllerSendEmail {
      public function sendEmailLink($email, $token){
		$mail = new PHPMailer();
	
        //SMTP Settings
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = "histormalawi@gmail.com";
		$mail->Password = 'Amblessed2022/';
    $mail->Port = 465; //587
    $mail->SMTPSecure = "ssl"; //tls

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom("histormalawi@gmail.com", 'Reset Password');
    $body = '
    <!doctype html>
    <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Reset password</title>
      <link rel="shortcut icon" type="image/jpg" href="images/favicon.ico" />
    </head>
    <body>
    <div class="container">
    Hello there
    <p>Please click here to reset your password.</p>
        <a href="localhost/history/verify.php?password-token='. $token. ' ">Reset your password</a>
    </div>
    </body>
    </html>'
    ;

    $mail->addAddress($email);
    //$mail->Subject = $subject;
    $mail->Body = $body;
    $mail->send();

  }

  }

  ?>
