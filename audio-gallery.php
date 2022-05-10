<?php session_start();?>

      <!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
   
<div class="container">

<div class="page-header">
    <h1><small>Video Gallery</small></h1>
</div>

<!-- Audio Gallery - START -->
<div class="container-fluid pb-video-container">
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-4">
    <audio controls style="background-color:#C8C8C8;">
      <source src="audios/mponela.aac" type="audio/mpeg" />
    </audio>
    <p>how was computing at Mzuzu university from 2004 to 2007</p>
  </div>
  <div class="col-sm-4">
    <audio controls style="background-color:#C8C8C8;">
      <source src="audios/edithchipo.mp3" type="audio/mpeg" />
    </audio>
  </div>
  <div class="col-sm-4">
    <audio controls style="background-color:#C8C8C8;">
      <source src="audios/chrissym.mp3" type="audio/mpeg" />
    </audio>
  </div>
</div>
    </div>
</div>

<!-- Audio Gallery - END -->
</div>
<!-- Footer -->
<?php include_once('footer.php'); ?>
<!-- Footer - END -->


</body>
</html>
