<?php
   include_once('../functions/dbArticles.php');
   include_once('../functions/dbFunction.php');
   session_start();
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
   $checkInput = new dbFunction();
   ?>

   <?php


   if(isset($_POST['submit'])) {
      

     $id = $checkInput->input_data($_POST['articleId']);
     $title = $checkInput->input_data($_POST['status']);
        
     $update = $funObj->updateArticleStatus($id, $status);

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
