<?php require('includes/header.php'); 

	require('includes/security-check.php');

//parse the form if submitted
if( $_POST['did_post'] ){
	//sanitize the data
	$title = clean_input( $_POST['title'], $db );
	$description = clean_input( $_POST['description'], $db );
	$room = $_POST['room'];
	$theme =$_POST['theme'];

	//validate
	$valid = true;

	//did they leave title or description blank?
	if( strlen($title) == 0 OR strlen($description) == 0 ){
		$valid = false;
		$message[] = 'Please fill in all fields.';
	}

	//check for bad value in room or theme
	if( ! is_numeric($room) ){
		$valid = false;
		$message[] = 'invalid room.';
	}

	if( ! is_numeric($theme) ){
		$valid = false;
		$message[] = 'invalid theme.';
	}

	
	//add to database
	if($valid){
		$query_addpost = "INSERT INTO posts
						(title, description, user_id, room_id, theme_id, date)
						VALUES
					 	('$title', '$description', $user_id, $room, $theme, now())";
		$result_addpost = $db->query($query_addpost);
		//make sure it worked
		if( $db->affected_rows == 1 ){
			

			$message = 'Post successfully saved.';

		} //end if query worked
		else{
			$message = 'Something went wrong saving your post.';
		}
	} //end if valid
} //end parse
?>
<main>
	<h2>Upload</h2>

	<?php echo $message; ?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		
		<label for="title">Title:</label>
		<input type="text" name="title" id="title">

		<label for="image">Image:</label>
		<input type="file" name="img" id="image" accept="image/x-png, image/gif, image/jpeg">

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