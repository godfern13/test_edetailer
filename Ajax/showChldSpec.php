<?php
	session_start();
	include("../classes/classes.php");
	$chldCnt		=	$_POST['cunt'];
	$contentCnt		=	$_SESSION['contentCnt'];
	$addParentObj 	=   unserialize($_SESSION['contentObject'.$contentCnt]);
	$parentCount	=	$addParentObj->getParentCount();
	$chldSpecObj 	= 	unserialize($_SESSION['childObject'.$chldCnt]);
	$speDispChld	=	$chldSpecObj->getChildSpecification();
	echo $speDispChld;
?>