<?php
	session_start();
	require_once("../library/dbcon.php");
	require_once("../classes/csGeneral.php");
	
	include("../classes/classes.php");
	$childCunter	=	$_POST['chldCunter'];
	$contentCnt		=	$_SESSION['contentCnt'];
	$addParentObj 	=   unserialize($_SESSION['contentObject'.$contentCnt]);
	$parentCount	=	$addParentObj->getParentCount();
	$parentSpecObj 	= 	unserialize($_SESSION['parentObject'.$parentCount]);
	$parentData		=	$parentSpecObj->saveParentData();
	$chldData		=	'';
	for($i=1;$i<=$childCunter;$i++)
	{
		$chldSpecObj 	= 	unserialize($_SESSION['childObject'.$i]);
		$chldData		.=	$chldSpecObj->saveChildData();
	}
	echo $chldData;
?>