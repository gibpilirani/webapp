<?php
include_once('../functions/dbFunction.php');
include_once('../functions/dbArticles.php');
//session_start();

$articleData = new dbArticles(5);

$total_pages = $articleData->get_pagination_number();
  //Count records
$numberOfRecords = $articleData->set_total_records_admin();
  //Count records
$currentPage = $articleData->current_page();
$nextPage = $articleData->next_page();
$previousPage = $articleData->prev_page();
require_once("header.php");
include_once('../functions/dbUsers.php');

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
include_once('../functions/dbFunction.php');
$userData = new dbUsers();
?>
<!-- Container -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-light d-none d-md-block sidebar">
      <div class="sidebar-left">
        <?php require_once "admin_menu.php";?>
      </div>
    </div>

    <!-- Main -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt">
  <?php  $query =$articleData->queryArticlesAdmin();  ?>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Thumbnail<?php echo $articleData->get_limit(); ?></th>
      <th scope="col">Summary</th>
    </tr>
  </thead>
  <tbody>
            <?php
            $number = 1;
            $numElementsPerPage = $articleData->get_limit(); // How many elements per page
            $currentNumber = ($currentPage - 1) * $numElementsPerPage + $number;
            //echo "<td>  ". $currentNumber++ ." </td>"; 
            foreach ($query as $value) {
                
            ?>
                <tr><td><?php echo $currentNumber++; ?></td>
                  <td><img src="../uploads/<?php echo $value['image']; ?>" class="img-thumbnail img-fluid img-zoom" width="50">
               </td>
                <td>
                  <h5><?php echo  $value['title']; ?></h5>
                  <p><span class="data"><?php 
                  $story_summary = $value['content'];
                  $story_summary = str_replace("<p>"," ",$story_summary);
                  $story_summary = str_replace("</p>"," ",$story_summary);
                  echo  $articleData->readmore(40, $story_summary);?><a href="story.php?article-id=<?php echo $value['id'];?>">...read more...
                  </a></span></p></td>
                </div>
              <?php }?>
            </tbody>
            </table>
            <!-- Pagination -->
            <nav aria-label="Page navigation example mt-5">
              <ul class="pagination justify-content-center">
                <li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; } ?>">
                  <a class="page-link" href="<?php if($currentPage <= 1){ echo '#'; } else { echo "?page=" . $previousPage; } ?>">First</a>
                </li>

                <li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; } ?>">
                  <a class="page-link" href="<?php if($currentPage <= 1){ echo '#'; } else { echo "?page=" . $previousPage; } ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++ ): ?>
                  <li class="page-item <?php if($currentPage == $i) {echo 'disabled'; } ?>">
                    <a class="page-link" href="articles.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                  </li>
                <?php endfor; ?>
                <li class="page-item <?php if($currentPage >= $total_pages) { echo 'disabled'; } ?>">
                  <a class="page-link" href="<?php if($currentPage >= $total_pages){ echo '#'; } else {echo "?page=". $nextPage; } ?>">Next</a>

                </li>
                <li class="page-item <?php if($currentPage == $total_pages) { echo 'disabled'; } ?>">
                  <a class="page-link" href="<?php if($currentPage == $total_pages){ echo '#'; } else {echo "?page=". $total_pages; } ?>">Last</a>
                </li>
              </ul>
            </nav>
          </main>
        </div>
      </div>


      <!--   Jquery fr reading data ---------------->
      <script>
       $(document).ready(function(){
         $('.readData').click(function(){

          var article_id = $(this).data('id');

        // AJAX request
        $.ajax({
         url: 'story.php',
         type: 'POST',
         data: {article_id: article_id},
         success: function(response){
           // Add response in Modal body
           $('.modal-body').html(response);
           // Display Modal
           $('#read').modal('show');
         }
       });
      });
       });
     </script>


     <!---Script for calling the editi form-->
     <script>
       $(document).ready(function(){
         $('.editData').click(function(){

          var editArticle_id = $(this).data('id');

        // AJAX request
        $.ajax({
         url: 'update-article.php',
         type: 'POST',
         data: {editArticle_id: editArticle_id},
         success: function(response){
           // Add response in Modal body
           $('.modal-body').html(response);
           // Display Modal
           $('#editContent').modal('show');
         }
       });
      });
       });
     </script>
   </div>
   <script>
     $(document).ready(function(){
       $('.view_data').click(function(){

        var view_id = $(this).data('id');

              // AJAX request
              $.ajax({
               url: 'fetch.php',
               type: 'POST',
               data: {view_id: view_id},
               success: function(response){
                 // Add response in Modal body
                 $('.modal-body').html(response);
                 // Display Modal
                 $('#empModal').modal('show');
               }
             });
            });


     });
   </script>
   <script>
     $(document).ready(function(){
       $('.edit_data').click(function(){

        var updateid = $(this).data('id');

              // AJAX request
              $.ajax({
               url: 'fetch.php',
               type: 'POST',
               data: {updateid: updateid},
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
   <!--Delete user data-->
   <script>
     $(document).ready(function(){
       $('.delete_data').click(function(){

        var delete_id = $(this).data('id');

              // AJAX request
              $.ajax({
               url: 'fetch.php',
               type: 'POST',
               data: {delete_id: delete_id},
               success: function(response){
                 // Add response in Modal body
                 $('.modal-body').html(response);
                 // Display Modal
                 $('#delete').modal('show');
               }
             });
            });


     });
   </script>

   <!-- Function to ask for confirmation to delete message-->
   <script>
    function confirmDelete(self) {
      var id = self.getAttribute("data-id");

      document.getElementById("form-delete-user").id.value = id;
      $("#update").modal("show");
    }
  </script>

  <script>
    $(document).ready(function() {
            var newWin; // declaring global variable
            ////////////////////////////
            $("#b_open").click(function(){
              newWin = window.open("window-child-refresh.php");
            })
            //////////////
            $("#b_close").click(function(){
              newWin.close();
            })
        ///////
      })
    </script>
  </body>
  </html>
