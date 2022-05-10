<?php
session_start();
  include_once('../functions/dbUsers.php');
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: admin_login.php');
  exit;
} 
 include_once('../functions/dbFunction.php');
  $userData = new dbUsers();      
 /*$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
  );*/
        if(isset($_POST['email'])) {
          $id = $_POST['id'];
          $lastname = $_POST['lastname'];
          $firstname = $_POST['firstname'];
          $email = $_POST['email'];
          //$password = $_POST['password'];
          //$confirmPassword = $_POST['confirmPassword'];
          $gender = $_POST['gender'];
          $contact = $_POST['mobile'];
          $designation = $_POST['designation'];
          $status = $_POST['status'];
          $profile_image = $_FILES['profile_image']['name'];
          if(!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] == UPLOAD_ERR_NO_FILE) {
            $query = $userData->fetchUsers($id);
            foreach ($query as $value) {
            $profile_image = $value['profile_image'];
          }

          //Update user method
          $update = $userData->updateUsers($id, $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation, $status);
          if ($update){ 
            /*$response['status'] = 1; 
            $response['message']= "Article updated successfully";*/
            exit('Article updated succefully');
          } else {
            /*$response['status'] = 2; 
            $response['message']= "There was a problem please again later";*/
            exit('Article updated succefully');
          }
        } else {
          //Name of the uploaded file
          $profile_image = $_FILES['profile_image']['name'];

          //Destination of the file on the server
          $destination = '../profile/' . $profile_image;

          //Get the file extension
          $extension = pathinfo($profile_image, PATHINFO_EXTENSION);

          //The physical file on a temporary uploads directory on the server
          $file = $_FILES['profile_image']['tmp_name'];
          $size = $_FILES['profile_image']['size'];

          //Check if the correct file format is uploaded
          if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
            /*$response['status'] = 3; 
            $response['message']= "You file extension must be .jpeg, .gif, .gif or .png";*/

            exit('Your file extension must be .jpeg, .gif, .gif or .png');
          } elseif ($_FILES['profile_image']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            /*$response['status'] = 4; 
            $response['message']= "The image is too large!";*/
            exit('The image is too large');
          } else {
            // Move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
              $update = $userData->updateUsers($id, $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation, $status);
              if($update) {
                /*$response['status'] = 5; 
                $response['message']= "Article updated successfully";*/
                exit('Article updated succefully');
              } else {
                /*$response['status'] = 6; 
                $response['message']= "Sorry there was a problem please try gain";*/
                exit('Sorry there was a problem pleas try again later');
              }
            }
          }
        }
      }
      ?>