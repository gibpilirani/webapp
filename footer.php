<!-- Footer -->
<footer class="text-lg-start text-muted sticky-top">
  <!--style="background-color: #45637d;"-->
  <!-- Section: Social media -->
  <section class="p-4 border-bottom border-5 border-secondary">
  </section>
  <!-- Section: Social media -->
  <!-- Section: Links  -->
  <section class="container">
    <div class="text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-4 mb-4">
          <!-- Links -->
          <h6 class="fw-bold text-black mb-4">
            <i class="fas fa-address-book"></i><strong>&nbsp;Contact</strong>
          </h6>
          <p><i class="fas fa-home me-3"></i> Zomba , Domasi, Malawi</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            histormalawi@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 265 883 325 705</p>
          <p><i class="fab fa-whatsapp" aria-hidden="true"></i> + 265 883 325 705</p>
        
            <a href="https://web.facebook.com/historyofcomputinginmalawi" class="me-4 text-reset">
            <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-reset">
            <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="me-4 text-reset">
            <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset">
            <i class="fab fa-linkedin"></i>
            </a>
          </div>
          <!-- Right -->
        
        <!-- Grid column -->
        <!-- Grid column -->
        <div class="col-md-4 mb-4">
          <!-- Links -->
          <h6 class="fw-bold mb-4">
            <i class="fas fa-link"></i><strong>&nbsp;Other Links</strong>
          </h6>
          <ul class="list-unstyled">
            <li><a href="https://computerhistory.org/" class="text-reset">Computer History Museum</a></li>
        
            <li><a href="https://acrmuseum.org/" class="text-reset">ACRM</a></li>
          
            <li><a href="https://www.swansea.ac.uk/library/archive-and-research-collections/hocc/" class="text-reset">Swansea University History of Computing Collection</a></li>
         
            <li><a href="https://americanhistory.si.edu/" class="text-reset">National Museum of American History</a></li>
         
            <li><a href="contact.php" class="text-reset">Help</a></li>
        </ul>
        </div>
        <!-- Grid column -->
     
        <!-- Grid column -->
        <div class="col-md-4 mb-4">
          <!--Grid column-->
          <h6>
          <i class="fas fa-newspaper"></i><strong>&nbsp;Sign up for our newsletter</strong></h6>
          <!-- Email input -->
            <div class="form-outline form-white mb-1">
              <form method="post">
                <input type="email" name="useremail" placeholder="YourEmail@email.com" class="email-box col-8 input-lg" maxlength="60" id="email_data"><br>
                <span class="email-message" id="email_msg"></span><br>
            </div>
          <!--Grid column-->
          <!-- Submit button -->
          <button type="button" class="btn btn-outline-primary mb-4" id="email_submit">
          Subscribe
          </button>
          </div>
          </form>
          <!--Grid column-->
        </div>
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->
  <!--Grid row-->
  <!-- Copyright -->
  <div class="text-center p-3 text-white" style="background-color: #45637d;">
    &copy; 2021-<?php echo date("Y"); ?> Copyright:
    <a class="text-white" href="#">History of Computing in Malawi</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function (){
    //Trigger submit to perform form events
    $("#email_submit").click(function (){
      var $email_data_var;
      $email_data_var = $("#email_data").val();
  
      //Clear success message
      $("#email_data").keyup(function() {
        $(this).css("border", "1px solid green");
        $('#email_msg').html('');  
      });
  
      if($email_data_var == ''){
        $("#email_msg").html("<span class='text-danger'>Please Enter a Email Address</span>");
      }
      else{
  
        $.ajax({
          type:'POST',
          url:"newsletter/ajax/email-submit.php",
          data:{email_data_values : $email_data_var},
          success:function(response){
            $("#email_msg").html(response);
          }
        });
      }
    });
  });
</script>