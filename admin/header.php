
<!doctype html>
<html lang="en">
<head>
  <!--  meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>History of Computing</title>
  <link rel="shortcut icon" type="image/jpg" href="../images/favicon.ico" />
  
  <script src="../fontawesome/js/all.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/bootstrap.js"></script> 
  <script src="../js/signup.js"></script>
  <script src="../tinymce/tinymce.min.js"></script>
  <script src="../profile.js"></script>
  <script src="../js/jquery.confirm.js"></script>
  <script src="../js/bootbox.min.js"></script>
  <script src='script.js' type='text/javascript'></script> 

  <!--CSS local libraries-->
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/image.css">
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<?php
include_once('../functions/dbUsers.php');
if (!isset($_SESSION['loggedin'] )) {
  header('Location: admin_login.php');
  exit;
} else {
  if (isset($_SESSION['loggedin'] )) {
    if($_SESSION['type'] !== 'admin') {
      header('Location: admin_login.php');
      exit;
    }
  } 
}
?>
<nav class="navbar navbar-dark bg-primary fixed-top flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Admin Dashboard</a>
  <input type="text" class="form-control form-control-primary w-100" type="text" placeholder="Search...">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
     <?php if(isset($_SESSION['loggedin'])){ ?><a class="nav-link text-white" href="logout.php">Logout</a> <?php
   }
   ?>
 </li>
</ul>
</nav>