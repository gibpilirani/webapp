
    <ul class="nav navbar-nav navbar-right container">
      <?php
        //Retrieve data if the session is true
        //$sessionObj = new dbFunction();
        if(isset($_SESSION['email'])){
            //$user = $sessionObj->showLoginName($_SESSION['email']);
            //if($user) {

       //if(isset($_SESSION['email']))
       //{?>
       <div class="row">
         <div class="col-md-12 bg-light text-right">
            <li> <a href="#">Welcome <?php  echo $_SESSION['first_name'];

              //echo $user;
            ?></a></li>
            <li> <a href="logout.php">Log Out</a></li>
        </div>
      </div>
    <?php }else{ ?>
        <div class="row">
            <div class="col-md-12 bg-light text-right">
              <li> <a href="user-login.php">Log in</a></li> | <a href="registration.php">Register</a>
            </div>
          </div>
      <?php } ?>
    </ul>
    <nav class="nav navbar navbar-inverse navbar-expand-md navbar-dark bg-danger sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="about.php"><img src="../images/favicon.ico"></a>
        <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link text-white main-menu" href="index.php">Home</a>
              </li>
              <li class="nav-item text-white">
                <a class="nav-link text-white" href="about.php">About us</a>
              </li>
              <li class="nav-item  dropdown">
                <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#">History</a>
                <span class="caret"></span></a>
                <ul class="dropdown-menu bg-danger">
                  <li><a href="articles.php" class="nav-link text-white">Malawi</a></li>
                  <li><a href="#" class="nav-link text-white">Zambia</a></li>
                  <li><a href="#" class="nav-link text-white">Tanzania</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">Service</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="contact.php">Contact US</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="submitArticle.php">Submit</a>
              </li>
          </ul>
          <form class="navbar-form navbar-left" action="/action_page.php">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        </div>
      </div>
    </nav>
  </ul>
</div>
