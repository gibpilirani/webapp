<?php
include_once('../functions/dbUsers.php');
// If the user is not logged in redirect to the login page...
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

$userData = new dbUsers();
?>

<?php require_once("header.php");?>
<!-- Container -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-light d-none d-md-block sidebar">
      <div class="sidebar-left">
        <?php require_once "admin_menu.php";?>
   </div>
 </div>

 <!-- Main -->
 <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt">
   <h3>Welcome</h3>
   <div class="container">
  <div class="row align-items-start">
    <div class="col">
      Web traffic
    </div>
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
</div>
 </main>
</div>
</div>
</body>
</html>
