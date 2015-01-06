<?php require('includes/header.php'); ?>	


		<main id="content">
				<div id="wrapper">
					<h2>Thank you for visiting us!</h2>
					<p>Kitten Ipsum smile neighbors mix leap leap Baxter norwegian forest cat, cat 9 lives loves love this cat psycho skeptical. Craig craig hiss boots here nina sleep on your keyboard cat, cute hot sleep in the sink friend siam new scratched loving cats cute she tabby roof lady grown long hair little. Trust drinks cats lady, eyes cat siamese cute cat cake day cold water. Eat spoon finally awesomeness terrified purses crosseyed kitten browsing kitties nina petting breeds claw. Love petting kitten around fluff he success catnip fuzzy waffles her warmer girlfriend. Smokey french she's cat his toys, making biscuits rip the couch siam reddit birdwatch face. Her box drinking kitties leap bat girlfriend cat meowlly Jinx 9th fun basket sits kat. Nina kitties sucked lady cat spoon slept whisker, persian fight baby Calvin basket toss the mousie years rescue cats size little nina gf's stowaway prrrrr.</p>


					<?php include( 'newest.php' ); ?>

				</div>


<?php //get all the published posts, most recent first
		$query = "SELECT posts.post_id, posts.weeklydecor, posts.date, posts.title, posts.thumb_img, themes.name AS theme, rooms.name AS room, users.username
					  FROM posts, themes, rooms, users
					  WHERE users.user_id = posts.user_id
					  AND posts.theme_id = themes.theme_id
					  AND posts.room_id = rooms.room_id
					  AND posts.weeklydecor = 1
					  LIMIT 1"; 

	//Run the query. hold onto the results in a variable
		$result = $db->query( $query );		
		//check to see if one or more rows were found
		if( $result->num_rows >= 1 ){ 
			while( $row = $result->fetch_assoc() ){
		?>		

			<aside id="sidebar">
			 	<h3>Decor of the Week</h3>
			 	<figure class="weeklydecor">
					
			 		<a href="single_post.php?post_id=<?php echo $row['post_id'];?>">
						<div>
							<img src="<?php echo $row['thumb_img']?>" alt="thumbimage"> <br>
							<h4><?php echo $row['title'] ?></h4>
							<p>By: <?php echo $row['username'] ?></p> 
							<p><?php echo $row['date'] ?></p>
							<p><?php echo $row['room'] ?> | <?php echo $row['theme'] ?> </p>
						
						</div>
 					</a>

				</figure>

				<h4>Is this a cute look?</h4>
				<div id="vote_yes">
					<img src="images/thumbup.png"/>
				</div>
				<div id="vote_no">
					 <img src="images/thumbdown.png"/>
				</div>

			 </aside>

		</main>

<?php } //end while loop
			}//end if rows
			else{
				echo 'Sorry, no posts to show';
			} //end else
		 ?> 


<?php include('includes/footer.php');?>