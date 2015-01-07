<?php 
//parse image uploads if the form was submitted
if($_POST['did_post']){
	//get the text fields and sanitize
	$title = clean_input( $_POST['title'], $db );
	$description = clean_input( $_POST['description'], $db );
	$room = $_POST['room'];
	$theme =$_POST['theme'];

	//validate
	$valid = true;
	//did they leave title or description blank?
	if( strlen($title) == 0 OR strlen($description) == 0 ){
		$valid = false;
		$message[] = 'Please fill in all fields.';
	}

	//check for bad value in room or theme
	if( ! is_numeric($room) ){
		$valid = false;
		$message[] = 'invalid room.';
	}

	if( ! is_numeric($theme) ){
		$valid = false;
		$message[] = 'invalid theme.';
	}

	//if valid, do image upload
	if($valid){

	//file uploading stuff begins

		$target_path = "uploads/";

	//list of image sizes to generate. make sure a column name in your DB matches up with a key for each size
		$sizes = array(
			'thumb_img' => 150,
			'large_img' => 600 
			);	

	// This is the temporary file created by PHP
		$uploadedfile = $_FILES['uploadedfile']['tmp_name'];
		//if image is blank, use old image key
if( $uploadedfile != '' ){
	// Capture the original size of the uploaded image
	list($width,$height) = getimagesize($uploadedfile);

	//make sure the width and height exist, otherwise, this is not a valid image
	if($width > 0 AND $height > 0){

	//what kind of image is it
	$filetype = $_FILES['uploadedfile']['type'];

	switch($filetype){
		case 'image/gif':
	// Create an Image from it so we can do the resize
		$src = imagecreatefromgif($uploadedfile);
		break;

		case 'image/pjpeg':
		case 'image/jpg':
		case 'image/jpeg': 
	// Create an Image from it so we can do the resize
		$src = imagecreatefromjpeg($uploadedfile);
		break;

		case 'image/png':
	// Create an Image from it so we can do the resize
		$required_memory = Round($width * $height * $size['bits']);
		$new_limit=memory_get_usage() + $required_memory;
		ini_set("memory_limit", $new_limit);
		$src = imagecreatefrompng($uploadedfile);
		ini_restore ("memory_limit");
		break;


	}
	//for filename
	$randomsha = sha1(microtime());

	
	//do it!  resize images
		foreach($sizes as $size_name => $target_dimension){
		
			//BIG IMAGE: set up square canvas if original image is larger than target size
			if($width >=  $target_dimension AND $height >= $target_dimension){
				//set canvas size to the target size
				$canvaswidth = $canvasheight = $target_dimension;
				// original image is LANDSCAPE:
				if( $width > $height){
					$crop_width = $crop_height = $height;
					$offsetX = ($width - $height) / 2;
					$offsetY = 0;
				}// original image is PORTRAIT:
				else{
					$crop_width = $crop_height = $width;
					$offsetX = 0;
					$offsetY = ($height - $width) / 2;
				}	
			
			}else{
			//SMALL IMAGE - use the original size
				$canvaswidth=$width;
				$canvasheight=$height;
				$crop_width = $width;
				$crop_height = $height;
				$offsetX = $offsetY= 0;
			}
			//make temporary square canvas
			$destination_canvas=imagecreatetruecolor($canvaswidth,$canvasheight);
			//apply the cropped, resized image to the destination canvas
			imagecopyresampled($destination_canvas,$src,0,0,$offsetX,$offsetY,$canvaswidth,$canvasheight,$crop_width,$crop_height);
			



		$filename = $target_path.$randomsha.'_'.$size_name.'.jpg';
		$didcreate = imagejpeg($destination_canvas, $filename,70);
		imagedestroy($destination_canvas);
		

		//store in DB if it successfully saved the image to the file
		if($didcreate){
			//DELETE OLD FILE
			//look up the old image name
			$query_oldfile = "SELECT image_key FROM posts where post_id = $post_id LIMIT 1";
            $result_oldfile = $db->query($query_oldfile);
            if($result_oldfile->num_rows == 1){
                $row_oldfile = $result_oldfile->fetch_assoc();
                //get filepath of old file (doesn't work with http: protocol, needs file path)
                $old_file = uploaded_image_path($row_oldfile['image_key'], $size_name);
                 //Delete the file from the directory with unlink()
                unlink($old_file);
            }
			//END DELETE OLD FILE
			$message .= 'file uploaded';
		}	else{
			$message .= 'file not uploaded';

		}


		}//end foreach
	}//end if no image
		imagedestroy($src);	
}//end if not blank image


	//update the post's info
	$query = "UPDATE posts
				SET title = '$title',
				description = '$description',
				theme_id = $theme,
				room_id = $room";

	if(isset($randomsha)){
		$query .=		", image_key = '$randomsha'";
	}
	$query .=		" WHERE post_id = $post_id
				LIMIT 1";
	$result = $db->query($query);		
		//make sure it worked
		if( $db->affected_rows == 1 ){


			$message .= 'Post successfully saved.';
		

		} //end if query worked
		else{
				$message = 'Something went wrong saving your post.';
		}
		
	


	}else{//width and height not greater than 0
		$didcreate = false;
	}
	



	}//end if valid



