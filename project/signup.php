<?php 

require('includes/header.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign up as a commenter</title>
</head>
<body>
	<h1>Sign up as a commenter on my blog!</h1>



<?php 
//if there are errors, show them
	if( isset($errors) ){

		vs_array_list($errors);

	}

 ?>



<body>
	<h2 class="up">Sign Up Form</h2>
<!--Register Form -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginreg">
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

	<?php include('includes/footer.php');?>