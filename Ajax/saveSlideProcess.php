<?php
	session_start();
	require_once("../library/dbcon.php");
	require_once("../classes/csGeneral.php");
	$jsonVal	=	$_POST['data'];
	$result = json_decode($jsonVal, true);echo count($result);
	for($i=0;$i< count($result);$i++)
	{
		print_r($result[$i]);
		//--------------------------------------- Get Ids From The Tables -----------------------------------------------//
		$generalObj = 	new general();
		$table_name	= 	'child';
		$table_col	= 	'id';
		$chldId		= 	$generalObj->getPK($table_name,$table_col);
		$parentId 	= 	$generalObj->getLastId('parent');
		$parentId	=	1;
		$animated 			= 	0;
		$animationType 		= 	'';
		$animationPathCord 	= 	'';
		$delaySlideTime 	= 	'';
		$ext 				= 	'';
	
		$childType		=	$result[$i]['childType'];
		$childName		=	$result[$i]['name'];
		$childWdth		=	$result[$i]['width'];
		$childHght		=	$result[$i]['height'];
		$childXax		=	$result[$i]['xaxis'];
		$childYax		=	$result[$i]['yaxis'];
		$childFrameData	=	$childWdth.','.$childHght.','.$childXax.','.$childYax;
		//------------------------------------------- Text Child Type -----------------------------------------------//
		if($childType == 1)
		{
			$chldContentText	=	$result[$i]['txt'];
			$childTextClr		=	$result[$i]['txtColor'];
			$childTextSize		=	$result[$i]['txtSize'];
			$chldContentStyle	=	$childTextClr.'|'.$childTextSize;
			$chldContntUrl		=	'';
		}
		//------------------------------------------- Image Child Type -----------------------------------------------//
		if($childType == 2)
		{
			$upload_dir 		= 	'images/'.$_SESSION['mainPresntnName'].'/child/';
			$upload_dir2		=	preg_replace('/\s+/','',$upload_dir);
			$childImg			=	$result[$i]['chldImgName'];
			$chldContntUrl		=	$upload_dir2.$childImg;
			$chldContentText	=	'';
			$chldContentStyle	=	'';
		}
		//------------------------------------------- Video Child Type -----------------------------------------------//
		if($childType == 3)
		{
			$upload_dir 		= 	'images/'.$_SESSION['mainPresntnName'].'/child/';
			$upload_dir2		=	preg_replace('/\s+/','',$upload_dir);
			$childVdo			=	$result[$i]['chldImgName'];
			$chldContntUrl		=	$upload_dir2.$childVdo;
			$chldContentText	=	'';
			$chldContentStyle	=	'';
		}
		//------------------------------------------- Reference Child Type -----------------------------------------------//
		if($childType == 4)
		{
			$chldContntUrl		= 	'';
			$chldContentText	=	'';
			$chldContentStyle	=	'';
		}
		$childCretedDte		=	date('Y-m-d');
		$childUpdtedDte		=	'';
		
		//echo $chldId."<br>".$parentId."<br>".$childName."<br>".$childType."<br>".$chldContntUrl."<br>".$childFrameData."<br>";
		//--------------------------------- Child Insert Query -----------------------------------------------------------//
		$query 	= 	"INSERT INTO child(id,parent_id,name,type,content_url,frame,isAnimated,animType,animPathCord,delayTime,
							content_extention,content_text,content_style,added_on,updated_on)
					VALUES(".$chldId.",".$parentId.",'".$childName."',".$childType.",'".$chldContntUrl."','".$childFrameData."',
							".$animated.",'".$animationType."','".$animationPathCord."','".$delaySlideTime."','".$ext."',
							'".$chldContentText."','".$chldContentStyle."','".$childCretedDte."','".$childUpdtedDte."')";
		mysql_query($query)or die(mysql_error());
		//$childResid = 	mysql_insert_id();
	}
?>