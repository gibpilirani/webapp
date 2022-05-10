<?php
 include_once('functions/dbFunction.php');
 include_once('functions/dbArticles.php');
 if(!isset($_SESSION)) {
 session_start();
 }
 $delete = new dbArticles();

 if(isset($_GET['delete_id'])) {
 	$id = $_GET['delete_id'];

	 $delete_images = $delete->selectImage($id);
	 foreach ($removeImages as $removeImage) {
		 echo $removeImage['id'];
		 echo $removeImage['image'];
	 }
	 unlink("uploads/". $removeImage['image']);
 // Select the record that is going to be deleted

 	$query = $delete->deleteArticle($id);
 	if($query){
 		echo "article deleted successfully";
 	}
 }



    