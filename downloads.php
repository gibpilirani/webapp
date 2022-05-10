<?php session_start(); ?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<?php
include_once('functions/dbArticles.php');
include_once('functions/dbConnect.php');
$get_data = new dbArticles();

//if admin and loggedin access all downloads
if( isset($_SESSION['loggedin']) && ($_SESSION['type'] == 'admin')) {
  $query =$get_data->admin_download();
    //sprint_r($query);
  $total_pages = $get_data->get_pagination_number_files();
  //Total number of records
  $numberOfRecords = $get_data->set_total_records_files();
  //Get current page
  $currentPage = $get_data->current_page();
  //Get next page
  $nextPage = $get_data->next_page_files();
  //Get previous page
  $previousPage = $get_data->prev_page();


}else {
  //ordinary user access only approved downloads
  $query =$get_data->download();
  $total_pages = $get_data->get_pagination_number_userfiles();
  //Total number of records
  $numberOfRecords = $get_data->set_total_records_userfiles();
  //Get current page
  $currentPage = $get_data->current_page();
  //Get next page
  $nextPage = $get_data->next_page_userfiles();
  //Get previous page
  $previousPage = $get_data->prev_page();
}

?>
<div class="container mt-5 mb-5">
  <div class="row download-header">
    <div class="col-sm-4 font-weight-bold">File Name</div>
    <div class="col-sm-4 font-weight-bold">File Size</div>
    <div class="col-sm-4 font-weight-bold">Download</div>
  </div>
  <?php
  if(!is_array($query)){
    echo "No data found";
  } else {
    foreach ($query as $value) {
    	$id = $value['id'];
    	$name = $value['filename'];
    	$file_path = "pdf/" . $value['file_path'];
    	$type = $value['mime'];
    	?>
      <div class="row download-list mt-2">
        <div class="col-sm-4">
          <?php 
          if( isset($_SESSION['loggedin']) && ($_SESSION['type'] == 'admin')) { 
            echo "<a href='update-file.php?id=$id '>".  $name . "</a>";
          } else {
            echo $name;
          }
          ?>
        </div>
        <div class="col-sm-4">
          <?php
      //Assign appropriate file size and display it
          $bytes = filesize($file_path);
          if($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
          } elseif($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
          } elseif($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
          } elseif($bytes > 1) {
            $bytes = $bytes . ' bytes';
          } elseif($bytes == 1) {
            $bytes = $bytes . ' byte';
          } else {
            $bytes = '0 bytes';
          }
          echo $bytes;
          ?>
        </div>
        <div class="col-sm-4"><a href="<?php echo $file_path; ?>"><i class='fas fa-file-pdf' style="font-size:30px;color:red"></i>
        </a> <?php if( isset($_SESSION['loggedin']) && ($_SESSION['type'] == 'admin')) { ?> <span style="font-size: 30px">|</span> <a href="delete-file.php?id=<?php echo $id;?>"><i class='fas fa-trash' style="font-size:30px;color:gray"></i></a><?php } ?></div>
      </div>
      <?php
    }
  }
  ?>

  <!-- Pagination -->
  <nav aria-label="Download Page navigation example" class="mt-5">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($currentPage <= 1){ echo '#'; } else { echo "?page=" . $previousPage; } ?>">First</a>
      </li>

      <li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($currentPage <= 1){ echo '#'; } else { echo "?page=" . $previousPage; } ?>">Previous</a>
      </li>
      <?php for($i = 1; $i <= $total_pages; $i++ ): ?>
        <li class="page-item <?php if($currentPage == $i) {echo 'disabled'; } ?>">
          <a class="page-link" href="downloads.php?page=<?= $i; ?>"> <?= $i; ?> </a>
        </li>
      <?php endfor; ?>
      <li class="page-item <?php if($currentPage >= $total_pages) { echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($currentPage >= $total_pages){ echo '#'; } else {echo "?page=". $nextPage; } ?>">Next</a>

      </li>
      <li class="page-item <?php if($currentPage == $total_pages) { echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($currentPage == $total_pages){ echo '#'; } else {echo "?page=". $total_pages; } ?>">Last</a>
      </li>
    </ul>
  </nav>
</div>
<?php include_once("footer.php");?>
</body>
</html>