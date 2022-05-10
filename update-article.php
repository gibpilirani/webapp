<?php
session_start();
if(!isset($_SESSION)) {
 header('user-login.php');
}
include_once('functions/dbArticles.php');

  //Instatiate an object
$article = new dbArticles();

if(isset($_POST['update-id'])){
  $id = $_POST['update-id']; 
  $title = $_POST['title'];
  $content = $_POST['content'];
  $country = $_POST['country'];
  $category = $_POST['category'];
  $author = $_SESSION['email'];
  $status = $_POST['status'];
  $featured = $_POST['featured'];
  $category =$_POST['category'];
  if (!empty($title) && !empty($content) && !empty($country) && !empty($category)) {
      //name of the uploaded file
    $filename = $_FILES['file']['name'];
    if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
      $query = $article->selectImage($id);
      foreach ($query as $value) {
        $image = $value['image'];
      }
      $insert =  $article->editArticle($id, $title, $content, $country, $status, $featured, $category, $image);     
      if($insert) {
        exit('1');
      }     
    }else {
      // destination of the file on the server
      $destination = 'uploads/' . $filename;

      // get the file extension
      $extension = pathinfo($filename, PATHINFO_EXTENSION);

      // the physical file on a temporary uploads directory on the server
      $file = $_FILES['file']['tmp_name'];
      $size = $_FILES['file']['size'];
      if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png'])) {
        $message = "You file extension must be .jpeg, .gif, .gif or .png";
          } elseif ($_FILES['file']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
          exit('2'); //"The image is too large!";
        } else {
          // move the uploaded (temporary) file to the specified destination
          if (move_uploaded_file($file, $destination)) {
            $insert =  $article->editArticle($id, $title, $content, $country, $status, $featured, $category, $filename);
            if($insert){
              exit('1');
            } else {
             exit('3'); // "Failed to upload file.";
           }
         }
       }
      //}
     }
   } else {
    exit('4'); //"One of the fileds is empty please check and fill it.";
    echo $title . " ". $content . " " . $country. " " .$category;

  }
}
//Check if an id has been taken/picked
if(isset($_GET['id'])) {
       //assgn the picked id to a variable
 $articleId = $_GET['id'];
       //Calling the getarticles method or function
 $query =$article->getTargetArticle($articleId);
       //Loop throug ht e database to access the required data
 foreach($query as $values) {
   $id = $values['id'];
   $title = $values['title'];
   $image = $values['image'];
   $content = $values['content'];
   $country = $values['country'];
   $status = $values['status'];
   $featured = $values['feature'];
   $category = $values['category'];
 }
}
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<?php 
//Provide access to edit article form if user is an admin or editor
if( isset($_SESSION['loggedin']) && ($_SESSION['type'] == 'admin' OR $_SESSION['type'] == 'editor')) {?>
  <div class="container">
    <div class="mt-2"></div>    
    <span class="statusMsg"></span>
    <div class="card mt-5 mb-5">
      <div class="card-header">
        <h4>Update article</h4>
      </div>
        <div id="update-article-error-message"></div>
       <span class="updateMsg" class="text-primary"></span>
      <div class="card-body" id="my-form">
        <form method="post" action="update-article.php" enctype="multipart/form-data">
          <div class="form-group row">
            <label for="title" class="col-sm-12 col-form-label">Title</label>
            <div class="col-sm-12">
              <input type="text" hidden value="<?php echo $id; ?>" id="update-id" name="update-id">
              <input type="text" value="<?php echo $title; ?>" class="form-control form-control-warning" id="title" name="title"  placeholder="Title of article...">
            </div>
          </div>
          <div class="form-group row">
            <label for="content" class="col-sm-12 col-form-label">Content</label>
            <div class="col-lg-12">
              <textarea class="form-control" id="content" name="content" rows="10"><?php echo $content;   }?></textarea>
            </div>
          </div>
          <?php if( isset($_SESSION['loggedin']) && ($_SESSION['type'] == 'admin' OR $_SESSION['type'] == 'editor' ) ) {?>
            <div class="form-group row">


            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <label for="country" class="col-sm-12 col-form-label">Country</label>
                <div class="col-sm-12">
                  <select class="form-control" id="country" name="country">
                    <option value="<?php echo $country; ?>" selected><?php echo $country; ?></option>
                    <option value="Malawi">Malawi</option>
                    <option value="Zambia">Zambia</option>
                    <option value="South Africa">South Africa</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-6">
                <label for="category" class="col-sm-12 col-form-label">Category</label>
                <div class="col-sm-12">
                  <select class="form-control" id="category" name="category">
                    <option value="<?php echo $category; ?>" selected><?php echo $category; ?></option>
                    <option value="Software">Software</option>
                    <option value="Phone">Phone</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Programming">Programming</option>
                    <option value="Internet">Internet</option>
                    <option value="Web">Web</option>
                    <option value="Course">Course</option>
                    <option value="Smartphone">Smartphone</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="category" class="col-sm-10 col-form-label">Status</label>
                <div class="col-sm-10">
                  <label class="radio-inline">
                    <input type="radio" id="status" name="status" value="approved" <?php if($status=="approved"){ echo "checked";}?>/> Publish
                  </label>
                  <label class="radio-inline">
                    <input type="radio" id="status" name="status" value="pending" <?php if($status =="pending"){ echo "checked";}?>/> Unpublish
                  </label>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="category" class="col-sm-12 col-form-label">Featured</label>
                <div class="col-sm-12">
                  <label class="radio-inline">
                    <input type="radio" id="featured" name="featured" value="featured" <?php if($featured =="featured"){ echo "checked";}?>/> Yes
                  </label>
                  <label class="radio-inline">
                    <input type="radio" id="featured" name="featured" value="none" <?php if($featured=="none"){ echo "checked";}?>/> No
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="file" class="col-sm-10 col-form-label">Upload file</label>
              <div class="col-sm-10">
                <input type="file" class="form-control-file" value="<?php echo $image;  ?>" id="file" name="file">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <input type="button" id="update-btn" name="update-btn" class="btn btn-outline-primary" value="Update">
                <!--<input type="submit" id="update-btn" name="update-btn" class="btn btn-primary" value="Update trial">-->
                <input type="reset" class="btn btn-outline-primary" name="cancel" value="Cancel">
              </div>
            </div>
          </form>
          <?php 
        } else {
          echo "<p class='ml-5 mt-5'>Access denied</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <script src="ckeditor/ckeditor.js"></script>
  <script src="ckfinder/ckfinder.js"></script>
  <script>
     var editor = CKEDITOR.replace('content');
     CKEDITOR.config.extraPlugins ='colorbutton';
     CKFinder.setupCKEditor(editor);
  </script>

  <?php include_once('footer.php'); ?>
  <script>
    $(document).ready(function(){
      $("#update-btn").click(function(){
        for ( instance in CKEDITOR.instances ) {
          CKEDITOR.instances[instance].updateElement();
        }

      var formData = new FormData(this.form);
      //add data to content
      formData.append('content', CKEDITOR.instances['content'].getData());
      bootbox.confirm("Are you sure want to edit this record?", function(result) {
        if(result){  
          $.ajax({
            url: 'update-article.php',
            type: 'POST',
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false, 
            dataType: 'json',
           
            error: function (request, error) {
              //console.log(arguments);
              $("#update-article-error-message").html("<div class='text-danger'> Could not reach, server please try again later " + error + "</div>");
            },

          success:function(response) {
            /*$('#updateMsg').html(response); */
            if(response == 1) {
              var dialog = bootbox.dialog({
                  title: 'Process update',
                  message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                  callback: function () { location.reload(true); },
              });
                          
              dialog.init(function(){
                  setTimeout(function(){
                      dialog.find('.bootbox-body').html('The record has been updated!');
                  }, 5000);
                  
              });
             
            }else if(response == 3){
              $(".updateMsg").show().html('<span class="text-danger">There is a problem please check.</span>');
            }
          }
        });      
      }
    });
    });
    });     
  </script>
  <script>
  
  // File type validation
  var match = ['image/jpeg', 'image/png', 'image/jpg'];
  $("#file").change(function () {
    for (i = 0; i < this.files.length; i++) {
      var file = this.files[i];
      var fileType = file.type;

      if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
        alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
  //$('.statusMsg').html('<p class="alert alert-danger">Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.</p>');
  $("#file").val('');
  return false;
}
}
});
  
</script>
</body>
</html>