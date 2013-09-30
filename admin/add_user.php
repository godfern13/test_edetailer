<?php 
	require_once "library/functions.php";
	sessionCheck();
	if(!(isset($_SESSION["errmsg"]))){
		$_SESSION["errmsg"]="";
	}
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
				min-height:350px;
			}
		</style>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type= "text/javascript" src = "js/user.js"></script>
		<!--Country Drop Down JScript File-->
		<script type= "text/javascript" src = "js/countries.js"></script>
		
		<script>
			$(window).load(function(){
				print_country("country");
				});
			$(function(){
				$('#msgDiv').fadeOut(3000);
			});	
			
		</script>
		
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
					
						<?if($_SESSION['errmsg'] != ""){?>
							<div id="msgDiv" style="display:block"><?echo $_SESSION['errmsg']?></div>
						<?$_SESSION['errmsg'] ="";}?>
						
					<div id="user-form-element" >
					<form name="userForm" action="userSubmit" method="post" >
						<ul>
							<li style="width:200px;">First Name<span style="color:red">*</span></li>
							<li style="width:400px;">
								<span style="float:left;width:400;"><input id="fName" type="text" name="fName" class="userTextBox"></span>
								<span id="errormsg_0_fName" class="errormsg">You can't leave this empty.</span>
							</li>							
							
							<li style="width:200px;">Last Name<span style="color:red">*</span></li>
							<li style="width:400px;">
								<span style="float:left;width:400;"><input id="lName" type="text" name="lName" class="userTextBox"></span>
								<span id="errormsg_0_lName" class="errormsg">You can't leave this empty.</span>
							</li>
							
							
							<li style="width:200px;">Username<span style="color:red">*</span></li>
							<li style="width:400px;">
								<span style="float:left;width:400;"><input id="username" type="text" name="username" class="userTextBox" onChange="checkUserName();"></span>
								<span id="errormsg_0_usrnm" class="errormsg">You can't leave this empty.</span>
								<span id="errormsg_1_usrnm" class="errormsg" style="margin: 0 0 0 5px;width: 120px;"></span>
							</li>
								<input type="hidden" id="valD" name="valD" value="0">
							
														
							<li style="width:200px;">Password<span style="color:red">*</span></li>
							<li style="width:400px;">
								<span style="float:left;width:400;"><input id="pswd" type="password" name="pswd" class="userTextBox"></span>
								<span id="errormsg_0_Pswd" class="errormsg">You can't leave this empty.</span>
							</li>							
							
							<li style="width:200px;">Confirm-Password<span style="color:red">*</span></li>
							<li style="width:400px;">
								<span style="float:left;width:400;"><input id="repswd" type="password" name="repswd" class="userTextBox"></span>
								<span id="errormsg_0_RePswd" class="errormsg">You can't leave this empty.</span>
								<span id="errormsg_1_RePswd" class="errormsg">Password does not Match.</span>
							</li>							
							
							<li style="width:200px;">Country</li>
							<li>
								<select  id="country" name ="country" type="text" maxlength="30"  class="userTextBox"  onchange="print_state('state',this.selectedIndex);">
								</select>
							</li>
							<li style="width:200px;">State</li>
							<li>
								<select id="state" name ="state" type="text" maxlength="30" class="userTextBox">
									<option value='' selected>Select State<option>
								</select>
							</li>	
							<li style="width:200px;">City</li>
							<li><input id="city" type="text" name="city" maxlength="30" class="userTextBox"></li>
							<span id="errormsg_0_City" class="errormsg" role="alert">Enter a Valid City.</span>
							
							<li style="width:200px;">Contact No</li>
							<li><input id="contact" type="text" name="contact" maxlength="30" class="userTextBox"></li>
							<span id="errormsg_0_Contact" class="errormsg">Enter a Valid Contact Number.</span>
							
							<li style="width:200px;">Email-Address<span style="color:red">*</span></li>
							<li style="width:400px;">
								<input id="email" type="text" name="email" maxlength="30" class="userTextBox">
								<span id="errormsg_0_Email" class="errormsg">Enter a Valid Email Address.</span>
								<span id="errormsg_1_Email" class="errormsg">You can't leave this empty.</span>
							</li>
							
							<li style="width:600px;text-align:center;">
							<span>
								<input id="submitbutton" type="submit" name="submitbutton" value="Submit" >
							</span>
							<span>
								<input id="resetbutton" type="reset" name="resetbutton" value="Reset">
							</span>
							</li>
							<input id="queryFlag" type="hidden" name="queryFlag" value="0">
					</form>	
					</div>					
				</div>
				<?
					require_once('include/footer.php');
				?>
			</div>
			
		</div>
	</body>
</html>
