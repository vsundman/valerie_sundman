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

	<?php if( $_POST['did_submit'] == true ){ ?>
		<p>Good Morning, <?php echo $_POST['name'] ?>. <?php echo $_POST['breakfast'] ?> sounds delish!</p>
	<?php } ?>



	<form method="post" action="post.php"> 
		<label for="name">What is your name?</label>
		<input type="text" name="name" id="name">

		<label for="breakfast">What did you have for breakfast?</label>
		<input type="text" name="breakfast" id="breakfast">

		<input type="submit" name="button" value="Submit this Info!">
		<input type="hidden" name="did_submit" value="true">
	</form>

</body>
</html>
