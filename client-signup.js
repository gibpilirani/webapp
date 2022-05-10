// Submit form data via Ajax
$("#user-signup").on('submit',function (e) {
  e.preventDefault();

  $.ajax({
    type: 'POST',
    url: 'registerUser.php',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      $('.submitBtn').attr("disabled", "disabled");
      $('#user-signup').css("opacity", ".5");
    },
    success: function (response) {
      $('.signUpMsg').html('');
      if (response.status == 3) {
        $('#user-signup')[0].reset();
        $('.signUpMsg').html('<p class="alert alert-success">' + response.message + '</p>');
      } else if (response.status == 2) {
        $('.signUpMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
      } else if (response.status == 1) {
        $('.signUpMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
      } else {
        $('.signUpMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
      }
      $('#user-signup').css("opacity", "");
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
      alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
      //$('.statusMsg').html('<p class="alert alert-danger">Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.</p>');
      $("#file").val('');
      return false;
    }
  }
});
