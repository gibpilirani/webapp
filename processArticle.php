<?php
session_start();
  include_once('functions/dbFunction.php');
  include_once('functions/dbArticles.php');
  
  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['loggedin'])) {
  header('Location: user-login.php');
  exit;
  }
  
$insertArticle = new dbArticles();
  $response = array();
  $errors = array();
  
  
  if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['country'])){ 
  $title = $_POST['title'];
  $content = $_POST['content'];
  $country = $_POST['country'];
  $category = $_POST['category'];
  $author = $_SESSION['email'];
  $filename = $_FILES['file']['name'];

  // get the file extension
  $extension = (strtolower(pathinfo($filename, PATHINFO_EXTENSION)));

  if(empty($title)) {
    $errors['title'] = "Title is required";
  }

  $checkIfExist = $insertArticle->isTitleExist($title);
  if($checkIfExist){
    $errors['title_exist'] = "Title already exist!"; 
  } 

  if(empty($content)) {
    $errors['content'] = "Body cannot be empty";
  }

  if(empty($country)) {
    $errors['country'] = "Please select country";
  }

  if(empty($category)) {
    $errors['category'] = "Please select category";
  }

  if(empty($filename)) {
    $errors['file'] = "Please select file to upload";
  } else 

  
 
  //check if file format is correct
  if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
    $errors['file_extension'] = "You file extension must be .jpeg, .gif, .gif or .png!";
  }

  // destination of the file on the server
    $destination = 'uploads/' . $filename;

  // the physical file on a temporary uploads directory on the server
  $file = $_FILES['file']['tmp_name'];
  $size = $_FILES['file']['size'];
  if($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
    $errors['file_size'] = "The image is too large!";
  } 
  
  $response['errors'] = $errors;

  if(!empty($errors)) {
    $response['success'] = false;
    $response['message'] = 'Fail';
  } else {
    // move the uploaded (temporary) file to the specified destination
     if(move_uploaded_file($file, $destination)) {    
      $insert =  $insertArticle->insertArticle($title, $content, $country, $filename, $author, $category);
      if($insert){
        $response['success'] = true; 
        $response['message'] = "Article created successfully..!";         
      }
      }        
      
  }
}
  
  echo json_encode($response);
  ?>