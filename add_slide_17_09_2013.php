<?php 
	require_once "library/functions.php";
	include("classes/classes.php");
	sessionCheck();
	
	if(!(isset($_SESSION["msg"]))){
		$_SESSION["msg"]="";
	}
	
	$presnt_id = base64_decode($_GET['id']);
		 
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
				padding: 0px 0 0;
			}
		</style>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script src="script/popup.js" type="text/javascript"></script>
		<script src="js/addSlide.js" type="text/javascript"></script>
		<script src="js/loadSlide.js" type="text/javascript"></script>
		
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
						
						<a href="slide.php" id="addSlide" class="addbtn">New Slide</a>
						<div id="toPopup"><!--toPopup start-->
							<div class="close"></div>
							<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
							<div id="popup_content">
								<div id="slideForm" class="popupForm">
									<ul>
										<li style="margin:10px 0 0 0;">Name your Slide<li>
										<li style="margin:10px 0 0 0;">:<li>
										<li>
											<input type="text" id="slideName" name="slideName" class="popupTextbox" onkeyup="checkSlide()">
											<span id="errormsg" style=" margin: 0 0 0 58px;"></span>
										<li>
										<li style="width:100%;">
											<input type="button" value="Create" id="slideBtn" name="slideBtn" class="popupBtn">
											<input type="hidden" id="valD" name="valD">
										</li>
									</ul>
								</div>
							</div> <!--your content end-->
						</div> <!--toPopup end-->
						<input type="hidden" id="contentId" name="contentId" value="<?echo $presnt_id?>">
					</div>
					<div id="backgroundPopup"></div>
					<div id="allSlides" class="contentDisplay">
						
					</div>
				</div>
			</div>
			<?include('include/footer.php');?>
		</div>
	</body>
</html>
