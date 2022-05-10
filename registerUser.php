<?php
include_once('functions/dbFunction.php');
include_once('functions/dbUsers.php');
// must end with a slash

use PHPMailer\PHPMailer\PHPMailer;
if (!isset($_SESSION)) {
  session_start();
}

$userObject = new dbUsers();
$errors = array();
$response = array();

if (isset($_POST['lastname']) && isset($_POST['firstname'])) {
  //Check lastname is empty
  if(empty($_POST['lastname'])) {
    $errors['lastname'] = 'Lastname is required';
  }
  //Check firstname is empty
  if(empty($_POST['firstname'])) {
    $errors['firstname'] = 'Firstname is required';
  }

  $email = $_POST['email'];
  //Check email is empty
  if(empty($_POST['email'])) {
    $errors['email'] = 'Email is required';
  }

  
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //Check if the email is valids
    
      $errors['invalidEmail'] = 'Email is not valid';
  }

  $checkIfExist = $userObject->isUserExist($_POST['email']);
    if($checkIfExist) {
      $errors['userexist'] = 'This username is already taken. Please try another one';
  }
  //Check confirm email is empty
  if(empty($_POST['repeatEmail'])) {
    $errors['repeatEmail'] = 'Confirm email is required';
  }
  //Check password is empty
  if(empty($_POST['password'])) {
    $errors['password'] = 'Password is required';
  }
  //Check confirm password is empty
  if(empty($_POST['repeatPassword'])) {
    $errors['repeatPassword'] = 'Confirm password is required';
  }
  //Check gender is empty
  if(empty($_POST['gender'])) {
    $errors['gender'] = 'Gender is required';
  }
  //Check designation is empty
  if(empty($_POST['designation'])) {
    $errors['designation'] = 'Designation is required';
  }
  //Check address is empty
  if(empty($_POST['addressOne'])) {
    $errors['addressOne'] = 'Address is required';
  }
  //Check city is empty
  if(empty($_POST['city'])) {
    $errors['city'] = 'City is required';
  }

  //Check zip code is empty
  if(empty($_POST['zip'])) {
    $errors['zip'] = 'Zip code is required';
  }
  //Check country is empty
  if(empty($_POST['country'])) {
    $errors['country'] = 'Country is required';
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
          $response['message'] = 'Thank you for signing up. We will get back to you';
          require_once "PHPMailer/PHPMailer.php";
          require_once "PHPMailer/SMTP.php";
          require_once "PHPMailer/Exception.php";
    
          $mail = new PHPMailer();
          $subject = "Registration";
          $body = "Thank you for signing up with History of Computing in Malawi. We will get back to you once your accounted is activated";
    
          //SMTP Settings
          $mail->isSMTP();
          $mail->Host = "smtp.gmail.com";
          $mail->SMTPAuth = true;
          $mail->Username = "histormalawi@gmail.com";
          $mail->Password = 'Amblessed2022/';
          $mail->Port = 465; //587
          $mail->SMTPSecure = "ssl"; //tls
    
          //Email Settings
          $mail->isHTML(true);
          $mail->setFrom("histormalawi@gmail.com", 'History of Computing');
          $mail->addAddress("$email");
          $mail->addAddress("histormalawi@gmail.com");
          $mail->Subject = $subject;
          $mail->Body = $body;
    
          if ($mail->send()) {
              $response['success'] = true;
              $response['message'] = 'Your inquiry has been sent. We will come back to you soon';
          }
        } else {
          $response['success'] = false;
          $response['message'] = 'Something is wrong please try gain later';
        }
      }
    }
   
  }
}
  
//}
  echo json_encode($response);
