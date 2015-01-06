<?php
require('includes/header.php'); 
//figure out which post to display based on the query string like ?post_id=X
$post_id = $_GET['post_id'];

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

	<h2><?php echo $row['title'];?> </h2>
	<h3>By: <?php echo $row['username'];?></h3>
		
		<section id="newest">
					<figure class="post">

					<div class="singlepost">
						  <img src="<?php echo $row['image_key']?>" alt="largeimage">  

						 <br>
						 <?php echo $row['title'] ?> <br>
						 <?php echo $row['room'] ?> | 
						 <?php echo $row['theme'] ?> <br>
						 <?php echo $row['date'] ?>
						 <br><br>
						 <?php echo $row['description'] ?>
 
					</div>
	
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

	<?php include('includes/footer.php'); ?>	



