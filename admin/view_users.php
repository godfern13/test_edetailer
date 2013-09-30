<?php 
	require_once "library/functions.php";
	sessionCheck();
	if(!(isset($_SESSION["errmsg"]))){
		$_SESSION["errmsg"]="";
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>e-Detailer:Admin</title>
		<link href="css/paging.css" type="text/css" rel="stylesheet">
		<link href="css/styles.css" type="text/css" rel="stylesheet">
		<style>
			#container{
				min-height:420px;
			}
		</style>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type= "text/javascript" src = "js/load_users.js"></script>
	</head>
	<body id="admin_home">
		<div id="wrapper">
			<div id="mainWrapper">
				<div id="header">
					<?
						require_once('include/header.php');
					?>
				</div>
				<div id="container">
				
					<?if($_SESSION['errmsg'] != ""){?>
							<div id="msgDiv" style="display:block"><?echo $_SESSION['errmsg']?></div>
						<?$_SESSION['errmsg'] ="";}?>
						
					<div id="viewUserDiv">
						<div id="usertable">
							<div id="tbHeader">
								<ul>
									<li style="width:100px;border-left:none;">Sr No.</li>
									<li style="width:400px;">Name</li>
									<li style="width:100px;">Edit/Delete</li>
								</ul>
							</div>
							<div id="tbContent">
							</div>
						</div>
					</div>
				</div>
				<?
					require_once('include/footer.php');
				?>
			</div>
		</div>
	</body>
</html>
