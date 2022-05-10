<?php
  //Call articles with necessary functions
include_once('functions/dbArticles.php');
include_once('functions/dbUsers.php');
$linkstring="";
$readArticle = new dbArticles();
$user = new dbUsers();
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<?php
$articleId = $_GET['id'];

  //Get the article data
$query =$readArticle->getTargetArticle($articleId);
foreach ($query as $value) { 
  $date = $value['date'];
  $title = $value['title'];
  $image = $value['image'];
  $content = $value['content'];
  $id = $value['id'];
  $author = $value['author'];
  $category = $value['category'];

}
  //Number of views per on accessed page
$page_views = $readArticle->pageViews($articleId);
foreach ($page_views as $value) {
  $visits = $value['visits'];
}

  //Get the author of the aricle queried
$access_user = $user->article_authors($author);
foreach ($access_user as $value) {
  $lastname = $value['last_name'];
  $firstname = $value['first_name'];      
}
?>
<article class="container mt-5 mb-5">
  <!--Horizontal card-->
  <div class="row">
    <div class="col-md-8">
      <h3 class="article-title story-titles"><?php echo  $title;?></h3>
      <div class="article-line-1"></div>
      <small><?php echo  strtoupper($firstname . " " . $lastname);
      $date = date("j F Y", strtotime($date));
      echo "  ". strtoupper($date);
      ?>
      <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['type'] == 'admin') {
        ?>
        <a href="update-article.php?id=<?php echo $id; ?>"> Edit</a>
        <a href="delete-article.php?delete_id=<?php echo $id; ?>" > Delete</a>
        <?php
      }
      echo $visits;
      ?> Views | Category: <?php echo $category;?>
    </small>
    <div class="text-primary mt-2"><a href="https://web.facebook.com/historyofcomputinginmalawi" class="me-4 text-reset">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="" class="me-4 text-reset">
      <i class="fab fa-twitter"></i>
    </a>
    <a href="" class="me-4 text-reset">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="" class="me-4 text-reset">
      <i class="fab fa-linkedin"></i>
    </a>
  </div>
  <div class="article-line-2"></div>
  <br>
  <img src="uploads/<?php echo $image; ?>"  alt="Sorry! Image not available at this time" 
  onError="this.onerror=null;this.src='uploads/computer_hst.png';" class="img-fluid img-thumbnail">
  <br>
  <div class="text-justify" width="25%" height="auto" style ="user-select: none; background: none; background: none;
      "><p><?php echo $content;
  ?></p></div>
</div>
<div class="col-md-4">
  <div class="col-sm-12">
    <h6 class="font-weight-bold">POPULAR TOPICS</h6>
    <hr class="line">
    <!--Links for popular posts-->
    <?php include 'popular/popular-posts.php'; ?>
  </div>
  <!-- Categories -->
      <div class="col-sm-12">
        <h6 class="font-weight-bold mt-4">CATEGORIES</h6>
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
</article>

<!-- Footer -->
<?php include_once('footer.php'); ?>

<script>
      // PREVENT CONTEXT MENU FROM OPENING
      document.addEventListener("contextmenu", function(evt){
        evt.preventDefault();
      }, false);

      // PREVENT CLIPBOARD COPYING
      document.addEventListener("copy", function(evt){
        // Change the copied text if you want
        evt.clipboardData.setData("text/plain", "Copying is not allowed on this webpage");

        // Prevent the default copy action
        evt.preventDefault();
      }, false);
    </script>
<!-- <script type="text/javascript">
 $(document).bind("contextmenu",function(e){
 return false;
 });
 </script> -->
</body>
</html>