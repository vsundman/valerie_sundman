<?php 
require('includes/header.php');
?>

<?php echo $message ?>
	<h2 class="up">Log In Form</h2>
<!--Register Form -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginreg">
		
		<label>Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username;?>">		
		<label>Password:</label>
		<input type="password" name="password" id="password">
		
		<input type="submit" value="Log In">
		<input type="hidden" name="did_login" value="true">
	</form>



	<?php include('includes/footer.php'); ?>