<?php
    use PHPMailer\PHPMailer\PHPMailer;
   /*  $response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
    ); */

  $errors = array();
	$response = array();
  if (isset($_POST['name']) && isset($_POST['email'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $body = $_POST['body'];

      if(empty($_POST['name'])) {
          $errors['name'] = "Name is required!";
      }

      if(empty($email)) {
          $errors['email'] = "Email is required!";
      }

      if(empty($subject)) {
          $errors['subject'] = "Subject is required!";
      }

      if(empty($body)) {
          $errors['message_body'] = "Message is required!";
      }

      $response['errors'] = $errors;

      
      if(!empty($errors)) {
          $response['success'] = false;
          $response['message'] = 'FAIL';
      } else {

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
          $response['success'] = true;
          $response['message'] = 'Your inquiry has been sent. We will come back to you soon';
      } else {
          $response['success'] = false;
    $response['message'] = 'Check your internet connection';
      }
  }
      
  }
  echo json_encode($response);
?>
