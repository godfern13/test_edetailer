<?php 
	require_once "../classes/csGeneral.php";
	include_once '../classes/db_functions.php';
	require_once "../library/dbcon.php";
	require_once "../library/functions.php";
	sessionCheck();
	
	//Creating object of DB_Functions Class
	$db = new DB_Functions();
	
	$submitType = $_POST['queryFlag'];
	
	if($submitType == 0)//Adding Slides
	{
		$generalObj = new general();
		$table_name	= 'parent';
		$table_col	= 'id';
		$prntId		= $generalObj->getPK($table_name,$table_col);
		
		$contentId 	= $_POST['c_id'];
		$name 		= $_POST['sName'];
		
		$parentId 	= $db->storeSlide($prntId,$contentId,$name);
		//echo 'data:'.$parentId;
		if ($parentId != false){
			echo $parentId;
		}
		else{
            echo 'Error';
		}
	}
	
	if($submitType == 5)//Checking for Presentations name
	{
		$id 				= $_POST['slideId'];
		$name 				= $_POST['slideName'];
		$checkPresentnName 	= $db->check_slide($id,$name);
		if($checkPresentnName == 0 ){
			//Slide name not found
			echo '-1';
		}
		else{
			//Slide name found
			echo "<img src='images/unavailable.png' title='Please choose another slide name'></img>";
		}
	}
	
?>


