<?php 
require('includes/header.php');



//parse the form if it was submited
if( $_POST['did_login'] == true ){
	//extract the user submitted data
	$username = clean_input( $_POST['username'], $db );
	$password = clean_input( $_POST['password'], $db );

	//hashed version of the password for DB comparison
	$hashed_password = sha1($password);

	//make sure the values are within the length limits
	if( strlen($username) < 50 
		AND 
		strlen($username) >= 3 
		AND 
		strlen($password) >= 8 ){

		//check to see if these credentials exist in the DB
		$query = "SELECT user_id
					FROM users
					WHERE username = '$username'
					AND password = '$hashed_password'
					LIMIT 1";
		$result = $db->query($query);

		//if they match, log them in
		if( $result->num_rows == 1 ){

			//TO DO: Make these cookies more secure

			//success! remember the user for 2 days
			setcookie('loggedin', true, time() + 60 * 60 * 24 * 2);
			$_SESSION['loggedin'] = true;

			//WHO is logged in?
			$row = $result->fetch_assoc();
			$user_id = $row['user_id'];

			setcookie( 'user_id', $user_id,  time() + 60 * 60 * 24 * 2 );
			$_SESSION['user_id'] = $user_id;

			//redirect to home page
			header('Location:index.php');

		}else{
			$message = 'Your username and/or password is incorrect.';
		}//end if creds match
	}//end if within limits
	else{
		//length out of bounds
		$message = 'Your username and password combination is incorrect.';
	}
}//end if did login



?>

<?php echo $message ?>

<!--Register Form -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
		<label>Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username;?>">		
		<label>Password:</label>
		<input type="password" name="password" id="password">
		
		<input type="submit" value="Log In">
		<input type="hidden" name="did_login" value="true">
	</form>



	<?php include('includes/footer.php'); ?>