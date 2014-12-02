<?php
	//load the functions file
	require_once('functions.php');


//parse the form when it is submitted
	if( true == $_POST['did_send'] ){
		//extract the dirty data and sanitize it
		$name = filter_var( $_POST['name'] , FILTER_SANITIZE_STRING );
		$email = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL );
		$phone = filter_var( $_POST['phone'] , FILTER_SANITIZE_NUMBER_INT );
		$message = filter_var( $_POST['message'] , FILTER_SANITIZE_STRING );
		
		//validate all fields
		$valid = true;
		//check to see if name is blank
			if( '' == $name ){
				$valid = false;
				$errors['name'] = 'Please provide your name.';
			}//end if nameblank

			//check for invalid or blank email
			if( ! filter_var( $email, FILTER_VALIDATE_EMAIL  ) ){
				$valid = false;
				$errors['email'] = 'The email you entered is invalid.';
			}//end email error

			//check to see if message is blank
			if( '' == $message ) {
				$valid = false;
				$errors['message'] = 'Please fill in a message.';
			}//end messageblank


		//if the data passes validation, send the mail,otherwise, show an error message
			if( $valid ){
				//send mail
				$to = 'valeriec@san.rr.com';
				$subject = 'Testing Contact Form';
				//        \n = line break
				$body = "Sent By: $name \n ";
				// .= means add to the current value, we are adding to $body
				$body .= "Email: $email \n ";
				$body .= "Phone Number: $phone \n";
				$body .= "Message: $message";

				$headers = "Reply-to: $email";

				$mail_status = mail($to, $subject, $body, $headers);

					if($mail_status){
						$feedback = 'Thank you for your message!';
					}else{
						$feedback = 'There was a problem sending the mail.';
					}

				}else{
					//error message
					$feedback = 'Something went wrong. Try again!';
					}
			
	}//end if $valid

?>


	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Contact form with validation and sanitization</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Contact Us</h1>

	<?php 
		//show the feedback if it exists
		if( isset($feedback) ){
			echo '<div class="feedback">';
			echo $feedback; 
			//print_r( $errors );
			vs_array_list($errors);
			echo '</div>';
		} ?>
		
	<!-- Use the novalidate attribute in the form to test the PHP, then remove it -->

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

		<label>Name:</label>
		<input type="text" name="name" id="name" value="<?php echo $name; ?>">
		<?php vs_inline_error($errors, 'name'); ?>

		<label>Email:</label>
		<input type="email" name="email" id="email" value="<?php echo $email; ?>">
		<?php vs_inline_error($errors, 'email'); ?>

		<label>Phone Number: (optional)</label>
		<input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>">

		<label>Message:</label>
		<textarea name="message" id="message"><?php echo $message; ?></textarea> 
		<?php vs_inline_error($errors, 'message'); ?>

		<input type="submit" value="Send Message">
		<input type="hidden" name="did_send" value="true">

	</form>




</body>
</html>