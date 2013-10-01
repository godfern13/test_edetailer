<?php 
	include("classes/classes.php");
	session_start();
	$serVerName		=	$_SERVER['SERVER_NAME'];
	$upload_dir 	= 	'images/'.$_SESSION['mainPresntnName'].'/child/'; // Directory for file storing
	$upload_dir2	=	preg_replace('/\s+/','',$upload_dir);
	$filename		= 	'';
	$result 		= 	'ERROR';
	$result_msg 	= 	'';
	
	if (isset($_FILES['childVdoPath']))  // file was send from browser
	{
			$filename = $_FILES['childVdoPath']['name'];
			move_uploaded_file($_FILES['childVdoPath']['tmp_name'], $upload_dir2.$filename);
	}
	exit(); // do not go futher
?>