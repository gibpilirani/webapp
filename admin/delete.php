<?php
include_once('../functions/dbUsers.php');
 $funObj = new dbUsers();
if(isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $query =$funObj->deleteUser($id);    
    echo 1;
  }
?>