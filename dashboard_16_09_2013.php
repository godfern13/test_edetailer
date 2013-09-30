<?php 
	require_once "library/functions.php";
	sessionCheck();
	
	if(!(isset($_SESSION["msg"]))){
		$_SESSION["msg"]="";
	}
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
		<script src="js/dashboard.js" type="text/javascript"></script>
		<script src="js/loadDashboard.js" type="text/javascript"></script>
		
		
		
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
						
						<a href="add_slide.php" id="addPresentation" class="addbtn">New Presentation</a>
					</div>
					
					<div id="toPopup"><!--toPopup start-->
						<div class="close"></div>
						<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
						<div id="popup_content">
							<div id="presentnForm" class="popupForm">
								<ul>
									<li style="margin:10px 0 0 0;">Name your presentation<li>
									<li style="margin:10px 0 0 0;">:<li>
									<li>
										<input type="text" id="prestnName" name="prestnName" class="popupTextbox">
									<li>
									<li style="width:100%;">
										<input type="button" value="Create" id="prestnBtn" name="prestnBtn" class="popupBtn">
										<input type="hidden" value="Create" id="prestnBtn" name="prestnBtn" class="popupBtn">
									</li>
								</ul>
							</div>
						</div> <!--your content end-->
					</div> <!--toPopup end-->
					
					<div id="sharePopup"><!--toPopup start-->
						<div class="close"></div>
						<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
						<div id="popup_content">
							<div id="presentnForm" class="popupForm">
								<ul>
									<li style="margin:10px 0 0 0;">Enter Email-Id<li>
									<li style="margin:10px 0 0 0;">:<li>
									<li>
										<input type="text" id="emailId" name="emailId" class="popupTextbox">						
									<li>
									<span id="email_error_0" class="errormsg"></span>
									<li style="width:100%;">
										<input type="button" value="Share" id="shareBtn" name="shareBtn" onclick="sharePresentn();" class="popupBtn">
										<input type="hidden" id="prntId" name="prntId" >
										
									</li>
								</ul>
							</div>
						</div> <!--your content end-->
					</div> <!--toPopup end-->
					
					
					<div id="backgroundPopup"></div>
					<div id="allPresentations" class="contentDisplay">
						
					</div>
					<input type="hidden" id="userId" name="userId" value="<?echo $_SESSION["userId"]?>">
				</div>
			</div>
			<?include('include/footer.php');?>
		</div>
	</body>
</html>
