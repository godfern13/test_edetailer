<?php 
	require_once "library/functions.php";
	require_once "classes/db_functions.php";
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
		<script src="js/loadProfile.js" type="text/javascript"></script>		
	</head>
	<body id="admin_home">
		<div id="wrapper">
			<?include('include/header.php');?>
			<div id="mainWrapper">
				<div id="container">
					<div id="profileWrapper">
						
					</div>
				</div>
			</div>
			<?include('include/footer.php');?>
		</div>
	</body>
</html>
