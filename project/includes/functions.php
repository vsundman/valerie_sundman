<?php
/**
 * this function is for making the date look pretty. ex. December 4, 2014 (it converts mysql datetime format)
 * @param datetime $dateR the date that needs to be made readable
 * @return string the date in Month, Day, Year format
 * @author valerie <valeriec@san.rr.com>
 * @since 0.1
 */
function convert_date($dateR){
	$engMon=array('January','February','March','April','May','June','July','August','September','October','November','December',' ');
	$l_months='January:February:March:April:May:June:July:August:September:October:November:December';
	$dateFormat='F j, Y'; //for hours/min its h:m a the a is for ampm
	$months=explode (':', $l_months);
	$months[]='&nbsp;';
	$dfval=strtotime($dateR);
	$dateR=date($dateFormat,$dfval);
	$dateR=str_replace($engMon,$months,$dateR);
	return $dateR;
}

/**
* Clean String Inputs before submitting to DB
* @param $input - the dirty data that needs cleaning!
* @param $db - Database object - $db was established in the config.php file
* @return cleaned data
*/
function clean_input( $input, $db ){
	return mysqli_real_escape_string($db, strip_tags($input));	
}
function clean_int($input, $db ){
	return filter_var($input, FILTER_SANITIZE_NUMBER_INT);	

}


//output any array as an unordered list
function vs_array_list($array){ #i put my initials before the array list so i know that nowhere else in the php language does this exist so it will not conflict
 	if(is_array($array)){

	 	echo '<ul>';

	 	//output one list item per thing in the array
	 	foreach( $array as $item ){
	 		echo '<li>' . $item . '</li>';
	 	}

	 	echo '</ul>';
	}
}

//display one inline error message (use this next to a field)
function vs_inline_error( $array, $item ){
	//check to make sure the item exists in the array
	if( isset( $array[$item] ) ){
		echo '<div class="inline-error">' . $array[$item] . '</div>' ;
	}

}

/**
 * Count posts of any user
 * @param int user - a user ID
 * @param int status - What kind of posts are we counting?
 *						1 = default. only published posts
 *						2 = only private (draft) posts
 *						3 = count all posts
 * @param resrouce db - database connection
 */
function count_posts( $user, $status = 1, $db ){
	//count the posts
	$query = "SELECT COUNT(*) AS total 	
				FROM posts 
				WHERE user_id = $user ";
	//depending on the value of status, refine the query
		if( 1 == $status ){
			$query .= " AND is_published = 1";
		}elseif( 2 == $status ){
			$query .= " AND is_published = 0";
		}
		//run it
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		return $row['total'];

}
/**
 * Count the number of comments on any user's posts
 * @param int user - a user ID
 * @param resrouce db - database connection
 */
function count_user_post_comments( $user, $db ){
	//count the comments
	$query = "SELECT COUNT(*) AS total 	
				FROM posts, comments 
				WHERE posts.post_id = comments.post_id
				AND posts.user_id = $user ";
		//run it
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		return $row['total'];
}



function convTimestamp($date){
  $year   = substr($date,0,4);
  $month  = substr($date,5,2);
  $day    = substr($date,8,2);
  $hour   = substr($date,11,2);
  $minute = substr($date,14,2);
  $second = substr($date,17,2);
  $stamp =  date('D, d M Y H:i:s O', mktime($hour, $min, $sec, $month, $day, $year));
  return $stamp;
}


function user_badge( $user, $db ){
	//get the user's name, profile pic, 
	$query = "SELECT username, medium_img
				FROM users 
				WHERE user_id = $user
				LIMIT 1 ";
	$result = $db->query($query);
	//check it
	if($result->num_rows == 1){
		$row = $result->fetch_assoc();

		if ( $row['medium_img'] != '' ) {
			$image = SITE_PATH . $row['medium_img'];
		}else{
			//DOCUMENT_ROOT is htdocs
			//default img
			$image =  'http://localhost/valerie_sundman/project/images/default_user.jpg';
		}
	//display it
		?>
		<!-- SOME HTML HERE -->
		<div class="user-badge">
			<img src="<?php echo $image; ?>">
		</div>
		<?php 
	}
}//end user_badge



//no close PHP