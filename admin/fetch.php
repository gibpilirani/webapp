<?php
  include_once('../functions/dbUsers.php');
  $fetch = new dbUsers();
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

  <table border='0' width='100%'>
    <?php
  if(isset($_POST['view_id'])){
    $userid = $_POST['view_id'];
  
    $query =$fetch->fetchUsers($userid);
    foreach($query as $value){
      $id = $value['id'];
      $firstname = $value['last_name'];
      $lastname = $value['first_name'];
      $email = $value['email'];
      $status = $value['status'];
      $gender = $value['gender'];
      $designation = $value['designation'];
      $userType = $value['type'];
      $image = $value['profile_image'];
      $address_one = $value['address_one'];
      $country = $value['country'];
       }
     }

       ?>
     <tr><td colspan='2' class='text-center'><div class="form-group text-center col-sm-4 mt-4">
      <img class="rounded-circle" id="profileDisplay" height="128"  src="../profile/<?=$image?>" onerror="this.src='../profile/default.jpg'" onclick="triggerClick()" id="profileDisplay" alt="Image not found"
      /><br>
      <label for="profileImage"></label>
      <input type="file" id="profile-image" onchange="displayImage(this)" name="profile-image" class="form-control" style="display: none;" class="cursor-pointer" placeholder="Choose file">
    </div></td></tr>
     <tr><td>Lastname </td><td>: </td><td><?=$lastname?></td></tr>
     <tr><td>Firstname </td><td>: </td><td><?=$firstname?></td></tr>
     <tr><td>Email </td><td>: </td><td><?=$email?></td></tr>
     <tr><td>Gender </td><td>: </td><td><?=$gender?></td></tr>
     <tr><td>Status </td><td>: </td><td><?=$status?></td></tr>
     <tr><td>Designation </td><td>: </td><td><?=$designation?></td></tr>
    <tr><td>User Type </td><td></td><td><?=$userType?></td></tr>
    <tr><td>Address  </td><td>:  </td><td><?=$address_one?><br/><?=$country?></td></tr>
  
</table>
 
