<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
  header('Location: user-login.php');
    exit;
}
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<?php 
if(isset($_SESSION['loggedin']) && ($_SESSION['type'] == 'admin'))  {
  
?>
<!-- Contact form -->
<div class="container mt-5">
  <div class="row justify-content-center">
      <div class="mb-5">
        <h5 class="font-weight-bold">Distribute a news letter</h5>
        <hr class="line">
        <div class="card-body">
          <!--Section: Contact v.2-->
          <section class="mb-8">
            <!--Section description-->
            <div class="statusMsg"></div>
            <div class="row">
              <!--Grid column-->
              <div class=" mb-md-0 mb-5">
                <form id="sendEmail" action="newsletter-email.php" name="contact-form"  method="POST" action="newsletter-email.php">
                  <!--Grid row-->
                  <div class="row">
                  </div>
                  <!--Grid row-->
                  <!--Grid row-->
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="md-form mb-0">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control"> 
                      </div>
                      <div class="error_subject text-danger"></div>
                    </div>
                  </div>
                  <!--Grid row-->
                  <!--Grid row-->
                  <div class="form-group">
                    <!--Grid column-->
                    <div class="col-md-12">
                      <div class="md-form">
                        <label for="message">Your message</label>
                        <textarea type="text" id="message" name="body" rows="2" class="form-control md-textarea"></textarea>
                        <script src="ckeditor/ckeditor.js"></script>
                  <script>
                        CKEDITOR.replace( 'body');              </script>
                      </div>
                      <div class="error_message text-danger"></div>
                    </div>
                  </div>
                  <div id="server_success"></div>
                  <!--Grid row-->
                  <div class="mt-auto">
                    <input type="submit" name="submit" class="btn btn-outline-primary submitBtn" value="Send message">
                    <input type="reset" name="reset-mail" class="btn btn-outline-primary submitBtn" value="Reset">
                  </div>
                  <div class="status"></div>
                  
                </form>
              </div>
              <!--Grid column--> 
            </div>
          </section>
          <!--Section: Contact v.2-->
        </div>
    </div>
  </div>
</div>

<?php
}else {

  ?>
  <div class="container mt-5">You are not allowed to access this page.</div>

  <?php
}
?>
<?php include_once('footer.php');?>
<script>
  $(document).ready(function(){
    // Submit form data via Ajax
    //Clear success message
  $("#subject").keyup(function() {
    $(this).css("border", "1px solid green");
    $('.statusMsg').html(''); 
    $('.error_subject').html('');  
    $('.error_message').html(''); 
    //$('#server_success').html(''); 
  });

  $("#message").keyup(function() {
    $(this).css("border", "1px solid green");
    $('.statusMsg').html('');  
    $('.error_message').html('');
    $('.error_subject').html('');  
    //$('#server_success').html(''); 
  });
    $("#sendEmail").on('submit', function(e){
        e.preventDefault();
        for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
      }

    var formData = new FormData(this);
    
        $.ajax({
            type: 'POST',
            url: 'newsletter-email.php',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            
            success: function(response){
             // alert(response.success);
              if (response.success) {
                      $("#server_success").html("<span class='text-primary'>" + response.message + "</span>");
                      console.log(response.message);
                      $('#sendMail').hide();
                  } else {
                      //Error message for blank title
                      if (response.errors.subject) {
                          $(".error_subject").show();
                          $(".error_subject").html(response.errors.subject);
                          console.log(response.errors.subject);
                      }

                      //Error message for blank firstname
                      if (response.errors.message_body) {
                          $(".error_message").show();
                          $(".error_message").html(response.errors.message_body);
                          console.log(response.errors.message_body);
                      }

                  }
          }
      });
    });
  });
</script>
</body>
</html>