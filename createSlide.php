<?php
	session_start();
	include("classes/classes.php");
	$addContentObj	=	new contentClass();
	$contentCnt		=	$addContentObj->getContentCount();
	$addContentObj->addToContentArray($contentCnt);
	$_SESSION['contentCnt'] =	$contentCnt;
	$_SESSION['contentObject'.$contentCnt] = serialize($addContentObj);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-script-type" content="text/javascript" />
    <meta http-equiv="content-style-type" content="text/css" />
	<title>E-Detailing</title>
</head>
	<body>
		<div id="wrapper">
			<div id="headerDiv">
				<a href="slide.php">New Slide</a>
			</div>
		</div>
	</body>
</html>