<?php
  include_once('functions/dbUsers.php');
  /*if(!isset($_SESSION)) {
  session_start();
  }*/
  
  $userLogin = new dbUsers();
  $dbConnect = new dbConnect();
  $chekemail = " ";
   $response = array( 
  'status' => 0, 
  'message' => 'Sorry login failed, please try again.' 
  );
  //if(isset($_POST['login'])) {
  if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //$remember = $_POST['remember'];
    if (!empty($email) AND !empty($password)) {      
      $data = $userLogin->Login($email, $password);
      if ($data) {
        /*if (!empty($remember)) {
          echo "cookei";
          setcookie("login_user", $_POST['email'],
          time()+(60*1));
        } else {
          if(isset($_COOKIE["login_user"])) {
            setcookie("login_user", "");
          }
        }*/
        //Successful login
        $response['status'] = 1; 
        $response['message'] = 'Loggedin successfully'; 
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

  //}
  }
      echo json_encode($response);
  ?>