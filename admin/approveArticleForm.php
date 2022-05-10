<?php
   include_once('../functions/dbArticles.php');
   session_start();
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
   $funObj = new dbArticles();
   if(isset($_POST['approve_id'])){
    //Get the id from the calling form
     $articleId = $_POST['approve_id'];
     //Call the getartile method
     $query =$funObj->getTargetArticle($articleId);
      foreach ($query as $value) {
         $id = $value['id'];
         $title = $value['title'];
         $content = $value['content'];
         $country = $value['country'];
         $image = $value['image'];
         $status = $value['status'];
       ?>
<!doctype html>
<!-- <html lang="en">
   <head>
      <!-- Required meta tags -->
      <!-- <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>History of Computing</title>-->
      <?php //include_once("../favicon.html"); ?>
      <!-- Bootstrap CSS -->
      <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> -->
      <!-- <script src="https://cdn.tiny.cloud/1/0fxmmlxv5ojnr8hnkd7v6dp7plklckd2smjx713nm9ngimbt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
      <script src="../tinymce/tinymce.min.js"></script>
      <!-- <script src="tinymce/tinymce.min.js"></script> -->
      <!-- <script src="ckeditor/ckeditor.js"></script> -->
       
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
      <?php  include_once('menu.php');?>


      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <!-- <div class="col-lg-6 offset-lg-3 mt-5" id="first"> -->
         <form method="post" action="articleApproved.php" enctype="multipart/form-data">
            <div id="title-group" class="form-group row">
               <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Title</label>
               <div class="col-sm-10">
                  <input type="text"  hidden value="<?php echo $id; ?>" name="articleId">
                  <input type="text" value="<?php echo $title; }?>" class="form-control" id="title" name="title"  placeholder="Title of article...">
               </div>
            </div>
            
          <div id="country-group" class="form-group row">
                 <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Aprrove/reject</label>
          <!-- Check the status of the article-->
           <div class="col-sm-10">
           Pending <input type="radio" name="status" value="pending" <?php if($status =="pending"){ echo "checked";}?>/>
           Approved <input type="radio" name="status" value="active" <?php if($status=="aproved"){ echo "checked";}?>/>
           Rejected <input type="radio" name="status" value="active" <?php if($status=="rejected"){ echo "checked";}?>/>
         </div>
          </div>
           
            <div class="form-group row">
               <div class="col-sm-10">
                  <input type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit-btn">
               </div>
            </div>
         </form>
      <!-- </div> -->
      <?php }?>

      <script>
         // Disable form submissions if there are invalid fields
         (function() {
           'use strict';
           window.addEventListener('load', function() {
             // Get the forms we want to add validation styles to
             var forms = document.getElementsByClassName('needs-validation');
             // Loop over them and prevent submission
             var validation = Array.prototype.filter.call(forms, function(form) {
               form.addEventListener('submit', function(event) {
                 if (form.checkValidity() === false) {
                   event.preventDefault();
                   event.stopPropagation();
                 }
                 form.classList.add('was-validated');
               }, false);
             });
           }, false);
         })();
      </script>

      <!--Hide form after submission-->

      <script>
        jQuery("#submit-btn").click(function(e)) {
          e.preventDefault();
          jQuery('#first').hide();
          jQuery('#show').show();
        }
      </script>
      <?php //include_once('footer.php'); ?>
   </body>
</html>
