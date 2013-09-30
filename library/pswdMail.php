<?php	 	
	ini_set("SMTP",'karbens.com');
	require_once ("include/csGeneral.php");	
	$generalObj = new general();
	
	function sendAdminMail($id,$user_name,$email,$pswd){
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
		//$to = 'godfrey@karbens.com';
		$subject = "Forgot Password";
		//echo $to.'<br>';
		//echo $subject.'<br>';
		//echo $emailmsg.'<br>';
		//echo $headers.'<br>';
		if(mail($to,$subject,$emailmsg,$headers)){
		//echo "Mail Sent To.".$to."";
		//$enc_pswd = md5($pswd);
		$enc_pswd 	= $generalObj->encrypt($pswd);
			$msg = "Mail Sent";
			if($enc_pswd != '')
			{
				$pswdUpdateQry = "UPDATE users SET password='".$enc_pswd."' WHERE id=".$id." AND del_flag=0";
				//echo $pswdUpdateQry;
				$pswdUpdateResult = mysql_query($pswdUpdateQry)or die("Error in connection".mysql_error());
			}
			return $msg;
			//header('Location:index.php');
		}
		else{
			//echo "Mail Not Sent";
			$msg = "Mail Not Sent";
			return $msg;
			
		}
	}