<?php 
	
	$error='';
	require_once ("library/functions.php");
	require_once("library/pswdMail.php");
	require_once("include/csGeneral.php");
	/*if(!(isset($_SESSION["msg"]))){
		$_SESSION["msg"]="";
	}*/
	
	if (isset($_SESSION["userId"]) && $_SESSION["userId"]!='')
	{
		$data = "You are already logged in Please signout first:".$_SESSION["uname"]." ";
	}
	else{
		if( isset($_POST['submit']) ) {
	
			$user_name 	= $_POST['username'];
			$pswdQry 	= "SELECT * FROM users WHERE username='".$user_name."' AND del_flag=0";
			//echo $pswdQry;
			$pswdResult = mysql_query($pswdQry)or die('Error in connection'.mysql_error());
			$pswdNums	= mysql_num_rows($pswdResult);
			if($pswdNums>0){
				$rows 		= mysql_fetch_assoc($pswdResult);
				$id 	= $rows['id'];
				$email 	= $rows['email_id'];
				$allowed_chars = 'abcdefghijklmnopqrstuvwxz';
				$allowed_count = strlen($allowed_chars);
				$password = null;
				$password_length = 7;

					while($password === null) {
						$password = '';
						for($i = 0; $i < $password_length; ++$i) {
							$password .= $allowed_chars{mt_rand(0, $allowed_count - 1)};
						}
					}
					sendAdminMail($id,$user_name,$email,$password);
			}
			
			else{
				echo "<script>alert('Invalid Username');</script>";
			}
		}
		
		$data = "<div id='frgtPswdDiv'>
						".$error."
						<form name='login' action='forgot_password.php' method='post'onSubmit='return checkForm();' >
						<ul>
							<li style='width:150px;'>Enter username:</li>
							<li style='width:204px;'>
								<input type='text' name='username' id='username' class='loginTextBox' placeholder='USERNAME'>
							</li>
							
							<li class='loginBtn' style='width:400px;'>
								<input type='submit' name='submit' id='submit' value='Submit' >
							</li>
						</ul>
						</form>
					</div>";
	}
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>e-Detailer</title>
		<meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1">
		<link rel="stylesheet" type="text/css" href="css/general.css"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		
		<script type="text/javascript">
			function checkForm() {
				
				var username = document.getElementById('username').value;
				if(username == ''){
				alert("Enter username");
				return false;
				}
				
				/*if( !document.login.username.value ) {
					alert("Please Enter User Name");
					document.login.username.focus();
					return false;
				}*/
				
			}
		</script>
		<style>
			#container{
				min-height:463px;
				margin: 100px 0 0 360px;
			}
		</style>
		<script>
		$(function(){
			$("#errormsg").fadeOut(3000);
		});
		
		</script>
	</head>
	
	<body>
		<div id="wrapper">
		<?include('include/header.php');?>
			<div id="mainWrapper">
				<div id="container">
				<?
					if($_SESSION["msg"]!=""){
					?>
					<div id="errormsg" style="display:block;">
					<?
						echo $_SESSION["msg"];
						$_SESSION["msg"] = "";
					?>
					</div>
				<?}?>
				<div id="errormsg" style="margin:-35px 0 0 30px;display:none"><?echo $_SESSION["msg"]; ?></div>
					<?echo $data;?>								
				</div>
			</div>
			<?include('include/footer.php');?>
		</div>
	</body>
</html>