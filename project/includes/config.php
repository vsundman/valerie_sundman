<?php 
//DB credentials
if($_SERVER['HTTP_HOST'] == 'localhost'){
	$db_name = 'valerie_project';
	$db_user = 'vsundman';
	//Define file path constants'
	//on xampp, DOCUMENT_ROOT takes you to c:/xampp/htdocs
	define("SITE_URL", 'http://localhost/valerie_sundman/project/');
	define("SITE_PATH",  'C:/xampp/htdocs/valerie_sundman/project/');

}else{
	$db_name = 'vsundman_project';
	$db_user = 'vsundman_project';
	//Define file path constants'
	//on xampp, DOCUMENT_ROOT takes you to c:/xampp/htdocs
	define("SITE_URL", 'http://www.valeriesundman.com/project/');
	define("SITE_PATH",  '/home3/vsundman/public_html/project/');

}
	$db_password = 'FsRKL98xeFMZTCnt';


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