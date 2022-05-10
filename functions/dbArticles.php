<?php
  require_once 'dbConnect.php';
  require_once('dbFunction.php');
  
  class dbArticles  {


    //class variables
    private $total_records, $limit = 10;
    private $download_limit;
    private $nodata = "No data found";
  
    public function get_limit() {
      return $this->limit;
    }  

    //database connection function
    public function database() {
      $db = new dbConnect();
      $db = $db->dataBase();
      return $db;
    }
  
    /*========== Articles section ==========*/
    //function for inserting articles into the database
    public function insertArticle($title, $content, $country, $image_path, $author, $category) {
      $conn = $this->database();
      $insert = $conn->prepare("INSERT INTO article(title,
            content, country, image, author, category, date) VALUES(?,?,?,?,?,?,NOW())"); 
      $insert->bind_param('ssssss',$title, $content,$country, $image_path, $author, $category);
      $insert->execute();   
      return $insert->affected_rows;
    }

    //========== Check if same title exist ==========
    //function to check if the user already exist in the database
    public function isTitleExist($title) {  
      $conn = $this->database(); 
      $query = $conn->prepare("SELECT title FROM article
                  WHERE title = ? ");
      $query->bind_param('s', $title);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()){
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }
      
    //get number articles
    public function set_total_records() {
      $conn = $this->database();
      $query = $conn->prepare("SELECT * FROM article WHERE status = 'approved'");
      $query->execute();
      $query->store_result();
      $result = $query->num_rows;  
      return $result;
    }


    //get current page
    public function current_page()  {
      return isset($_GET['page']) ? (int)$_GET['page'] :1;
    }

    //get data and limit the number of rows per page
    public function queryArticles()  {
      $start = 0;
      if($this->current_page() > 1){
        $start = ($this->current_page() * $this->limit) - $this->limit;
      }
      $conn = $this->database();
      $query = $conn->prepare("SELECT id, title, content, image, date, modifiedDate, author, category FROM article WHERE status = 'approved' ORDER BY date DESC LIMIT $start, $this->limit");
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()){
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    ///================================= Country section =============================================================
    //get data for country
    public function country($country)  {
      $start = 0;
      if($this->current_page() > 1){
        $start = ($this->current_page() * $this->limit) - $this->limit;
      }

      $conn = $this->database();
      $query = $conn->prepare("SELECT id, title, content, image, date, modifiedDate, author, category, country FROM article WHERE status = 'approved' AND country = '". $country."' ORDER BY date DESC LIMIT $start, $this->limit");
      $query->execute();
      $result = $query->get_result();
      //check results if available
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()){
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }


    //get number articles for country
    public function set_total_records_country($country) {
      $conn = $this->database();
      $query = $conn->prepare("SELECT id FROM article WHERE status = 'approved' AND country = ?");
      $query->bind_param('s', $country);
      $query->execute();
      $result = $query->store_result();
      return $result;
    }

    //calculate total number of pages in relation to number of records per page for country data
    public function get_pagination_number_country($country) {
      $total_records = $this->set_total_records_country($country);
      return ceil($total_records / $this->limit);
    }

    //get next page
    public function next_page_country($country) {
      return ($this->current_page() < $this->get_pagination_number_country($country)) ? $this->current_page()+1 : $this->get_pagination_number_country($country);
    }

    //================================ Category Section===============================================================
    
    //get data for category
    public function category($category) {
      $start = 0;
      if($this->current_page() > 1) {
        $start = ($this->current_page() * $this->limit) - $this->limit;
      }

      $conn = $this->database();
      $query = $conn->prepare("SELECT id, title, content, image, date, modifiedDate, author, category, country FROM article WHERE status = 'approved' AND category = ? ORDER BY date DESC LIMIT $start, $this->limit");
      $query->bind_param('s', $category);
      $query->execute();
      $result = $query->get_result();
      //check results if available
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    //get number articles for category
    public function set_total_records_category($category) {
      $conn = $this->database();
      $query = $conn->prepare("SELECT id FROM article WHERE status = 'approved' AND category = ?");
      $query->bind_param('s', $category);
      $query->execute();
      $result = $query->store_result();
      return $result;
    }
    
    //get data and limit the number of rows per page
    public function categoryLinks() {
      $conn = $this->database();
      $query = $conn->prepare("SELECT DISTINCT category FROM article  WHERE status = 'approved'");
      $query->execute();
      $result = $query->get_result();
      //check results if available
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    //get country dropdown links
    public function country_links() {
      $db = new dbConnect();
      $conn = $db->dataBase();
      $query = $conn->prepare("SELECT DISTINCT country FROM article  WHERE status = 'approved'");
      $query->execute();
      $result = $query->get_result();
      //check results if available
      if ( ! $result->num_rows ) {
        return false;
      }
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data; 
    }

    

    //Function to upload files into the database
    public function pdf_upload($filename, $data, $type) {
      $conn = $this->database();
      $insert = $conn->prepare("INSERT INTO files(filename,
              file_path, mime, created_date) VALUES(?,?,?, NOW())"); 
      $insert->bind_param('sss',$filename, $data, $type);
      $insert->execute();   
      return $insert;
    }

    //prepare file to be deleted
    public function selectFileToDelete($id) {
      $conn = $this->database();
      $query = $conn->prepare("SELECT * FROM files WHERE id = ?");
      $query->bind_param('s', $id);
      $query->execute();
      $result = $query->get_result();
      //Check results if available
      if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data;
        }
    }

    //Delete pdf file from database
    public function deleteFile($id) {
      $conn = $this->database();
      $query = $conn->prepare("DELETE FROM files WHERE id = ?");
      $query->bind_param('s', $id);
      $query->execute();
      return $query;
    }
    //========================================= User file section ====================================================
    // function download cfiles from database
    public function download() {
      $start = 0;
        if($this->current_page() > 1){
        $start = ($this->current_page() * $this->limit) - $this->limit;
      }
      //database connection
      $conn = $this->database();
      $query = $conn->prepare("SELECT * FROM files WHERE status = 'approved' ORDER BY created_date DESC LIMIT $start, $this->limit");
      $query->execute();
      $result = $query->get_result();
      //check results if available
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
      
    }

    //get number articles for category
    public function set_total_records_userfiles() {
      $conn = $this->database();
      $query = $conn->prepare("SELECT id FROM files WHERE status ='approved'");
      $query->execute();
      $query->store_result();
      $result = $query->num_rows; 
      if ($result > 0) { 
        return $result;
      } else {
        return $this->nodata;
      }
    }

    //calculate total number of pages in relation to number of records per page
    public function get_pagination_number_userfiles() {
      $total_records = $this->set_total_records_userfiles();
      return ceil($total_records / $this->limit);
    }

    //get next page
    public function next_page_userfiles() {
      return ($this->current_page() < $this->get_pagination_number_userfiles()) ? $this->current_page()+1 : $this->get_pagination_number_userfiles();
    }
    

    //=================================== Admin file section =========================================================
      
    //function download admin files from database
    public function admin_download() {
      $start = 0;
        if($this->current_page() > 1){
        $start = ($this->current_page() * $this->limit) - $this->limit;
      }
      //instance of database connection
      $conn = $this->database();
      $query = $conn->prepare("SELECT * FROM files ORDER BY created_date DESC LIMIT $start, $this->limit");
      $query->execute();
      $result = $query->get_result();
      //check results if available
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    //get number articles for category
    public function set_total_records_files() {
      $conn = $this->database();
      $query = $conn->prepare("SELECT id FROM files");
      $query->execute();
      $query->store_result();
      $result = $query->num_rows;  
      if ($result > 0 ) {
      return $result;
      } else {
        return $this->nodata;
      }
    }

    //select single file from database
    public function single_file($id) {
      $conn = $this->database();
      $query = $conn->prepare("SELECT * FROM files WHERE id = ?");
      $query->bind_param('s', $id);
      $query->execute();
      $result = $query->get_result();
      //check results if available
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    //update files 
    public function update_file($id, $filename, $status) {
      $conn = $this->database();
      $query = $conn->prepare("UPDATE  files SET filename = ?, status = ? WHERE id = ?");
      $query->bind_param('sss', $filename, $status, $id);
      $query->execute();   
      return $query;
    }

    //calculate total number of pages in relation to number of records per page
    public function get_pagination_number_files(){
      $total_records = $this->set_total_records_files();
      return ceil($total_records / $this->limit);
    }

    //get next page
    public function next_page_files() {
      return ($this->current_page() < $this->get_pagination_number_files()) ? $this->current_page()+1 : $this->get_pagination_number_files();
    }

    //calculate total number of pages in relation to number of records per page
    public function get_pagination_number() {
      $total_records = $this->set_total_records();
      return ceil($total_records / $this->limit);
    }



    /*========== Set paginations by category ==========*/ 
    //Calculate total number of pages 
    public function get_pagination_number_category($category) {
      $total_records = $this->set_total_records_category($category);
      return ceil($total_records / $this->limit);
    }

    //get next page
    public function next_page_category($category) {
      return ($this->current_page() < $this->get_pagination_number_category($category)) ? $this->current_page()+1 : $this->get_pagination_number_category($category);
    }


    //if current page disable the link
    public function prev_page() {
              return ($this->current_page() > 1) ? $this->current_page()-1 : 1;
          }
    //get next page
    public function next_page() {
      return ($this->current_page() < $this->get_pagination_number()) ? $this->current_page()+1 : $this->get_pagination_number();
    }

    

    //========== For administrator ==========
    //set total records
    public function set_total_records_admin() {
      $conn = $this->database();
      $query =$conn->prepare("SELECT id FROM article");
      $query->execute();
      $result = $query->store_result();
      return $result;
    }

    //query article for admin_login
    public function queryArticlesAdmin() {
      $conn = $this->database();   
      $start = 0;
      if($this->current_page() > 1) {
        $start = ($this->current_page() * $this->limit) - $this->limit;
      }

    $query = $conn->prepare("SELECT id, title, content, country, image, date, modifiedDate, status, author FROM article ORDER BY date DESC LIMIT $start, $this->limit");
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      } 
    }

    //view content by category
    public function hardwareCategory($category ) { 
      $conn = $this->database();
        $start = 0;
      if($this->current_page() > 1) {
        $start = ($this->current_page() * $this->limit) - $this->limit;
      }  
      
      $query = $conn->prepare("SELECT * FROM article WHERE category= ? LIMIT $start, $this->limit");
      $query->bind_param('s', $category);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    //show a summary on the list of articles 
    public function readmore($limit, $text) {   
      $contents = explode(" ", $text);
      $words = array_slice($contents, 0, $limit);

      return implode(" ", $words);
    }

    //show a summary on homepage links
    public function readmoreHome($limit, $text) {   
      $contents = explode(" ", $text);
      $words = array_slice($contents, 0, $limit);
      return implode(" ", $words);
    }

    //  
    public function readMoreApprove($story_desc, $link, $targetFile, $id) {   
      //number of characters to show
      $chars = 500;
      $story_desc = substr($story_desc, 0, $chars);
      $story_desc = substr($story_desc, 0, strrpos($story_desc, ' '));
      $story_desc = "<a href='$link?$targetFile=$id'> " .  $story_desc . "</a>";
      return $story_desc;
    }

    //get target article by id
    public function getTargetArticle($id) {
      $conn = $this->database();
      $query = $conn->prepare("SELECT id, author, title, content, country, image, date, modifiedDate, status, feature, visits, category FROM article WHERE id = ?");
      $query->bind_param('s', $id);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      } 
    }

    //update article
    public function editArticle($id, $title, $content, $country, $status, $featured, $category, $image) {
      $conn = $this->database();
      $query = $conn->prepare("UPDATE  article SET title = ?, content = ?, country = ?, status = ?, feature = ?, category = ?, image = ?, modifiedDate = NOW() WHERE id = ?");
      $query->bind_param('ssssssss', $title, $content, $country, $status, $featured, $category, $image, $id);
      $query->execute();   
      return $query;
    }

      
    //article to feature on the bottom of the homepage
    public function homePagerFeature() {
      $conn = $this->database();  
      $query = $conn->prepare("SELECT id, title, image, content, date FROM article WHERE status = 'approved' AND feature = 'featured' ORDER BY DATE DESC LIMIT 4");
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    //to maintain the current image path if it is not changed
    public function selectImage($id) {
      $conn = $this->database();
      $query =$conn->prepare("SELECT image FROM article WHERE id = ?");
      $query->bind_param('s', $id);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }

    //delete article from database
    public function deleteArticle($id)  {
      $conn = $this->database();
      $query = $conn->prepare("DELETE FROM article WHERE id = ?");
      $query->bind_param('s', $id);
      $query->execute();
      return $query;
    }

    //get number of views per page
    public function pageviews($id) { 
      $conn = $this->database(); 
      $query = $conn->prepare("SELECT * FROM article WHERE status= 'approved' AND id = ? ");
      $query->bind_param('s', $id);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }
    
    //display most viewed articles
    public function mostViewedArticles() { 
      $conn = $this->database(); 
      $query = $conn->prepare("SELECT * FROM article WHERE status= 'approved' ORDER BY visits DESC LIMIT 3");
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data; 
      } else {
        return $this->nodata;
      }
    }
  }
?>

