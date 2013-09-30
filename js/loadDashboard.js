$(document).ready(function(){
	loadDashboard();
});

function loadDashboard() {
	
	var userId = $.trim($('#userId').val());
	var data = '&id=' + userId;
	$.ajax({
		url: 'Ajax/dashboardProcess.php',
		type: 'POST',
		data: data,
		cache: false,
		success: function(data){
			if(data == -1){
				$('#allPresentations').html('<span style="color:#E4E4E4;margin:215px;font-size:26px;">No Presentations Added</span>');
			} else {
                $('#allPresentations').html(data);
			}
		}		
	});
}

