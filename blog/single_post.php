<?php
//figure out which post to display based on the query string like ?post_id=X
$post_id = $_GET['post_id'];
 require('includes/header.php'); 
 include('includes/comment_parser.php') 

?>
<div id="wrap">
	<main id="content">
<?php //get all the published posts, most recent first
		$query = "SELECT posts.* , users.username, categories.title AS category
				  FROM posts, users, post_cats, categories 
				  WHERE is_published = 1
				  AND posts.user_id = users.user_id
				  AND posts.post_id = post_cats.post_id
				  AND categories.category_id = post_cats.category_id
				  AND posts.post_id = $post_id
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
		





		<?php 
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

						<div>
							on <?php echo convert_date( $row_comments['date'] ); ?> 
							<?php echo $row_comments['username']; ?> said:
							<p> <?php echo $row_comments['body']; ?> </p>
						</div>

					<?php 

				}//end while loop
			}else{
				echo 'This post has no comments, you can be the first!';
			}
		 ?>
		 <?php  //display a comment form if comments are allowed on this post
		 	if( $row['allow_comments'] == 1 ){
		 		//comment form
		 		include('includes/comment_form.php');
		 	}else{
		 		echo 'Comments closed.';
		 	}

		  ?>


		<?php } //end while loop
			}//end if rows
			else{
				echo 'Sorry, no posts to show';
			} //end else
		 ?> 

	</main>
</div>

		<?php include('includes/sidebar.php'); ?>


<?php include('includes/footer.php'); ?>
