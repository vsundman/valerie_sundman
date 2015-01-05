<?php 

//which post are we editing?
$post_id = $_GET['post_id'];

require('includes/header.php'); 
	require('includes/security-check.php');

//parse the form if submitted
if( $_POST['did_post'] ){
	//sanitize the data
	$title = clean_input( $_POST['title'], $db );
	$description = clean_input( $_POST['description'], $db );
	$room = $_POST['room'];
	$theme =$_POST['theme'];
	$image = 

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

/////////////////////////////////////////////////////////
	//edit this post in the database//
////////////////////////////////////////////////////////
	if($valid){
		$query_addpost = "UPDATE posts
						  SET title = '$title',
						  	  description = '$description',
						  	  theme_id = $theme,
						  	  room_id = $room
						  	  thumb_img = $image
						  	  /*--------------------------------------------------*/
						  	/*figure out if i need to add another one for large image*/






						  WHERE post_id = $post_id
						  LIMIT 1";

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


//Pre-fill the form with the current values, and check to make sure the logged in person wrote it
$query_post = "SELECT *
				FROM posts 
				WHERE user_id = $user_id
				AND post_id = $post_id
				LIMIT 1";
$result_post = $db->query($query_post);
?>

<main>

	<?php //make sure one post was found
			if($result_post->num_rows == 1){
			$row_post = $result_post->fetch_assoc();
	 ?>


	<h2>Edit Post</h2>

	<?php echo $message?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?post_id=<?php echo $post_id ?>" method="post" enctype="multipart/form-data">
		
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" value="<?php echo $row_post['title'];?>">

		<label for="image">Image:</label>
		<input type="file" name="uploadedfile" id="image">

		<label for="description">Description:</label>
		<textarea name="description" id="description"><?php echo $row_post['description']; ?></textarea>

		<fieldset>
			<h2>Room:</h2>

			<?php //get all the categories
			$query_cats = "SELECT * FROM rooms";
			$result_cats = $db->query($query_cats);
			if( $result_cats->num_rows >= 1 ){
				while( $row = $result_cats->fetch_assoc() ){ ?>
			<label>
				<input type="radio" name="room" value="<?php echo $row['room_id'] ?>" <?php echo $row_post['room_id'] == $row['room_id']? 'checked' : '' ; ?>>
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
				<input type="radio" name="theme" value="<?php echo $row['theme_id'] ?>" <?php echo $row_post['theme_id'] == $row['theme_id']? 'checked' : '' ; ?>>
				<?php echo $row['name'] ?>
			</label>
			<?php 
				}//end while
			}//end if cats found ?>
		</fieldset>

	
		<input type="submit" value="Save Post">

		<input type="hidden" name="did_post" value="1">

	</form>
	
	<?php }else{
		echo 'You cannot edit posts you didn\'t write';
		} ?>


</main>
<?php include('includes/footer.php'); ?>