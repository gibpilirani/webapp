<?php
  session_start();//session is a way to store information (in variables) to be used across multiple pages.
  unset($_SESSION['email']);
  session_destroy();
  //header("Location:user-login.php");//use for the redirection to some page
  if(isset($_SERVER['HTTP_REFERER'])) {
    //header('Location: '.$_SERVER['HTTP_REFERER']); 
    header('Location: user-login.php'); 
  } else {
    header('Location: index.php');  
  }
  exit;
  ?>