<?php
include_once("functions/dbUsers.php");

$get_token = new dbUsers();
$message = "";
if(isset($_GET['password-token'])) {
  $password_token = $_GET['password-token'];
  $retrieve_token = $get_token->verify_token($password_token);
  if(!$retrieve_token) {
   echo  $message = "The token does not exist or has expired";
  } else {
    
  
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->

<!-- Login form -->
<section class="mt-5">
  <div class="container">
  
    <div class="row">
      <div class="col-md-4 offset-md-4 border border-2 rounded">
        <form id="new_password" action="controllerAuthEmail.php" method="post"  role="form">
          <div class="loading-message"></div>
          <div class="">
            <h5 class="text-center fw-bold mx-3 mb-2 mt-3">Enter your new password</h5>
          </div>
          <div class="statusMsg"></div>
          <input type="text" name="user_id" value="<?php echo $password_token; ?>" hidden>
          <!-- Password input -->
          <label class="sr-only" for="usrname">New password</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
            </div>
            
            <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="New password...">
          </div>
          <!-- Password input -->
          <label class="sr-only" for="Password">Confirm password</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
            </div>
            <input id="confirm_password" type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm new password">
          </div>
          <div class="form-group col-sm-12">
            <input type="submit" class="form-control btn btn-primary" id="change_password" name="change_password" value="Change password"  />
          </div>
          </div>
          </form>
        </div>
        <div></div>
      </div>
      <?php }

}?>
    </div>
  </section>
  <?php include_once('footer.php');?>
<script type="text/javascript">
    $(document).ready(function(){
    // Submit form data via Ajax
    $("#new_password").on('submit', function(e){
      e.preventDefault();
      $(".loading-message").html("<p><img src='images/loading.gif'></p>");
      $.ajax({
        type: 'POST',
        url: 'controllerAuthEmail.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        
        success: function(response){
          if(response.success) {
            console.log(response.message)
            setTimeout(function() {
            window.location.href = "user-login.php";
          }, 3000);
          } else {
            if(response.errors.password) {
              console.log(response.errors.password);
            }

            if(response.errors.confirm_password) {
              console.log(response.errors.confirm_password);
            }

            if(response.errors.no_equal_passwords) {
              console.log(response.errors.no_equal_passwords);
            }
          }
      }
    });
    });
  });
</script>
</body>
</html>

