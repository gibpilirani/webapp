<?php
session_start();
   include_once('../functions/dbArticles.php');
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
   $editArticle = new dbArticles();
   ?>

   <?php


   if(isset($_POST['submit'])) {
      $errors = [];
      $data = [];

      if (empty($_POST['articleId'])) {
          $errors['articleId'] = 'Name is required.';
      }

      if (empty($_POST['title'])) {
          $errors['title'] = 'Title is required.';
      }

      if (empty($_POST['content'])) {
          $errors['content'] = 'Content is required.';
      }

      if (empty($_POST['country'])) {
          $errors['country'] = 'country is required.';
      }

      if (!empty($errors)) {
          $data['success'] = false;
          $data['errors'] = $errors;
      } else {
          $data['success'] = true;
          $data['message'] = 'Success!';
      }

      echo json_encode($data);


     $id = $editArticle->input_data($_POST['articleId']);
     $title = $editArticle->input_data($_POST['title']);
     $content = $editArticle->input_data($_POST['content']);
     $country = $editArticle->input_data($_POST['country']);
     $image = $_FILES['image']['name'];
     $image_tmp = $_FILES['image']['tmp_name'];
     $image_path = move_uploaded_file($image_tmp,"../uploads/$image");        
     $folder = $image_path;

     $update = $editArticle->editArticle($id, $title, $content, $country, $folder);

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
