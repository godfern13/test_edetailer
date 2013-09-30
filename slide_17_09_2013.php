<?php
	require_once("classes/csGeneral.php");
	require_once "library/dbcon.php";
	require_once "library/functions.php";
	sessionCheck();
	//session_start();
	include("classes/classes.php");
	
	$slideId = base64_decode($_GET['id']);	
	
	$contentCnt		=	$_SESSION['contentCnt'];
	$addParentObj 	=   unserialize($_SESSION['contentObject'.$contentCnt]);
	$parentCount	=	$addParentObj->getParentCount();
	$addParentObj->addParents($parentCount);
	$addParentObj		=	new parentClass();
	$_SESSION['parentObject'.$parentCount] = serialize($addParentObj);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-script-type" content="text/javascript" />
    <meta http-equiv="content-style-type" content="text/css" />
	<title>E-Detailing</title>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
	<script type="text/javascript">
	    google.load("jquery", "1.4.2");
		google.load("jqueryui", "1.7.2");
	</script>
	<link rel="stylesheet" type="text/css" href="css/framework.css" media="all" />
	<script type="text/javascript" src="script/slide.js"></script>
</head>
	<body>
		<div id="wrapper">
			<div id="headerDiv">
			<?//include('include/header.php');?>
				<ul style="width:950px">
					<li>
						<input type="image" name="saveSlide" id="saveSlide" src="images/submit.png" onclick="return slideSaveCall()"/>
						<input type="hidden" id="prntId" name="prntId" value="<?echo $slideId?>">
					</li>
				</ul>
			</div>
			<div id="frame">
				<!--<input type="button" name="" id="" value="save" onclick="return saveDta()"/>-->
			</div>
			<div id="rightDiv">
				<div id="specfcatnDiv">
					<img src="images/loader.gif" style="margin:120px 0 0 80px" id="specLoader">
				</div>
				<div id="options">
					<iframe name="upload_iframe" id="upload_iframe" style="display:none;"></iframe>
					<div id="drag1" class="drag"></div>
				</div>
			</div>
		</div>
		<div id="div_id"></div>
	</body>
</html>