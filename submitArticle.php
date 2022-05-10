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

<!-- Contact form -->
<div class="container mt-5">
  <div class="row">
   <div class="col-md-2">
    <img src="images/articleadd.png" class="img-fluid"
    alt="Add article">
    <p class="mt-5">Upload a pdf file <a href="upload-file.php"> here</a> </p>
  </div>
  
  <div class="col-md-10">
    <h5 class="font-weight-bold">Submit Article</h5>
    <hr class="line mb-3">
      <p class="w-responsive mx-auto mb-5">Do you have any story about development of computing in Malawi? Please do not hesitate to submit the story here.
      </p>
      <div id="error_server_message"></div>
      <div class="row">
        <div class="col-md-12">
          <form id="submitArticle" action="processArticle.php" method="post" enctype="multipart/form-data">
            <div class="submitMsg"></div>
            <div class="form-group">
              <label for="title" class="col-sm-2 col-form-label text-secondary"></label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="title" name="title"  placeholder="Enter title...">
                <div class="error_title text-danger"></div>
              </div>
              
            </div>
            <div class="form-group">
              <label for="content" class="col-sm-2 col-form-label"></label>
              <div class="col-lg-12">
                <textarea class="form-control" id="article" name="content" rows="10"></textarea>
               <!--  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->
                
                  <script src="ckeditor/ckeditor.js"></script>
                  <script src="ckfinder/ckfinder.js"></script>
                  <script>
                    var editor = CKEDITOR.replace('article');
                    CKEDITOR.config.extraPlugins ='colorbutton';
                    CKFinder.setupCKEditor(editor);
                  </script>
                  <div class="error_body text-danger"></div>
                  </div>
                   
                 </div>
                 <div class="form-group row ml-1">
                   
                   <div class="col-md-6">
                    <label for="selectcountry" class="col-sm-6 col-form-label">Country<span class="text-danger"> * </span></label>
                    <select class="form-control" id="country" name="country" class="form-control">
                      <option value="">Select country</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Tanzani">Tanzania</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="South Africa">South Africa</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    <div class="error_country text-danger"></div>
                  </div>
                
                 
                 <div class="col-md-6">
                  <label for="selectCategory" class="col-sm-6 col-form-label">Category <span class="text-danger"> * </span></label>
                  <select class="form-control" id="category" name="category">
                    <option value="">Select category</option>
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
                  <div class="error_category text-danger"></div>
                </div>
              </div>
              <div id="upload-image"></div>
              </div>
              <div class="form-group col-sm-12">
               <label for="uploadFile" class="col-sm-6 col-form-label">Upload image/photo<span class="text-danger"> * </span></label>
               <div class="col-sm-6">
                <input type="file" class="form-control-file" id="image" name="file">
                <div class="error_file text-danger"></div>
              </div>
            </div>
            <div class="form-group ml-3">
             <div class="col-sm-auto">
              <input type="submit" id="" class="btn btn-outline-primary" name="submit" value="Submit"> &nbsp;
              <input type="reset" id="reset-submit" class="btn btn-outline-primary" name="reset-submit" value="Reset">
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
</div>
</div>   
<?php include_once("footer.php");?>
<script>
   $(document).ready(function(){

    CKEDITOR.instances.article.on('key', function(evt) { 
      $(this).css("border", "1px solid green");
      $('.error_body').html('');
            });
    //Clear error message for title
    $("#title").keyup(function() {
      $(this).css("border", "1px solid green");
      $('.error_title').html('');
    });


      //Clear error message for country
    $("#country").change(function() {
      $(this).css("border", "1px solid green");
      $('.error_country').html('');
    });

    //Clear error message for category
    $("#category").change(function() {
      var email = $.trim($(this).val());
      $(this).css("border", "1px solid green");
      $('.error_category').html('');
    });

    //Clear error message for file
    $("#image").change(function() {
      var email = $.trim($(this).val());
      $(this).css("border", "1px solid green");
      $('.error_file').html('');
    });

  // Submit form data via Ajax
  $("#submitArticle").on('submit',function (e) {
    e.preventDefault();

    for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
    }

    var formData = new FormData(this);
    //add data to content
    formData.append('article', CKEDITOR.instances['article'].getData());
    
    $.ajax({
      type: 'POST',
      url: 'processArticle.php',
      data: formData,
      dataType: 'json',
      contentType: false,
      cache: false,
      processData: false,

      error: function(request, error) {
        //console.log(arguments);
        $("#error_server_message").html("<div class='alert alert-danger text-danger'> Could not reach, server please try again later " + error + "</div>");
        
      },
      
      success:function(response) {
        if (response.success) {
          $('.submitMsg').html('<p class="alert alert-success">' + response.message + '</p>');
          //Clear form
          $('#submitArticle')[0].reset();
          //update and clear ckeditor textarea
          for ( instance in CKEDITOR.instances ){
            CKEDITOR.instances[instance].updateElement();
          }

          CKEDITOR.instances[instance].setData('');
    
        } else {
          //check if title is empty
          if(response.errors.title) {
            $(".error_title").html(response.errors.title);
            console.log(response.errors.title);
          }

          if(response.errors.title_exist) {
            $(".error_title").html(response.errors.title_exist);
          }

          if(response.errors.content) {
            $(".error_body").html(response.errors.content);
          }

          if(response.errors.country) {
            $(".error_country").html(response.errors.country);
          }


          if(response.errors.category) {
            $(".error_category").html(response.errors.category);
          }

          if(response.errors.file) {
            $(".error_file").html(response.errors.file);
          }

          if(response.errors.file_extension) {
            $(".error_file").html(response.errors.file_extension);
          }

          if(response.errors.file_size) {
            $(".error_file").html(response.errors.file_size);
          }
        } 
      }
    });
  });
  
  // File type validation
  var match = ['image/jpeg', 'image/png', 'image/jpg'];
  $("#file").change(function () {
    for (i = 0; i < this.files.length; i++) {
      var file = this.files[i];
      var fileType = file.type;

      if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
        alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
  //$('.statusMsg').html('<p class="alert alert-danger">Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.</p>');
  $("#file").val('');
  return false;
}
}
});
   });
  
</script>
</body>
</html>
