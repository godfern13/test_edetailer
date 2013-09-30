<?php 
	include("classes/classes.php");
	session_start();
	$serVerName		=	$_SERVER['SERVER_NAME'];
	$upload_dir 	= 	'images/'.$_SESSION['mainPresntnName'].'/child/'; // Directory for file storing
	$filename		= 	'';
	$result 		= 	'ERROR';
	$result_msg 	= 	'';
	
	if (isset($_FILES['childVdoPath']))  // file was send from browser
	{
			$filename = $_FILES['childVdoPath']['name'];
			move_uploaded_file($_FILES['childVdoPath']['tmp_name'], $upload_dir.$filename);
	}
	exit(); // do not go futher
?>