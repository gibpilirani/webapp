<?php
 include_once('../functions/dbUsers.php');
 $userData = new dbUsers();
require_once("header.php");
 
if (isset($_SESSION['loggedin'] )) {
  if($_SESSION['type'] !== 'admin') {
    header('Location: admin_login.php');
    exit;
  }
}
?>

<!-- Container -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-light d-none d-md-block sidebar">
      <div class="left-sidebar">
        <?php require_once "admin_menu.php";?>
      </div>
    </div>

    <!-- Main -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt">
     <h3>Manage Users</h3>
     <div class="container mb-5 mt-5">
      <div>
        <div>
          <!--    Call display method -->
          <?php
          //call display method
          $name = $id = '';
          $query =$userData->get_data();
            //print_r($query);
          $total_pages = $userData->get_pagination_number();
          $records = $userData->set_total_records();
          $currentPage = $userData->current_page();
          $nextPage = $userData->next_page();
          $previousPage = $userData->prev_page();
          ?>
          <!-- Request modal to add user -->
          <div class="mb-2"><a href="adduser.php"><button class="btn btn-primary"><i class="fas fa-plus"></i></button></a></div>         
          <div class="row table-striped bg-dark text-white mt-1 mb-3 font-weight-bold">
            <div class="col-sm-1 text-left">No</div>
            <div class="col-sm-5">Fullname</div>
            <div class="col-sm-2">View </div>
            <div class="col-sm-2">Edit</div>
            <div class="col-sm-2">Delete</div>         
          </div>
          <?php
            $number = 0;
            /* $numElementsPerPage = 5; // How many elements per page
            $currentNumber = ($currentPage - 1) * $numElementsPerPage + $number; */
            //echo "<td>  ". $currentNumber++ ." </td>";
           
              if (is_array($query)){
                foreach ($query as $value) {
                  //$currentNumber++;
                  $number++;
                  $id = $value['id'];
                  ?>
                  <div class="row" id="row">
                    <div class="col-sm-1 mb-1">
                      <?php echo $number ?>    
                    </div>
                    <div class="col-sm-5">
                      <?php echo $value['fullname']; ?>
                    </div>
                    <div class="col-sm-2 mt-2">
                      <input type="button" name="view" value="View" class="btn btn-info view_data" data-toggle="modal" data-target="#view" data-id="<?php echo $value['id']; ?>"> 
                    </div>
                    <div class="col-sm-2 mt-2">
                      <a href="updateUser.php?updateid=<?=$value['id']; ?>"><i class="fas fa-edit fa-lg"></i></a>
                    </div>
                    <div class="col-sm-2 mt-2">
                        <a href="#" class="delete" id="<?php echo $value['id']; ?>"><i class="fas fa-trash fa-lg" style="color:#ff0000"></i></a>
                    </div>
                  </div>
                <?php
                }  
                ?>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-5">
                  <ul class="pagination justify-content-center">
                  <li class="page-item <?php if($currentPage <= 1){ echo 'hidden'; } ?>">
                      <a class="page-link" href="<?php if($currentPage <= 1){ echo '#'; } else { echo "?page=" . $previousPage; } ?>">Previous</a>
                    </li>
                    <?php for($i = 1; $i <= $total_pages; $i++ ): ?>
                      <li class="page-item <?php if($currentPage == $i) {echo 'disabled'; } ?>">
                        <a class="page-link" href="users.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                      </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if($currentPage >= $total_pages) { echo 'disabled'; } ?>">
                      <a class="page-link" href="<?php if($currentPage >= $total_pages){ echo '#'; } else {echo "?page=". $nextPage; } ?>">Next</a>
                    </li>
                  </ul>
                </nav>
                <?php
              }else{
                echo "Sorry your request is not available.";
              }?>
            </div>
          </div>
        </div>
        <div>
         <!-- View user Modal -->
         <div class="modal fade" id="view" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">User Info</h4>
                <button type="button" class="close modalMinimize" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body"> </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </main>
  </div>
</div> 
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click','.delete',function(){
      var delete_id= $(this).attr('id');
      //alert(delete_id);
      var $ele = $(this).parent().parent();
      $.ajax({
        type:'POST',
        url:'delete.php',
        data:{'delete_id':delete_id},
        //dataType: 'json',
        success: function(data){
          //alert(data);
          if(data == 1) {
            $ele.fadeOut().reload();
          }else{
            alert("Can't delete the row")
          }
        }
      });
    });
  });
</script>

</body>
</html>