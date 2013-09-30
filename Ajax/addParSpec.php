<?php
	session_start();
	include("../classes/classes.php");
	
	$contentCnt		=	$_SESSION['contentCnt'];
	$addParentObj 	=   unserialize($_SESSION['contentObject'.$contentCnt]);
	$parentCount	=	$addParentObj->getParentCount();
	$parentSpecObj 	= 	unserialize($_SESSION['parentObject'.$parentCount]);
	
	$parentCrDte	=	date('Y-m-d');
	$parentUpDte	=	'';
	$parentWdth		=	$_POST['parentWdth'];
	$parentHght		=	$_POST['parentHght'];
	$parentBgClr	=	$_POST['parentBgClr'];
	$parentX		=	$_POST['parentX'];
	$parentY		=	$_POST['parentY'];
	$parentName2	=	$_SESSION['ParntName'];
	$parentName		=	$_POST['parentName'];
	$parentBgImg	=	$_POST['pBgImgName'];
	$childCount		=	0;
	if($parentName == "" || $parentName=='undefined'){$parentName = $parentName2;}
	if($parentBgImg == "" || $parentBgImg=='undefined'){$parentBgImg = '';}
	
	
	$parentSpecObj->addParentSpec($parentName,$parentCrDte,$parentUpDte,$parentWdth,$parentHght,$childCount,$parentBgClr,$parentBgImg,$parentX,$parentY);
	$speDispOp	=	$parentSpecObj->getParentSpecification();
	$_SESSION['parentObject'.$parentCount] = serialize($parentSpecObj);
	echo $speDispOp;
?>