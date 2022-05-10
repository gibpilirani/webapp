$(document).ready(function() {
  $("#email").keyup(function() {
      var email = $("#email").val();
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (!filter.test(email)) {
          //alert('Please provide a valid email address');
          $("#error_email").text("Please enter a valid email");
          email.focus;
          $(this).css("border", "2px solid #ff0000");
          //return false;
          $(".error-email").html('');
      } else {
          $("#error_email").text("");
          $(this).css("border", "2px solid green");
          $(".error-email").html('');
      }
  });

    //Validate email
    $("#repeatEmail").keyup(function () {
        var repeatEmail = $("#repeatEmail").val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(repeatEmail)) {
            //alert('Please provide a valid email address');
            $("#error_repeatEmail").text("Please enter a valid email");
            repeatEmail.focus;
            $(this).css("border", "2px solid #ff0000");
            //return false;
            $(".error-repeatEmail").html('');
        } else {
            $("#error_repeatEmail").text("");
            $(this).css("border", "2px solid green");
            $(".error-repeatEmail").html('');
        }
    });

  //Check if lastname is empty
  $("#lastname").keyup(function() {
      var lastname = $.trim($(this).val());
      if (lastname == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-name').html('');
      }
  });

  //Check if first nae is empty
  $("#firstname").keyup(function() {
      var firstname = $.trim($(this).val());
      if (firstname == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {
          $(this).css("border", "1px solid green");
          $('.error-firstname').html('');
      }
  });

  //Check if password is empty
  $("#firstname").keyup(function() {
      var firstname = $.trim($(this).val());
      if (firstname == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {
          $(this).css("border", "1px solid green");
          $('.error-firstname').html('');
      }
  });

  //Check if password is empty
  $("#password").keyup(function() {
      var password = $.trim($(this).val());
      if (password == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {
          $(this).css("border", "1px solid green");
          $('.error-password').html('');
      }
  });

  //Check if confirm password is empty
  $("#repeatPassword").keyup(function() {
      var repeatPassword = $.trim($(this).val());
      if (repeatPassword == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-repeatPassword').html('');
      }
  });

  //Check if designation is not selected
  $("#designation").change(function() {
      var designation = $.trim($(this).val());
      if (designation == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-designation').html('');
      }
  });

  //Check if address is empty
  $("#addressOne").keyup(function() {
      var addressOne = $.trim($(this).val());
      if (addressOne == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-addressOne').html('');
      }
  });

  //Check if city is empty
  $("#city").keyup(function() {
      var city = $.trim($(this).val());
      if (city == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-city').html('');
      }
  });

  //Check if address is empty
  $("#country").change(function() {
      var country = $.trim($(this).val());
      if (country == "") {
          $(this).css("border", "2px solid #ff0000");
          return false;
      } else {

          $(this).css("border", "1px solid green");
          $('.error-country').html('');
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
      }
  });

  //Check if email and confirm email match
  function checkEmailMatch() {
      var email = $("#email").val();
      var confirmEmail = $("#repeatEmail").val();
      if (email != confirmEmail) {
          $("#CheckEmailMatch").html("Email does not match!");
          $(".error_show").css("border", "2px solid #ff0000");
      } else {
          $("#CheckEmailMatch").html(" ");
          $(".error").css("border", "2px solid green");
      }
  }

  //Trigger checkEmailMatch function
  $("#repeatEmail").keyup(checkEmailMatch);


  var x_timer;
  $("#email").keyup(function(e) {
      clearTimeout(x_timer);
      var user_name = $(this).val();
      x_timer = setTimeout(function() {
          check_username_ajax(user_name);
      }, 100);
  });

  function check_username_ajax(email) {
      $("#message").html('');
      $.post('check-availability.php', {
          'email': email,
      }, function(data) {
          if (data) {
              $("#message").html(data)
              $(".error_show").css("border", "2px solid #ff0000");
          }
      });
  }

  //Check if password and confirm password match
  function checkPasswordMatch() {
      var password = $("#password").val();
      var confirmPassword = $("#repeatPassword").val();
      if (password != confirmPassword) {
          $("#CheckPasswordMatch").html("Passwords does not match!");
      } else {
          $("#CheckPasswordMatch").html(" ");
      }
    }
      //Trigger checkPasswordMatch function
      $("#repeatPassword").keyup(checkPasswordMatch);

      $("#loading").hide(); // To Hide progress bar

      // Submit form data via Ajax
      $("#userSignup").on('submit', function(e) {
          e.preventDefault();
          $('#message-success').html('Sending...')
          
          $.ajax({
              type: 'POST',
              url: 'registerUser.php',
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,

              error: function(request, error) {
                  //console.log(arguments);
                  $("#userSignup").html("<div class='text-danger'> Could not reach, server please try again later " + error + "</div>");
              },

              success: function(response) {
                $("#loading").show();
                  if (response.success) {
                   
                      $(".signUpMsg").html("<div class='text-primary'>" + response.message + "</div>");
                      //alert(response.message);
                      console.log(response.message);
                      $('#userSignup')[0].reset();
                      $('#hide').hide();
                  } else {
                      //Error message for blank lastname
                      if (response.errors.lastname) {
                          $(".error-name").show();
                          $(".error-name").html(response.errors.lastname);
                          //console.log(response.errors.lastname);
                      }

                      //Error message for blank firstname
                      if (response.errors.firstname) {
                          $(".error-firstname").show();
                          $(".error-firstname").html(response.errors.firstname);
                          console.log(response.errors.firstname);
                      }

                      //Error message for blank email
                      if (response.errors.email) {
                          $(".error-email").show();
                          $(".error-email").html(response.errors.email);
                          console.log(response.errors.email);
                      }

                      //Error message for blank email
                      if (response.errors.invalidEmail) {
                          $(".error-email").show();
                          $(".error-email").html(response.errors.invalidEmail);
                          console.log(response.errors.invalidEmail);
                      }

                      //Error message for blank repeat email
                      if (response.errors.repeatEmail) {
                          $(".error-repeatEmail").show();
                          $(".error-repeatEmail").html(response.errors.repeatEmail);
                          console.log(response.errors.repeatEmail);
                      }

                      //Error message for blank password
                      if (response.errors.password) {
                          $(".error-password").show();
                          $(".error-password").html(response.errors.password);
                          console.log(response.errors.password);
                      }

                      //Error message for blank repeat password
                      if (response.errors.repeatPassword) {
                          $(".error-repeatPassword").show();
                          $(".error-repeatPassword").html(response.errors.repeatPassword);
                      }

                      //Error message for blank gender
                      if (response.errors.gender) {
                          $(".error-gender").show();
                          $(".error-gender").html(response.errors.gender);
                      }

                      //Error message for blank designation
                      if (response.errors.designation) {
                          $(".error-designation").show();
                          $(".error-designation").html(response.errors.designation);
                      }

                      //Error message for blank address
                      if (response.errors.addressOne) {
                          $(".error-addressOne").show();
                          $(".error-addressOne").html(response.errors.addressOne);
                      }

                      //Error message for blank city
                      if (response.errors.city) {
                          $(".error-city").show();
                          $(".error-city").html(response.errors.city);
                      }

                      //Error message for blank city
                      if (response.errors.zip) {
                        $(".error-zip").show();
                        $(".error-zip").html(response.errors.zip);
                    }


                      //Error message for blank country
                      if (response.errors.country) {
                          $(".error-country").show();
                          $(".error-country").html(response.errors.country);
                      }

                      //Error message for blank file
                      if (response.errors.file) {
                          $(".error-file").show();
                          $(".error-file").html(response.errors.file);
                      }
                  }
              }
          });
      });

      //File type validation
      var match = ['image/jpeg', 'image/png', 'image/jpg'];
      $("#file").change(function() {
          for (i = 0; i < this.files.length; i++) {
              var file = this.files[i];
              var fileType = file.type;

              if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
                  alert('Sorry, only JPG, JPEG, GIF, & PNG files are allowed to upload.');
                  $("#file").val('');
                  return false;
              }
          }
      });
  }
);