<?php 
	//this is where you would put php that you want to use for the rest of the document
	// keep track of the status of the page (error/success/etc)
	$status = 'success';
//change the message if the page in success or error mode
	if( $status == 'success'){
		$message = 'You have successfully done what you need to do!';
	}else {
		$message = 'Nooo! Something went wrong!';
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PHP Practice Day 1</title>
	<link rel="stylesheet" href="">
	<style type="text/css">
		.success{
			color: green;
			background-color: #B6F3D9;
		}
		.error{
			color: red;
			background-color: #FCC7C8;
		}
	</style>
</head>
<body class="<?php echo $status; ?>">

	<h1>
		<?php 
			echo $message;
			// comment example	
		?>
	</h1>






</body>
</html>