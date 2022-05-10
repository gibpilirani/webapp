<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
 header('Location: user-login.php');
 exit;
}
include_once('functions/dbArticles.php');
include_once('functions/dbConnect.php');

$upload = new dbArticles();

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = $upload->single_file($id);

  foreach ($query as $value) {
    $id = $value['id'];
    $filename = $value['filename'];
    $file = $value['file_path']; 
    $status = $value['status'];
  }
}

if(isset($_POST['id'])) {
  $id = $_POST['id'];
  $filename = $_POST['file-name'];
  $status = $_POST['status'];

  $update = $upload->update_file($id, $filename, $status);
  if($update){
    exit('1');
  } else {
    exit('2');
  }

}
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<div class="container mt-5">

  <span id="update-data"></span>
  <form id="upload-pdf" method="post" action="update-file.php" accept-charset="utf-8" enctype="multipart/form-data">
    <div>Update file name</div>
    <input type="text" hidden name="id" value="<?php echo $id;?>">
    <div class="form-group col-sm-12">

      <label for="uploadFile" class="col-sm-6 col-form-label">Name of the file<span class="text-danger"></span></label>
      <div class="col-sm-6">
        <input type="text" class="form-control-file" id="file-name" name="file-name" value="<?=$filename?>">
      </div>
    </div>

    <div class="form-group col-sm-12">
      <label class="radio-inline">
        <input type="radio" id="status" name="status" value="pending" <?php if($status =="pending"){ echo "checked";}?>/> Pending
      </label>
      <label class="radio-inline">
        <input type="radio" id="status" name="status" value="approved" <?php if($status=="approved"){ echo "checked";}?>/> Approve
      </label>
      <label class="radio-inline">
        <input type="radio" id="status" name="status" value="waiting" <?php if($status=="waiting"){ echo "checked";}?>/> Disabled
      </label>
    </div>
    <div class="form-group col-sm-12">
      <label for="uploadFile" class="col-sm-6 col-form-label">
        <div class="col-sm-6">
          <?php echo $file; ?>
        </div>
      </div>


      <div class="form-group ml-3">
        <div class="col-sm-4">
          <input type="button" id="update-btn" class="btn btn-outline-primary" name="update-btn" value="Submit"> &nbsp;
          <input type="reset" id="update-btn" class="btn btn-outline-primary" name="update-btn" value="Reset"> 
        </div>
      </div>
    </form>
  </div>
  <div>
    <?php include_once("footer.php");?>
  </div>
  <script>
    $(document).ready(function(){
      $("#update-btn").click(function(){
        var formData = new FormData(this.form);
        if (confirm('Are you sure you want to update the file name?')) {
          console.log('ok');
        }   else{
          return false;
        }  
        $.ajax({
          url: 'update-file.php',
          type: 'POST',
          data: formData,
          contentType: false,       
          cache: false,             
          processData:false, 
          dataType: 'text',

          success:function(response) {
            /*$('#updateMsg').html(response); */
            console.log(response);
            if(response == 1) {
              $("#upload-pdf").hide().html("File name is updated successfully").slideToggle(600);
              $('#upload-pdf')[0].reset();
            }else if(response == 2){
              $("#error").show().html('Something is wrong');
            }
          }

        });      
      });
    });     
  </script>
</body>
</html>