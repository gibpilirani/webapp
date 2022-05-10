<?php
require_once 'dbConnect.php';
session_start();
class dbUsers{
  private $total_records, $limit = 5;
  private $nodata = "No data found";
  //Database connection function
  public function database() {
    $dbObject= new dbConnect();
    $conn = $dbObject->dataBase();
    return $conn;
  }

  //function to for registering users in the system
  public function UserRegister($lastname, $firstname, $email, $password, $profile_image, $gender, $designation) { 
    $conn = $this->database();  
    $password = password_hash($password, PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users(last_name, first_name, email, password, profile_image, gender, designation, time_stamp) 
      VALUES(?, ?, ?, ?, ?, ?, ?, NOW())"); 
    $insert->bind_param('sssssss', $lastname, $firstname, $email, $password, $profile_image, $gender, $designation);
    $insert->execute();

    return $insert;
  }

  //insert address
  public function address($address_one, $city, $country, $zip, $user_email) {
    $conn = $this->database();
    $insert_address = $conn->prepare("INSERT INTO address(address_one, city, country, zip_code, user_email)
     VALUES(?, ?, ?, ?, ?)");
    $insert_address->bind_param('sssss', $address_one, $city, $country, $zip, $user_email);
    $insert_address->execute();
    return $insert_address;
  }

  //update address
  public function update_address($id, $address_one, $city, $country, $zip) {
    $conn = $this->database();
    $update_address = $conn->prepare("UPDATE address SET address_one = ?, city = ?, country = ?, zip_code = ? WHERE address_id = ?");
    $update_address->bind_param('sssss', $address_one, $city, $country, $zip, $id);
    $update_address->execute();
    return $update_address;
  }

  //admin login
  public function adminLogin($email, $password) {
    $conn = $this->database();
    $query =$conn->prepare ("SELECT id, last_name, first_name, email, profile_image, type, status, password FROM users
      WHERE email= ? AND status = 'active'");
    $query->bind_param('s', $email);
    $query->execute();
    $query->store_result();
    $query->bind_result($userid, $lastname, $firstname, $email_db, $profile_image, $type, $status, $password_db);
    
    //if true set session
    if ($query->num_rows == 1) {
      //fetch data
      $query->fetch(); 
      //verify input password against database password
      if(password_verify($password, $password_db)) {
      $_SESSION['loggedin'] = true;
      $_SESSION['id'] = $userid;
      $_SESSION['first_name'] = $firstname;
      $_SESSION['last_name'] = $lastname;
      $_SESSION['email'] = $email_db;
      $_SESSION['type'] = $type;
      $_SESSION['profile'] = $profile_image;
      $_SESSION['userid'] = $status;
      $_SESSION['userid'] = $userid;
      return $firstname;

      } else {
        $_SESSION = [];
        session_destroy();
      }
    } else {
      $_SESSION = [];
      session_destroy();
      return false;
    }
  }
  

  //funtion to allow user to login into the sysytem
  public function Login($email, $password) {
    $conn = $this->database();
    $query =$conn->prepare ("SELECT id, last_name, first_name, email, profile_image, type, status, password FROM users
      WHERE email= ?  AND status = 'active'");
    $query->bind_param('s', $email);
    $query->execute();
    $query->store_result();
    $query->bind_result($userid, $lastname, $firstname, $email_db, $profile_image, $type, $status, $password_db);
    
    //if true set session
    if ($query->num_rows == 1) {
      //fetch data
      $query->fetch(); 
      //verify input password against database password
      if(password_verify($password, $password_db)) {
      $_SESSION['loggedin'] = true;
      $_SESSION['id'] = $userid;
      $_SESSION['first_name'] = $firstname;
      $_SESSION['last_name'] = $lastname;
      $_SESSION['email'] = $email_db;
      $_SESSION['type'] = $type;
      $_SESSION['profile'] = $profile_image;
      $_SESSION['userid'] = $status;
      $_SESSION['userid'] = $userid;
      return $firstname;
      } else {
        $_SESSION = [];
        session_destroy();
      }
    } else {
      $_SESSION = [];
      session_destroy();
      return false;
    }
  }

  //get user password for editing
  public function editPassword($id, $password) {
    $conn = $this->database();
    $query =$conn->prepare ("SELECT id, password FROM users
      WHERE id= ?");
    $query->bind_param('s', $id);
    $query->execute();
    $query->store_result();
    $query->bind_result($userid, $password_db);
    //check if requested data is available
    if ($query->num_rows == 1) {
      //fetch data
      $query->fetch();
      //verify passwords
      if(password_verify($password, $password_db)) {
        return true; 
      }    
    }
  }

  //verify if token exist
  public function verify_token($token) {
    $conn = $this->database();
    $query = $conn->prepare("SELECT * FROM users WHERE user_token = ? ");
    $query->bind_param('s', $token);
    $query->execute();
    $result = $query->get_result();
    $count = $result->num_rows;
    if($count == 1) {
      return true;
    } 
  }

  //update password
  public function updatePassword($user_token, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $conn = $this->database();
    $query = $conn->prepare("UPDATE users SET password = ? WHERE user_token = ?");
    $query->bind_param('ss', $hashed_password, $user_token);
    $query->execute();
    return $query;
  }

  //update token
  public function updateToken($id, $token) {
    $conn = $this->database();
    $query = $conn->prepare("UPDATE users SET user_token = ? WHERE id = ?");
    $query->bind_param('ss', $token, $id);
    $query->execute();
    return $query;
  }

  //function to check if the user already exist in the database
  public function isUserExist($email) {
    $db = new dbConnect();
    $conn = $this->database();
    $query = $conn->prepare("SELECT * FROM users WHERE email = ? ");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();
    $count = $result->num_rows;
    if($count == 1) {
      return true;
    } 
  }

   //function to check if the user already exist in the database
   public function UserExist($email) {
    $db = new dbConnect();
    $conn = $this->database();
    $query = $conn->prepare("SELECT * FROM users WHERE email = ? ");
    $query->bind_param('s', $email);
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

  //extract email for newsletter distribution
  public function email() {
    $conn = $this->database();
    $query = $conn->prepare("SELECT * FROM email");
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

  //get current page
  public function current_page() {
    return isset($_GET['page']) ? (int)$_GET['page'] :1;
  }
  
  //retrieve total number users
  public function set_total_records() {
    $conn = $this->database();
    $query = $conn->prepare("SELECT id FROM users");
    $query->execute();
    $query->store_result();
    $result = $query->num_rows; 
      if ($result > 0) { 
        return $result;
      }
  }

 
  //get data and limit the number of rows per page
  public function get_data() {
    //call database function
    $conn = $this->dataBase();
    $start = 0;
    if($this->current_page() > 1) {
      $start = ($this->current_page() * $this->limit) - $this->limit;
    }

    $query = $conn->prepare("SELECT id, CONCAT(first_name, ' ', last_name) AS 'fullname', email FROM users ORDER BY time_stamp DESC LIMIT $start, $this->limit");
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

  //calculate total number of pages in relation to number of records per page
  public function get_pagination_number() {
    $total_records = $this->set_total_records();
    return ceil($total_records / $this->limit);
  }
//get next page
  public function next_page() {
    return ($this->current_page() < $this->get_pagination_number()) ? $this->current_page()+1 : $this->get_pagination_number();
  }
  
  //if current page disable it link
  public function prev_page() {
    return ($this->current_page() > 1) ? $this->current_page() - 1 : 1;
  }

  


  //fetch all users
  public function fetchUsers($id) {
    $conn = $this->dataBase();
    $query = $conn->prepare("SELECT u.id, ad.address_id, u.last_name, u.first_name, u.email, u.gender, u.type, u.profile_image, u.contact, u.designation, u.status, ad.address_one, ad.city, ad.country, ad.zip_code, ad.user_email FROM users AS u JOIN address AS ad ON u.email = ad.user_email WHERE u.id = ?");
    $query->bind_param('s', $id);
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

  //fetch all authors
  public function article_authors($author) {
    $conn = $this->database();
    $query = $conn->prepare("SELECT u.id, u.last_name, u.first_name, u.email, u.gender, u.type, u.profile_image, u.contact, u.designation, u.status, ad.address_one, ad.city, ad.country, ad.zip_code, ad.user_email FROM users AS u JOIN address AS ad ON u.email = ad.user_email WHERE u.email = ?");
    $query->bind_param('s', $author);
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

  //display users with edit or delete link
  public function displayEdit($id) {
    $conn = $this->database();
    $query = $conn->prepare("SELECT id, first_name, last_name, email, password, confirm_password, mobile, designation, status FROM users WHERE id = ?");
    $query->bind_param('s', $id);
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

  //update users
  public function updateUsers($id, $lastname, $firstname, $email, $profile_image, $gender, $telephone, $designation,$status, $type) {
    $conn = $this->database();
    $query = $conn->prepare("UPDATE users SET last_name = ?, first_name = ?, email = ?, profile_image =?, gender = ?, contact = ?, designation = ?, status = ?, type = ? WHERE id = ?");
    $query->bind_param('ssssssssss', $lastname, $firstname, $email, $profile_image, $gender, $telephone, $designation, $status, $type, $id);
    $query->execute();
    return $query;
  }

  //edit profile
  public function editProfile($id, $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation) {
    $conn = $this->database();
    $query = $conn->prepare("UPDATE users SET last_name = ?, first_name = ?, email = ?, profile_image =?, gender = ?, contact = ?, designation = ? WHERE id = ?");
    $query->bind_param('ssssssss', $lastname, $firstname, $email, $profile_image, $gender, $contact, $designation, $id);
    $query->execute();
    return $query;
  }

  //delete user from the database
  public function deleteUser($id) {
    $conn = $this->database();
    $query = $conn->prepare("DELETE FROM users WHERE id = ?");
    $query->bind_param('s', $id);
    $query->execute();
    return $query;
  }

  //check user status
  public function checkStatus($id) {
    $conn = $this->database();
    $activate = $conn->prepare("SELECT * from users where id = ?");
    $activate->bind_param("s", $id);
    $activate->execute();
    $result = $activate->get_result();
    if ($result->num_rows > 0 ) {
      while ($row = $result->fetch_assoc()){
        $data[] = $row;
      }
      return $data; 
    } else {
      return $this->nodata;
    }
  }

  //activate user through email
  public function activateUser($id) {
    $conn = $this->database();
    $update = $conn->prepare("UPDATE users SET  status =  'active' WHERE id = ?");
    $update->bind_param("s", $id);
    $update->execute();
    return $update;
  }
}
?>
