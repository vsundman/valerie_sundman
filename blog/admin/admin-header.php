<?php 
	session_start();
//security check! Make sure the person viewing the page is Logged in
	if( $_SESSION['loggedin'] != true ){
		//kick them out to the login form
		header('Location:login.php');
		//stop this file from loading
		die('You do not have permission to view this page.');
	}
//connect to database
	require('../includes/config.php');
	include_once('../includes/functions.php');

//who is logged in? store in a var for easy use on admin pages
	$user_id = $_SESSION['user_id'];
	
?>

	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Blog Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="../css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-style.css">
	<!--                  FONTS                -->
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<!--                  FONTS                -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
</head>
<body>

	<header>
		<h1>Blog Admin Panel</h1>
		<nav>
			<ul>
				<li><a href="index.php">Dashboard</a></li>
				<li><a href="write-post.php">Write New Post</a></li>
				<li><a href="manage-posts.php">Manage Posts</a></li>
				<li><a href="#">Manage Comments</a></li>
				<li><a href="#">Edit Profile</a></li>
			</ul>	
		</nav>

		<ul class="utilities">
			<li><a href="../">View Blog</a></li>
			<li><a href="login.php?action=logout">Log Out</a></li>
		</ul>

		<?php user_badge($user_id, $db); ?>

	</header>

