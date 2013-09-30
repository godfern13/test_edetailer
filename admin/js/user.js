function checkUserName(){
	var checkString = $("#username").val();
	var chkFlag		= 0;
	var data        = 'userName='+ checkString + '&flag=' + chkFlag;
 
	if(checkString) {
		$.ajax({
			type: "POST",
			url: "Ajax/check_username.php",
			data: data,
			success: function(data){ // this happen after we get result
				if(data == 1){
					$('#errormsg_1_usrnm').html("<img src='../images/available.png'></img>");
					$("#errormsg_1_usrnm").show();
					$('input#valD').val('0');
					$("#username").css("borderColor", "#EAEAEA");
				}
				else if(data == 2){
					$("#errormsg_1_usrnm").html("<img src='../images/unavailable.png'></img>")
					$("#errormsg_1_usrnm").show();
					$("#username").focus();
					$("#username").css("borderColor", "#ff0000");
					$('input#valD').val('1');
					flag = false;
					return false;
				}
			}
			
		});
	}
}

$(function() { 
	$("#fName").focus();
	
	$("#submitbutton").click(function(){
		var flag = true;
		
		//*****************************FIRST NAME*****************************************//
		var f_name = $.trim($("#fName").val());
		if ( f_name == '' ){ 
				$("#fName").css("borderColor", "#ff0000");
				$("#errormsg_0_fName").show();
				 $("#fName").focus();
				 flag = false;
			}
		$("#fName").keyup(function(){
			$("#errormsg_0_fName").hide();
			$("#fName").css("borderColor", "#EAEAEA");
			//flag = 'true';
			});	
			
		//*****************************LAST NAME*****************************************//
		var l_name = $.trim($("#lName").val());
		if ( l_name == '' ){ 
				$("#lName").css("borderColor", "#ff0000");
				$("#errormsg_0_lName").show();
				 $("#lName").focus();
				 flag = false;
			}
		$("#lName").keyup(function(){
			$("#errormsg_0_lName").hide();
			$("#lName").css("borderColor", "#EAEAEA");
			//flag = 'true';
			});	
		
		//*****************************USERNAME*****************************************//
		var username = $.trim($("#username").val());
		if ( username == '' ){ 
				$("#username").css("borderColor", "#ff0000");
				$("#errormsg_0_usrnm").show();
				 $("#username").focus();
				 flag = false;
			}
		$("#username").keyup(function(){
			$("#errormsg_0_usrnm").hide();
			$("#username").css("borderColor", "#EAEAEA");
			//flag = 'true';
			});			
			
		//*****************************PASSWORD*****************************************//
		var pswd = $.trim($("#pswd").val());
		if (pswd == '' ){ 
				$("#pswd").css("borderColor", "#ff0000");
				$("#errormsg_0_Pswd").show();
				 $("#pswd").focus();
				 flag = false;
			}
		
		$("#pswd").keyup(function(){
			$("#errormsg_0_Pswd").hide();
			$("#pswd").css("borderColor", "#EAEAEA");
			//flag = 'true';
			});
			
		//*****************************CONFIRM PASSWORD*****************************************//
		var repswd = $.trim($("#repswd").val());
		if (repswd== '' ){ 
				$("#repswd").css("borderColor", "#ff0000");
				$("#errormsg_0_RePswd").show();
				$("#repswd").focus();
				flag = false;
			}
		if(pswd != repswd){
			$("#repswd").css("borderColor", "#ff0000");
			$("#errormsg_1_RePswd").show();
			$("#repswd").focus();
			flag = false;
		}
		
		$("#repswd").keyup(function(){
			$("#errormsg_0_RePswd").hide();
			$("#errormsg_1_RePswd").hide();
			$("#repswd").css("borderColor", "#EAEAEA");
			//flag = 'true';
			});
			
		//########EMAIL ADDRESS########//
		
		var email = $.trim($("#email").val());
		if (email == '' ){ 
				$("#email").css("borderColor", "#ff0000");
				$("#errormsg_1_Email").show();
				 $("#email").focus();
				 flag = false;
			}
		
		if($("#email").val()!=''){
			var x= document.getElementById('email').value;
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
			{
				$("#email").css("borderColor", "#ff0000");
				$("#email").focus();
				$("#errormsg_0_Email").show();
				flag = false;
			}
			else{
				$("#errormsg_0_Email").hide();
			//	flag = true;
				}
			}
			$("#email").keyup(function(){
				$("#email").css("borderColor", "#EAEAEA");
				$("#errormsg_0_Email").hide();
				$("#errormsg_1_Email").hide();
			});
			
			/*Check For the username*/
			var u_name = $.trim($('input#valD').val());
			if(u_name == 1){
				$("#username").css("borderColor", "#ff0000");
				$("#errormsg_1_usrnm").show();
				$('#errormsg_1_usrnm').text(rest_username + " already exist");
				$("#username").focus();
				flag = false;
			}
			
			if(flag == true)
			{
				document.forms[0].action="Ajax/userSubmit.php";
				document.forms[0].submit();
			}
			return false;
	});
	
	
	//##############Edit User################//
	$("#editbutton").click(function(){
		var flag = true;
		
		//*****************************FIRST NAME*****************************************//
		var f_name = $.trim($("#fName").val());
		if ( f_name == '' ){ 
				$("#fName").css("borderColor", "#ff0000");
				$("#errormsg_0_fName").show();
				 $("#fName").focus();
				 flag = false;
			}
		$("#fName").keyup(function(){
			$("#errormsg_0_fName").hide();
			$("#fName").css("borderColor", "#EAEAEA");
			//flag = 'true';
			});	
			
		//*****************************LAST NAME*****************************************//
		var l_name = $.trim($("#lName").val());
		if ( l_name == '' ){ 
				$("#lName").css("borderColor", "#ff0000");
				$("#errormsg_0_lName").show();
				 $("#lName").focus();
				 flag = false;
			}
		$("#lName").keyup(function(){
			$("#errormsg_0_lName").hide();
			$("#lName").css("borderColor", "#EAEAEA");
			//flag = 'true';
			});	
		
		//########EMAIL ADDRESS########//
		
		var email = $.trim($("#email").val());
		if (email == '' ){ 
				$("#email").css("borderColor", "#ff0000");
				$("#errormsg_1_Email").show();
				 $("#email").focus();
				 flag = false;
			}
		
		if($("#email").val()!=''){
			var x= document.getElementById('email').value;
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
			{
				$("#email").css("borderColor", "#ff0000");
				$("#email").focus();
				$("#errormsg_0_Email").show();
				flag = false;
			}
			else{
				$("#errormsg_0_Email").hide();
			//	flag = true;
				}
			}
			$("#email").keyup(function(){
				$("#email").css("borderColor", "#EAEAEA");
				$("#errormsg_0_Email").hide();
				$("#errormsg_1_Email").hide();
			});
			
			/*Check For the username*/
			var u_name = $.trim($('input#valD').val());
			if(u_name == 1){
				$("#username").css("borderColor", "#ff0000");
				$("#errormsg_1_usrnm").show();
				$('#errormsg_1_usrnm').text(rest_username + " already exist");
				$("#username").focus();
				flag = false;
			}
			
			if(flag == true)
			{
				//alert('hi');
				document.forms[0].action="Ajax/userSubmit.php";
				document.forms[0].submit();
			}
			return false;
	});
});