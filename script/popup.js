jQuery(function($) {

	$(".addbtn").click(function() {
			loading(); // loading
			//setTimeout(function(){ // then show popup, deley in .5 second
				loadPopup(); // function show popup
			//}, 500); // .5 second
	return false;
	});
	
	$(".addbtn2").click(function() {
			var contentId = $(this).attr('id');
			var id = contentId.split('#');
			$('#prntId').val(id[1]);
			//alert(contentId);
			loading(); // loading
			//setTimeout(function(){ // then show popup, deley in .5 second
				loadPopup2(); // function show popup
			//}, 500); // .5 second
	return false;
	});

	/* event for close the popup */
	$("div.close").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);

	$("div.close").click(function() {
		disablePopup();  // function close pop up
	});

	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup();  // function close pop up
		}
	});

        $("div#backgroundPopup").click(function() {
		disablePopup();  // function close pop up
	});

	$('a.livebox').click(function() {
		alert('Hello World!');
	return false;
	});

	 /************** start: functions. **************/
	function loading() {
		$("div.loader").show();
	}
	function closeloading() {
		$("div.loader").fadeOut('normal');
	}

	var popupStatus = 0; // set value

	function loadPopup() {
		if(popupStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001);
			popupStatus = 1; // and set value to 1
		}
	}
	
	function loadPopup2() {
		if(popupStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#sharePopup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001);
			popupStatus = 1; // and set value to 1
		}
	}

	function disablePopup() {
		if(popupStatus == 1) { // if value is 1, close popup
			$('#prestnName').val('');
			$("#prestnName").css("borderColor", "");
			$('#slideName').val('');
			$("#slideName").css("borderColor", "");
			$('#errormsg').hide();
			$("#sharePopup").fadeOut("normal");
			$("#toPopup").fadeOut("normal");
			$("#backgroundPopup").fadeOut("normal");
			popupStatus = 0;  // and set value to 0
			
		}
	}
});