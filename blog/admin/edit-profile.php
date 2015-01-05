<?php require('admin-header.php');?>
<main>
	<h1>Edit Your Userpic</h1>

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

<?php require('admin-footer.php');?>