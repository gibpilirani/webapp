<?php
include_once('../functions/dbFunction.php');
include_once('../functions/dbUsers.php');
   	//Create a user object and instatiate it
    $userObject = new dbUsers();
	 $checkIfExist = $userObject->isUserExist($_POST['email']);
      if($checkIfExist) {
        echo "<span class='text-danger'>Username has already been taken</span><br>";
      }else{
        echo "<span class='text-info'>This user is available</span><br>";
      }

?>