function checkPresention(){
	var name 		= $.trim($('input#prestnName').val());
	var id 			= $.trim($('input#cat_id').val());
	var submitFlag	= 5;
	var data 	= 'presntnName=' + name + '&presntnId=' + id + '&queryFlag=' + submitFlag;
	
	$.ajax({
		type: "POST",
		url: "Ajax/presentnSubmit.php",
		data: data,
		success: function(data){ // this happen after we get result
		
			if(data == -1){
				$('#errormsg').html();
				$('input#valD').val('0');
				$('#errormsg').hide();
				
			} else {				
				$('#errormsg').css({ display: "block" });
				$('#errormsg').html(data);
				$("#prestnName").focus();
				$("#prestnName").css("borderColor", "#ff0000");
				$('input#valD').val('1');
				flag = false;
				return false;
			}
		}
	});	
}


$(function(){	
	//SAVE PRESENTAION
	$("#prestnBtn").click(function() {
		var flag = true;
		var name = $.trim($('#prestnName').val());
		if(name == ''){
			alert('enter presentation name');
			flag = false;
		}
		
		var checkedname = $.trim($('input#valD').val());
		if(checkedname == 1){
			$("#prestnName").css("borderColor", "#ff0000");
			$("#errormsg").show();
			$('#errormsg').text(name + " already exist");
			$("#prestnName").focus();
			flag = false;
		}
		
		if(flag == true){
			var submitFlag = 0;
			var data = '&pName=' + name + '&queryFlag=' + submitFlag;
			//alert(data);
			$.ajax({
			url: 'Ajax/presentnSubmit.php',
			type: 'POST',
			data: data,
			cache: false,
			success: function(data){
				if(data == -1){
					$('#succesMsg').html('Error');
				} else if(data){
					$('#succesMsg').html(data).fadeOut();
					setTimeout("window.location='add_slide.php?id="+btoa(data)+"'",1000);
					//setTimeout("window.location='add_slide.php'");
					$('#prestnName').val('');
				}
			}
			});
		}
	
	});
		
	/************** end: functions. **************/
}); // jQuery End


function publishPresntn(id,msg,status){
	var p_Id = id;
	var r=confirm(msg);
	
	if (r==true)
	  {
		var submitFlag = 2;
		var data = 'pId=' + p_Id + '&pubState=' +status + '&queryFlag=' + submitFlag;
		$.ajax({
			type:"POST",
			url:"Ajax/presentnSubmit.php",
			cache: false,
			data: data,
			success: function()
				{
					setTimeout("window.location='dashboard.php'");
				},
			error: function(request, status, error)
				{
				  // check status && error
				  alert(request.responseText);
			    }
		});
	  
	  }
	/*else
	  {
	  x="You pressed Cancel!";
	  }*/
}

function delPresntn(id,pubState){
	
	if(pubState == 1){
		alert('Cannot Delete! Presentation is being Published.')
	}
	else{
	var p_Id = id;
	var r=confirm("Do You Want To Delete ?");
	
	if (r==true)
	  {
		var submitFlag = 3;
		var data = 'pId=' + p_Id + '&queryFlag=' + submitFlag;
		//alert (catgData);
		$.ajax({
			type:"POST",
			url:"Ajax/presentnSubmit.php",
			cache: false,
			data: data,
			success: function()
				{
					setTimeout("window.location='dashboard.php'");
				},
			error: function(request, status, error)
				{
				  // check status && error
				  alert(request.responseText);
			    }
		});
	  
	  }
	}
	/*else
	  {
	  x="You pressed Cancel!";
	  }*/
}


function sharePresentn(){
	
	var flag = true;
	var submitFlag = 4;
	var prntId = $.trim($("#prntId").val());
	
	var email = $.trim($("#emailId").val());
		if (email == '' ){ 
				$("#emailId").css("borderColor", "#ff0000");
				$("#email_error_0").text('*Required');
				$("#email_error_0").show();
				 $("#emailId").focus();
				 flag = false;
		}
		
		if($("#emailId").val()!=''){
			var x= document.getElementById('emailId').value;
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
			{
				$("#emailId").css("borderColor", "#ff0000");
				$("#emailId").focus();
				$("#email_error_0").text('*Enter Valid email-id');
				$("#email_error_0").show();
				flag = false;
			}
			else{
				$("#email_error_0").hide();
			//	flag = true;
				}
		}
			$("#email").keyup(function(){
				$("#email").css("borderColor", "#EAEAEA");
				$("#email_error_0").hide();
				$("#email_error_0").hide();
			});

		if( flag == true){
			var data = 'email_id=' + email + '&id=' + prntId + '&queryFlag=' + submitFlag;
			//alert(data);
			$.ajax({
			url: 'Ajax/presentnSubmit.php',
			type: 'POST',
			data: data,
			cache: false,
			success: function(data){
				alert(data);
				setTimeout("window.location='dashboard.php'");
			}
			});
		}
}
