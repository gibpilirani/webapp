$(document).ready(function(){
  // Submit form data via Ajax
  $("#loginFormHome").on('submit', function(e){
      e.preventDefault();
      $.ajax({
          type: 'POST',
          url: 'login.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData:false,
          beforeSend: function(){
              $('.submitBtn').attr("disabled","disabled");
              $('#loginFormHome').css("opacity",".5");
          },
          success: function(response){
              $('.statusMsgHome').html('');
              if(response.status == 1){
                $('#loginFormHome')[0].reset();
                $('.statusMsgHome').html('<p class="alert alert-success">'+response.message+'</p>');
                //
               //$('#login').modal('hide');
              }else if(response.status == 2){
                  $('.statusMsgHome').html('<p class="alert alert-danger">'+response.message+'</p>');
              }else{
                  $('.statusMsgHome').html('<p class="alert alert-danger">'+response.message+'</p>');
              }
              $('#loginFormHome').css("opacity","");
              $(".submitBtn").removeAttr("disabled");
          }
      });
  });
});