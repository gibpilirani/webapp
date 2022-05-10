<?php
include_once('../functions/dbFunction.php');
include_once('../functions/dbArticles.php');
session_start();
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

$delete = new dbArticles();

if(isset($_POST['id'])) {
  $articleId = $_POST['id'];

  $removeImages = $delete->selectImage($articleId);
	 foreach ($removeImages as $removeImage) {
		 $image_delete = $removeImage['image'];
      //remove image from server
	 unlink("../uploads/". $image_delete);
	 }
  

 // delete data from database
  $query =$delete->deleteArticle($articleId);
  echo "Data deleted successfully";
}


