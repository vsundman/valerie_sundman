<?php
require('includes/header.php'); 

//figure out which post to display based on the query string like ?post_id=X
$post_id = $_GET['post_id'];


 include('includes/comment-parser.php'); 



?>

<div id="wrap">
	<main id="content" class="newest">
		
<?php //get all the published posts, most recent first
		$query = "SELECT users.username, title, description, date, posts.image_key, rooms.name AS room, themes.name AS theme
					  FROM users, posts, rooms, themes
					  WHERE users.user_id = posts.user_id
					  AND posts.theme_id = themes.theme_id
					  AND posts.room_id = rooms.room_id
					  AND post_id = $post_id
					  LIMIT 1"; 

	//Run the query. hold onto the results in a variable
		$result = $db->query( $query );		
		//check to see if one or more rows were found
		if( $result->num_rows >= 1 ){ 
			while( $row = $result->fetch_assoc() ){
		?>		


		
		<section id="newest">
			<figure class="post big">
				<h2><?php echo $row['title'];?> </h2>
				<h3>By: <?php echo $row['username'];?></h3>

				<div class="singlepost">
					  <img src="<?php echo uploaded_image_path( $row['image_key'], 'large_img', false); ?>">
					 <br>
					 <div class="info">
					 	 <h3>Room:</h3><p> <?php echo $row['room'] ?> </p><br>
						 <h3>Theme:</h3><p> <?php echo $row['theme'] ?> </p><br>
						 <p><?php echo $row['date'] ?></p><br>
						 <div class="description">
						 	<h3>Description:</h3><p> <?php echo $row['description'] ?></p>
						 </div>
					 </div>
		
		
<?php 
//////////////        COMMENTS SECTION        ///////////////////////////////////////
		//get the comments for this post, if there are any to show
			$query_comments = "SELECT comments.date, comments.body, users.username
								FROM comments, users
								WHERE comments.post_id = $post_id
								AND comments.user_id = users.user_id
								ORDER BY date DESC";
		//run it
			$result_comments = $db->query($query_comments);
		//check it to make sure at least one comment found
			if( $result_comments->num_rows >= 1 ){
				while( $row_comments = $result_comments->fetch_assoc() ){
					?>


						<div class="comm2">
							on <?php echo convert_date( $row_comments['date'] ); ?> 
							<?php echo $row_comments['username']; ?> said:
							<p> <?php echo $row_comments['body']; ?> </p>
						</div>




					<?php 

				}//end while loop
			}else{
				echo '<p class="nocomm">This post has no comments, you can be the first!</p>';
			}

			include('includes/comment-form.php');
		
	 } //end while loop
			}//end if rows
			else{
				echo 'Sorry, no posts to show';
			} //end else
		 ?> 
		</div>

			</figure>
		</section>
	</main>
</div>

	<?php include('includes/footer.php'); ?>	



