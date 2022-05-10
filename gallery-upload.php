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
	$images = new dbImage();
	$errors = array();
	$response = array();
	// Check if user has uploaded new image
	if (isset($_POST['title']) && isset($_POST['description'])) {
		
		if(empty($_POST['title'])) {
			$errors['title'] = 'Please title is required';
		}

		if(empty($_POST['description'])) {
			$errors['description'] = 'Please description is required';
		}

		// The folder where the images will be stored
		$target_dir = 'gallery/';
		// The path of the new uploaded image
		// get the file extension
		//$image_path = $target_dir . basename($_FILES['image']['name']);
		// Check to make sure the image is valid
		if (empty($_FILES['image']['tmp_name'])){
			$errors['file'] = 'Please upload file.';
		} 
		
		//$size = getimagesize($_FILES['image']['tmp_name']);
		
		

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
		// Everything checks out now we can move the uploaded image
		if(move_uploaded_file($file, $image_path)) {
		// Insert image info into the database (title, description, image file)
		$images->insertImage($title, $description, $filename);
		//$msg = 'Image uploaded successfully!';
		// 
		$response['success'] = true;
		$response['message'] = 'The image is uploaded';
		} else {
			$response['success'] = false;
			$response['message'] = 'FAIL';
		}
	}
	}

	echo json_encode($response);
?>