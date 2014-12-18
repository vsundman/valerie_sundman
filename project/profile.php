<?php require('includes/header.php');	

//security check! Make sure the person viewing the page is Logged in
	if( $_SESSION['loggedin'] != true ){
		//kick them out to the login form
		header('Location:login.php');
		//stop this file from loading
		die('You do not have permission to view this page.');
	}

//who is logged in? store in a var for easy use on profile pages
	$user_id = $_SESSION['user_id'];

	$query = "SELECT username
				FROM users 
				WHERE user_id = $user_id
				";
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$username = $row['username'];

 ?>

<header>
		<h2>Welcome! <?php echo $row['username']; ?></h2>
		<?php user_badge($user_id, $db); ?>
		<nav>
			<ul>
				<li><a href="write-post.php">Upload New Post</a></li>
				<li><a href="#">Manage Posts</a></li>
				<li><a href="#">Edit Profile</a></li>
			</ul>	
		</nav>




	</header>






THIS IS THE PROFILE PAGE


<?php include('includes/footer.php'); ?>	