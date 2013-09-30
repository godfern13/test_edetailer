function checkSlide(){
	var name 		= $.trim($('input#slideName').val());
	var id 			= $.trim($('input#cat_id').val());
	var submitFlag	= 5;
	var data 	= 'slideName=' + name + '&slideId=' + id + '&queryFlag=' + submitFlag;
	
	$.ajax({
		type: "POST",
		url: "Ajax/slideSubmit.php",
		data: data,
		success: function(data){ // this happen after we get result
		
			if(data == -1){
				$('#errormsg').html();
				$('input#valD').val('0');
				$('#errormsg').hide();
				
			} else {				
				$('#errormsg').css({ display: "block" });
				$('#errormsg').html(data);
				$("#slideName").focus();
				$("#slideName").css("borderColor", "#ff0000");
				$('input#valD').val('1');
				flag = false;
				return false;
			}
		}
	});	
}

$(function(){
	
	//SAVE PRESENTAION
	$("#slideBtn").click(function() {
		var flag = true;
		var name = $.trim($('#slideName').val());
		var content_id = $('#contentId').val();
		if(name == ''){
			alert('enter slide name');
			flag = false;
		}
		
		var checkedname = $.trim($('input#valD').val());
		if(checkedname == 1){
			$("#slideName").css("borderColor", "#ff0000");
			$("#errormsg").show();
			$('#errormsg').text(name + " already exist");
			$("#slideName").focus();
			flag = false;
		}
		
		if(flag == true){
			var submitFlag = 0;
			var data = '&sName=' + name + '&c_id=' + content_id + '&queryFlag=' + submitFlag;
			$.ajax({
			url: 'Ajax/slideSubmit.php',
			type: 'POST',
			data: data,
			cache: false,
			success: function(data){
				if(!data){
					$('#succesMsg').html('Error');
				} else if(data){
					$('#succesMsg').html(data).fadeOut();
					setTimeout("window.location='slide.php?id="+btoa(data)+"'",1000);
					$('#slideName').val('');
				}
			}
			});
		}
	
	});
	
	/************** end: functions. **************/
}); // jQuery End
