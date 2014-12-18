<?php 
	session_start(); //to access global variables ex. $_SESSION
	//connect to DB
require('includes/config.php');
//include the helper functions
include_once('includes/functions.php');

//LOGOUT!!!! So that my nav can change

	if( $_GET['action'] == 'logout' ){
		//remove all session_id cookie from the user's computer
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}
		//close the session on the server
		session_destroy();
		unset( $_SESSION['loggedin'] );
		//set cookies to null
		setcookie( 'loggedin', '' );

		unset($_SESSION['user_id']);
		setcookie('user_id', '');


	//check to see if the cookie is still valid, if so, re-build the session
	}elseif( $_COOKIE['loggedin'] == true ){
		//TO DO: fix this security loophole
		$_SESSION['loggedin'] = true;
		$_SESSION['user_id'] = $_COOKIE['user_id'];
		
	}//end elseif 



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cute Cottage</title>

		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<!-- This link allows feed readers and apps to find our rss file -->
		<link rel="alternate" type="application/rss+xml" href="rss.php">

	</head>
	<body>
		<header id="banner">
			<h1><a href="index.php">Cute Cottage</a></h1>

			<form action="search.php" method="get" id="searchform">
				<input type="search" name="phrase" id="phrase" value="<?php echo $_GET['phrase'] ?>">
				<input type="submit" value="Search">
			</form>
			
			<nav id="logout">
				<ul>
					<li class="dhome"><a href="index.php">Home</a></li>
					<li class="dabout"><a href="about.php">About Us</a></li>
					<li class="drooms"><a href="rooms.php">Rooms</a></li>
					<li class="dthemes"><a href="themes.php">Themes</a></li>
						<!--change to profile and logout-->
						<?php 
						//if the user is logged in show Profile link
						if( true == $_SESSION['loggedin'] ){
							
							?>
							<!-- HTML STUFF -->
					<li class="dlogin"><a href="profile.php">Profile</a></li>

					<li class="dsignup"><a href="login.php?action=logout">Log Out</a></li>


							<?php
						}else{ //show log in link
														
							?>
							<!-- HTML STUFF -->
					<li class="dlogin"><a href="login.php">Log In</a></li>

					<li class="dsignup"><a href="signup.php">Sign Up</a></li>

							<?php
						}?>






				</ul>
			</nav> 

		</header>
<body>

