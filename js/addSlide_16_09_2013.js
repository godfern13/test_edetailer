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
		
		var data = '&sName=' + name + '&c_id=' + content_id;
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
	
	});
	
	/************** end: functions. **************/
}); // jQuery End
