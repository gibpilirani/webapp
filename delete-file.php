<?php
session_start();
?>
<?php
include_once('functions/dbFunction.php');
include_once('functions/dbArticles.php');

 $getFiles = new dbArticles();

// Check that the poll ID exists
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $removeFiles = $getFiles->selectFileToDelete($id);
      foreach ($removeFiles as $removeFile) {
        echo $removeFile['id'];
        echo $removeFile['file_path'];
      }
      //remove file from the web server
      unlink("pdf/". $removeFile['file_path']);
    //remove file path from the database
    $files = $getFiles->deleteFile($id);
      if($files) {
          echo "File deleted successfully";
      //header("Location: image-gallery.php");
    }else {
    echo "Such file name does not exist";
    } 
}
?>