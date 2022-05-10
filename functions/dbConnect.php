<?php
  require_once('config.php');
  class dbConnect {
    public function dataBase()  {
      $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
      // testing the connectio
      if (!$conn) {
        echo "Cannection failed";
      } else {
        return $conn;
      }
    }
    public function Close() {
      mysqli_close();
    }

  /*========== get number articles for country ==========*/
  public function country($country) {
    $conn = $this->dataBase();
    $query = $conn->prepare("SELECT DISTINCT country FROM article WHERE status = 'approved' AND country = ?");
    $query->bind_param('s', $country);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
      return  $row['country'];  
    }
  }
}
?>