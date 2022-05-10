<?php
/**
 * Performs a search
 *
 * This class is used to perform search functions in a MySQL database
 *
 * @version 1.2
 * @author John Morris <support@johnmorrisonline.com>
 * @author Kirill Krasin <kirillkrasin@gmail.com>
 */

require_once 'dbConnect.php';
require_once('dbFunction.php');

class dbSearch {

  private $total_records, $limit = 4;
  //connecto database
  public function database() {
      $db = new dbConnect();
      $db = $db->dataBase();
      return $db;
  }

  //get current page
  public function current_page()  {
    return isset($_GET['page']) ? (int)$_GET['page'] :1;
  }
  //perform search  
  public function search($search_term) {
    $start = 0;
    if($this->current_page() > 1){
      $start = ($this->current_page() * $this->limit) - $this->limit;
    }
    $conn = $this->database();    
    //run the query
    $query = $conn->prepare("SELECT title, id, content FROM article WHERE title LIKE CONCAT('%',?,'%') AND status = 'approved' OR content LIKE CONCAT('%',?,'%') ORDER BY visits DESC LIMIT $start, $this->limit");
    $query->bind_param('ss',$search_term, $search_term);
    $query->execute();    
    $result = $query->get_result();
    //check results
    if ( ! $result->num_rows ) {
      return false;
    }
    //loop through fetched data
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    //build our return result
    $search_results = array(
      'count' => $result->num_rows,
      'results' => $data,
    );
    //return results
    return $search_results; 
  }

  //get number of records found in database
  public function set_total_records($search_term) {
    $db = new dbConnect();
    $conn = $this->database();
    $query = $conn->prepare("SELECT id FROM article WHERE title LIKE CONCAT('%',?,'%') AND status = 'approved' OR content LIKE CONCAT('%',?,'%') 
    ");
    $query->bind_param('ss',$search_term, $search_term);
    $query->execute();
    $query->store_result();
    $result = $query->num_rows;  
    return $result;
  }

  public function get_pagination_number($search_term)  {
    $total_records = $this->set_total_records($search_term);
    return ceil($total_records / $this->limit);
  }

  //get next page
  public function next_page($search_term) {
    return ($this->current_page() < $this->get_pagination_number($search_term)) ? $this->current_page()+1 : $this->get_pagination_number($search_term);
  }

  //if current page disable the link
  public function prev_page() {
    return ($this->current_page() > 1) ? $this->current_page()-1 : 1;
  }
}
