<?php
	session_start();
	require_once("../library/dbcon.php");
	require_once("../classes/csGeneral.php");
	$generalObj = 	new general();
	$jsonVal	=	$_POST['data'];
	$result 	= 	json_decode($jsonVal, true);
	$arrayCunt	=	count($result);
	print_r($result);
	
	//---------------------------------------------- PARENT QUERY -------------------------------------------//
	$table_name		= 	'parent';
	$table_col		= 	'id';
	$parentId		= 	$generalObj->getPK($table_name,$table_col);
	$contentId 		= 	$_SESSION['contentCnt'];
	$parentName		=	$result[0]['parntName'];
	$parentWidth	=	$result[0]['parntWdth'];
	$parentheight	=	$result[0]['parntHght'];
	$parentX		=	$result[0]['parentX'];
	$parentY		=	$result[0]['parentY'];
	$parentBgImg	=	$result[0]['parntBgImg'];
	if($parentBgImg == '' || $parentBgImg == 'undefined'){
		$imgUrl = 'images/default_bg.jpg';
	}
	else{
		$upload_dir 	= 	'images/'.$_SESSION['mainPresntnName'].'/parent/';
		$upload_dir2	=	preg_replace('/\s+/','',$upload_dir);
		$imgUrl			=	$upload_dir2.$parentBgImg;
	}
	if($arrayCunt> 1 ){
		$chldStatus = 1;//Has Child
	}
	else{
		$chldStatus = 0;//No Child
	}
	$parentCretedDte	=	date('Y-m-d');
	$parentUpdtedDte	=	'';
	$prntFrameData 		= 	$parentWidth.','.$parentheight.','.$parentX.','.$parentY;
	$parQuery 	= 	"INSERT INTO parent(id,content_id,name,frame,content_url,has_childs,added_on,updated_on)
									VALUES(".$parentId.",".$contentId.",'".$parentName."','".$prntFrameData."','".$imgUrl."',".$chldStatus.",'".$parentCretedDte."','".$parentUpdtedDte."')";
	$ParResult 	= 	mysql_query($parQuery)or die(mysql_error());
	
	//------------------------------------------- CHILD QUERY ------------------------------------------------------//
	for($i=1;$i< $arrayCunt;$i++)
	{
		//--------------------------------------- Get Ids From The Tables -----------------------------------------------//
		$table_name	= 	'child';
		$table_col	= 	'id';
		$chldId		= 	$generalObj->getPK($table_name,$table_col);
		
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
			if($childImg != "")
			{
				$chldContntUrl		=	$upload_dir2.$childImg;
			}
			else
			{
				$chldContntUrl	=	'';
			}
			$chldContentText	=	'';
			$chldContentStyle	=	'';
		}
		//------------------------------------------- Video Child Type -----------------------------------------------//
		if($childType == 3)
		{
			$upload_dir 		= 	'images/'.$_SESSION['mainPresntnName'].'/child/';
			$upload_dir2		=	preg_replace('/\s+/','',$upload_dir);
			$childVdo			=	$result[$i]['chldImgName'];
			if($childVdo != "")
			{
				$chldContntUrl		=	$upload_dir2.$childVdo;
			}
			else
			{
				$chldContntUrl	=	'';
			}
			$chldContentText	=	'';
			$chldContentStyle	=	'';
		}
		//------------------------------------------- Reference Child Type -----------------------------------------------//
		if($childType == 4)
		{
			$upload_dir 		= 	'images/'.$_SESSION['mainPresntnName'].'/child/';
			$upload_dir2		=	preg_replace('/\s+/','',$upload_dir);
			$childRefImg	=	$result[$i]['chldImgName'];
			if($childRefImg != "")
			{
				$chldContntUrl		=	$upload_dir2.$childRefImg;
			}
			else
			{
				$chldContntUrl	=	'';
			}
			$chldContentText	=	'';
			$chldContentStyle	=	'';
		}
		$childCretedDte		=	date('Y-m-d');
		$childUpdtedDte		=	'';
		
		//--------------------------------- Child Insert Query -----------------------------------------------------------//
		$query 	= 	"INSERT INTO child(id,parent_id,name,type,content_url,frame,isAnimated,animType,animPathCord,delayTime,
							content_extention,content_text,content_style,added_on,updated_on)
					VALUES(".$chldId.",".$parentId.",'".$childName."',".$childType.",'".$chldContntUrl."','".$childFrameData."',
							".$animated.",'".$animationType."','".$animationPathCord."','".$delaySlideTime."','".$ext."',
							'".$chldContentText."','".$chldContentStyle."','".$childCretedDte."','".$childUpdtedDte."')";
		mysql_query($query)or die(mysql_error());
		
		if($childType == 4)
		{
			$referncesAray	=	$result[$i]['references'];
			$referenceCnt	=	count($referncesAray);
			for($rc=0;$rc<$referenceCnt;$rc++)
			{
				$referencesL	=	$referncesAray[$rc];
				$requery2 = 	"INSERT INTO childreferences(child_id,ref_url,ref_link,added_on,updated_on)
							VALUES('".$chldId."','','".$referencesL."','".$childCretedDte."','".$childUpdtedDte."')";
				mysql_query($requery2)or die(mysql_error());
			}
		}
	}
	echo $contentId;
?>