<?php 
//so the <? in the xml tag doesn't break php
echo '<?xml version="1.0" encoding="utf-8"?>';  
//connect to DB
require( 'includes/config.php' );
include_once( 'includes/functions.php' );
?>
<rss version="2.0">
	<channel>
		<title>Valerie's Blog</title>
		<link>http://localhost/valerie_sundman/blog/</link>
		<description>A Demo of how RSS works</description>
		<?php //get up to 10 most recent published posts
			$query = "SELECT posts.post_id, posts.date, posts.title, posts.body, users.username, users.email
					  FROM posts, users
					  WHERE users.user_id = posts.user_id
					  AND posts.is_published = 1
					  ORDER BY posts.date DESC 
					  LIMIT 10";   
			$result = $db->query($query);
			if( $result->num_rows >= 1 ){
				while( $row = $result->fetch_assoc() ){

					  ?>
		<item>
			<title><?php echo $row['title']; ?></title>
			<link>http://localhost/valerie_sundman/blog/single_post.php?post_id=<?php echo $row['post_id']; ?></link>
			<guid>http://localhost/valerie_sundman/blog/single_post.php?post_id=<?php echo $row['post_id']; ?></guid> <!--same as link when the post id gets put in -->
			<!-- the CDATA lets you put images and weird stuff in your body without breaking the XML -->
			<description><![CDATA[ <?php echo htmlentities($row['body']);?> ]]></description>
			<author><?php echo $row['email']?> ( <?php echo $row['username']; ?> ); </author>
			<pubDate><?php echo convTimestamp($row['date']); ?></pubDate>
		</item>
		<?php 
				}//end while 
			}//endif 
		?>
	</channel>




</rss>