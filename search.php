<?php
  session_start();
  
  //-- HEADER -->
  include_once('web_header.php');
  //--END OF HEADER-->
  $search_results =  $search_term  = "";
  //Check if search data was submitted
  if ( isset( $_GET['search-text'] ) ) {
    
    // Include the search class
    require_once('functions/dbSearch.php' );
    require_once('functions/dbArticles.php' );
    // Instantiate a new instance of the search class
    // Instantiate a new instance of the search class
    $search = new dbSearch();
    $summary = new dbArticles();
    
    // Store search term into a variable
    $search_term = htmlspecialchars($_GET['search-text'], ENT_QUOTES, 'UTF-8');
    // Send the search term to our search class and store the result
    $search_results = $search->search($search_term);
    //print_r($search_results);
    $total_pages = $search->get_pagination_number($search_term);
    //Total number of records
    $numberOfRecords = $search->set_total_records($search_term);
    //Get current page
    $currentPage = $search->current_page();
    //Get next page
    $nextPage = $search->next_page($search_term);
    //Get previous page
    $previousPage = $search->prev_page();
  }
  ?>    
<div class="search-form container p-0">
  <h4 class="mt-5 ml-3">Search</h4>
  <form action="" method="get">
    <div class="input-group form-group col-sm-8">
      <input type="search" name="search-text" id="search-text" placeholder="Enter your search term..." class="form-control form-control-lg" results="5" value="<?php echo $search_term; ?>" size="50" required>
      <div class="input-group-prepend">
        <button type="submit" class="input-group-text" style="border-radius: 0px 12px 12px 0px" id="submit"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>
</div>
<div class="mb-1" style="border-bottom: solid 1px #d3d3d3d3;"></div>
<div class="container mb-5">
  <?php if ( $search_results ) : ?>
  <div class="results-count">
    <p> <?php 
      $result = $numberOfRecords;
      if($result == 1)
        echo $result . " result found"; 
      else
        echo "About " . $result . " results found";
      ?></p>
  </div>
  <div class="row col-sm-8">
    <?php foreach ( $search_results['results'] as $search_result ) : ?>
    <div class="col-sm-12 mt-2">
      <h4 class="article"><a href="story.php?id=<?php echo $search_result['id']; ?>"> <?php echo $pageSearch = $search_result['title']; ?></a></h4>
      <p><?php $text = $search_result['content'];
        echo $summary->readmore(20, $text). " ...";?></p>
    </div>
    <?php 
      endforeach; ?>
  </div>
  <?php 
    else:
      echo "No results found";
    endif; ?>
</div>

        <!-- Pagination -->
        <nav aria-label="Page navigation mt-5">
          <ul class="pagination justify-content-center">
            <li class="page-item <?php if($currentPage == ($total_pages - ($total_pages-1))){ echo 'disabled'; } ?>">
              <a class="page-link" href="search.php?search-text=<?php  echo $search_term.  "&page=". ($total_pages - ($total_pages-1));?>">First</a>
            </li>
            </li>
            <li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; } ?>">
              <a class="page-link" href="search.php?search-text=<?php if($currentPage <= 1){ echo '#'; } else { echo $search_term. "&page=" . $previousPage; } ?>">Previous</a>
            </li>
            <?php for($i = 1; $i <= $total_pages; $i++ ): ?>
              <li class="page-item <?php if($currentPage == $i) {echo 'disabled'; } ?>">
                <a class="page-link" href="search.php?search-text=<?php echo $search_term?>&page=<?= $i; ?>"> <?= $i; ?> </a>

              </li>
            <?php endfor; ?>
            <li class="page-item <?php if($currentPage >= $total_pages) { echo 'disabled'; } ?>">
              <a class="page-link" href="search.php?search-text=<?php if($currentPage >= $total_pages){ echo '#'; } else {echo $search_term. "&page=". $nextPage; } ?>">Next</a>

            </li>
            <li class="page-item <?php if($currentPage == $total_pages) { echo 'disabled'; } ?>">
              <a class="page-link" href="search.php?search-text=<?php if($currentPage == $total_pages){ echo '#'; } else {echo $search_term . "&page=". $total_pages; } ?>">Last</a>
            </li>
          </ul>
        </nav>
<?php include_once('footer.php');?>
</body>
</html>