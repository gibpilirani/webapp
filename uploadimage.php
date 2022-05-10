<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
  header('Location: user-login.php');
    exit;
  }
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->

<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
  <div id="server-error" class="mt-5"></div>
  <div id="server-success"></div>
	<h5 class="font-weight-bold">Upload Image</h5>
  <hr class="line mb-5">

	<form id="upload-image" action="gallery-upload.php"  class="needs-validation" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="uname">Title:</label>
      <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
      <div class="valid-feedback">Valid.</div>
      <div class="error-title text-danger"></div>
    </div>
    <div class="form-group">
      <label for="pwd">Description:</label>
	  <textarea class="form-control" rows="2" col="200" name="description"  id="description"></textarea>
      <div class="valid-feedback">Valid.</div>
      <div class="error-description text-danger"></div>
    </div>
	<div class="form-group">
	<label class="form-label" for="customFile">Upload image</label>
	 <input type="file" class="form-control" name="image" id="file" />
    	<div class="valid-feedback">Valid.</div>
			<div class="error-file text-danger"></div>
      <div class="error-fileType text-danger"></div>
      <div class="error-imageSize text-danger"></div>
    </div>
    <input type="submit" class="btn btn-outline-primary" id="upload-image" name="upload-image" value="Upload Image"> &nbsp;
    <input type="reset" class="btn btn-outline-primary" id="reset-image" name="reset-image" value="Reset">
  </form>
</div>
</div>
</div>
<?php include_once("footer.php");?>

<script>
  $(document).ready(function() {

    $("#myfile").change(function(){
            alert("A file has been selected.");
        }); 

  //Check if lastitle tname is empty
  $("#title").keyup(function() {
      var title = $.trim($(this).val());
      if (title == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-title').html('');
      }
  });

  $("#description").keyup(function() {
      var description = $.trim($(this).val());
      if (description == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-description').html('');
      }
  });

  //Check if file is empty
  $("#file").change(function() {
      var file = $.trim($(this).val());
      if (file == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-file').html('');
          $('.error-fileType').html('');
          $('.error-imageSize').html('');
      }
  });

  // Submit form data via Ajax
  $("#upload-image").on('submit', function(e) {
          e.preventDefault();
          //console.log("Hello world");
      $.ajax({
          type: 'POST',
          url: 'gallery-upload.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,

          error: function(request, error) {
              //console.log(arguments);
              $("#server-error").html("<div class='text-danger'> Could not reach, server please try again later " + error + "</div>");
          },

          success:function(response) {
                  if (response.success) {
                      $("#server-success").html("<div class='text-primary'>" + response.message + "</div>");
                      console.log(response.message);
                      //$('#userSignup')[0].reset();
                  } else {
                      //Error message for blank title
                      if (response.errors.title) {
                          $(".error-title").show();
                          $(".error-title").html(response.errors.title);
                          console.log(response.errors.title);
                      }

                      //Error message for blank firstname
                      if (response.errors.description) {
                          $(".error-description").show();
                          $(".error-description").html(response.errors.description);
                          console.log(response.errors.description);
                      }

                      //Error message for blank file
                      if (response.errors.file) {
                          $(".error-file").show();
                          $(".error-file").html(response.errors.file);
                          console.log(response.errors.file);
                      }

                       //Error message for file type error
                       if (response.errors.fileType) {
                          $(".error-fileType").show();
                          $(".error-fileType").html(response.errors.fileType);
                          console.log(response.errors.fileType);
                      }

                      //Error message for blank 
                      if (response.errors.file_size) {
                          $(".error-imageSize").show();
                          $(".error-imageSize").html(response.errors.file_size);
                          console.log(response.errors.file_size);
                      } 
                  }
              }
          });
      });
    });
</script>
</body>
</html>