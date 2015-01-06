<?php require('includes/header.php'); 
$post_id = $_GET['theme_id'];
?>	
		
		<main id="content">

	<?php //get the titles of all themes
		$query = "SELECT * FROM themes";
		
		//run it
		$result = $db->query($query);	
		
		if($result->num_rows >= 1){	
	 ?>
		<h2>Themes</h2>
		<ul id="roomlist">
			<li><a href="themes.php">All Themes</a></li>
		<?php //loop it 
			while( $row = $result->fetch_assoc() ){ ?>

				<li>
					<a href="themes.php?theme_id=<?php echo $row['theme_id'];?>">
						<?php echo $row['name'] ?>
					</a>
				</li>

			<?php }//end while
					?>
		</ul>
	

	<?php }//END IF ?>

	
<!-- FILTER CODE -->
<div id="wrap">
<?php
	if( $post_id > 0 ){
 //get all the published posts with matching theme_id
		$query = "SELECT posts.post_id, posts.date, posts.title, posts.thumb_img, themes.name AS theme, rooms.name AS room, users.user_id
					  FROM posts, themes, rooms, users
					  WHERE users.user_id = posts.user_id
					  AND posts.theme_id = themes.theme_id
					  AND posts.room_id = rooms.room_id
					  AND posts.theme_id = $post_id /*this is where it matches*/
					  ORDER BY posts.date DESC 
					  "; 

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

								 <img src="<?php echo $row['thumb_img']?>" alt="thumbimage"> 

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
			}//end if result 
			elseif($result->num_rows == 0){
				echo 'Sorry, no posts to show';
			} //end elseif//end if rows
			
		}
			else{//end if

		 ?> 
</div>

<?php //get all the published posts, most recent first

		$query = "SELECT posts.post_id, posts.date, posts.title, posts.thumb_img, themes.name AS theme, rooms.name AS room
					  FROM posts, themes, rooms, users
					  WHERE users.user_id = posts.user_id
					  AND posts.theme_id = themes.theme_id
					  AND posts.room_id = rooms.room_id
					  ORDER BY posts.date DESC 
					  "; 

	//Run the query. hold onto the results in a variable
		$result = $db->query( $query );		
		//check to see if one or more rows were found
		if( $result->num_rows >= 1 ){ 
			while( $row = $result->fetch_assoc() ){
		?>		


	<section id="rooms">
		<figure class="post">
			<a href="single_post.php?post_id=<?php echo $row['post_id'];?>">
				<div class="uploadfeed">

					 <img src="<?php echo $row['thumb_img']?>" alt="thumbimage"> 

					 <br>
					 <?php echo $row['title'] ?> <br>
					 <?php echo $row['room'] ?> | 
					 <?php echo $row['theme'] ?> <br>
					 <?php echo $row['date'] ?>

					</div>
				</a>

		</figure>
	</section>

		</main>
<?php  } //end while loop
			}//end if rows
		
		}




include('includes/footer.php');
		 ?> 
