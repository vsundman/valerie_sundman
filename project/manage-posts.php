<?php require('includes/header.php'); 
	require('includes/security-check.php');
?>

<main>
	<section>
		<h2>Manage Your Posts</h2>

		<?php 
		//get all the posts by the logged in user, newest first
		$query = "SELECT post_id, title, image, room_id AS room, theme_id AS theme
					FROM posts
					WHERE user_id = $user_id
					ORDER BY date DESC";

		$result = $db->query($query);
		if($result->num_rows >= 1){
		
 while( $row = $result->fetch_assoc() ){ 
		?>
			
				<figure class="post">
					
					<a href="edit-post.php?post_id=<?php echo $row['post_id']; ?>">
						<div class="uploadfeed">
							 <?php echo $row['image']?>  <br>
							 <?php echo $row['title'] ?> <br>
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