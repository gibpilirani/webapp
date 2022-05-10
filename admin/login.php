<?php
  include_once('../functions/dbUsers.php');
 
  $userLogin = new dbUsers();
  $dbConnect = new dbConnect();
   $response = array( 
  'status' => 0, 
  'message' => 'Sorry login failed, please try again.' 
  );
  if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) AND !empty($password)) {      
      $data = $userLogin->AdminLogin($email, $password);
      if ($data) {
         header("Location: index.php");
      }else  {
        // Wrong username or password
        $response['status'] = 2;
        $response['message'] = 'Incorrect username/password combination';
      }
    } else {
      // Login Failed
        $response['status'] = 3;
        $response['message'] = 'Pleas email and password fields cannot be empty';
    }
  }
  echo json_encode($response);
  ?>
