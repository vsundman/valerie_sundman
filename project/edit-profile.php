<?php require('includes/header.php');
require('includes/security-check.php');
//IMAGE UPLOADER
	include('includes/upload-parser.php');?>

<main id="main">
	<h2>Edit Your Userpic</h2>
		<?php if ( isset($statusmsg) ){
		echo $statusmsg;
		} ?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" 
		  enctype="multipart/form-data">
		
		  <label>Choose a file:</label>
		  <input type="file" name="uploadedfile">

		  <input type="submit" value="Upload Image">
		  <input type="hidden" name="did_upload" value="true">

	</form>

</main>

<?php require('includes/footer.php');?>