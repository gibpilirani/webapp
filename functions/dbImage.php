<?php
require_once 'dbConnect.php';
require_once('dbFunction.php');
class dbImage{

	public function database() {
		$db = new dbConnect();
		$db = $db->dataBase();
		return $db;
	}

	//insert images 
	public function insertImage($title, $description, $image_path) {
	  $conn = $this->database();
		// Insert image info into the database (title, description, image path, and date added)
		$insert_image = $conn->prepare("INSERT INTO images(title, description, path) VALUES (?, ?, ?)");
		$insert_image->bind_param('sss', $title, $description, $image_path);
		$insert_image->execute();

		return $insert_image;
	}

	//query images
	public function queryImage() {
		$conn = $this->database();
		$select_image = $conn->prepare("SELECT * FROM images ORDER BY uploaded_date DESC");

		$select_image->execute();
	    $result = $select_image->get_result();
	    while ($row = $result->fetch_assoc()){
	      $data[] = $row;
	    }
	   return $data; 
  }

  //query images for editing
	public function queryImageEdit($id) {
		$conn = $this->database();
		$select_image = $conn->prepare("SELECT * FROM images WHERE id = ?");
		$select_image->bind_param('s', $id);
		$select_image->execute();
	    $result = $select_image->get_result();
	    while ($row = $result->fetch_assoc()){
	      $data[] = $row;
	    }
	   return $data; 
  }


	//query an image for deletion
	public function queryForDeletion($id) {
		$conn = $this->database();
		$query = $conn->prepare("SELECT * FROM images WHERE id= ?");
		$query->bind_param('s', $id);
		$query->execute();
		$result = $query->get_result();
		while ($row = $result->fetch_assoc()){
			$data[] = $row;
		}
		return $data;
	}

	//update an image
	public function updateImage($id, $title, $description, $path) {
		//pdateImage($id, $title, $description, $path)
		$conn = $this->database();
		$update_image = $conn->prepare("UPDATE images SET title = ?, description = ?, path = ? WHERE id =?");
		$update_image->bind_param('ssss', $title, $description, $path, $id);
		$update_image->execute();
		return $update_image;
	}

	//delete image
	public function deleteImage($id) {
		$conn = $this->database();
		$delete =$conn->prepare("DELETE FROM images WHERE id = ?");
		$delete->bind_param('s', $id);
		$delete->execute();
	  return $delete;
	}
}