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
		
		<!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>-->
		<script src="http://www.google.com/jsapi" type="text/javascript"></script>
		<script type="text/javascript">
			google.load("jquery", "1.4.2");
			google.load("jqueryui", "1.7.2");
		</script>
		<script src="script/slideRemake.js" type="text/javascript"></script>
		<script src="script/drag.js" type="text/javascript"></script>
		<script>
		/*$(document).ready(function(){
			$('.addTool').drags();
		});		*/
		</script>
				
		
		
	</head>
	<body id="admin_home">
		<div id="wrapper">
			<?include('include/header.php');?>
			<div id="mainWrapper">
				<div id="container">
					<div id="webFrameBody">
						<div id="webFrameMenu"></div>
						<div id="frame"></div>
						<div id="rightDiv">
							<div id="specfcatnDiv"></div>
							<div id="options" class="toolParent">
								<div id="textbox" class="addTool">Text</div>
								<div id="imgbox" class="addTool">Image</div>
								<div id="videobox" class="addTool">Video</div>
							</div>
						</div>
					
					</div>
					
				</div>
			</div>
			<?include('include/footer.php');?>
		</div>
	</body>
</html>
