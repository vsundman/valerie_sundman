<?php require('includes/header.php');	

	require('includes/security-check.php');

 ?>

<header>
		<h2>Welcome! <?php echo $row['username']; ?></h2>
		<?php user_badge($user_id, $db); ?>
		<nav>
			<ul>
				<li><a href="upload-post.php">Upload New Post</a></li>
				<li><a href="manage-posts.php">Manage Posts</a></li>
				<li><a href="edit-profile.php">Edit Profile</a></li>
			</ul>	
		</nav>




	</header>






THIS IS THE PROFILE PAGE


<?php include('includes/footer.php'); ?>	