<?php
//opens or resume a session
session_start();
//connect to DB
require('../includes/config.php');
//include the helper functions
include_once('../includes/functions.php');

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
		strlen($username) > 3 
		AND 
		strlen($password) > 5 ){

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

			//success! remember the user for 1 week
			setcookie('loggedin', true, time() + 60 * 60 * 24 * 7);
			$_SESSION['loggedin'] = true;

			//WHO is logged in?
			$row = $result->fetch_assoc();
			$user_id = $row['user_id'];

			setcookie( 'user_id', $user_id,  time() + 60 * 60 * 24 * 7 );
			$_SESSION['user_id'] = $user_id;

			//redirect to admin panel
			header('Location:index.php');

		}else{
			$message = 'Your username and/or password is incorrect.';
		}//end if creds match
	}//end if within limits
	else{
		//length out of bounds
		$message = 'Your username and password combo is wrong.';
	}
}//end if did login





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
		//redirect to admin
		header('Location:index.php');
	}//end elseif 

?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simple Login Form</title>
</head>
<body>

	<h1> Log In to Your Account </h1>
	<?php echo $message;//success/fail from above ?>


	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

	<label for="username">Username:</label>
	<input type="text" name="username" id="username">

	<label for="password">Password:</label>
	<input type="password" name="password" id="password">

	<input type="submit" value="Log In!">
	<input type="hidden" name="did_login" value="true">

	</form>


</body>
</html>