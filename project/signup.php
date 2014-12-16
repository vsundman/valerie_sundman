<?php 
	require('includes/header.php');
?>



<body>

<!--Register Form -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label>Email Address:</label>
		<input type="email" name="email" id="email" value="<?php echo $email;?>">

		<label>Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username;?>">		
		<label>Password:</label>
		<input type="password" name="password" id="password">
		
		<label>
			<input type="checkbox" name="policy" value="1" id="policy" <?php 
						if($policy){echo 'checked';} ?> >
				I have read the <a href="#">Privacy Policy</a>
		</label>

		<input type="submit" value="Sign Up">
		<input type="hidden" name="did_register" value="true">
	</form>