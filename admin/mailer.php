<?php
require "../PHPMailer/PHPMailerAutoload.php";


        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->Port = 587;
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'historymalawi@gmail.com';
        $mail->Password = 'Amblessed2021/'; 

        $mail->setFrom('historymalawi@gmail.com', 'Gibson');
        $mail->addAddress('gibson.dzimbiri@hotmail.com'); 
        $mail->AddReplyTo('historymalawi@gmail.com');

   
        $mail->IsHTML(true);
        $mail->Subject = 'Ph mailer';
        $mail->Body = '<h4>Hello message</h4>';
        if(!$mail->Send())
        {
            $error = "Please try Later, Error Occured while Processing...";
            
        }
        else 
        {
            $error = "Thanks You !! Your email is sent.";  
            
        }
    
    
?>

<html>
    <head>
        <title>PHPMailer 5.2 testing from DomainRacer</title>
    </head>
    <body style="background: black;">
        <center><h2 style="padding-top:70px;color: white;"><?php echo $error; ?></h2></center>
    </body>
    
</html>