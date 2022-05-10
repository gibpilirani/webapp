<?php
  include_once('../functions/dbArticles.php');
  $linkstring="";
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
  ?>
   <!doctype html>
   <html lang="en">
      <head>
         <!-- Required meta tags -->
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <title>History of Computing</title>
         <?php include_once("../favicon.html"); ?>
         <!-- Bootstrap CSS -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
         <!--CSS libraries-->
         <link rel="stylesheet" href="bootstrap/css/jquery-ui.css">
         <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
         <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
         <link rel="stylesheet" href="style.css">
         <link rel="stylesheet" href="/resources/demos/style.css">

         <!--JS local libraries-->
         <script src="../fontawesome/js/all.js"></script>
         <script src="bootstrap/js/bootstrap.js"></script>
         <script src="bootstrap/js/bootstrap.min.js"></script>
         <script src="bootstrap/js/jquery.min.js"></script>
         <script src="bootstrap/js/popper.min.js"></script>
         <script src="bootstrap/js/jquery-ui.js"></script>
         <script src="js/ajax.js"></script>

      </head>
      <body>

        <!-- Edit user modal -->
        <div class="modal fade" id="editContent" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
             <!-- Modal content-->
             <div class="modal-content">
                <div class="modal-header bg-warning">
                   <h4 class="modal-title">Full Article</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body justify-content-start col-md-10">  </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
             </div>
          </div>
      </div>

      <!--Header=======-->
        <?php require_once("header.php");?>
      <div class="container mb-10 mt-5">
         <?php

            if(isset($_GET['id'])){
                $articleId = $_GET['id'];
                $query =$funObj->getTargetArticle($articleId);
                 foreach($query as $value) {
                   $date = $value['date'];
                   $title = $value['title'];
                   $story = $value['content'];
                   $id = $value['id'];
            ?>



      <div class="d-flex justify-content-start container-fluid mb-5">
         <!--Horizontal card-->
         <div class="row">
            <div>
               <h5><?php echo  $title;?></h5>

               <small>Posted: <?php echo  $date;
                ?>
                <?php
                if(isset($_SESSION['email'])) {

                  ?>
                <!--Direct user to the approe/edit form-->
                <a href="#editContent"  data-id="<?php echo $value['id']; ?>" class="edit_data" data-toggle="modal"> Edit</a>
                <!--Delete article-->
                  <?php
                }
                ?>
              </small>
               <div class="container text-justify"><?php //echo $result['story'];
                  echo $story;
                  ?></div>
            </div>
         </div>
      </div>
      <?php }
         }?>
    </div>
    </div>
      <!--Footer-->
    <?php include_once("../footer.php"); ?>



    <script>
       $(document).ready(function(){
           $('.edit_data').click(function(){

            var approve_id = $(this).data('id');

            // AJAX request
            $.ajax({
             url: 'approveArticleForm.php',
             type: 'POST',
             data: {approve_id: approve_id},
             success: function(response){
               // Add response in Modal body
               $('.modal-body').html(response);
               // Display Modal
               $('#update').modal('show');
             }
           });
         });


       });
    </script>
   </body>
</html>