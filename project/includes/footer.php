<footer id="foot">
			<nav id="footernav">
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

					<li class="drooms"><a href="privacy.php">Privacy Policy</a></li>
					<li class="dthemes"><a href="sitemap.php">Site Map</a></li>




				</ul>
			</nav> 
			<div class="copyright">&copy; 2014 Valerie Sundman</div>
		</footer>
	</body>
</html>