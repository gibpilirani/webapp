<?php
include_once('../functions/dbUsers.php');
use PHPMailer\PHPMailer\PHPMailer;
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: admin_login.php');
  exit;
}
include_once('../functions/dbFunction.php');
$userData = new dbUsers();

if(isset($_POST['email'])) {
  $id = $_POST['id'];
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $email = $_POST['email'];
  $c_email = $_POST['confirm-email'];
          //$profile_image = $_POST['profile-image'];
  $gender = $_POST['gender'];
  $contact = $_POST['telephone'];
  $designation = $_POST['designation'];
  $status = $_POST['status'];
  $type = $_POST['type'];
  $telephone = $_POST['telephone'];
  $address_id = $_POST['address_id']; 
  $address_one = $_POST['address']; 
  $city = $_POST['city'];  
  $country = $_POST['country']; 
  $zip = $_POST['zip'];
  $user_email = $_POST['email'];
  if ($email != $c_email) {
    exit('<span class="text-danger">Email and confirm email do not match</span>');
  }else {
    if($status == 'active') {
    //$password = $_POST['password'];
      $profile_image = $_FILES['profile-image']['name'];
      if(!isset($_FILES['profile-image']) || $_FILES['profile-image']['error'] == UPLOAD_ERR_NO_FILE) {
        $query = $userData->fetchUsers($id);
        foreach ($query as $value) {
          $profile_image = $value['profile_image'];
        }

          //Update user method
        $update = $userData->updateUsers($id, $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation, $status, $type);
        $update_address = $userData->update_address($address_id, $address_one, $city, $country, $zip);
        if ($update){ 
            /*$response['status'] = 1; 
            $response['message']= "Article updated successfully";*/
            exit('1');
          } else {
            /*$response['status'] = 2; 
            $response['message']= "There was a problem please again later";*/
            exit('There was a problem please again later');
          }
        } else {
          //Name of the uploaded file
          $profile_image = $_FILES['profile-image']['name'];

          //Destination of the file on the server
          $destination = '../profile/' . $profile_image;

          //Get the file extension
          $extension = pathinfo($profile_image, PATHINFO_EXTENSION);

          //The physical file on a temporary uploads directory on the server
          $file = $_FILES['profile-image']['tmp_name'];
          $size = $_FILES['profile-image']['size'];

          //Check if the correct file format is uploaded
          if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
            /*$response['status'] = 3; 
            $response['message']= "You file extension must be .jpeg, .gif, .gif or .png";*/

            exit('Your file extension must be .jpeg, .gif, .gif or .png');
          } elseif ($_FILES['profile-image']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            /*$response['status'] = 4; 
            $response['message']= "The image is too large!";*/
            exit('The image is too large');
          } else {
            // Move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
              $update = $userData->updateUsers($id, $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation, $status, $type);
              $update_address = $userData->update_address($address_id, $address_one, $city, $country, $zip);
              if($update) {
                /*$response['status'] = 5; 
                $response['message']= "Article updated successfully";*/
                exit('1');
              } else {
                /*$response['status'] = 6; 
                $response['message']= "Sorry there was a problem please try gain";*/
                exit('Sorry there was a problem pleas try again later');
              }
            }
          }
        }



          //Subject
        $subject = 'Thank you for registering with us';
          // my message to send to the user
        $message = '<html><head>
        <title>Account activation Verification</title>
        </head>
        <body>';
        $message .= '<h1>Hi ' . $firstname . ' ' . $lastname . '!</h1>';
        if($status == 'active') {
          $message .= "Your account has been activated</p>";
        }

        if($status == 'disabled') {
          $message .= "Your account has been activated</p>";
        }
        
        $message .= "</body></html>";

        require_once "../PHPMailer/PHPMailer.php";
        require_once "../PHPMailer/SMTP.php";
        require_once "../PHPMailer/Exception.php";

        $mail = new PHPMailer();

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
        $mail->Body = $message;

        if ($mail->send()) {
          $response['status'] = 1;
          $response['message'] = "<span class='text-success'>Thank you for submitting your message</span>";
        } else {
          $response['status'] = 2;
          $response['message'] = "<span class='text-danger'>Something is wrong</span.";
        }

      }else{
        $profile_image = $_FILES['profile-image']['name'];
        if(!isset($_FILES['profile-image']) || $_FILES['profile-image']['error'] == UPLOAD_ERR_NO_FILE) {
          $query = $userData->fetchUsers($id);
          foreach ($query as $value) {
            $profile_image = $value['profile_image'];
          }

          //Update user method
          $update = $userData->updateUsers($id, $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation, $status, $type);
          $update_address = $userData->update_address($address_id, $address_one, $city, $country, $zip);
          if ($update){ 
            /*$response['status'] = 1; 
            $response['message']= "Article updated successfully";*/
            exit('1');
          } else {
            /*$response['status'] = 2; 
            $response['message']= "There was a problem please again later";*/
            exit('There was a problem please again later');
          }
        } else {
          //Name of the uploaded file
          $profile_image = $_FILES['profile-image']['name'];

          //Destination of the file on the server
          $destination = '../profile/' . $profile_image;

          //Get the file extension
          $extension = pathinfo($profile_image, PATHINFO_EXTENSION);

          //The physical file on a temporary uploads directory on the server
          $file = $_FILES['profile-image']['tmp_name'];
          $size = $_FILES['profile-image']['size'];

          //Check if the correct file format is uploaded
          if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
            /*$response['status'] = 3; 
            $response['message']= "You file extension must be .jpeg, .gif, .gif or .png";*/

            exit('Your file extension must be .jpeg, .gif, .gif or .png');
          } elseif ($_FILES['profile-image']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            /*$response['status'] = 4; 
            $response['message']= "The image is too large!";*/
            exit('The image is too large');
          } else {
            // Move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
              $update = $userData->updateUsers($id, $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation, $status, $type);
              $update_address = $userData->update_address($address_id, $address_one, $city, $country, $zip);
              if($update) {
                /*$response['status'] = 5; 
                $response['message']= "Article updated successfully";*/
                exit('1');
              } else {
                /*$response['status'] = 6; 
                $response['message']= "Sorry there was a problem please try gain";*/
                exit('Sorry there was a problem pleas try again later');
              }
            }
          }
        }
      }
    }
  }

  

  if(isset($_GET['updateid'])){

    $userid = $_GET['updateid'];

    $query =$userData->fetchUsers($userid);
    foreach ($query as $value) {

      $row = $value;
      $id = $value['id'];
      $lastname = $value['last_name'];
      $firstname = $value['first_name'];
      $email = $value['email'];
      $contact = $value['contact'];
      $image = $value['profile_image'];
      $designation = $value['designation'];
      $status = $value['status'];
      $lastname = $value['last_name'];
      $gender = $value['gender'];
      $type = $value['type'];
      $address_id = $value['address_id'];
      $address_one = $value['address_one'];
      $city = $value['city'];
      $zip_code = $value['zip_code'];
      $country = $value['country'];
      //$_SESSION['password'] = $value['password'];
      $_SESSION['id'] = $value['id'];
      //$password = $value['password'];
    }
  }
  ?>

  <!-- Header -->
  <?php  require_once("header.php"); ?>
  <!-- Container -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 bg-light d-none d-md-block sidebar">
        <div class="sidebar-left">
          <?php require_once "admin_menu.php";?>
        </div>
      </div>

      <!-- Main -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mb-5">
       <h4 class="card-title p-4">Update User</h4>
       <div id="updateMsg"></div>
       <span id="error"></span>



       <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="mt-5 mb-5">
            <div class="text-center">
              <h2>Update account</h2>
              <hr class="line">
            </div>

            <div class="card-body" >
              <form  method="post" action="updateUser.php"  enctype="multipart/form-data">
                <div class="form-group text-center">
                  <img class="rounded-circle" id="profileDisplay" height="128"  src="../profile/<?=$image?>" onerror="this.src='../profile/default.jpg'" onclick="triggerClick()" id="profileDisplay" alt="Image not found"
                  /><br>
                  <label for="profileImage"></label>
                  <input type="file" id="profile-image" onchange="displayImage(this)" name="profile-image" class="form-control" style="display: none;" class="cursor-pointer" placeholder="Choose file">
                </div>
                <span class="update-data" class="text-primary"></span>
                <div class="accordion" id="accordion" >
                  <!-- Name -->
                  <div class="form-group row">
                    <div class="col-md-6">
                      <!--User id-->
                      <input type="text" hidden name="id" id="id" value="<?php echo $id; ?>">
                      <!--Address id-->
                      <input type="text" hidden name="address_id" id="address_id" value="<?php echo $address_id; ?>">

                      <label for="firstname" class="col-md-6 col-form-label">Last Name<span class="text-danger">*</span></label>

                      <input type="text" id="lastname" class="form-control lastname input-sm" name="lastname" placeholder="Last name..." value="<?php echo $lastname; ?>">
                    </div>


                    <div class="col-md-6">
                      <label for="firstname" class="col-md-6 col-form-label">First Name<span class="text-danger">*</span></label>
                      <input type="text" id="firstname" class="form-control firstname" name="firstname" placeholder="Firstname" value="<?php echo $firstname;?>">
                    </div>
                  </div>

                  <!-- Email -->
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label for="email_address" class="col-md-6 col-form-label">E-Mail Address<span class="text-danger">*</span></label>
                      <input type="email" id="email" class="form-control email" name="email" placeholder="doe@local.com" value="<?php echo $email; ?>">
                      <span id="message"></span>
                      <span id="error_email" class="text-danger"></span>
                      <span class="emailMsg hidden text-danger"></span>
                    </div>

                    <div class="col-md-6">
                      <label for="email_address" class="col-md-8 col-form-label">Repeat E-Mail Address <span class="text-danger">*</span></label>
                      <input type="email" id="confirm-email" class="form-control repeatEmail" name="confirm-email" placeholder="doe@local.com" value="<?php echo $email; ?>">
                      <span class="repeatEmailMsg hidden text-danger"></span>
                      <span class="notmatchMsg hidden text-danger"></span>
                    </div>
                  </div>

                  <!-- Gender and designation-->  
                  <div class="form-group row">
                    <div class="col-md-2">
                      <label for="gender" class="col-md-8 col-form-label">Gender<span class="text-danger">*</span></label>
                      <select class="form-control" id="gender" name="gender" class="gender">
                        <option value="<?php echo $gender; ?>" selected><?php echo ucfirst($gender); ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                      </select>
                    </div>        
                    <div class="col-md-4">
                      <label for="phone_number" class="col-md-8 col-form-label">Designation/Position<span class="text-danger">*</span></label>
                      <select class="form-control" id="designation" name="designation" class="designation">
                        <option value="<?php echo $designation; ?>" selected><?php echo $designation; ?></option>
                        <option value="">Select designation</option>
                        <option value="Developer">Developer</option>
                        <option value="Designer">Designer</option>
                        <option value="Engineer">Engineer</option>
                        <option value="Teacher">Teacher</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label for="permanent_address" class="col-md-6 col-form-label">Phone </label>
                      <input type="tel" id="telephone" class="form-control city" name="telephone" placeholder="123-4567-8901" value="<?php echo $contact;?>">
                      <span class="cityMsg hidden text-danger"></span>
                    </div>
                  </div>


                  <!-- Address -->
                  <div class="form-group row">

                    <!-- Postal or residential address -->
                    <div class="col-md-6">
                      <label for="permanent_address" class="col-md-8 col-form-label">Address<span class="text-danger">*</span></label>
                      <textarea id="addressOne" class="form-control  address" name="address" placeholder="Address here ..." value=""><?php echo $address_one?></textarea>
                      <span class="addressMsg hidden text-danger"></span>
                      <span class="length hidden text-danger"></span>
                    </div>

                    <!--City -->
                    <div class="col-md-6">
                      <label for="permanent_address" class="col-md-6 col-form-label">City/town <span class="text-danger">*</span></label>
                      <input type="text" id="city" class="form-control city" name="city" placeholder="London..." value="<?php echo $city;?>">
                      <span class="cityMsg hidden text-danger"></span>
                    </div>
                  </div>

                  <div class="form-group row">


                    <!--Zip code -->
                    <div class="col-md-4">
                      <label for="permanent_address" class="col-md- col-form-label">Postal/Zip Code <span class="text-danger">*</span></label>
                      <input type="text" id="zip" class="form-control zip" name="zip" placeholder="Zip code here..." value="<?php echo $zip_code; ?> ">
                      <span class="zipMsg text-danger"></span>
                    </div>

                    <!-- Country -->
                    <div class="col-md-4">
                      <label for="permanent_address" class="col-md-6 col-form-label">Country<span style="color: red !important; display: inline; float: none;">*</span></label>
                      <select id="country" name="country" class="form-control">
                        <option value="<?php echo $country; ?>" selected><?php echo $country; ?></option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                      </select>
                    </div>
                  </div>

                </div>
                <?php if($_SESSION['type'] =='admin') { ?>
                  <div class="form-radio update-radio">
                    <span class="font-weight-bold">User Status: </span>
                    <label class="radio-inline">
                      <input type="radio" id="status" name="status" value="pending" <?php if($status =="pending"){ echo "checked";}?>/> Pending
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id="status" name="status" value="active" <?php if($status=="active"){ echo "checked";}?>/> Activate
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id="status" name="status" value="disabled" <?php if($status=="disabled"){ echo "checked";}?>/> Disabled
                    </label>
                  </div>

                  <div class="form-radio">
                    <span class="font-weight-bold">User Type: </span> 
                    <label class="radio-inline">
                      <input type="radio" id="type" name="type" value="user" <?php if($type =="user"){ echo "checked";}?>/> General User
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id="type" name="type" value="editor" <?php if($type=="editor"){ echo "checked";}?>/> Editor
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id="type" name="type" value="admin" <?php if($type =="admin"){ echo "checked";}?>/> Admin
                    </label>
                  </div>

                <?php }?>
                <div class="form-group">
                  <input type="button" id="update-btn" class="btn btn-primary" name="update-btn" value="Update record"> | 
                  <input type="reset" id="update-btn" class="btn btn-primary" name="update-btn" value="Reset"> <span class="text-primary">  <a href="change_password.php?updateid=<?= $id ?>">Change password</a> </span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<script src="../profile.js"></script>
<script>
  $(document).ready(function(){
    $("#update-btn").click(function(){
      var formData = new FormData(this.form);
     bootbox.confirm("Are you sure want to edit this record?",function(result) {
        if(result){
        //console.log("Hello");
          
      $.ajax({
        url: 'updateUser.php',
        type: 'POST',
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false, 
        dataType: 'text',

        success:function(response) {
          /*$('#updateMsg').html(response); */
          if(response == 1) {
            var dialog = bootbox.dialog({
                  title: 'Process update',
                  message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                  callback: function () { location.reload(true); },
              });
                          
              dialog.init(function(){
                  setTimeout(function(){
                      dialog.find('.bootbox-body').html('The record has been updated!');
                  }, 5000);
                  
              });

          }else if(response == 2){
            $(".update-data").show().html('<span class="text-danger">Email and confirm email do not match</span>');
          }
        }

      })
      }});      
    });
  });     
</script>
</body>
</html>
