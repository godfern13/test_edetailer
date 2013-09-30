<?php 
	require_once "../classes/csGeneral.php";
	include_once '../classes/db_functions.php';
	require_once "../library/mailFunctions.php";
	require_once "../library/functions.php";
	sessionCheck();
	
	//Creating object of DB_Functions Class
	$db = new DB_Functions();
	
	$submitType = $_POST['queryFlag'];
	
	if($submitType == 0)//Adding Presentation
	{
		$generalObj = new general();
		$table_name	= 'content';
		$table_col	= 'id';
		$contentId	= $generalObj->getPK($table_name,$table_col);		
		$name 		= $_POST['pName'];
		
		$contentId 	= $db->storePresentaions($contentId,$name);
		//echo 'data:'.$contentId;
		if ($contentId != false){
			echo $contentId;
		}
		else{
            echo 'Error';
		}
	}
	
	if($submitType == 1)//Editing Slides
	{
	
	}
	
	if($submitType == 2)//Publishing Presentations
	{
		$presentationId = $_POST['pId'];
		$status			= $_POST['pubState'];
		$updateQuery 	= "UPDATE content SET isPublished = ".$status." WHERE id = ".$presentationId." ";
		$result			= mysql_query($updateQuery) or die(mysql_error());
		return true;
	}
	
	if($submitType == 3)//Deleting Presentations,Slides and child
	{
		$presentationId = $_POST['pId'];
		$callDelete 	= $db->delete_presentation($presentationId);		
	}

	if($submitType == 4)//Sharing Presentations--Send a mail with a link to view the presentation
	{
		$emailId 		= $_POST['email_id'];
		$presentationId = $_POST['id'];
		
		//Fetching presentations name
		$selectQuery 	= "SELECT name FROM content WHERE id = ".$presentationId." AND del_flag= 0";
		$result			= mysql_query($selectQuery)or die(mysql_error());
		$num_row		= mysql_num_rows($result);
		$row			= mysql_fetch_assoc($result);
		$name			= $row['name'];
		
		$callshare	= sendShareMail($emailId,$name);		
	}

	if($submitType == 5)//Checking for Presentations name
	{
		$id 				= $_POST['presntnId'];
		$name 				= $_POST['presntnName'];
		$checkPresentnName 	= $db->check_presentation($id,$name);
		if($checkPresentnName == 0 ){
			//Presentation name not found
			echo '-1';
		}
		else{
			//Presentation name found
			echo "<img src='images/unavailable.png' title='Please choose another presentation name'></img>";
		}
	}	
?>


