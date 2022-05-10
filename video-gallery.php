<?php session_start();?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
   
<div class="container">

<div class="page-header">
    <h1><small>Video Gallery</small></h1>
</div>

<!-- Video Gallery - START -->
<div class="container-fluid pb-video-container">
  <div class="col-md-12 col-md-offset-1">
    <div class="row pb-row">
      <div class="col-md-4">
        <video width="400" controls>
          <source src="gallery/Steve Jobs presenting the first Mac in 1984.mp4" type="video/mp4">
          <source src="mov_bbb.ogg" type="video/ogg">
          Your browser does not support HTML video.
        </video>
      </div>
      
      <div class="col-md-4">
        
        <label class="form-control label-warning text-center">Clean Bandit - Rockabye</label>
      </div>
      <div class="col-md-4">
        
        <label class="form-control label-warning text-center">Burak Yeter - Tuesday</label>
      </div>
      </div>
    </div>
</div>

<style>
    .pb-video-container {
        padding-top: 20px;
        background: #bdc3c7;
        font-family: Lato;
    }

    .pb-video {
        border: 1px solid #e6e6e6;
        padding: 5px;
    }

        .pb-video:hover {
            background: #2c3e50;
        }

    .pb-video-frame {
        transition: width 2s, height 2s;
    }

        .pb-video-frame:hover {
            height: 300px;
        }

    .pb-row {
        margin-bottom: 10px;
    }
</style>

<!-- Video Gallery - END -->
</div>
<!-- Footer -->
<?php include_once('footer.php'); ?>
<!-- Footer - END -->


</body>
</html>
