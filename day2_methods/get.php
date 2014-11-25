<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Example of handling GET method</title>
	<style type="text/css">
	input{
		display: block;
		margin: 10px 0;
	}
	</style>
</head>
<body>

	<?php if( $GET['did_submit'] == true ){ ?>
		<p>Good Morning, <?php echo $GET['name'] ?>. <?php echo $GET['breakfast'] ?> sounds delish!</p>
	<?php } ?>



	<form method="get" action="get.php"> 
		<label for="name">What is your name?</label>
		<input type="text" name="name" id="name">

		<label for="breakfast">What did you have for breakfast?</label>
		<input type="text" name="breakfast" id="breakfast">

		<input type="submit" name="button" value="Submit this Info!">
		<input type="hidden" name="did_submit" value="true">
	</form>

</body>
</html>
