<?php
include_once('../functions/dbArticles.php');
include_once('../functions/dbFunction.php');
include_once('../functions/dbUsers.php');
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
?>
<!-- HEADER -->
<?php include_once('header.php'); ?>
<!-- Container -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-light d-none d-md-block sidebar">
      <div class="left-sidebar">
        <?php require_once "admin_menu.php";?>
      </div>
    </div>

    <!-- Main -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt">
     <div class="container">
  <div class="mt-2"></div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="mt-5 mb-5">
        <div class="text-center">
          <h2>Create an account</h2>
          <hr class="line">
        </div>
        <div class="signUpMsg"></div>
        <div class="card-body">
          <form method="post" id="userSignup" action="registerUser.php" enctype="multipart/form-data">
            <div class="accordion" id="accordion" >
              <!-- Name -->
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="firstname" class="col-md-6 col-form-label">Last Name<span class="text-danger">*</span></label>
                  <input type="text" id="lastname" class="form-control error-name" name="lastname" placeholder="Last name...">
                  <p><span class="lastnameMsg error-name text-danger" id="lastnameMsg"></span></p>
                </div>

                <div class="col-md-6">
                  <label for="firstname" class="col-md-6 col-form-label">First Name<span class="text-danger">*</span></label>
                  <input type="text" id="firstname" class="form-control firstname" name="firstname" placeholder="Firstname">
                  <p><span class="error-firstname text-danger"></span></p>
                </div>
              </div>

              <!-- Email -->
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="email_address" class="col-md-6 col-form-label">E-Mail Address<span class="text-danger">*</span></label>
                  <input type="email" id="email" class="form-control email" name="email" placeholder="doe@local.com">
                  <span class="error-email text-danger"></span>
                  <span id="message"></span>
                  <span id="error_email" class="text-danger"></span>
                  <span id="CheckEmailMatch" class="text-danger"></span>
                  <span class="emailMsg hidden text-danger"></span>
                </div>

                <div class="col-md-6">
                  <label for="email_address" class="col-md-8 col-form-label">Repeat E-Mail Address <span class="text-danger">*</span></label>
                  <input type="email" id="repeatEmail" class="form-control repeatEmail" name="repeatEmail" placeholder="doe@local.com">
                  <span class="error-repeatEmail text-danger"></span>
                  <span class="repeatEmailMsg hidden text-danger"></span>
                  <span class="notmatchMsg hidden text-danger"></span>
                </div>
              </div>
              <!-- Password -->
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="password" class="col-md-6 col-form-label">Pasword<span class="text-danger">*</span></label>
                  <input type="password" id="password" class="form-control password" name="password">
                  <span class="error-password text-danger"></span>
                  <span id="CheckPasswordMatch"></span>
                  <span class="letter hidden text-danger"></span>
                  <span class="capital hidden text-danger"></span>
                  <span class="number hidden text-danger"></span>
                  <span class="length hidden text-danger"></span>
                  <span class="statusMsgf"></span>
                </div>
                
                <div class="col-md-6">
                  <label for="repeatPassword" class="col-md-6 col-form-label">Repeat Pasword <span class="text-danger">*</span></label>
                  <input type="password" id="repeatPassword" class="form-control repeatPassword" name="repeatPassword">
                  <span class="error-repeatPassword text-danger"></span>
                  <span class="pswdMatchMsg hidden text-danger"></span>
                </div>
              </div>

             <div class="form-group row mt-3">
              <!-- Gender -->
              <div class="col-md-6">
              <div class="form-check-inline">
                <label class="form-check-label" for="check1">
                  <input type="radio" class="form-check-input"name="gender" id="gender" value="male" class="" checked placeholder="Male"> Male
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label" for="check1">
                  <input type="radio" name="gender" id="gender" value="female"> Female
                </label>
                <span class="error-gender text-danger"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check-inline">
                <label class="form-check-label" for="check1">
                  <input type="radio" class="form-check-input"name="status" id="status" value="pending" class="" checked placeholder="pending"> Pending
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label" for="check1">
                  <input type="radio" name="status" id="status" value="active"> Active
                </label>
                <span class="error-gender text-danger"></span>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label" for="check1">
                  <input type="radio" name="status" id="status" value="disabled"> Disabled
                </label>
                <span class="error-gender text-danger"></span>
              </div>
            </div>
            </div>
              
              <!-- Designation -->
              <div class="form-group row mt-3">

                <div class="col-md-6">
                  <label for="phone_number" class="col-md-8 col-form-label">Designation/Position<span class="text-danger">*</span></label>
                  <select class="form-control" id="designation" name="designation" class="designation">
                    <option value="">Select designation</option>
                    <option value="Developer">Developer</option>
                    <option value="Designer">Designer</option>
                    <option value="Engineer">Engineer</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Teacher">Other</option>
                  </select>
                  <span class="error-designation text-danger"></span>
                  <span class="designationMsg hidden text-danger"></span>

                </div>
                <div class="col-md-6">
                  <label for="present_address" class="col-md-6 col-form-label ">Profile Photo<span class="text-danger">*</span></label>
                  <input type="file" class="form-control" name="file" id="file">
                  <span class="error-file text-danger"></span>
                </div>
              </div>
              <div
              > <!-- Address -->
              <div class="form-group row">
                <!-- Postal or residential address -->
                <div class="col-md-8">
                  <label for="permanent_address" class="col-md-8 col-form-label">Address<span class="text-danger">*</span></label>
                  <textarea id="addressOne" class="form-control  address-one" name="addressOne" placeholder="Address here ..."></textarea>
                  <span class="addressMsg hidden text-danger"></span>
                  <span class="length hidden text-danger"></span>
                </div>
              </div>
              <div class="form-group row">
                <!--City -->
                <div class="col-md-6">
                  <label for="permanent_address" class="col-md-6 col-form-label">City/town <span class="text-danger">*</span></label>
                  <input type="text" id="city" class="form-control city" name="city" placeholder="London...">
                  <span class="cityMsg hidden text-danger"></span>
                  <span class="error-city text-danger"></span>
                </div>

                <!--Zip code -->
                <div class="col-md-6">
                  <label for="permanent_address" class="col-md-7 col-form-label">Postal / Zip Code <span class="text-danger">*</span></label>
                  <input type="text" id="zip" class="form-control zip" name="zip" placeholder="Zip code here...">
                  <span class="zipMsg text-danger"></span>

                </div>
              </div>

              <div class="form-group row">
                <!-- Country -->
                <div class="col-md-6">
                  <label for="permanent_address" class="col-md-6 col-form-label">Country<span style="color: red !important; display: inline; float: none;">*</span></label>
                  <select id="country" name="country" class="form-control">
                    <option value="">Select country</option>
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
                  <span class="error-country text-danger"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Register"/>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#email").keyup(function(){
      var email = $("#email").val();
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (!filter.test(email)) {
        //alert('Please provide a valid email address');
        $("#error_email").text("Please enter a valid email");
        email.focus;
        //return false;
      } else {
        $("#error_email").text("");
      }
    });

    $("#lastname").keyup(function (e){
      var lastname = $(this).val();
      if(lastname === ' ') {
        $("#lastnameMsg").html("Please fill lastname");
      } 
    });



    var x_timer;  
    $("#email").keyup(function (e){
      clearTimeout(x_timer);
      var user_name = $(this).val();
      x_timer = setTimeout(function(){
        check_username_ajax(user_name);
      }, 100);
    }); 

    function check_username_ajax(email){
      $("#message").html('<img src="loader.gif" width="50"/>');
      $.post('../check-availability.php', {'email':email, }, function(data) {
        $("#message").html(data);
      });
    }


  // Submit form data via Ajax
  $("#userSignup").on('submit',function (e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: '../registerUser.php',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $('.submitBtn').attr("disabled", "disabled");
        $('#userSignup').css("opacity", ".5");
      },
      success: function (response) {
        $('.signUpMsg').html('');
        if (response.status == 1) {
          $('#userSignup')[0].reset();
          $('.signUpMsg').html('<p class="alert alert-success">' + response.message + '</p>');
        } else if (response.status == 2) {
          $('.signUpMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
        } else if (response.status == 3) {
          $('.signUpMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
        } else{
          $('.signUpMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
        } 
        $('#userSignup').css("opacity", "");
        $(".submitBtn").removeAttr("disabled");
      }
    });
  });
  
  // File type validation
  var match = ['image/jpeg', 'image/png', 'image/jpg'];
  $("#file").change(function () {
    for (i = 0; i < this.files.length; i++) {
      var file = this.files[i];
      var fileType = file.type;

      if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
        alert('Sorry, only JPG, JPEG, GIF, & PNG files are allowed to upload.');
        $("#file").val('');
        return false;
      }
    }
  });
}); 
</script>
     </main>
      

    <script type="text/javascript">
      $(document).ready(function() {
        var x_timer;  
        $("#email").keyup(function (e){
          clearTimeout(x_timer);
          var user_name = $(this).val();
          x_timer = setTimeout(function(){
            check_username_ajax(user_name);
          }, 1000);
        }); 

        function check_username_ajax(email){
          $("#message").html('<img src="loader.gif" width="50"/>');
          $.post('check-availability.php', {'email':email, }, function(data) {
            $("#message").html(data);
          });
        }
      });
    </script>
   
</body>
</html>