$(document).ready(function() {
  // Submit form data via Ajax
  $("#upload-image").click(function() {
      var formData = new FormData(this.form);
      $.ajax({
          url: 'gallery-upload.php',
          type: 'POST',
          data: formData,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,

          error: function(request, error) {
              //console.log(arguments);
              alert("<div class='text-danger'> Could not reach, server please try again later " + error + "</div>");

          },

          success: function(response) {
              /*$('#updateMsg').html(response); */
              if (response.success) {
                  console.log(response.message);

              } else {
                  //Error message for blank title
                  if (response.errors.title) {
                      $(".error-title").show();
                      $(".error-title").html(response.errors.title);
                      //console.log(response.errors.title);
                  }

                  //Error message for blank description
                  if (response.errors.description) {
                      $(".error-description").show();
                      $(".error-description").html(response.errors.description);
                      //console.log(response.errors.title);
                  }

                  //Error message for blank description
                  if (response.errors.file) {
                      $(".error-file").show();
                      $(".error-file").html(response.errors.file);
                      //console.log(response.errors.file);
                  }
              }
          }
      });

  });
});