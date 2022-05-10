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
      <div class="col-md-4 offset-md-4 border border-2">
        <?php if(isset($_SESSION['loggedin'])){ ?><h3>Welcome <?php  echo $_SESSION['first_name'];
          ?></h3>
          <?php }else{ ?>
        <form id="loginForm" action="login.php" method="post"  role="form">
          
          <div class="">
            <h5 class="text-center fw-bold mx-3 mb-2 mt-3">Login</h5>
          </div>
          <div class="statusMsg"></div>
          <!-- Email input -->
          <label class="sr-only" for="usrname">Username</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
            <input type="email" id="email" class="form-control form-control-lg" name="email" placeholder="Username">
          </div>
          <!-- Password input -->
          <label class="sr-only" for="Password">Name</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
            </div>
            <input id="password" type="password" name="password" class="form-control form-control-lg" placeholder="Password">
          </div>
         
          <div class="form-group col-sm-12">
            <input type="submit" class="form-control btn btn-primary" id="login" name="login" value="Sign In"  />
          </div>
            <p class="fw-bold mt-2 pt-1 mb-0">Not yet a member? <a href="registration.php"
              class="link-danger">Sigup</a></p>
              <p><a href="forgot_password.php">Forgot password</a></p>
          </div>
          
          </form>
        <?php }?>
        </div>
        <div></div>
      </div>
    </div>
  </section>
  <?php include_once('footer.php');?>
<script type="text/javascript">
    $(document).ready(function(){
    // Submit form data via Ajax
    $("#loginForm").on('submit', function(e){
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'login.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
          $('.submitBtn').attr("disabled","disabled");
          $('#loginForm').css("opacity",".5");

        },
        success: function(response){
          $('.statusMsg').html('');
          if(response.status == 1){
           $('#loginForm')[0].reset();
           setTimeout(function() {
                  //Refresh the current page after successful login
                  window.location.reload();
                }, 1000);

         }else if (response.status == 2){
          $('.statusMsg').html('<p class="text-danger">'+response.message+'</p>');
        }else if (response.status == 3){
          $('.statusMsg').html('<p class="text-danger">'+response.message+'</p>');
        }else{
          $('.statusMsg').html('<p class="text-danger">'+response.message+'</p>');
        }
        $('#loginForm').css("opacity","");
        $(".submitBtn").removeAttr("disabled");
      }
    });
    });
  });
</script>
</body>
</html>

