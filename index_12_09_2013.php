<?php 
	$error='';
	require_once ("library/functions.php");
	require_once ("include/csGeneral.php");
	
	$generalObj = new general();
	
	if( isset($_POST['submit']) ) {
		$user	= $generalObj->setFormField($_POST['username']); 
		$pass 	= $generalObj->encrypt($_POST['password']);
		//$pass 	= $_POST['password'];
		if($user && $pass){
		 $error=sessionStart($user,$pass);
		}else{
			$error = " <p class='errorMessage' ><strong>Invalid Username or Password</strong></p><br/>";
		}
	}

	/*if(!(isset($_SESSION["msg"]))){
		$_SESSION["msg"]="";
	}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>e-Detailer</title>
		<link type="image/x-icon" href="images/favicon.ico" rel="shortcut icon">
		<meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1">
		<link rel="stylesheet" type="text/css" href="css/general.css"/>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script src="scripts/placeholder.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			function checkForm() {
				if( !document.login.username.value ) {
					alert("Please Enter User Name");
					document.login.username.focus();
					return false;
				}
				if( !document.login.password.value ) {
					alert("Please Enter Password");
					document.login.password.focus();
					return false;
				}
			}
		
		</script>
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
				<div id="container">
					<div id="loginWrapper">
						<div id="loginDiv">
							<?php echo $error; ?>
							<form name="login" action="index.php" method="post" onSubmit="return checkForm();">
							<ul>
								<!--<li>USERNAME:<li>-->
								<li><input type="text" name="username" id="username" class="loginTextBox" placeholder="USERNAME"><li>
								
								<!--<li>PASSWORD:<li>-->
								<li><input type="password" name="password" id="password" class="loginTextBox" placeholder="PASSWORD"><li>
								
								<li class="loginBtn" style="margin:10px 0 0 0;">
									<input type="submit" name="submit" id="submit" value="Login" class="loginButton">
									<!--LOGIN-->
								</li>
								
								<li style="margin:5px 0 0 0;color:#21146C"><a href="forgot_password.php">Forgot Password</li>
							</ul>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?include('include/footer.php');?>
		</div>
	</body>
</html>