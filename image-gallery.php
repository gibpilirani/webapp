
<?php
session_start();
include_once('functions/dbFunction.php');
 include_once('functions/dbArticles.php');
 include_once('functions/dbImage.php');

 $getImages = new dbImage();
 $images = $getImages->queryImage();
 ?>
 <!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
 <div class="container">
<div class="content home">
	<h5 class="font-weight-bold mt-4">Photo Gallery</h5>
    <hr class="line mb-3">
	<p>Welcome to the gallery page, you can view the list of images below.</p>
	<?php if( isset($_SESSION['loggedin']) && $_SESSION['type'] == 'admin' ) {?>


	<a href="uploadimage.php" class="upload-image">Upload Image</a>
	<?php } ?>
	<div class="row images mb-5">
		<?php foreach ($images as $image){ ?>
	
			<a href="#" class="image-link mb-2 ml-2">
		<div class="thumbnail text-center">
        <img src="gallery/<?php echo $image['path'];?>" alt="<?php echo $image['description'];?>" class="img-responsive" style="width: 100%;
    height: 100%;
    object-fit: cover;" data-id="<?php echo $image['id'];?>" data-title="<?php echo $image['title'];?>">
        <div class="caption">
            <p class="description"><?php //echo $image['description'];?></p>
        </div>
    </div>
	</a>
		<?php } ?>
	
	</div>
</div>
<div class="image-popup"></div>
</div>
<?php include_once("footer.php");?>
<script>
// Container we'll use to show an image
let image_popup = document.querySelector('.image-popup');
// Loop each image so we can add the on click event
document.querySelectorAll('.images a').forEach(img_link => {
	img_link.onclick = e => {
		e.preventDefault();
		let img_meta = img_link.querySelector('img');
		
		let img = new Image();
		img.onload = () => {
			// Create the pop out image
			image_popup.innerHTML = `
			
				<div class="con container mb-2 mt-5 col-md-8 row justify-content-center">
					<h3 class="font-weight-bold">${img_meta.dataset.title}</h3>
					<?php if( isset($_SESSION['loggedin']) && $_SESSION['type'] == 'admin' ) {      
   					?>
					<span class="row ml-1">
   					<span><a href="editImage.php?edit_id=${img_meta.dataset.id}" title="click for edit" onclick="return confirm('Are sure to edit ?')" class="edit">Edit</a></span> &nbsp;
						<span><a href="delete-image.php?id=${img_meta.dataset.id}" onclick="return confirm('Are sure you want to delete this image?')" class="edit">Delete</a></span> &nbsp;
					</span>
					<?php }?>
					<span>${img_meta.alt}</span>
					<img class="image-description img-fluid" src="${img.src}">
				</div>
			`;
			image_popup.style.display = 'flex';
		};
		img.src = img_meta.src;
	};
});
// Hide the image popup container if user clicks outside the image
image_popup.onclick = e => {
	if (e.target.className == 'image-popup') {
		image_popup.style.display = "none";
	}
};
</script>
<script type="text/javascript">
        $(".delete").on('click', function(){
					alert("Hellow world");
            var id = $(this).data("id");
            if(confirm('Are you sure to delete this record ?')) {
                $.ajax({
                    url: 'delete-image.php',
                    type: 'GET',
                    data: {id: id},
                    error: function() {
                      alert('Something is wrong, couldn\'t delete record');
                    },
                    success: function(data) {
                        $("#" + id).remove();
                        alert("Record delete successfully.");  
                    }
                });
            }
        });
    </script>
    <!-- <script type="text/javascript">
    	function deleteAjax(id) {
    		if(confirm('Are you sure?')) {
    			$.ajax({
    				type: 'post',
    				url: 'image-delete.php',
    				data: {dele_id:id}, 
    				success: function(data) {

    				}
    			})
    		}
    	}
    </script> -->

    
</body>
</html>
