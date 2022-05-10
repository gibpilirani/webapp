<?php
session_start();
  require_once("header.php");
  include_once('../functions/dbArticles.php');
  $linkstring="";
    $funObj = new dbArticles();
?>
<?php
  if(isset($_GET['article-id'])) {
    $articleId = $_GET['article-id'];
    $query =$funObj->getTargetArticle($articleId);
    //Loop through the array data retrieved from the database
    foreach ($query as $value) { 
      $date = $value['date'];
      $title = $value['title'];
      $story = $value['content'];
      $id = $value['id'];
      $author = $value['author'];
?>
<div class="row">
    <div class="col-md-2 bg-light d-none d-md-block sidebar">
      <div class="sidebar-left">
        <?php require_once "admin_menu.php";?>
      </div>
    </div>
   <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt">
  
    <div class="container">
      <h5><?php echo  $title;?></h5>
      <?php 
        $date = str_replace('/', '-', $date);
        $date = date('j F, Y',strtotime($date));
      ?>        
      <small>
        Written by: 
        <?php echo  $author;?><br/> 
        Posted: <?php echo  $date; ?>
        <?php
          if(isset($_SESSION['email'])) {
        ?><br/>
        <a href="update-article.php?id=<?php echo $value['id']; ?>"> Edit</a>
        <input type="button" name="edit" class="fas fa-edit fa-lg edit_data"  data-toggle="modal" data-target="#update" data-id="<?php echo $id; ?> ">
        <a href="#" class="delete" id="<?php echo $value['id']; ?>"> Delete</a>
        <?php } ?>
      </small>
      <div class="text-justify"> 
        <div class="loading-message"></div>
        <?php 
            echo $story;
        ?>
      </div>
      </div>
      </main>
      </div>
      <?php 
        }
      } ?>

<script type="text/javascript">

$('document').ready(function() {
  $('.delete').click(function() {
    alert(12334);
    var del_id = $(this).attr('id');
    var parent = $(this).parent();
    $.post('delete-article.php', {id:del_id},function(data) {
      $(".loading-message").html("<p><img src='../images/loading.gif'></p>");
      setTimeout(function() {
            window.location.href = "articles.php";
          }, 3000);
        parent.slideUp('slow', function() {$(this).remove();
      });
    });
  });
});
</script>
