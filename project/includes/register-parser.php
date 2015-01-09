<?php 
//parse the form if the user submitted it
	if( $_POST['did_register']){
		//clean the data
		$username 	=	clean_input($_POST['username'], $db);
		$email 		=	clean_input($_POST['email'], $db);
		$password	= 	clean_input($_POST['password'], $db);
		$policy 	= 	clean_input($_POST['policy'], $db);

		//hashed password for DB
		$hashed_password = sha1($password);

		//validate it
		$valid = true;


		#username not within the limits
		if( strlen($username) <= 3 OR strlen($username) > 50 ){
			$valid = false;
			$errors['username'] = 'Choose a username that is between 3-50 characters long.';
		}else{
			//if the length check passed, check to see if this username is already taken in DB
			$query_username = "SELECT username
								FROM users 
								WHERE username = '$username'
								LIMIT 1";
			$result_username = $db->query($query_username);
			//if one result found, name is already taken
			if( $result_username->num_rows == 1){
				$valid = false;
				$errors['username'] = 'That username is already taken.';
			}//end if username is taken

		}#end username tests

		#check for invalid or blank email
		if( ! filter_var($email, FILTER_VALIDATE_EMAIL) ){
				$valid = false;
				$errors['email'] = 'Please provide a valid email address, like johndoe@mail.com';
		}else{
			//valid email, but make sure it isn't already taken in DB
			$query_email = "SELECT email
							FROM users
							WHERE email = '$email'
							LIMIT 1";
			$result_email = $db->query($query_email);
			if($result_email->num_rows == 1){
				$valid = false;
				$errors['email'] = 'That email is already registered. Do you want to login?';
			}//end if email is taken
		}//end check for invalid email

		#PASSWORD TOO SHORT CHECK
		if(strlen($password) < 8){
			$valid = false;
			$errors['password'] = 'Password must be at least 8 characters long.';
		}

		#did not check the POLICY BOX
		if( $policy != 1 ){
			$valid = false;
			$errors['policy'] = 'You must agree to the Terms before registering.';
		}

		//if valid, add the new user to DB
		if($valid){
			$query_newuser = "INSERT INTO users
								(username, email, password, date_joined)
								VALUES
								( '$username', '$email', '$hashed_password', now() )";

			$result_newuser = $db->query($query_newuser);
			//check to make sure the user was added
			if( $db->affected_rows == 1 ){
				//log them in a redirect to admin
				setcookie('loggedin', true, time() + 60 * 60 * 24 * 2);
				$_SESSION['loggedin'] = true;

				//get their new user id
				$user_id = $db->insert_id;

				setcookie('user_id', $user_id, time() + 60 * 60 * 24 * 2);
				$_SESSION['user_id'] = $user_id;

				//redirect
				header('Location:index.php');

			}else{
				$errors['db'] = 'Something went wrong during account creation.';
			}//end else

		}
	}//end of parser