<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
  header('Location: user-login.php');
    exit;
  }
?>
<?php
	include_once('functions/dbFunction.php');
	//include_once('functions/dbArticles.php');
	include_once('functions/dbImage.php');
	$getImages = new dbImage();
	$errors = array();
	$response = array();
	// Check if user has uploaded new image
	if (isset($_POST['title']) && isset($_POST['id']) && isset($_POST['description'])) {
		// Check to make sure the image is not empty and replace the old file with new uploaded file
		if (!empty($_FILES['image']['tmp_name'])){
		
    //Check if title is empty
		if(empty($_POST['title'])) {
			$errors['title'] = 'Please title is required';
		}
    
    //Check if description is empty
		if(empty($_POST['description'])) {
			$errors['description'] = 'Please description is required';
		}

		// The folder where the images will be stored
		$target_dir = 'gallery/';
    //Temprary file name
		$file = $_FILES['image']['tmp_name'];
		// The path of the new uploaded image
		$image_path = $target_dir ."". $_FILES['image']['name'];
		$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

		if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
      $errors['fileType'] = "You file extension must be .jpeg, .jpg, .gif or .png";
    } 
		
		if ($_FILES['image']['size'] > 10000000) { 
    // file shouldn't be larger than 1Megabyte
      $errors['file_size'] = "The image is too large!";
    } 

			$response['errors'] = $errors;
			
			if(!empty($errors)) {
				$response['success'] = false;
				$response['message'] = 'FAIL';
			} else {
	
			$title = $_POST['title'];
			$description =  $_POST['description'];
			$filename = $_FILES['image']['name'];
      //If new file is uploaded remove the old one from folder
      $id = $_POST['id'];
      $removeImages = $getImages->queryForDeletion($id);
      foreach ($removeImages as $removeImage) {
        echo $removeImage['id'];
        echo $removeImage['path'];
      }
			//Remove old file from folder
      unlink("gallery/". $removeImage['path']);
		// Everything checks out now we can move the uploaded image
		if(move_uploaded_file($file, $image_path)) {
		// Insert image info into the database (title, description, image file)
			//Call the method to insert data
      $image_update = $getImages->updateImage($id, $title, $description, $filename);
		//$msg = 'Image uploaded successfully!';
		// 
		$response['success'] = true;
		$response['message'] = 'Record has been updated successfully';
		} 
	}
	}else {
    //Update the title and desription and maintain old file
    if(empty($_POST['title'])) {
			$errors['title'] = 'Please title is required';
		}

		if(empty($_POST['description'])) {
			$errors['description'] = 'Please description is required';
		}

    $response['errors'] = $errors;
			
    if(!empty($errors)) {
      $response['success'] = false;
      $response['message'] = 'FAIL';
    } else {

    	$id = $_POST['id'];
      $removeImages = $getImages->queryForDeletion($id);
      foreach ($removeImages as $removeImage) {
        $removeImage['id'];
        $filename =  $removeImage['path'];
      }
			$title = $_POST['title'];
			$description =  $_POST['description'];
      //Update the title and desription and maintain old file
      $image_update = $getImages->updateImage($id, $title, $description, $filename);
      $response['success'] = true;
		  $response['message'] = 'Record has been updated successfully';
    }

  }
}
	echo json_encode($response);
?>