

<div id="wrap">
	<main id="content" class="newest">
		<h2>Newest Uploads</h2>
<?php //get all the published posts, most recent first
		$query = "SELECT posts.post_id, posts.date, posts.title, posts.image_key, themes.name AS theme, rooms.name AS room, 				users.username
					  FROM posts, themes, rooms, users
					  WHERE users.user_id = posts.user_id
					  AND posts.theme_id = themes.theme_id
					  AND posts.room_id = rooms.room_id
					  ORDER BY posts.date DESC 
					  LIMIT 6"; 

	//Run the query. hold onto the results in a variable
		$result = $db->query( $query );		
		//check to see if one or more rows were found
		if( $result->num_rows >= 1 ){ 
			while( $row = $result->fetch_assoc() ){
		?>		

		<section id="newest">
					<figure class="post">
						<a href="single_post.php?post_id=<?php echo $row['post_id'];?>">
							<div class="uploadfeed">
								
									<img src="<?php echo uploaded_image_path( $row['image_key'], 'thumb_img', false); ?>"> 
								

								 <br>
								 <?php echo $row['title'] ?> <br>
								 <?php echo $row['room'] ?> | 
								 <?php echo $row['theme'] ?> <br>
								 <?php echo $row['date'] ?>

	 						</div>
 						</a>

					</figure>
		</section>
		
		<?php } //end while loop
			}//end if rows
			else{
				echo 'Sorry, no posts to show';
			} //end else
		 ?> 

	</main>
</div>

	



