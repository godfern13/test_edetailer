<?php
	/*---------------------------------Database Connections for MySQL------------------------------------------*/
	
	/*$db_server = "localhost"; 	
	$db_user = "karbensc_mahadev";			
	$db_pass = "U#B}cdvhwck}"; 				
	$database = "karbensc_edetailing";*/
 
	$db_server = "localhost"; 	
	$db_user = "root";			
	$db_pass = ""; 				
	$database = "edetailing";
	
	
	$conn = @mysql_connect($db_server,$db_user,$db_pass) or die("Connection to Database Server Failed");
	@mysql_select_db($database) or die("Database Selection Failed");
?>