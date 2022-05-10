$(document).ready(function() {
  var x_timer;  
  $("#email").keyup(function (e){
    clearTimeout(x_timer);
    var user_name = $(this).val();
    x_timer = setTimeout(function(){
      check_username_ajax(user_name);
    }, 1000);
  }); 

function check_username_ajax(email){
  $("message").html('<img src="loader.gif" width="50"/>');
  $.post('check-availability.php', {'email':email, }, function(data) {
    $("message").html(data);
  });
}
});