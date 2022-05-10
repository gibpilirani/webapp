<?php
   include_once('../functions/dbFunction.php');
   if(!isset($_SESSION)) {
   session_start();
   }
   $funObj = new dbFunction();
   ?>
   <!doctype html>
   <html lang="en">
      <head>
         <!-- Required meta tags -->
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <title>History of Computing</title>
         <!-- Bootstrap CSS -->
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
         <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
         <link rel="stylesheet" href="css/bootstrap.css">
         <link rel="stylesheet" href="css/bootstrap.min.css">
         <link rel="stylesheet" href="style.css">
      </head>
      <body>
   <?php


   if(isset($_POST['submit'])) {
     $id = $funObj->input_data($_POST['articleId']);
     $title = $funObj->input_data($_POST['title']);
     $content = $funObj->input_data($_POST['content']);
     $country = $funObj->input_data($_POST['country']);

     $update = $funObj->editArticle($id, $title, $content, $country);

   if ($update > 0){ ?>

      <!--Success pop up Starts-->
      <div class="modal fade" id="success_msg" role="dialog" tabindex="-1">
         <div class="success">
            <div class="modal-dialog-success">
               <div class="col-xs-12 pade_none">
                  <button type="button" class="close" onClick="closeConfirm();" data-dismiss="modal">&times;</button>
                  <div class="col-xs-12 pade_none">
                     <h2>Success!</h2>
                     <p>Your message has been sent.</p>
                  </div>
                  <div class="col-xs-12 pad_none">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--Success pop up ends-->

      <?php
         }
         }
         ?>

   </body>
</html>
