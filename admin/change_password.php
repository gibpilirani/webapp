<?php
include_once('../functions/dbUsers.php');
// If the user is not logged in redirect to the login page...
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

include_once('../functions/dbFunction.php');
$userData = new dbUsers();
$response = "";
if(isset($_POST['password'])) {
  $id = $_SESSION['id'];
  $old_password = $_POST['old-password'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];
  

  if(empty($old_password)) { 
    //$errors['oldpassword'] =  "Old password is required";
   $response = 1;
  }

  if(empty($password)) {
    //$errors['password'] =  "New password is required";
    $response = 2;
  }
  if(empty($c_password)) { 
    //$errors['confirm_password'] = "Confirm new password";
    exit('3');
  }

  $edit_password = $userData->editPassword($id, $old_password);
  if(!$edit_password) {
    //$errors['wronng_password'] ="Old password is wrong";
    exit('4');
  }

  if($password != $c_password) {
    //$errors['equal_password'] = "Password and confirm password do not match";
    exit('5');
  } else{

 
    //Update user method
    $update = $userData->updatePassword($id, $password);
    if ($update) { 
      exit('6');
      
    }
}
}

echo $response;
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
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt">
        <div class="col-md-6 offset-md-2 border border-2 border-primary rounded">
        <h4 class="card-title mt-2 text-center">Update Password</h4>
        <div id="updateMsg"></div>
    
        <!--To show success message after form login-->
        <form id="update_password" action="process_edit_password.php" method="post">
          <div class="form-group input-group col-sm-12">
            <input type="text" class="form-control" hidden id="id" name="id" value="<?=$_SESSION['id']; ?>">
          </div>

          <div class="form-group row">
            <div class="col-md-10">
              <label for="email_address" class="col-md-6 col-form-label">Enter old password<span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Old password...">
              <div class="error_oldPassword text-danger"></div>
              <div class="error_wrongPassword text-danger"></div>
            </div>
          </div>
  
          <div class="form-group row">
            <div class="col-md-10">
              <label for="email_address" class="col-md-6 col-form-label">New password<span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="password" name="password" placeholder="New password...">
              <span class="error_newPassword text-danger"></span>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-10">
              <label for="email_address" class="col-md-6 col-form-label">New password<span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="c_password" name="c_password" placeholder="New password...">
              <div class="error_newPassword2 text-danger"></div>
              <div class="error_equalPassword text-danger"></div>
            </div>
          </div>

          <div class="form-group input-group col-sm-10">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="checkbox" required>
              <label class="form-check-label" for="checkbox">I agree to the terms and conditions</label>
            </div>
          </div>
          <div class="loading-message"></div>
          <div class="col-sm-10 mb-3">
            <input type="submit" id="update-btn" class="btn btn-primary" name="update-password" value="Change password">
          </div>
        </form>
        <div id="server-error"></div>
        </div>
      </main>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $("#update_password").on('submit', function(e){
      e.preventDefault();
      $(".loading-message").html("<p><img src='../images/loading.gif'></p>");

      //Clear error message
      $("#old-password").keyup(function() {
      var email = $.trim($(this).val());
      
          $(this).css("border", "1px solid green");
          $('.error_oldPassword').html('');
          $('.error_wrongPassword').html('');
      });


      //Clear error message
      $("#password").keyup(function() {
      var email = $.trim($(this).val());
      
          $(this).css("border", "1px solid green");
          $('.error_newPassword').html('');
      });

      //Clear error message
      $("#c_password").keyup(function() {
      var email = $.trim($(this).val());
      
          $(this).css("border", "1px solid green");
          $('.error_newPassword2').html('');
          $('.error_equalPassword').html('');
      });
          $.ajax({
            type: 'POST',
            url: 'process_edit_password.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,

            success:function(response) {
              if(response.success) {
              
              } else {
                if(response.errors.oldpassword) {
                  $(".error_oldPassword").html("Old password is required");
                  $(".loading-message").html('');
                }

                if(response.errors.password) {
                  $(".error_newPassword").html(response.errors.password);
                  $(".loading-message").html('');
                }

                if(response.errors.confirm_password) {
                  $(".error_newPassword2").html(response.errors.confirm_password);
                }

                if(response.errors.wrong_password) {
                  $(".error_wrongPassword").html(response.errors.wrong_password);
                  $(".loading-message").html('');
                }

                if(response.errors.equal_password) {
                  $(".error_equalPassword").html(response.errors.equal_password);
                  $(".loading-message").html('');
                }
              }
              
            }
          })

      });

    });
  </script>
  
</body>
</html>