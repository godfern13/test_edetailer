<?php
	session_start();
	include("../classes/classes.php");
	$contentCnt		=	$_SESSION['contentCnt'];
	$addParentObj 	=   unserialize($_SESSION['contentObject'.$contentCnt]);
	$parentCount	=	$addParentObj->getParentCount();
	$parSpecObj 	= 	unserialize($_SESSION['parentObject'.$parentCount]);
	$speDispOp		=	$parSpecObj->getParentSpecification();
	echo $speDispOp;
?>