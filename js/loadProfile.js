$(document).ready(function(){
	loadProfile();
});

function loadProfile() {
	
	var userId = $.trim($('#userId').val());
	var data = '&id=' + userId;
	$.ajax({
		url: 'Ajax/profileProcess.php',
		type: 'POST',
		data: data,
		cache: false,
		success: function(data){
			if(data == -1){
				$('#profileWrapper').html('<span style="color:#E4E4E4;margin:215px;font-size:26px;">No Profile Added</span>');
			} else {
				$('#profileWrapper').html(data);
			}
		}		
	});
}

