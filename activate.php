<?php
include_once('functions/dbUsers.php');
$userData = new dbUsers();
  if (isset($_GET["id"])) {
  $id = intval(base64_decode($_GET["id"]));
  $check = $userData->checkStatus($id);
  //Check if account available
   if ($check) {
      foreach ($check as $value) {
        
      }
     $status = $value['status'];
     //If already activated
      if ($status == "active") {
        exit("Your account has already been activated.");
      } else {
        //Activate user
        $activate = $userData->activateUser($id);
        exit("Your account has been activated.");
      }
    } else {
      exit("No account found");
    }
}
?>