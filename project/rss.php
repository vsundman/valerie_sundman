<?php 
//so the <? in the xml tag doesn't break php
echo '<?xml version="1.0" encoding="utf-8"?>';  
//connect to DB
require( 'includes/config.php' );
include_once( 'includes/functions.php' );
?>

<rss version="2.0">

	<channel>
		<title>Newest Uploads</title>
		<link>http://localhost/valerie_sundman/project/</link>
		
		<?php //get up to 6 most recent published posts
			$query = "SELECT posts.post_id, posts.date, posts.title, posts.image, themes.name AS theme, rooms.name AS room, users.username
					  FROM posts, themes, rooms, users
					  WHERE users.user_id = posts.user_id
					  AND posts.theme_id = themes.theme_id
					  AND posts.room_id = rooms.room_id
					  ORDER BY posts.date DESC 
					  LIMIT 6";   
			$result = $db->query($query);
			if( $result->num_rows >= 1 ){
				while( $row = $result->fetch_assoc() ){
		 ?>

		<item>
			<title><?php echo $row['title']; ?></title>

			<link>http://localhost/valerie_sundman/project/single_post.php?post_id=<?php echo $row['post_id']; ?> </link>

			<guid>http://localhost/valerie_sundman/project/single_post.php?post_id=<?php echo $row['post_id']; ?></guid> <!--same as link when the post id gets put in -->
			<!-- the CDATA lets you put images and weird stuff in your body without breaking the XML -->
			<author>  <?php echo $row['username']; ?></author>

			<description>
				<image><?php echo $row['image']; ?></image>

				<?php echo $row['room'];?> - <?php echo $row['theme'];?> 

			</description>



			<pubDate><?php echo convTimestamp($row['date']); ?></pubDate>
		</item>

		<?php 
				}//end while 
			}//endif 
		?>
	</channel>




</rss>