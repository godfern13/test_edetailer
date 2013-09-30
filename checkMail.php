<?
	$emailmsg = '';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Doctor Access <noreply@karbens.com>'. "\r\n";
		$emailmsg.= "<HTML><HEAD><TITLE>New Testimonial Details</TITLE></HEAD>";
		$emailmsg.="<BODY>";
		$emailmsg.="<b>Hello  </b>admin ,<br><br>";
		$emailmsg.="<u>New Testimonial Details</u><br>";
		$emailmsg.="<table style='width:450px'>";
		$emailmsg.="<tr><td style='width:200px'>Customer Name </td>";
		$emailmsg.="<td style='width:20px'>-</td>";
		$emailmsg.="<td>".$name."</td></tr>";
		$emailmsg.="<tr><td style='width:200px'>Email Id </td>";
		$emailmsg.="<td style='width:20px'>-</td>";
		$emailmsg.="<td>".$email."</td></tr>";
		$emailmsg.="<tr><td style='width:200px'>Message </td>";
		$emailmsg.="<td style='width:20px'>-</td>";
		$emailmsg.="<td>".$message."</td></tr></table><br><br>";
		$emailmsg.= "</BODY></HTML>";
		$subject = "New Testmonial For Approval";
		$to	=	'mahadev@karbens.com';
		mail($to,$subject,$emailmsg,$headers);
?>