<?php 
	include('../../library/dbcon.php');
	
    
	$qryFlag  = $_POST['flag'];
	
	if($qryFlag == 0){
		$name = $_POST['userName'];
		$sql = "SELECT * FROM users WHERE username = '" .$name."' AND del_flag = 0 ";
		//echo $sql;
		$rowSql = mysql_query($sql)or die('Error in connection'.mysql_error());
		$checkRows = mysql_num_rows($rowSql);
	   
		if($checkRows <= 0) { 
			//echo '<img src="images/available.png"></img>';
			echo 1;
		} 
		else {
			//echo '<img src="images/unavailable.png"></img>';
			echo 2;
		}
	}
	/*else if($qryFlag == 1){
	
		$r_id 	= $_POST['rest_id'];
		$r_name = strtolower($_POST['restName']);
		
		if($r_id != ''){
			$sql = "SELECT * FROM kl_restaurants WHERE rest_name = '" .$r_name."' AND rest_id != ".$r_id." AND del_flag = 0";
		}
		else{
			$sql = "SELECT * FROM kl_restaurants WHERE rest_name = '" .$r_name."' AND del_flag = 0";
		}
		
		$checkResult = pg_query($sql)or die('Error in connection'.pg_last_error());
		$checkRows = pg_num_rows($checkResult);
		
		if($checkRows <= 0) { 
			
		} 
		else {
			echo ucwords($r_name).' Restaurant already Exists.';
		}
	}*/

?>