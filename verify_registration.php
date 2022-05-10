<?php
    use PHPMailer\PHPMailer\PHPMailer;
    $response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
    );
    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

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
        $mail->setFrom("histormalawi@gmail.com", 'History of Computing');
        $mail->addAddress("$email");
        $mail->addAddress("histormalawi@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            $response['status'] = 1;
            $response['message'] = "<span class='text-success'>Thank you for submitting your message</span>";
        } else {
            $response['status'] = 2;
            $response['message'] = "<span class='text-danger'>Something is wrong</span.";
        }

        echo json_encode($response);
    }
?>
