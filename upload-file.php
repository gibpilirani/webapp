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
<div class="container mt-5">
  <span class="submitMsg"></span>
  <form id="upload-pdf" method="post" action="add-files.php" accept-charset="utf-8" enctype="multipart/form-data">
    <div>Upload your pdf file</div>
    <div class="form-group col-sm-12">
      <label for="uploadFile" class="col-sm-6 col-form-label">Name of the file<span class="text-danger"> * </span></label>
      <div class="col-sm-6">
        <input type="text" class="form-control-file" id="file-name" name="file-name">
        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
      </div>
    </div>
    <div class="form-group col-sm-12">
      <label for="uploadFile" class="col-sm-6 col-form-label">Upload a pdf file<span class="text-danger"> * </span></label>
      <div class="col-sm-6">
        <input type="file" class="form-control-file" id="pdf_file" name="file" accept=".pdf">
        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
      </div>
    </div>
    <div class="form-group ml-3">
      <div class="col-sm-4">
        <button type="submit" id="submit" class="btn btn-outline-primary" name="submit">Submit</button> &nbsp;
        <button type="reset" id="rreset-file" class="btn btn-outline-primary" name="reset-file">Reset</button>
      </div>
    </div>
  </form>
</div>
<div>
  <?php include_once("footer.php");?>
</div>
<script>
  $(document).ready(function()  {
  // Submit form data via Ajax
  $("#upload-pdf").on('submit',function (e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: 'add-files.php',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $('.submitBtn').attr("disabled", "disabled");
        $('#upload-pdf').css("opacity", ".5");
      },
      success: function (response) {
        $('.submitMsg').html('');
        if (response.status == 1) {
          $('#upload-pdf')[0].reset();
          $('.submitMsg').html('<p class="alert alert-success">' + response.message + '</p>');
        } else if (response.status == 2) {
          $('.submitMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
        } else if (response.status == 3) {
          $('.submitMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
        }else if (response.status == 4) {
          $('.submitMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
        }else{
          $('.submitMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
        }
        $('#upload-pdf').css("opacity", "");
        $(".submitBtn").removeAttr("disabled");
      }
    });
  });
  
  /*// File type validation
  var match = ['image/png'];
  $("#file").change(function () {
    for (i = 0; i < this.files.length; i++) {
      var file = this.files[i];
      var fileType = file.type;

      if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
        alert('Sorry, only pdf files are allowed to upload.');
  //$('.statusMsg').html('<p class="alert alert-danger">Sorry, only PDF files are allowed to upload.</p>');
  $("#file").val('');
  return false;
}
}
});*/
});
  
</script>
</body>
</html>