<?php require('includes/header.php'); 
	require('includes/security-check.php');
?>

<main id="main">
	<section>
		<h2>Manage Your Posts</h2>

		<?php 
		//get all the posts by the logged in user, newest first
			$query = "SELECT posts.post_id, posts.date, posts.title, posts.image_key, themes.name AS theme, rooms.name AS room
					  FROM posts, themes, rooms
					  WHERE posts.user_id = $user_id
					  AND posts.theme_id = themes.theme_id
					  AND posts.room_id = rooms.room_id
					  ORDER BY posts.date DESC ";

		$result = $db->query($query);
		if($result->num_rows >= 1){
		
 while( $row = $result->fetch_assoc() ){ 
		?>

			
				<figure class="post">
					
					<a href="edit-post.php?post_id=<?php echo $row['post_id']; ?>">
						<div class="uploadfeed">
							  	<img src="<?php echo uploaded_image_path( $row['image_key'], 'thumb_img', false); ?>">
								    <br>
							 <?php echo $row['title'] ?> <br>
							 <?php echo $row['date'] ?> <br>
							 <?php echo $row['room'] ?> | 
							 <?php echo $row['theme'] ?> <br>
						</div>
					</a>
				</figure>
	</section>

		<?php } //end while loop
			}//end if rows
			else{
				echo 'You have not written any posts yet.';
			} //end else
		 ?> 


</main>

<?php include('includes/footer.php'); ?>