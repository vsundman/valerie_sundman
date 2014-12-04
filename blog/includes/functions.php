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
//no close PHP