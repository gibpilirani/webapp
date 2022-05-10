<?php
include_once('functions/dbFunction.php');
include_once('functions/dbArticles.php');
if(!isset($_SESSION)) {
 session_start();
}
$updateArticle = new dbArticles();

$response = array( 
  'status' => 0, 
  'message' => 'Form submission failed, please try again.' 
);
$checkIfExist = $message = $success = "";
$updateArticle = new dbArticles();
if(isset($_POST['id'])){
  $id = $_POST['id']; 
  $title = $_POST['title'];
  $content = $_POST['content'];
  $country = $_POST['country'];
  $category = $_POST['category'];
  $author = $_SESSION['email'];
  $status = $_POST['status'];
  $featured = $_POST['featured'];
  $category =$_POST['category'];
  if(!empty($title) && !empty($content) && !empty($country) && !empty($category)) {
      //name of the uploaded file
    $filename = $_FILES['file']['name'];
    if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
      $query = $updateArticle->selectImage($id);
      foreach ($query as $value) {
        $image = $value['image'];
      }
      $insert =  $updateArticle->editArticle($id, $title, $content, $country, $status, $featured, $category, $image);     
      if($insert) {
        $response['status'] = 1; 
        $response['message']= "<div style='padding-top: 100px'>Article updated successfully</div>";
      }     
    }else {

          // destination of the file on the server
      $destination = 'uploads/' . $filename;

          // get the file extension
      $extension = pathinfo($filename, PATHINFO_EXTENSION);

          // the physical file on a temporary uploads directory on the server
      $file = $_FILES['file']['tmp_name'];
      $size = $_FILES['file']['size'];
      if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
        $message = "You file extension must be .jpeg, .gif, .gif or .png";
          } elseif ($_FILES['file']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
          echo "The image is too large!";
        } else {
          // move the uploaded (temporary) file to the specified destination
          if (move_uploaded_file($file, $destination)) {
            $insert =  $updateArticle->editArticle($id, $title, $content, $country, $status, $featured, $category, $filename);
            if($insert){
              $response['status'] = 2; 
              $response['message']= "<div style='padding-bottom: 500px'>Article updated successfully</div>";
            } else {
             $response['status'] = 3; 
             $response['message']= "Failed to upload file.";
           }
         }
       }
      //}
     }
   } else {
    $response['status'] = 4; 
    $response['message']= "One of the fileds is empty please check and fill it.";
    echo $title . " ". $content . " " . $country. " " .$category;

  }
}
echo json_encode($response);
?>

