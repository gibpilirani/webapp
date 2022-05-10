<?php
session_start();
?>
<?php
include_once('functions/dbFunction.php');
include_once('functions/dbImage.php');

 $getImages = new dbImage();

// Check that the poll ID exists
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $removeImages = $getImages->queryForDeletion($id);
      foreach ($removeImages as $removeImage) {
        echo $removeImage['id'];
        echo $removeImage['path'];
      }
      unlink("gallery/". $removeImage['path']);
    // Select the record that is going to be deleted
    $images = $getImages->deleteImage($id);
      if($removeImages) {
      header("Location: image-gallery.php");
    }else {
    exit('2');
    }
}
?>
