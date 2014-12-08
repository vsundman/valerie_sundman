
<aside id="sidebar">

	<?php 
	//get the title and post_id of the latest 5 published posts 
	$query_latest = "SELECT title, post_id
					 FROM posts 
					 WHERE is_published = 1
					 ORDER BY date DESC
					 LIMIT 5 ";
	//run it
	$result_latest = $db->query($query_latest);
	//check to see if any posts were found
	if( $result_latest->num_rows >= 1){
	?>
	<section>
		<h1>Latest Posts</h1>

		<ul>
			<?php while( $row_latest = $result_latest->fetch_assoc() ){ ?>
				<li><a href="single_post.php?post_id=<?php 
						echo $row_latest['post_id'] ?>">
						<?php echo $row_latest['title'] ?>
					</a>
				</li>
			<?php } ?>
		</ul>
	</section>
	<?php } //end if posts found ?>


	<?php //get the titles of all categories in alpha order
	$query_cats = "SELECT title FROM categories
					ORDER BY RAND()";
	//run it
	$result_cats = $db->query($query_cats);	
	
	//check it
	if($result_cats->num_rows >= 1){	
	 ?>
	<section>
		<h1>Categories</h1>

		<ul>
			<?php //loop it 
			while( $row_cats = $result_cats->fetch_assoc() ){ ?>
			<li><a href="#"><?php echo $row_cats['title'] ?></a></li>
			<?php } ?>
		</ul>
	</section>
	<?php } ?>





	<?php //get the titles of all categories in alpha order
	$query_links = "SELECT title, url FROM links
					ORDER BY RAND()";
	//run it
	$result_links = $db->query($query_links);	
	
	//check it
	if($result_links->num_rows >= 1){	
	 ?>
	<section>
		<h1>Links</h1>

		<ul>
			<?php //loop it 
			while( $row_links = $result_links->fetch_assoc() ){ ?>
			<li><a href="<?php echo $row_links['url'] ?>"><?php echo $row_links['title'] ?></a></li>
			<?php } ?>
		</ul>
	</section>
	<?php } ?>

</aside>
