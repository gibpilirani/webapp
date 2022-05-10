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
      <div class="col-md-6 offset-md-4 border border-2 border-radius-5">
        <div class="">
          <h5 class="text-center fw-bold mx-3 mb-2 mt-3"></h5>
          <p>An email has been sent to your email address with a link to reset the password.</p>
        </div> 
      </div>
    </div>
  </div>
</section>
<?php include_once('footer.php');?>
</body>
</html>

