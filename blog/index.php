	<?php 
	//connect to DB!
	require('includes/config.php'); 
	require_once('includes/functions.php'); ?>



	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demo PHP + MYSQL Blog</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">


<!--                  FONTS                -->
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<!--                  FONTS                -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>


</head>
<body>
	
	<header id="banner">
		<h1>Valerie's Blog</h1>
	</header>
	
	<main id="content">

	<?php //get all the published posts, most recent first
		$query = "SELECT * FROM posts 
				  WHERE is_published = 1 
				  ORDER BY date DESC ";
		//run the query. hold onto the results in a variable
		$result = $db->query( $query );
		//check to see if one or more rows were found
		if( $result->num_rows >= 1 ){ 
			while( $row = $result->fetch_assoc() ){

	 ?>

		<article class="post">
			<h1><?php echo $row['title'] ?></h1>
			<time><?php echo convert_date( $row['date'] ) ?></time>
			<p><?php echo $row['body'] ?></p>
		</article>
	
		<?php } //end while loop
			}//end if rows
			else{
				echo 'Sorry, no posts to show';
			} //end else
		 ?> 

	</main>

	<aside id="sidebar">This is the sidebar</aside>

	<footer id="colophon">&copy; 2014 Valerie Sundman</footer>
</body>
</html>