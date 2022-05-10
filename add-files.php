<?php
include_once('functions/dbArticles.php');
include_once('functions/dbConnect.php');

$upload = new dbArticles();
$response = array( 
  'status' => 0, 
  'message' => 'Form submission failed, please try again.' 
  );
if(isset($_POST["file-name"])) {
    $folder_path = 'pdf/';
    $filename = basename($_FILES['file']['name']);
    $type = $_FILES['file']['type'];
    $name = $_POST['file-name'];
    $newname = $folder_path . $filename;

    $FileType = pathinfo($newname,PATHINFO_EXTENSION);

    if($FileType == "pdf") {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $newname)) {
			$upload->pdf_upload($name, $filename, $type);
 
            if ($upload) {
            	$response['status'] = 1; 
    			$response['message'] = "File Uploaded successfuly and is pending approval"; 
            } else {
            	$response['status'] = 2; 
    			$response['message'] = "Something went Wrong";
            }
        } else {
        	$response['status'] = 3; 
    		$response['message'] = "Upload Failed.";
            exit("<p>Upload Failed.</p>");
        }
    } else {
    	$response['status'] = 4; 
    	$response['message'] = "File must be uploaded in PDF format.";
    }
}
echo json_encode($response);
?>