<?php
//session_start();
 include_once('../functions/dbUsers.php');
if(isset($_SESSION['loggedin']) && $_SESSION['type'] == 'admin'){
      header('location: index.php');
  }
 
  $userLogin = new dbUsers();
  $dbConnect = new dbConnect();
  
  if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) AND !empty($password)) {      
      $data = $userLogin->AdminLogin($email, $password);
      if($data) {
        //redirect
        //header('Location: index.php');
        if($_SESSION['type'] == 'admin') {
            exit('1');
        } else {
          exit('2');
        }
          
        } else {
          exit('<p class="alert text-danger">Username or password is wrong</p>' );
        } 
    }else {
       
    }
    } 
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>History of Computing</title>
    <link rel="shortcut icon" type="image/jpg" href="../images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>


     <!--CSS libraries-->
      <link rel="stylesheet" href="bootstrap/css/jquery-ui.css">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <style>
        .alert-danger {
          width: 350px;
         
        }
      </style>
         

      <!--JS local libraries-->
      <script src="../fontawesome/js/all.js"></script>
      <script src="bootstrap/js/bootstrap.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="bootstrap/js/jquery.min.js"></script>
      <script src="bootstrap/js/popper.min.js"></script>
      <script src="bootstrap/js/jquery-ui.js"></script>
  </head>
  <body>
  
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

      <div class="container col-sm-3 mt-5">
        <div class="">
        <h4 class="card-title mt-3 text-center">Admin Login</h4>
        <hr>
        <p id="statusMsg" ></p>
        <p id="empty" class="empty"></p>
        <form  method="post" action="admin_login.php" >

        <div class="form-group input-group">
          <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-user"></i> </span>
       </div>
            <input type="text" class="form-control" id="email" placeholder="Username/email" name="email">
        </div>
        <div class="form-group input-group">
          <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
       </div>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        </div>
        <div class="col-sm-10">
        <input type="button" id="login" class="btn btn-primary btn-block" name="login" value="Sign In">
        </div>
      </form>
     </div>
   </div>

<!--Validate -->
<script type="text/javascript">
    $(document).ready(function()  {
    // Submit form data via Ajax
    $('#email').keyup(function()  {
      $('#statusMsg').html('');
    });

    $('#password').keyup(function()  {
      $('#statusMsg').html('');
    });

    $('#email').keyup(function()  {
      $('#empty').html('');
    });

    $('#password').keyup(function()  {
      $('#empty').html('');
    });



    $("#login").on('click', function(){
      var email = $("#email").val();
      var password = $("#password").val();

      if (email == "" || password == ""){
        $('#empty').html('<span class="alert alert-danger">Please check you input</span>');
      }else {
      $.ajax({
        type: 'POST',
        url: 'admin_login.php',
        data: {login:1, email:email, password:password},
        success: function(response){
          $('#statusMsg').html(response);

          if(response == 1) {
            window.location = 'index.php';
          } else if(response == 2) {
            $('#statusMsg').html("<p class='alert alert-danger'> Access denied</p>");
          }
      },
      dataType: 'text'
    });
    }
    });
  });
</script>

  </body>
</html>
