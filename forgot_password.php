<?php
session_start();
?>

<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->

<!-- Login form -->
<section class="mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-4 border border-2 border-primary rounded">
      <div class="loading-message"></div>
        <form id="forgot_password" action="controllerAuthEmail.php" method="post"  role="form">
          <div class="">
            <h5 class="text-center fw-bold mx-3 mb-2 mt-3">Recover your password</h5>
            <p>Please enter your email you used to sign up on this site so that we can assist you in recovering your password.</p>
          </div>
          <div class="error_email"></div>
          <div class="error_invalidEmail"></div>
          <!-- Email input -->
          <label class="sr-only" for="usrname">Email</label>
          <div class="input-group mb-3 col-md-12">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
            </div>
            <input type="text" id="email" class="form-control form-control-lg" name="email" placeholder="Enter your email...">
          </div>
          
          <div class="form-group col-sm-12">
            <button type="submit" class="form-control btn btn-primary" id="forgot-password" name="forgot-password">
              <span class="static_message">Recover your password</span>
            </button>
          </div>          
        </form>
       
        </div>
        
      </div>
    </div>
  </section>
  <?php include_once('footer.php');?>
<script type="text/javascript">
    $(document).ready(function(){
     
    // Submit form data via Ajax
    $("#forgot_password").on('submit', function(e){
      e.preventDefault();
      $(".loading-message").html("<p><img src='images/loading.gif'></p>");
     
      //Clear error message
      $("#email").keyup(function() {
      var email = $.trim($(this).val());
      
          $(this).css("border", "1px solid green");
          $('.error_email').html('');
          $('.error_invalidEmail').html('');
      
       });

      $.ajax({
        type: 'POST',
        url: 'controllerAuthEmail.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        
        success: function(response){
          $(".loading-message").html("<p><img src='images/loading.gif'></p>");
          $('.statusMsg').html('');
          $("#loading_message").remove();
          if(response.success){
            setTimeout(function() {
            window.location.href = "password_message.php";
          }, 3000);
         }else {
         if (response.errors.email){
          $('.error_email').html('<p class="text-danger">'+response.errors.email+'</p>');
          $(".loading-message").html('');
        } 

        if (response.errors.invalidEmail){
          $('.error_invalidEmail').html('<p class="text-danger">'+response.errors.invalidEmail+'</p>');
          $(".loading-message").html('');
        } 
      }
    }
    });
    });
  });
</script>
</body>
</html>

