$(document).ready(function(){
	loaduserData(1);
});

function loaduserData(page) {
	
	var data = "&page="+page;
	
	$.ajax({
		url: 'Ajax/userProcess.php',
		type: 'POST',
		data: data,
		cache: false,
		success: function(data){
			if(data == 1){
				$('#usertable').html("<span style='color:#E4E4E4;margin-left:200px;font-size:26px;'>No User's Added</span>");
			} else {
                $('#tbContent').html(data);
			}
		}		
	});
}
$('#tbContent #pagination li.active').live('click',function(){
    var page = $(this).attr('p');
   loaduserData(page);
});

function delUser(id){
	var userId = id;
	var r=confirm("Do You Want To Delete ?");
	
	if (r==true)
	  {
		var delFlag = 2;
		var userData = 'user_id=' + userId + '&queryFlag=' + delFlag;
		$.ajax({
				type:"POST",
				url:"Ajax/userSubmit.php",
				cache: false,
				data: userData,
				success: function(data) {
				alert(data);
				$("#errmsg").val(data);
				$("#errmsg").fadeOut(1500);
				setTimeout("window.location='view_users.php'",1000);
				}
		});
	  
	  }
	/*else
	  {
	  x="You pressed Cancel!";
	  }*/
}


	
	

