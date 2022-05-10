// Submit form data via Ajax
$("#fupForm").on('submit',function (e) {
  e.preventDefault();

  $.ajax({
    type: 'POST',
    url: 'register.php',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      $('.submitBtn').attr("disabled", "disabled");
      //$('#fupForm').css("opacity", ".5");
    },
    success: function (response) {
      $('.statusMsg').html('');
      if (response.status == 1) {
        $('#fupForm')[0].reset();
        $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
      } 

      if (response.status == 2) {
        $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
      } else if (response.status == 3) {
        $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
      } else {
        $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
      }
      $('#fupForm').css("opacity", "");
      $(".submitBtn").removeAttr("disabled");
    }
  });
});

// File type validation
var match = ['image/jpeg', 'image/png', 'image/jpg'];
$("#file").change(function () {
  for (i = 0; i < this.files.length; i++) {
    var file = this.files[i];
    var fileType = file.type;

    if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
      alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
      //$('.statusMsg').html('<p class="alert alert-danger">Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.</p>');
      $("#file").val('');
      return false;
    }
  }
});
