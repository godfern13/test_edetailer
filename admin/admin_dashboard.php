<?php 
	require_once "library/functions.php";
	sessionCheck();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>e-Detailer-Admin</title>
		<!--<link href="css/general.css" type="text/css" rel="stylesheet">-->
		<link href="css/styles.css" type="text/css" rel="stylesheet">
		<style>
			#container{
				min-height:420px;
			}
		</style>
		
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
					<h2 style="margin:120px 0 0 320px">Welcome To e-Detailing Admin Panel</h2>
				</div>
				<?
					require_once('include/footer.php');
				?>
			</div>
			
		</div>
	</body>
</html>
