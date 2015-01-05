<?php require('includes/header.php');	

	require('includes/security-check.php');

 ?>

<header id="profilepage">
		<h2>Welcome! <?php echo $row['username']; ?></h2>
		<div class="userpic"><?php user_badge($user_id, $db); ?></div>
		<nav class="profilenav">
			<ul>
				<li><a href="upload-post.php">Upload New Post</a></li>
				<li><a href="manage-posts.php">Manage Posts</a></li>
				<li><a href="edit-profile.php">Edit Profile</a></li>
			</ul>	
		</nav>




	</header>









<?php include('includes/footer.php'); ?>	