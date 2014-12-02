<?php 
#this is where you would put all the custom functions on a site and you can link it to the pages
	//do not close PHP tag

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