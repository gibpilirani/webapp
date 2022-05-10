<?php session_start(); ?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<?php
include_once('functions/dbArticles.php');
include_once('functions/dbConnect.php');
if(isset($_GET['country'])) {
$country = $_GET['country'];
$get_data = new dbArticles();
$query =$get_data->country($country);

   //sprint_r($query);
$total_pages = $get_data->get_pagination_number_country($country);
  //Total number of records
$numberOfRecords = $get_data->set_total_records_country($country);
  //Get current page
$currentPage = $get_data->current_page();
  //Get next page
$nextPage = $get_data->next_page_country($country);
  //Get previous page
$previousPage = $get_data->prev_page();
?>
<!--Container for the content-->

<div class="container mt-5">       
  <?php
    foreach ($query as $value) {

    $country1 = $value['country'];                 
       ?>
       <div class="row col-sm-8 mt-4">
        <div class="col-sm-12">
          <div class="text-justify article-title">
            <h4 class="article"><a class="text-secondary" href="story.php?id=<?php echo $value['id'];?>"><?php echo  $value['title']; ?></a></h4>
          </div>
          <div class="text-justify">
            <?php 
            $story_summary = $value['content'];
            echo $get_data->readmore(25, $story_summary)?> ...
          </div>
        </div>
      </div>
      <?php 
    }?>

        <div class="mt-5"></div> 
        <!-- Pagination -->
        <nav aria-label="Page navigation mt-5">
          <ul class="pagination justify-content-center">
            <li class="page-item <?php if($currentPage == ($total_pages - ($total_pages-1))){ echo 'disabled'; } ?>">
              <a class="page-link" href="country.php?country=<?php  echo $country1 . "&page=". ($total_pages - ($total_pages-1));?>">First</a>
            </li>
            </li>
            <li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; } ?>">
              <a class="page-link" href="country.php?country=<?php if($currentPage <= 1){ echo '#'; } else { echo $country1 . "&page=" . $previousPage; } ?>">Previous</a>
            </li>
            <?php for($i = 1; $i <= $total_pages; $i++ ): ?>
              <li class="page-item <?php if($currentPage == $i) {echo 'disabled'; } ?>">
                <a class="page-link" href="country.php?country=<?=$country1?>&page=<?= $i; ?>"> <?= $i; ?> </a>

              </li>
            <?php endfor; ?>
            <li class="page-item <?php if($currentPage >= $total_pages) { echo 'disabled'; } ?>">
              <a class="page-link" href="country.php?country=<?php if($currentPage >= $total_pages){ echo '#'; } else {echo $country1. "&page=". $nextPage; } ?>">Next</a>

            </li>
            <li class="page-item <?php if($currentPage == $total_pages) { echo 'disabled'; } ?>">
              <a class="page-link" href="country.php?country=<?php if($currentPage == $total_pages){ echo '#'; } else {echo $country. "&page=". $total_pages; } ?>">Last</a>
            </li>
          </ul>
        </nav>
      </div>
<?php } ?>
      <!-- jQuery + Bootstrap JS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <script>
        $(document).ready(function () {
          $('#records-limit').change(function () {
            $('form').submit();
          })
        });
      </script>
    </div>
  </div>  


  <script>
   $(document).ready(function(){
     $('.readData').click(function(){

      var article_id = $(this).data('id');

        // AJAX request
        $.ajax({
         url: 'story.php',
         type: 'POST',
         data: {article_id: article_id},
         success: function(response){
           // Add response in Modal body
           $('.modal-body').html(response);
           // Display Modal
           $('#edit-article').modal('show');
         }
       });
      });

   });
 </script>
 <!--Footer-->
 <div><?php include_once('footer.php');?> </div>

</body>
</html>