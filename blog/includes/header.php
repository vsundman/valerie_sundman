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
<!-- This link allows feed readers and apps to find our rss file -->
<link rel="alternate" type="application/rss+xml" href="rss.php">

</head>
<body>
	
	<header id="banner">
		<h1>Valerie's Blog</h1>
	</header>
	<div id="wrapper">

	<form action="search.php" method="get" id="searchform">
		<input type="search" name="phrase" id="phrase" value="<?php echo $_GET['phrase'] ?>">
		<input type="submit" value="Search">
	</form>






	