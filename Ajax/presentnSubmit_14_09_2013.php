<?php 
	require_once "../classes/csGeneral.php";
	require_once "../library/dbcon.php";
	require_once "../library/mailFunctions.php";
	require_once "../library/functions.php";
	sessionCheck();
	
	$submitType = $_POST['queryFlag'];
	
	if($submitType == 0)//Adding Slides
	{
		$generalObj = new general();
		$table_name	= 'content';
		$table_col	= 'id';
		$contentId		= $generalObj->getPK($table_name,$table_col);
		
		$name 	= $_POST['pName'];
		$query 	= "	INSERT INTO content(id,name)VALUES(".$contentId.",'".$name."')";
		$result = mysql_query($query)or die(mysql_error());
		$error 	= mysql_error() != '' ? true : false;

		if($error)
		{
			echo '-1';
		}
		else{
			echo $contentId;
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
		$callDelete 	= delete_presentation($presentationId);		
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
	
	
	/**
	***
	DELETE FUNCTIONS:-Presentation,Slides and Children
	**
	**/
	
	function delete_presentation($id){
		
		$contentId = $id;
		$callSlidesDelete = delete_slides($contentId);
		
		//Updating/Deleting a presentation
		$updateQuery 	= "UPDATE content SET del_flag = 1 WHERE id = ".$contentId." ";
		$result			= mysql_query($updateQuery) or die(mysql_error());
		return true;
	}
	
	function delete_slides($id){
	
		$contentId = $id;
		
		//Checking if presentations have slides
		$selectQuery 	= "SELECT id FROM parent WHERE content_id = ".$contentId." AND del_flag= 0";
		$result			= mysql_query($selectQuery)or die(mysql_error());
		$num_row		= mysql_num_rows($result);
		
		//if yes-->then deleting the children first
		if($num_row > 0)
		{
			while($row	= mysql_fetch_assoc($result))
			{
				$parentId 			= $row['id'];
				$callChildDelete 	= delete_child($parentId);				
			}			
		}
		else
		{
			//No Slides
		}
		
		//Updating/Deleting slide of a presentation
		$updateQuery 	= "UPDATE parent SET del_flag = 1 WHERE content_id = ".$contentId." ";
		$result			= mysql_query($updateQuery) or die(mysql_error());
		
	}
	
	function delete_child($id){
	
		$parentId = $id;
		
		//Updating/Deleting child of a slide
		$updateQuery 	= "UPDATE child SET del_flag = 1 WHERE parent_id = ".$parentId." ";
		$result			= mysql_query($updateQuery) or die(mysql_error());				
	}
	
?>


