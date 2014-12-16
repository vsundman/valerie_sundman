<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cute Cottage</title>

		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body>
		<header id="banner">
			<h1><a href="index.php">Cute Cottage</a></h1>
			<nav id="logout">
				<ul>
					<li class="dhome"><a href="index.php">Home</a></li>
					<li class="dabout"><a href="#">About Us</a></li>
					<li class="drooms"><a href="#">Rooms</a></li>
					<li class="dthemes"><a href="#">Themes</a></li>
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


