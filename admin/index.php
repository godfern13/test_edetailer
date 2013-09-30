<?php 
	$error='';
	require_once ("library/functions.php");
	if( isset($_POST['submit']) ) {
		$user = htmlentities($_POST['txtuser']);
		$pass = htmlentities($_POST['txtpass']);
		if($user && $pass){
		 $error=sessionStart($user,$pass);
		 
		}else{
			$error = " <p class='errorMessage' ><strong>Invalid Username or Password</strong></p><br/>";
		}
	} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>e-Detailer-Admin</title>
		<script type="text/javascript">
			function checkForm() {
				if( !document.login.txtuser.value ) {
					alert("Please Enter User Name");
					document.login.txtuser.focus();
					return false;
				}
				if( !document.login.txtpass.value ) {
					alert("Please Enter Password");
					document.login.txtpass.focus();
					return false;
				}
			}
		</script>
		<link rel="stylesheet" type="text/css" src="css/styles.css">
	</head>		
	<body id="body_home">
		<div id="wrapper">
			<div id="mainWrapper">
				<div id="header">
					<div id="logoDiv"></div>
				</div>
				<div id="container">
				<table cellpadding="0" cellspacing="0" border="0" align="center">
					<tr>
						<td width="971" height="204" align="left">
							<div align="center" style=" margin-top:100px;">
								<form name="login" action="index.php" method="post" onSubmit="return checkForm();">
									<table width="40%" border="1" align="center" cellpadding="5" cellspacing="2" bgcolor="#FFFFFF" style="border-collapse:collapse;">
										<tr bgcolor="" align="center" valign="top">
											<td colspan="2">
												<div id="adminlogin" align="center" style="margin-top:10px;">e-Detailing CONTROL PANEL</div><br>
												<?php echo $error; ?>
											</td>
										</tr>
										<tr>
											<td  width="209" height="30" align="right" valign="middle" class="logintxt" ><b>Admin Name </b>&nbsp;</td>
											<td  width="396" align="left" valign="middle">&nbsp;<input name="txtuser" type="text" id="txtuser" /></td>
										</tr>
										<tr>
											<td height="30" align="right" valign="middle" class="logintxt"><b>Password </b>&nbsp;</td>
											<td align="left" valign="middle">&nbsp;<input name="txtpass" type="password" id="txtpass" /></td>
										</tr>
										
										<tr>
											<td height="30" colspan="2" align="center">  
											<div align="center">
												<input  name="submit" type="submit" value="Login" />
											</div></td>
										</tr>
									</table>
							  
									<p>&nbsp;</p>
									<p>&nbsp;</p>
								</form>
							</div>
						</td>
					</tr>
				</table>
				</div>
			</div>
			<div id="footer"></div>
		</div>
		
	</body>
</html>
