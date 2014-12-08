<?php 
//DB credentials
	$db_name = 'valerie_blog';
	$db_user = 'vs_blog';
	$db_password = 'G9zCZ3D5KA32BWTu';

//connect to DB
	$db = new mysqli( 'localhost', $db_user, $db_password, $db_name );

//handle any errors
	if( $db->connect_errno > 0 ){
		//stop the page from loading
		die( 'Unable to connect to Database' );
	}

//error reporting - set the sensitivity of PHP's error display

	//show all errors except notices
	error_reporting( E_ALL & ~E_NOTICE );
	//show all errors (E_ALL)

//no close PHP