<?php 
	require_once "library/functions.php";
	sessionCheck();
	
	if(!(isset($_SESSION["msg"]))){
		$_SESSION["msg"]="";
	}
	
	// session_start();
	 include("classes/classes.php");
	 $addContentObj = new contentClass();
	 $contentCnt  = $addContentObj->getContentCount();
	 $addContentObj->addToContentArray($contentCnt);
	 $_SESSION['contentCnt'] = $contentCnt;
	 $_SESSION['contentObject'.$contentCnt] = serialize($addContentObj);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>e-Detailer</title>
		<link href="css/general.css" type="text/css" rel="stylesheet">
		<link href="css/header.css" type="text/css" rel="stylesheet">
		<style>
			#container{
				min-height:463px;
				width:100%;
				text-align:center;
				padding: 50px 0 0;
			}
		</style>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<!--<script src="script/dashboard.js" type="text/javascript"></script>-->
		
	</head>
	<body id="admin_home">
		<div id="wrapper">
			<?include('include/header.php');?>
			<div id="mainWrapper">
				<div id="container">
					<!--<h2>Welcome To The dashboard</h2>-->
					<div id="prsntnMenu">
						<?if($_SESSION["msg"]!=''){?>
							<div id="succesMsg" style="display:block;"></div>
						<?}?>
						
						<a href="slide.php" id="addPresentation" class="addbtn">New Slide</a>
					</div>
					<div id="allPresentations">
						
					</div>
				</div>
			</div>
			<?include('include/footer.php');?>
		</div>
	</body>
</html>
