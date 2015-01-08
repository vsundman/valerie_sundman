<?php 

//which post are we editing?
$post_id = $_GET['post_id'];


require('includes/header.php'); 
require('includes/security-check.php');
//IMAGE UPLOADER
include('includes/post-update-upload-parser.php');	



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


	<h2 class="up">Edit Post</h2>

	<?php echo $message?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?post_id=<?php echo $post_id ?>" method="post" id="uploads"enctype="multipart/form-data" >
		
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" value="<?php echo $row_post['title'];?>">


		
			<img src="<?php echo uploaded_image_path( $row_post['image_key'], 'thumb_img', false); ?>">
		
		<label for="image">Image:</label>
		<input type="file" name="uploadedfile" id="image">
			<p>This is the Image you have on file</p>

<fieldset>
			<h2 class="up">Room:</h2>

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






		<label for="description">Description:</label>
		<textarea name="description" id="description"><?php echo $row_post['description']; ?></textarea>

		

	
		<input type="submit" value="Save Post">

		<input type="hidden" name="did_post" value="1">

	</form>
	
	<?php }else{
		echo 'You cannot edit posts you didn\'t write';
		} ?>


</main>
<?php include('includes/footer.php'); ?>