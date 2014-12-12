<?php require('includes/header.php'); 
//search configuration
$per_page = 2;
$page_number = 1; //default current starting page

?>

<main id="content"> 

	<?php 
		$phrase = $_GET['phrase'];

		//look up all the published posts that have that phrase in the title or body
		$query = "SELECT title, body, post_id
				  FROM posts
				  WHERE is_published = 1
				  AND ( title LIKE '%" . $phrase ."%'
				  OR body LIKE '%". $phrase . "%')
				";

		//run it
		$result = $db->query($query);
		//check to see if results were found
		if( $result->num_rows >= 1  ){
			$totalposts = $result->num_rows;

		//pagination calculations
			//how many pages do we need? the ceil function is used to round up
			$max_page = ceil($totalposts / $per_page);
			//check to see if the page the user is viewing is within the max number of pages
			if( $_GET['page'] ){
				$page_number = $_GET['page'];
			}
			if( $page_number <= $max_page ){
				//add a limit to the original query
				$offset = ( $page_number - 1) * $per_page;

				$query_modified = $query . " LIMIT $offset, $per_page";
				//run the modified query (you need a modified query because the first query is to get how many posts we will have then you modify it to limit it per page)
				$result_modified = $db->query($query_modified);
	?>


	<h1>Search Results</h1>
	<p class="success message">
		<?php echo $totalposts; ?> results found for <?php echo $phrase; ?>.
		Showing page <?php echo $page_number ?> of <?php echo $max_page ?>.
	</p>

	<section class="search-results">
		<?php while( $row = $result_modified->fetch_assoc() ){ ?>

			<article>
				<h1><a href="single.php?post_id=<?php echo $row['post_id']; ?>">
					<?php echo $row['title']; ?>
					</a>
				</h1>
				<p>
					<?php echo $row['body']; ?>
				</p>
			</article>

		<?php }//end while loop ?>

	</section>
	<?php
		$prev_page = $page_number - 1;
		$next_page = $page_number + 1;
	?>

	<section class="pagination">
		<?php
			//only show PREV button if on a page higher than 1
			if( $page_number > 1 ){ 
		?>
			<a href="?phrase=<?php echo $phrase?>&amp;page=<?php echo $prev_page ?>">Previous</a>
		<?php }//end if higher than 1
		?>

		<?php
			//only show next button if not on the last page
			 if( $page_number < $max_page  ){ 
		?>
			<a href="?phrase=<?php echo $phrase?>&amp;page=<?php echo $next_page ?>">Next</a>
		<?php }//end if last page ?>

	</section>
	<?php 
		}//end if on valid page
	}//end if results found 
	else{
		echo 'Sorry, no posts found';
	}
	?>
</main>






<?php include('includes/sidebar.php'); ?>
<?php include('includes/footer.php'); ?>