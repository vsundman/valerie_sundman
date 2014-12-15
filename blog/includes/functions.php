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

/**
* Clean String Inputs before submitting to DB
* @param $input - the dirty data that needs cleaning!
* @param $db - Database object - $db was established in the config.php file
* @return cleaned data
*/
function clean_input( $input, $db ){
	return mysqli_real_escape_string($db, strip_tags($input));	


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












//no close PHP