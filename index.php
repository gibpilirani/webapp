<?php 
session_start();
include_once('functions/dbArticles.php');
$articleObject = new dbArticles();
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->

<div class="row line-bottom">
  <div class="col-sm-7 website-title"><h3>
    <p>Computing has a great legacy of its inception, and keeps changing our lives from the time it was invented. This is the place to discover the development of computing in Malawi</p></h3>
  </div>
  <div class="col-sm-5 skew">
    <div class="slideshow-container">
      <div class="mySlides">
        <q>Access to computers and the Internet has become a basic need for education in our society.</q>
        <p class="author">- Kent Conrad</p>
      </div>

      <div class="mySlides">
        <q>In the entire history of the human species, every tool we’ve invented has been to expand muscle power. All except one. The integrated circuit, the computer. That lets us use our brain power.</q>
        <p class="author">- David Gerold</p>
      </div>

      <div class="mySlides">
        <q>The whole history of computers is rampant with cheerleading at best and bigotry at worst.</q>
        <p class="author">- Larry Wall</p>
      </div>
      <div class="mySlides">
        <q>The people who are crazy enough to think they can change the world are the ones who do.</q>
        <p class="author">- Rob Siltanen</p>
      </div>
      <a class="prev" onclick="plusSlides(-1)">❮</a>
      <a class="next" onclick="plusSlides(1)">❯</a>
    </div>
    <span class="dot-container">
      <span class="dot" onclick="currentSlide(1)"></span> 
      <span class="dot" onclick="currentSlide(2)"></span> 
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(4)"></span>  
    </span>
  </div>
</div>

<div class="container mt-2 p-2">
  <div class="row">
    <div class="col-sm-8">
      <img src="image/babbage.png" class="img-fluid
      " width="700" height="auto">
      <h5><p class="text-justify mt-3">“As a young entrepreneur, the story goes, Steve Jobs asked Noyce for advice. Noyce told him that ‘You cannot understand what is going on now unless you understand what came before” (Shustek, 2011). He adds that the way an idea comes to life and changes the world is a phenomenon worth studying, preserving, and presenting as both a model and an inspiration to future generations. </p>
      </h3>
      <!-- Show featured articles -->
      <div class="row mt-5 col-sm-12">
      <h5 class="font-weight-bold featured col-sm-12 header-color">FEATURED</h5>
      <hr class="line">
      <?php
        //Get featured article
      $query = $articleObject->homePagerFeature();
      ?>
      <?php  foreach($query as $value) { 
        ?>
        <div class="col-sm-6 mt-4">

          <div class="box p-2">  
            <h4><a class="featured-link" href="story.php?id=<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a></h4>
            <div class="text-justify featured-summary">
              <?php $story_summary = $value['content'];
              echo $articleObject->readmoreHome(25, $story_summary)?> <a href="story.php?id=<?php echo $value['id']; ?>"><p><button>Read more... </button></p></a>
            </div>
          </div>
        </div>
      <?php  }
      ?>
    </div>
    </div>
    <div class="col-sm-4">
      <div class="col-sm-12">
        <h5 class="font-weight-bold header-color">POPULAR TOPICS</h5>
        <hr class="line">
        <!--Links for popular posts-->
        <?php include 'popular/popular-posts.php'; ?>
      </div>
      <!-- Categories -->
      <div class="col-sm-12">
        <h5 class="font-weight-bold mt-4 header-color">CATEGORIES</h5>
        <hr class="line mb-2">
        <ul class="category text-left list-unstyled">
          <?php $query = $articleObject->categoryLinks();
                  //Check for results 
          if (!is_array($query)){
            echo "No categories";
          }else{
            foreach ($query as $values) {
              ?>
              <li><a href="category.php?category=<?=$values['category']?>"><?=$values['category']?></a>
              </li>
              <?php   
            } }?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--Footer-->
  <div><?php include_once('footer.php');?> </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  <script>
    $(document).ready(function() {
      $('#homeSearch').click(function() {
        var value = document.getElementById('search-text').value;
        if (value === '') {
          return false;
        }
      })
    });
  </script>

  <script>
    $("#slideshow > span:gt(0)").hide();

    setInterval(function() {
      $('#slideshow > span:first')
      .fadeOut(2000)
      .next()
      .fadeIn(2000)
      .end()
      .appendTo('#slideshow');
    }, 3000);
  
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
        }
        window.onload= function () {
         setInterval(function(){ 
           plusSlides(1);
         }, 10000);
       }
     </script>
   </body>
   </html>