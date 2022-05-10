<div class="navbar-fixed-top top-bar">
  <div class="row">
    <div class="col-sm-7 ml-5">
  <a class="navbar-brand" href="index.php" >
    <span><h5 class="font-weight-bold" style="display: inline-block;color:#ffffff">History of Computing in Malawi</h5></span>
  </a>
</div>
<div class="col-sm-4">
  <div class="navbar-nav float-right">
    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
      <ul class="list-inline navbar-right" style="float: right; color: #ffffff">
        <li class="list-inline-item" style="padding-right: 15px">
          <!--Show the logout link only if the user has loggein-->
          <?php if(isset($_SESSION['loggedin'])){  echo $_SESSION['first_name']. ' ' .$_SESSION['last_name'];
          ?>
          <a href="logout.php" class="rlmenu"><i class="fas fa-sign-out-alt"></i>Log Out </a> 
          <span class="font-weight-bold">  </span> 
          <a href="profile.php?id=<?php echo $_SESSION['id']; ?>" class="rlmenu">
            <span style="background:color:#fff;text-align:center; padding:5px;"><img class="rounded-circle" id="profile_picture" height="128" src="profile/<?php echo $_SESSION['profile'];?>" alt="Image not found" onerror="this.src='profile/default.jpg'" data-src="" data-holder-rendered="true" style="width: 40px; height: 40px; border-radius: 50%;" />
                  </span>
          </a>
            <?php }else{ ?>
              <!--Hide the register and login link only if the user has loggein-->
            <a href="registration.php" class="rlmenu"><i class="fas fa-user-plus"></i>Register</a>
            <span class="text-white font-weight-bold"> | </span> 
            <a href="user-login.php" class="rlmenu"><i class="fas fa-sign-in-alt"></i> Log in</a>
            <!-- <a href=""  data-toggle="modal" data-target="#login" >Log in</a>  -->
            <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</div>
            </div>
            </div>
<nav class="navbar navbar-expand-lg navbar-light" id="nav_bar">
  <a class="navbar-brand" href="index.php" >
    <span class="ml-2"><img src="images/favicon.ico" alt="CoolBrand"></span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
  </button>
  
        <div class="collapse navbar-collapse ml-2 py-2" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About&nbsp;us</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                History <i class="fas fa-caret-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php 
                  include_once('functions/dbArticles.php');
                  $articleObject = new dbArticles();
                  $query = $articleObject->country_links();
                  //Check for results 
                  if (!is_array($query)) {
                    echo "No categories";
                  } else {
                ?>
                <?php
                  foreach ($query as $values) {
                ?>
                <a class="dropdown-item text-left" href="country.php?country=<?=$values['country']?>"><?=$values['country']?></a>
                <?php   
                    } 
                  } 
                ?>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Gallery <i class="fas fa-caret-down"></i>
              </a>
              <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-left" href="image-gallery.php">Images</a>
                <a class="dropdown-item text-left" href="video-gallery.php">Videos</a>
                <a class="dropdown-item text-left" href="audio-gallery.php">Audio</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="downloads.php">Downloads</a>
            </li>
            <?php if(isset($_SESSION['loggedin'])){ ?>
            <li class="nav-item">
              <a class="nav-link" href="submitArticle.php">Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="send-newsletter.php">Newsletter</a>
            </li>
            <?php } 
            ?>
        
          </ul>
        </div>
        <div class="col-sm-2">
      <form method="get" action="search.php">
        <div class="input-group form-group btn-search">
          <input type="search" name="search-text" id="search-text" placeholder="Enter your search term..." class="form-control form-control-sm" results="5" size="20">
          <div class="input-group-prepend btn-search">
            <button type="submit" class="input-group-text btn-search" id="search"><i class="fa fa-search"></i></button>
          </div>  
        </div>
      </form>
    </div>
      </nav>

<script>
  $(document).ready(function() {
    $('#search').click(function() {
      var value = document.getElementById('search-text').value;
      if (value === '') {
        $('.show-oo').html('<span class="text-danger">Please enter your search term</span>');
        return false;
      }
    })
  });
</script>

<script>
  $(document).ready(function() {
  //change the integers below to match the height of your upper div, which I called
  //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
  //to figure out what the scroll position is when exactly you want to fix the nav
  //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
  //you know the position.
  $(window).scroll(function () { 

    console.log($(window).scrollTop());

    if ($(window).scrollTop() >50) {
      $('#nav_bar').addClass('fixed-top');
    }

    if ($(window).scrollTop() <50) {
      $('#nav_bar').removeClass('fixed-top');
    }
  });
});
</script>
