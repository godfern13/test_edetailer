<?php 
	//include("classes/classes.php");
	session_start();
	$serVerName		=	$_SERVER['SERVER_NAME'];
	$upload_dir 	= 	'images/'.$_SESSION['mainPresntnName'].'/child/'; // Directory for file storing
	$upload_dir2	=	preg_replace('/\s+/','',$upload_dir);
	$filename		= 	'';
	$result 		= 	'ERROR';
	$result_msg 	= 	'';
	$allowed_image 	= 	array ('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg','image/png');
	
	if (isset($_FILES['chldImg']))  // file was send from browser
	{
		if (in_array($_FILES['chldImg']['type'], $allowed_image)) {
			//$filename = time()."_".strtolower($_FILES['chldImg']['name']);
			$filename = $_FILES['chldImg']['name'];
			move_uploaded_file($_FILES['chldImg']['tmp_name'], $upload_dir2.$filename);
		}
	}
	exit(); // do not go futher
?>