<?php
include_once('../functions/dbFunction.php');
include_once('../functions/dbUsers.php');
// must end with a slash

use PHPMailer\PHPMailer\PHPMailer;
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

$userObject = new dbUsers();
$errors = array();
$response = array();

if (isset($_POST['lastname']) && isset($_POST['firstname'])) {
  //Check lastname is empty
  if(empty($_POST['lastname'])) {
    $errors['lastname'] = 'Lastname is needed';
  }
  //Check firstname is empty
  if(empty($_POST['firstname'])) {
    $errors['firstname'] = 'Firstname is needed';
  }
  //Check email is empty
  if(empty($_POST['email'])) {
    $errors['email'] = 'Email is needed';
  }

  //Check if the email is valids
  $email = $_POST['email'];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['invalidEmail'] = 'Email is not valid';
  }
  //Check confirm email is empty
  if(empty($_POST['repeatEmail'])) {
    $errors['repeatEmail'] = 'Confirm email is needed';
  }
  //Check password is empty
  if(empty($_POST['password'])) {
    $errors['password'] = 'Password is needed';
  }
  //Check confirm password is empty
  if(empty($_POST['repeatPassword'])) {
    $errors['repeatPassword'] = 'Confirm password is needed';
  }
  //Check gender is empty
  if(empty($_POST['gender'])) {
    $errors['gender'] = 'Gender is needed';
  }
  //Check designation is empty
  if(empty($_POST['designation'])) {
    $errors['designation'] = 'Designation is needed';
  }
  //Check address is empty
  if(empty($_POST['addressOne'])) {
    $errors['addressOne'] = 'Address is needed';
  }
  //Check city is empty
  if(empty($_POST['city'])) {
    $errors['city'] = 'City is needed';
  }
  //Check country is empty
  if(empty($_POST['country'])) {
    $errors['country'] = 'Country is needed';
  }
  //Check file is empty
  if(empty($_FILES['file']['name'])) {
    $errors['file'] = 'Please upload profile photo';
 }

  $response['errors'] = $errors;

  if(!empty($errors)) {
    $response['success'] = false;
    $response['message'] = 'FAIL';
  } else {
    //Pass all the data to the processing function
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $repeatEmail = $_POST['repeatEmail'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $gender = $_POST['gender'];
    $designation = $_POST['designation'];
    $address_one = $_POST['addressOne'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];
    // name of the uploaded file
    $filename = $_FILES['file']['name'];
    // destination of the file on the server
    $destination = 'profile/' . $filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
      $errors['file-type'] = "You file extension must be .jpeg, .jpg, .gif or .png";
    } elseif ($_FILES['file']['size'] > 1000000) { 
    // file shouldn't be larger than 1Megabyte

      $errors['file-size'] = "The image is too large!";
    } else {
    // move the uploaded (temporary) file to the specified destination
      if (move_uploaded_file($file, $destination)) {
        $insert = $userObject->UserRegister($lastname, $firstname, $email, $password, $filename, $gender, $designation);

        $insert_address = $userObject->address($address_one, $city, $country, $zip, $email);
        if ($insert) {
          $response['success'] = true;
          $response['message'] = 'SUCCESS';
        }
      }
    }
    $response['success'] = true;
    $response['message'] = 'SUCCESS';
  }
}
  
//}
  echo json_encode($response);
