<?php	 	
	function sendPasswordMail($id,$user_name,$email,$pswd){
		$emailmsg = '';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: e-Detailer <noreply@karbens.com>'. "\r\n";
		$emailmsg.= "<HTML><HEAD><TITLE>Forgot Password</TITLE></HEAD>";
		$emailmsg.="<BODY>";
		$emailmsg.="<tr><td style='width:150px'>User Name</td>";
		$emailmsg.="<td style='width:20px'>-</td>";
		$emailmsg.="<td>".$user_name."</td></tr><br>";
		$emailmsg.="<tr><td style='width:150px'>Your new password</td>";
		$emailmsg.="<td style='width:20px'>-</td>";
		$emailmsg.="<td>".$pswd."</td></tr>";
		$emailmsg.= "</BODY></HTML>";
		
		$to=$email;
		$subject = "Forgot Password";
		$_SESSION['msg']=" ";
		
		//echo $to.'<br>';
		//echo $subject.'<br>';
		//echo $emailmsg.'<br>';
		//echo $headers.'<br>';
		//echo $pswd.'<br>';
		
		if(mail($to,$subject,$emailmsg,$headers)){
			$generalObj = new general();
			//echo "Sending mail";
			$enc_pswd 	= $generalObj->encrypt($pswd);
			//echo $enc_pswd.'============';			
			//Getting user email id
			$query 		= "SELECT email_id FROM users WHERE id=".$id." AND del_flag=0";
			//echo $query;
			$result 	= mysql_query($query)or die(mysql_error());
			$row		=	mysql_fetch_assoc($result);
			$emailid	= $row['email_id'];
			
			echo $emailid;
			
			if($enc_pswd != '')
			{
				$pswdUpdateQry 		= "UPDATE users SET password='".$enc_pswd."' WHERE id=".$id." AND del_flag=0";
				echo $pswdUpdateQry;
				$pswdUpdateResult 	= mysql_query($pswdUpdateQry)or die("Error in connection".mysql_error());
			}
			//return $msg;
			$_SESSION['msg']= "Password Reseted- Mail sent to".$emailid;
			header('Location:index.php');
		}
		else{
			//echo "Mail Not Sent";
			$_SESSION['msg']= "Sorry could't reset your password.Try again later";
			//header('Location:forgot_password.php');
			//return $msg;			
		}
	}
	
	//
//$email = $_POST['email_id'];
	function sendShareMail($email,$prsntn_name){
		
		ini_set("SMTP",'karbens.com');
		$emailmsg = '';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: e-Detailer <noreply@karbens.com>'. "\r\n";
		$emailmsg.= "<HTML><HEAD><TITLE>Shared Presentation</TITLE></HEAD>";
		$emailmsg.="<BODY>";
		$emailmsg.="<tr style='background: #eee;'><td><strong>Hello." .$email.",</strong></td></tr><br>";
		$emailmsg.="<tr><td style='width:150px'> A Presentation has been shared with you-</td></tr>";
		$emailmsg.="<tr><td style='width:150px'>Presentation name:</td>";
		$emailmsg.="<td style='width:20px'>-</td>";
		$emailmsg.="<td style='font:16px #5A64AB arial;text-decoration:italic;>".$prsntn_name."</td></tr><br>";
		$emailmsg.="<tr><td style='width:150px;height:30px;background:#F1F1F1;border:1px solid;'><a href='http://50.87.74.246/E-detailing/dashboard.php'>Click here to view the presentation</a></td>";
		$emailmsg.="<td style='width:20px'>-</td>";
		$emailmsg.= "</BODY></HTML>";
		
		$to=$email;
		$subject = "Presentation";
		$_SESSION['msg']=" ";

		if(mail($to,$subject,$emailmsg,$headers)){
			echo "Mail Sent";
		}
		else{
			echo "Mail Not Sent-Error";
		}
}