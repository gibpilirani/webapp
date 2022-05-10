<?php
session_start();
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<!-- Contact form -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="mb-5">
        <h5 class="font-weight-bold">Contact</h5>
        <hr class="line">
        <div class="card-body">
          <!--Section: Contact v.2-->
          <section class="mb-4">
            <!--Section description-->
            <p class="w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
              a matter of hours to help you.
            </p>
            <div class="success_message bg-success"></div>
            <div class="row">
              <!--Grid column-->
              <div class="col-md-9 mb-md-0 mb-5">
                <form id="sendEmail" action="sendEmail.php" name="contact-form"  method="POST">
                  <!--Grid row-->
                  <div class="row">
                    <!--Grid column-->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="name" class="" >Your name</label>
                        <input type="text" id="name" name="name" class="form-control">
                      </div>
                      <div class="error_name text-danger"></div>
                    </div>
                    <!--Grid column-->
                    <!--Grid column-->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="email" class="">Your email</label>
                        <input type="text" id="email" name="email" class="form-control"> 
                      </div>
                      <div class="error_email text-danger"></div>
                    </div>
                    <!--Grid column-->
                  </div>
                  <!--Grid row-->
                  <!--Grid row-->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="md-form mb-0">
                        <label for="subject" class="">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control"> 
                      </div>
                      <div class="error_subject text-danger"></div>
                    </div>
                  </div>
                  <!--Grid row-->
                  <!--Grid row-->
                  <div class="row">
                    <!--Grid column-->
                    <div class="col-md-12">
                      <div class="md-form">
                        <label for="message">Your message</label>
                        <textarea type="text" id="message_body" name="body" rows="2" class="form-control md-textarea"></textarea>
                      </div>
                      <div class="error_message text-danger"></div>
                    </div>
                  </div>
                  <!--Grid row-->
                  <div class="mt-2">
                    <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Send message">
                  </div>
                  <div class="status"></div>
                </form>
              </div>
              <!--Grid column--> 

              <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fa fa-map" aria-hidden="true"> </i> Map
          </h6>
          <p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1462.2416980678893!2d35.399195628773!3d-15.286875601179045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2smw!4v1631099377656!5m2!1sen!2smw" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </p>
        </div>
            </div>
          </section>
          <!--Section: Contact v.2-->
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('footer.php');?>
<script>
  $(document).ready(function(){
    
  //Clear error message
  $("#name").keyup(function() {
    $(this).css("border", "1px solid green");
    $('.error_name').html('');  
    $('.success_message').html('');  
  });

  //Clear error message
  $("#email").keyup(function() {
    $(this).css("border", "1px solid green");
    $('.error_email').html('');  
    $('.success_message').html('');
  });

  //Clear error message
  $("#subject").keyup(function() {
    $(this).css("border", "1px solid green");
    $('.error_subject').html(''); 
    $('.success_message').html(''); 
  });

  //Clear error message
  $("#message_body").keyup(function() {
    $(this).css("border", "1px solid green");
    $('.error_message').html('');  
    $('.success_message').html('');
  });

    // Submit form data via Ajax
    $("#sendEmail").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'sendEmail.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            
            success: function(response){
                $('.success_message').html('');
                if(response.success){
                   $('.success_message').html(response.message);
               } else {
                 if(response.errors.name) {
                  $('.error_name').html(response.errors.name);
                 }
                 
                 if(response.errors.email) {
                  $('.error_email').html(response.errors.email);
                 }

                 if(response.errors.subject) {
                  $('.error_subject').html(response.errors.subject);
                 }

                 if(response.errors.message_body) {
                  $('.error_message').html(response.errors.message_body);
                 }
               }               
              }          
      });
    });
  })
</script>
</body>
</html>