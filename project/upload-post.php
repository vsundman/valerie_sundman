<?php require('includes/header.php'); 

	require('includes/security-check.php');

	//IMAGE UPLOADER
	include('includes/post-upload-parser.php');

?>


<main id="main">
	<h2>Upload</h2>

	<?php echo $message; ?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
		
		<label for="title">Title:</label>
		<input type="text" name="title" id="title">

		<label for="image">Image:</label>
		<input type="file" name="uploadedfile" id="image">

		<label for="description">Description:</label>
		<textarea name="description" id="description"></textarea>

		<fieldset>
			<h2>Room:</h2>

			<?php //get all the categories
			$query_cats = "SELECT * FROM rooms";
			$result_cats = $db->query($query_cats);
			if( $result_cats->num_rows >= 1 ){
				while( $row = $result_cats->fetch_assoc() ){ ?>
			<label>
				<input type="radio" name="room" value="<?php echo $row['room_id'] ?>">
				<?php echo $row['name'] ?>
			</label>
			<?php 
				}//end while
			}//end if cats found ?>
		</fieldset>

	<fieldset>
			<h2>Theme:</h2>

			<?php //get all the categories
			$query_cats = "SELECT * FROM themes";
			$result_cats = $db->query($query_cats);
			if( $result_cats->num_rows >= 1 ){
				while( $row = $result_cats->fetch_assoc() ){ ?>
			<label>
				<input type="radio" name="theme" value="<?php echo $row['theme_id'] ?>">
				<?php echo $row['name'] ?>
			</label>
			<?php 
				}//end while
			}//end if cats found ?>
		</fieldset>

	
		<input type="submit" value="Save Post">

		<input type="hidden" name="did_post" value="1">

	</form>
	

</main>
<?php include('includes/footer.php'); ?>