<?php
include_once("functions/dbUsers.php");
include_once('controllerSendEmail.php');

$send_email = new controllerSendEmail();

$forgot_password_user = new dbUsers();

$errors = array();
$response = array();

if(isset($_POST['email'])){
  $email = $_POST['email'];
  
  //Check if email is empty
  if(empty($email)) {
    $errors['email'] = 'Email is needed';
  }

  //Check if the email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['invalidEmail'] = 'Email is not valid';
  }

  $response['errors'] = $errors;

  if(!empty($errors)) {
    $response['success'] = false;
    $response['message'] = 'Fail';
  } else {
    $query = $forgot_password_user->isUserExist($email);
    if($query){
      $user = $forgot_password_user->UserExist($email);
      foreach($user as $users) {
        $password_id = $users['id'];
      }
      //Generate a random string.
      $token = openssl_random_pseudo_bytes(16);

      //Convert the binary data into hexadecimal representation.
      $token = bin2hex($token);
      $forgot_password_user->updateToken($password_id, $token);
      //Print it out for exampl
      $send_email->sendEmaillink($email, $token);
      //header('location: password_message.php'); 
      $response['success'] = true;
      $response['message'] = 'Success';
    }
  }
} else if(isset($_POST['user_id'])) {
  $user_id = $_POST['user_id'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  //check if password is empty
  if(empty($password)) {
    $errors['password'] = "Password i required";
  }

   //check if confirm password is empty
  if(empty($confirm_password)) {
    $errors['confirm_password'] = "Confirm password is required";
  }

   //check if password and confirm password are not equal
  if($password != $confirm_password) {
    $errors['no_equal_passwords'] = " Password and confirm password do not match";
  }
  

  //assign error value to response array
  $response['errors'] = $errors;

  //check 
  if(!empty($errors)) {
    $response['success'] = false;
    $response['message'] = 'Fail';
  } else {
    $update_password = $forgot_password_user->updatePassword($user_id, $password);
    if($update_password) {
      //header('location: user-login.php');
      $response['success'] = true;
      $response['message'] = 'Success';
    } else {
      $response['success'] = false;
      $response['message'] = 'Password change failed';
    }
  }
}

echo json_encode($response);
?>