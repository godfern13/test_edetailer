<?php
	session_start();
	include("../classes/classes.php");
	$chldCrDte		=	date('Y-m-d');
	$chldUpDte		=	'';
	$childWdth		=	$_POST['childWdth'];
	$childHght		=	$_POST['childHght'];
	$childCnt		=	$_POST['chldCnt'];
	$chldX			=	$_POST['chldX'];
	$chldY			=	$_POST['chldY'];
	$childType		=	$_POST['childType'];
	$childText		=	$_POST['childText'];if($childText == "" || $childText == 'undefined'){ $childText = 'Sample Text';}
	$childImgPath	=	$_POST['childImgPath'];if($childImgPath == "" || $childImgPath == 'undefined'){ $childImgPath = '';}
	$childTextClr	=	$_POST['childTextClr'];if($childTextClr == "" || $childTextClr == 'undefined'){ $childTextClr = 'fff';}
	$childTextSze	=	$_POST['childTextSze'];if($childTextSze == "" || $childTextSze == 'undefined'){ $childTextSze = '12';}
	$childVdoPath	=	$_POST['childVdoPath'];if($childVdoPath == "" || $childVdoPath == 'undefined'){ $childVdoPath = '';}
	$childRefLink	=	$_POST['childRefLink'];if($childRefLink == "" || $childRefLink == 'undefined'){ $childRefLink = '';}
	$childRefPath	=	$_POST['childRefPath'];if($childRefPath == "" || $childRefPath == 'undefined'){ $childRefPath = '';}
	
	$contentCnt		=	$_SESSION['contentCnt'];
	$addParentObj 	=   unserialize($_SESSION['contentObject'.$contentCnt]);
	$parentCount	=	$addParentObj->getParentCount();
	$parentObj 		=   unserialize($_SESSION['parentObject'.$parentCount]);
	$childCount		=	$parentObj->getChildCount();
	$parentObj->addChild($childCount);
	
	$chldSpecObj	=	new childClass();
	$childName		=	'Child'.$childCount;
	$chldSpecObj->addChildSpecification($childName,$chldCrDte,$chldUpDte,$childWdth,$childHght,$childCnt,$chldX,$chldY,$childType,$childText,$childImgPath,$childTextClr,$childTextSze,$childVdoPath,$childRefLink,$childRefPath);
	$speDispChld	=	$chldSpecObj->getChildSpecification();
	$_SESSION['childObject'.$childCnt] = serialize($chldSpecObj);
	echo $speDispChld;
?>