<?php
require_once 'dbConnect.php';
define('SITE_URL', 'http://localhost/history/');
class dbFunction
{
  //database connection function
  public function database()  {
    $dbObject= new dbConnect();
    $db = $dbObject->__construct();
    return $db;
  }

  //function to prevent sql injection for rticles
  function input_data($data)  {
    $data = trim($data);
    return $data;
  }
  
  //function to prevent sql injection for users
  function login_protect($data)  {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

  // destructor
  function __destruct() {

  }
}
?>
