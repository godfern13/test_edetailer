<?php
require_once("../classes/csGeneral.php");
require_once("../classes/db_functions.php");
require_once("../library/dbcon.php");
session_start();

	$user_id 	= $_SESSION["userId"];
	$dataObj 	= new DB_Functions();
	$userData 	= $dataObj->getUserProfile($user_id);
	$data 		= '';
	if ($userData != false){
		while ($row = mysql_fetch_array($userData)) {
		
			$u_name 	= $row['name'];
			$u_cntry 	= $row['country'];
			$u_state 	= $row['state'];
			$u_city 	= $row['city'];
			$u_no 		= $row['contact'];
			$u_email 	= $row['email_id'];
		}
		
		$data .= '	<div id="profileContent">
						<h1>Your Profile</h1>
						<ul>
							<li style="width:200px;"><strong>Name:'.$u_name.'</strong></li>
							<li style="width:200px;">
								<span class="profAddress"><strong>Address</strong>
									<p>Country:'.$u_cntry.'</p>
									<p>State:'.$u_state.'</p>
									<p>City:'.$u_city.'</p>
								</span>
							</li>
							<li style="width:200px;">
								<span class="profContact"><strong>Contact Details</strong>
									<p>Phone No:'.$u_no.'</p>
									<p>Email-Id:'.$u_email.'</p>
								</span>
							</li>
						</ul>
					</div>';
		echo $data;
	}
    else{
		echo "Information not available-Error.";
	}
?>