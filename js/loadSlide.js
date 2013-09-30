$(document).ready(function(){
	loadSlides();
});

function loadSlides() {
	
	var userId 		= $.trim($('#userId').val());
	var content_id	= $.trim($('#contentId').val());
	var data = '&id=' + userId + '&c_id='+ content_id;
	$.ajax({
		url: 'Ajax/slideProcess.php',
		type: 'POST',
		data: data,
		cache: false,
		success: function(data){
			if(!data){
				$('#allSlides').html('<span style="color:#E4E4E4;margin:215px;font-size:26px;">No Slides Added</span>');
			} else {
                $('#allSlides').html(data);
			}
		}		
	});
}

