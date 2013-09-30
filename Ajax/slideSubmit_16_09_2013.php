<?php 
	require_once "../classes/csGeneral.php";
	require_once "../library/dbcon.php";
	require_once "../library/functions.php";
	sessionCheck();
	
	$generalObj = new general();
	$table_name	= 'parent';
	$table_col	= 'id';
	$prntId		= $generalObj->getPK($table_name,$table_col);
	
	$contentId 	= $_POST['c_id'];
	$name 		= $_POST['sName'];
	
	$query 	= "	INSERT INTO parent(id,content_id,name)VALUES(".$prntId.",".$contentId.",'".$name."')";
	
	//echo $query;
	$result = mysql_query($query)or die(mysql_error());
	$error 	= mysql_error() != '' ? true : false;

	if($error)
	{
		return false;
	}
	else{
		echo $prntId;
	}
	
	//header('Location:../add_slide.php');
	
?>


