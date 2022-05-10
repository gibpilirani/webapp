<?php
  include_once('../functions/dbUsers.php');
  $funObj = new dbUsers();
  //check if session is set and that session is the appropriate one
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
  $query =$funObj->fetchUsers(2);
  while($result = mysqli_fetch_array($query)){
    //echo json_encode($result);
    $lastname = $result['last_name'];


  ?>

              <form method="post" class="needs-validation form-horizontal" novalidate>
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                  </div>
                  <input type="text" hidden name="id" id="id">
                  <input type="text" class="form-control" id="lastname" value="<?php echo $lastname; ?>" name="lastname" required>
                  <span class="ml-3"></span>
                  <input type="text" class="form-control" id="firstname" value="<?php echo $firstname; ?>" name="firstname" required>
                </div>


                <div class="form-group input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
               </div>
                    <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" name="email" required>
                </div>

                <div class="form-group input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i> </span>
               </div>
                    <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" name="confirmEmail" required>
                </div>

                <div class="form-group input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                    <input type="password" class="form-control" id="password" value="<?php echo $password; ?>" name="password" required>
                </div>

                <div class="form-group input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                    <input type="text" class="form-control" id="confirmPassword" value="<?php echo $confirmPassword; ?>" name="confirmPassword" required>
                </div>
                <span id="error-mesage" class="alert-danger"></span>
                <div class="form-group input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
               </div>

                 <select class="form-control" id="selectGender" name="gender" placeholder="Select gender" equired>
                   <option></option>
                   <option value="male">Male</option>
                   <option value="female">Female</option>
                 </select>
              </div>


              <div class="form-group input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
             </div>
                  <input type="text" class="form-control" id="mobile" value="<?php echo $mobile; ?>" name="mobile" required>
              </div>

              <div class="form-group input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-suitcase"></i></span>
             </div>
                  <input type="text" class="form-control" id="designation" value="<?php echo $designation; ?>" name="designation" required>
              </div>

              <div class="form-group input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
             </div>

               <select class="form-control" id="selectStatus" name="status" value="<?php echo $status; ?>" equired>
                 <option></option>
                 <option value="pending">Pending</option>
                 <option value="active">Active</option>
               </select>
             </div>

            <div class="form-group input-group">
              <div class="input-group-prepend">

           </div>
                <input id="upload" type="file" onchange="readURL(this);" name="image" class="form-control border-0" placeholder="Choose file">
            </div>

            <div class="form-group input-group">
              <div class="form-check">
              <input type="checkbox" class="form-check-input" id="materialUnchecked">
              <label class="form-check-label" for="materialUnchecked">I agree to the terms and conditions</label>
              </div>
            </div>




            <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
                  <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

            <div class="col-sm-10">
            <input type="submit" id="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
            </div>
          </form>


<?php

}


?>

<script>
$(document).ready(function(){
  $('#update_form').submit(function(e){
    //console.log('Submitted')

    $.ajax({
      type: "POST",
      url: "updateUser.php",
      data: $("#update_form").serialize(),
      success: function(data){
        $('.success').removeClass('d-none').html(data);
        $("#update_form").hide();
      },
      error: function(data) {
        $('.error').removeClass('d-none').html(data);
      }
    })

    e.preventDefault();
  })
})
</script>
