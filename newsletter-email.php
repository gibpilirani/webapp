<?php
include_once('functions/dbUsers.php');
$userEmail = new dbUsers();
use PHPMailer\PHPMailer\PHPMailer;
$feedback = array( 
	'status' => 0, 
	'respond' => 'Form submission failed, please try again.' 
);

$response = array();
$errors = array();
if (isset($_POST['subject'])) {
	$subject = $_POST['subject'];
	$body = $_POST['body'];

	if(empty($subject)) {
    $errors['subject'] = "Subject filed is empty";
	}

	if(empty($body)) {
    $errors['message_body'] = "The message field is empty";
	}

	$response['errors'] = $errors;

	if(!empty($errors)) {
		$response['success'] = false;
		$response['message'] = 'FAIL';
	} else {
		require_once "PHPMailer/PHPMailer.php";
		require_once "PHPMailer/SMTP.php";
		require_once "PHPMailer/Exception.php";

		$query = $userEmail->email();
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
    foreach ($query as $value) {
			$email = $value['email'];
			$mail->addBcc("$email");
    }
    $mail->addAddress("histormalawi@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $body;

		

    if ($mail->send()) {
			
			$response['success'] = true;
			$response['message'] = 'News letter has been distibuted';
    } else {
			
			$response['success'] = false;
			$response['message'] = 'Something is wrong';
    }
    
	}
    echo json_encode($response);
}
?>
