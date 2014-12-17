
<?php require('includes/header.php'); ?>
	


	<main id="content">
<?php //get all the published posts, most recent first
		$query = "SELECT posts.* , users.username, categories.title AS category
				  FROM posts, users, post_cats, categories 
				  WHERE is_published = 1
				  AND posts.user_id = users.user_id
				  AND posts.post_id = post_cats.post_id
				  AND categories.category_id = post_cats.category_id
				  GROUP BY categories.category_id
				  ORDER BY date DESC "; 
		//Run the query. hold onto the results in a variable
		$result = $db->query( $query );		
		//check to see if one or more rows were found
		if( $result->num_rows >= 1 ){ 
			while( $row = $result->fetch_assoc() ){
		?>		

		<article class="post">
			<h1><?php echo $row['title'] ?></h1>
			<div>By  <?php echo $row['username'] ?> | 
				<?php echo convert_date( $row['date'] ) ?> |
				In the category <?php echo $row['category'] ?>
			</div>

			<p><?php echo $row['body'] ?></p>
		</article>
	
		<?php } //end while loop
			}//end if rows
			else{
				echo 'Sorry, no posts to show';
			} //end else
		 ?> 
	</main>


		<?php include('includes/sidebar.php'); ?>

	


<?php include('includes/footer.php'); ?>

