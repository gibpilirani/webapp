<?php
include_once('../functions/dbUsers.php');
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'] )) {
  header('Location: admin_login.php');
  exit;
} else {
  if (isset($_SESSION['loggedin'] )) {
    if($_SESSION['type'] !== 'admin') {
      header('Location: admin_login.php');
      exit;
    }
  } 
}

include_once('../functions/dbFunction.php');
$userData = new dbUsers();
$response = array();
$errors = array();
  
if(isset($_POST['password'])) {
  $id = $_SESSION['id'];
  $old_password = $_POST['old-password'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];
  

  if(empty($old_password)) { 
    $errors['oldpassword'] =  "Old password is required";
  }

  if(empty($password)) {
    $errors['password'] =  "New password is required";
  }
  if(empty($c_password)) { 
    $errors['confirm_password'] = "Confirm new password is required";
  }

  $edit_password = $userData->editPassword($id, $old_password);
  if(!$edit_password) {
    $errors['wrong_password'] ="Old password is wrong";
  }

  if($password != $c_password) {
    $errors['equal_password'] = "Password and confirm password do not match";
  } 

  $response['errors'] = $errors;

  if(!empty($errors)) {
    $response['success'] = false;
    $response['message'] = 'Fail';
  }  else {
    //Update user method
    $update = $userData->updatePassword($id, $password);
    if ($update) { 
      $response['success'] = true; 
      $response['message'] = "Password is updated";
      } else {
        $response['success'] = false; 
        $response['message'] = "Something is wrong";
      }
    }
}
echo json_encode($response);
?>