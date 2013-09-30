<?php 
	require_once "library/functions.php";
	sessionCheck();
	require_once ("../include/csGeneral.php");
	
	$generalObj = new general();
	
	if(!(isset($_SESSION["errmsg"]))){
		$_SESSION["errmsg"]="";
	}
	
	$user_id 		= base64_decode($_GET['id']);
	$userQry 		= "SELECT * FROM users WHERE id=".$user_id." AND u_type=1 AND del_flag=0";
	$userResult 	= mysql_query($userQry)or die('Error in connection'.mysql_error());
	$user_num_rows 	= mysql_num_rows($userResult);
	
	while($rows = mysql_fetch_assoc($userResult))
	{
		$userId			= $rows['id'];
		$user_fullname	= $generalObj->getFormField($rows['name']);
		$nameArr		= explode(" ",$user_fullname);
		$f_name			= $nameArr[0];
		$l_name			= $nameArr[1];
		$user_cntry		= $rows['country'];		
		$user_state		= $rows['state'];
		$user_city		= $rows['city'];
		$user_no		= $rows['contact'];
		$user_email		= $rows['email_id'];
		
		if($user_no == 0){
			$user_no = '';
		}
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
				min-height:420px;
			}
		</style>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type= "text/javascript" src = "js/user.js"></script>
		<!--Country Drop Down JScript File-->
		<script type= "text/javascript" src = "js/editcountries.js"></script>
		
		<script>
			$(window).load(function(){
				print_country("country");
				});
				
			$('#msgDiv').fadeOut('slow');
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
					<h2 style="text-decoration:underline;">Edit User</h2>
					<form name="usereditForm" action="usereditSubmit" method="post" >
						<ul>
							<li style="width:200px;">First Name<span style="color:red">*</span></li>
							<li style="width:400px;">
								<span style="float:left;width:400;">
									<input id="fName" type="text" name="fName" value="<?echo $f_name;?>" class="userTextBox">
								</span>
								<span id="errormsg_0_fName" class="errormsg">You can't leave this empty.</span>
							</li>							
							
							<li style="width:200px;">Last Name<span style="color:red">*</span></li>
							<li style="width:400px;">
								<span style="float:left;width:400;">
									<input id="lName" type="text" name="lName" value="<?echo $l_name;?>" class="userTextBox">
								</span>
								<span id="errormsg_0_lName" class="errormsg">You can't leave this empty.</span>
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
							<li><input id="city" type="text" name="city" maxlength="30" value="<?echo $user_city;?>" class="userTextBox"></li>
							<span id="errormsg_0_City" class="errormsg" role="alert">Enter a Valid City.</span>
							
							<li style="width:200px;">Contact No</li>
							<li><input id="contact" type="text" name="contact" maxlength="30" value="<?echo $user_no;?>" class="userTextBox"></li>
							<span id="errormsg_0_Contact" class="errormsg">Enter a Valid Contact Number.</span>
							
							<li style="width:200px;">Email-Address<span style="color:red">*</span></li>
							<li style="width:400px;">
								<input id="email" type="text" name="email" maxlength="30" value="<?echo $user_email;?>" class="userTextBox">
								<span id="errormsg_0_Email" class="errormsg">Enter a Valid Email Address.</span>
								<span id="errormsg_1_Email" class="errormsg">You can't leave this empty.</span>
							</li>
							
							<li style="width:600px;text-align:center;">
							<span>
								<input id="editbutton" type="button" name="editbutton" value="Submit">
							</span>
							<span>
								<input id="resetbutton" type="reset" name="resetbutton" value="Reset">
							</span>
							</li>
							<input type="hidden" name="cntry" id="cntry" value="<? echo $user_cntry?>">
							<input type="hidden" name="exstate" id="exstate" value="<? echo $user_state?>">
							<input id="user_id" type="hidden" name="user_id" value="<? echo $userId?>">
							<input id="queryFlag" type="hidden" name="queryFlag" value="1">
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
