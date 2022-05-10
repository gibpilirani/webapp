<?php
include_once('../functions/dbFunction.php');
include_once('../functions/dbArticles.php');
//session_start();
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

<?php  //include_once('menu.php');?>
<!--Container for the content-->
<div class="container">
    <!--Image slider -->

    <div class="modal fade" id="read" tabindex="-1" role="dialog">
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

<!--Modal for edit frm -->
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

<?php
$query =$funObj->queryArticlesAdmin();  ?>


<table class="table table-striped ml-2 mr-5 mb-5 p-4" cellspacing="0">
   <thead>
      <tr>
          <th>No</th>
          <th class="th-sm">Image
             <th class="th-sm">Summary of the article </th>
         </tr>
     </thead>
     <tbody>
         <?php
         $no =1;
         foreach ($query as $value) {

           ?>
           <tr>
            <td><?php echo $no++; ?>
            <td><img src="../<?php
            echo $value['image']; ?>" class="img-thumbnail img-fluid rounded"></td>
            <td>
              <h5><?php echo  $value['title']; ?></h5>
              <?php
              echo $funObj->readMoreApprove($value['content'],"storyApprove.php","id",$value['id']); ?>
          </td>


      </tr>
  <?php }?>

</tbody>
</table>
</div>



<script>
   $(document).ready(function(){
       $('.readData').click(function(){

        var article_id = $(this).data('id');

        // AJAX request
        $.ajax({
         url: '../story.php',
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
       $('.approveArticle').click(function(){

        var aprove_id = $(this).data('id');

        // AJAX request
        $.ajax({
         url: 'view_approve.php',
         type: 'POST',
         data: {aprove_id: aprove_id},
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

</body>
</html>
