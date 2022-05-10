<?php
include_once('functions/dbFunction.php');
include_once('functions/dbUsers.php');
   	//Create a user object and instatiate it
    $userObject = new dbUsers();
	 $checkIfExist = $userObject->isUserExist($_POST['email']);
      if($checkIfExist) {
        echo "<span class='text-danger'>This username is already taken. Please try another one</span><br>";
      }

?>