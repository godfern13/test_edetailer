<?php 
	include("classes/classes.php");
	session_start();
	$serVerName		=	$_SERVER['SERVER_NAME'];
	$upload_dir 	= 	'images/'.$_SESSION['mainPresntnName'].'/child/'; // Directory for file storing
	$filename		= 	'';
	$result 		= 	'ERROR';
	$result_msg 	= 	'';
	$allowed_image 	= 	array ('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg','image/png');
	
	if (isset($_FILES['chldRefBgImg']))  // file was send from browser
	{
		if (in_array($_FILES['chldRefBgImg']['type'], $allowed_image)) {
			$filename = $_FILES['chldRefBgImg']['name'];
			move_uploaded_file($_FILES['chldRefBgImg']['tmp_name'], $upload_dir.$filename);
		}
	}
	exit(); // do not go futher
?>