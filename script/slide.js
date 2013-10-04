$(document).ready(function(){

	sessionStorage.clear();
	/*******GLOBAL VAR*********
	*******************************/
	var counter = 0;
	var zindexval = 5000;
	/*******************************
	********************************/
	
	/*-------------------------------------On page load Get Parent Frame Specification ----------------------------------*/
	getParentSpec();	
	
	/********************************************************************
	******************Getting the X and Y axis of the frame*************
	********************************************************************/
	var offset2 = $("#frame").offset();
	var w = $(window);
	var parentX = 	(offset2.left-w.scrollLeft());
	var parentY	=	(offset2.top-w.scrollTop());
	// Save data to the current session's store
	sessionStorage.setItem("parentX", parentX);
	sessionStorage.setItem("parentY", parentY);
	/********************************************************************
	********************************************************************
	********************************************************************/
	
	$("#frame").click(function()
	{
		getParentSpec();
		$('.selected').removeClass('selected');
	});
	
	
	/***************************************************************
	**********Dragging an element from the tools box****************
	****************************************************************/
	/*-------------------------------------- function to drag an element -------------------------------------*/
	$(".drag").draggable({
		helper:'clone',
		containment: '#frame',
		/*--------------------------------------- first time drag -----------------------------------------------*/
		stop:function(ev, ui) { 
			$(this).css("z-index", zindexval); 
			if(ui.helper.attr('id') == 'drag1'){ var childType=1;}//Text
			else if(ui.helper.attr('id') == 'drag2'){ var childType=2;}//Image
			else if(ui.helper.attr('id') == 'drag3'){ var childType=3;}//Video
			else if(ui.helper.attr('id') == 'drag4'){ var childType=4;}//References
			
			var pos=$(ui.helper).offset();
			objName = "#clonediv"+counter;
			//************************************** ChangeMahadev 03-10-2013 *********************************//
			if(pos.left > '722.5'){pos.left = '722.5px'}
			if(pos.top > '614'){pos.top = '615px'}
			//*************************************** CHANGE ENDS *****************************************//
			$(objName).css({"left":pos.left,"top":pos.top});
			$(objName).removeClass("drag");
			
			/*------------------------------------------- drag element within the frame --------------------------------*/
			$(objName).draggable({
				containment: '#frame',
				stop:function(ev, ui) {  
					var pos=$(ui.helper).offset();
					console.log($(this).attr("id"));
					console.log(pos.left)
					console.log(pos.top);
					/*----------------------------------------- Function To Get Coordinates ----------------------------------*/
					var cordData = calCordinates(parentX,parentY,counter,childType);
				}
			});//.resizable({ handles: "n, e, s, w" });
			//$(objName).resizable({ handles: "n, e, s, w" });
			/*----------------------------------------- Function To Get Cordinates ----------------------------------*/
				var cordData = calCordinates(parentX,parentY,counter,childType);
		}
	});
	/*------------------------------------------ drop an element function -----------------------------------------------*/
	
	
	$("#frame").droppable({ 
		drop: function(ev, ui) { 
			
			if(ui.helper.attr('id') == 'drag1'){ var childType=1;}//Text
			else if(ui.helper.attr('id') == 'drag2'){ var childType=2;}//Image
			else if(ui.helper.attr('id') == 'drag3'){ var childType=3;}//Video
			else if(ui.helper.attr('id') == 'drag4'){ var childType=4;}//References
		
			if (ui.helper.attr('id').search(/drag[0-9]/) != -1){
				counter++;
				zindexval++;
				var element=$(ui.draggable).clone();
				objName = "#clonediv"+counter;
				element.addClass("tempclass");
				$(this).append(element);
				$(".tempclass").attr("id","clonediv"+counter);
				$("#clonediv"+counter).removeClass("tempclass");
				$(objName).resize();
				sessionStorage.setItem("#clonediv"+counter, "#clonediv"+counter);
				sessionStorage.setItem("childType"+counter, childType);
				
				$(objName).css({'z-index':zindexval});
				if(childType ==1){
					$("#clonediv"+counter).addClass("text");
					
				}
				else if(childType ==2){
					$("#clonediv"+counter).addClass("image");
				}
				else if(childType ==3){
					$("#clonediv"+counter).addClass("video");
				}
				if(childType ==4){
					$("#clonediv"+counter).addClass("ref");
					var refText = '';
					//Creation of hidden field for Reference
					var hiddenRefText = document.createElement("input");
					//Assign different attributes to the element.
					hiddenRefText.setAttribute("type", 'hidden');
					hiddenRefText.setAttribute("id", 'childRefLink1-'+counter);
					hiddenRefText.setAttribute("class", 'refTextClass');
					hiddenRefText.setAttribute("name", 'childRefLink1-'+counter);
					hiddenRefText.setAttribute("value", refText);
					
					var refBtn = document.getElementById('clonediv'+counter);
					refBtn.appendChild(hiddenRefText);
				}				
				$(objName).bind("click", function (event) {
					
					//var counter 	= childId.match(/\d+$/)[0];
					//var childName 	= 'child'+(i+1);
					counter = this.id.match(/\d+$/)[0];
					//alert(counter);
					
	
					getChildSpecifications(counter);
					event.stopPropagation();
					//showChildSpec(counter);
				});
				
			
				/*---------------------------------- Get the dynamically item id -------------------------------*/
				draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
				if(ui.helper.attr('id') == 'drag4'){ itemDragged = "dragged2" }
				else{itemDragged = "dragged1"}
				console.log(itemDragged)
				$("#clonediv"+counter).addClass(itemDragged);
				//var cordData = calCordinates(parentX,parentY,counter,childType);
				
				getChildSpecifications(counter);
				//$(objName).resize();				
			}
		}
	});
	
	
	/***************************************************************
	****************Moving an element to FRONT/BACK*****************
	****************************************************************/
	
	$('#sndbk').click(function(event){
					
		var divId = $('.selected').attr('id');
		var currIndex = $('.selected').css('z-index');
		var indexArray = [];
		$('.dragged1 ').each(function () {
			 indexArray.push($(this).css('zIndex'));
		});
		var minIndex = Math.min.apply(Math,indexArray);//Getting minimum index value
		var newIndex  = minIndex - 1;
		$('#'+divId).css({'z-index':newIndex});
		event.stopPropagation();
	});
	
	$('#bngfrnt').click(function(event){
					
		var divId = $('.selected').attr('id');
		var currIndex = $('.selected').css('z-index');
		var indexArray = [];
		$('.dragged1 ').each(function () {
			 indexArray.push($(this).css('zIndex'));
		});
		var maxIndex = Math.max.apply(Math,indexArray);//Getting maximum index value
		var newIndex  = maxIndex + 1;
		$('#'+divId).css({'z-index':newIndex});
		event.stopPropagation();
	});
	
	/***************************************************************
	*******************Hiding/Showing the tool box******************
	****************************************************************/
	
	/*var shwStatus = false;
	$('#hdToolKit').click(function(event){
		if(shwStatus == false){
			$('#hdToolKit').text('show');
			var frmWidth = $('#frame').css('width');
			alert(frmWidth);
			//$('#frame').css({'width':});299px
			shwStatus = true;
		}
		else{
			$('#hdToolKit').text('hide');
			shwStatus = false;
		}
		$('#rightDiv').toggle( "slide",{ direction: "right" });
		event.stopPropagation();
	});*/
	$( "#rightDiv" ).draggable({ containment: "window" });
	
});

/********************************************************************************************************************
											PARENT FUNCTIONS START
*********************************************************************************************************************/

/*--------------------------------------------- Add Parent Specification Function ------------------------------------*/
/*function addParentSpec()
{ 
	var offset2 = $("#frame").offset();
	var w = $(window);
	var parentX = 	(offset2.left-w.scrollLeft());
	var parentY	=	(offset2.top-w.scrollTop());
	
	var parentWdth	=	$("#frame").width();
	var parentHght	=	$("#frame").height();
	var rgb	=	$("#frame").css("background-color");
	
	rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    var parentBgClr = hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);

	
	var parentName	=	$("#sepcName").val();
	var pBgImgName	=	$("#pBgImgName").val();
	var dataString	=	'parentWdth='+parentWdth+'&parentHght='+parentHght+'&parentBgClr='+parentBgClr+'&parentName='+parentName+'&pBgImgName='+pBgImgName+'&parentX='+parentX+'&parentY='+parentY;
	$.ajax({
		type: "POST",
		url: "Ajax/addParSpec.php",
		cache: false,
		data: dataString,
		success: function(data) { 
			$('#specfcatnDiv').html(data);
			$('#specLoader').hide();
			$('#sepcWdth').attr("disabled", true);
			$('#sepcHght').attr("disabled", true);
		}
	});
}*/
/*------------------------------------ OnChange Function ------------------------------------------------*/
function chngeParSpec()
{
	var SesParNme	=	$('input#sepcName').val();
	document.getElementById('paentName').value = SesParNme;
}

/*------------------------------------- On click On Frame Function ------------------------------*/
/*function showParSpec()
{
	//$('#frame').click( function(event) {
		//if(event.target.id == 'frame')
		//{
			$.ajax({
				type: "POST",
				url: "Ajax/showParSpec.php",
				cache: false,
				success: function(data) { 
					$('#specfcatnDiv').html(data);
				}
			});
		//}
	//});
}*/

/********************************************************************************************************************
											PARENT FUNCTIONS ENDS
*********************************************************************************************************************/


/********************************************************************************************************************
											CHILD FUNCTION START
*********************************************************************************************************************/

/*----------------------------------- Get Child Cordinates Function ---------------------------------*/
function calCordinates(parentX,parentY,counter,childType)
{	
	//$("#clonediv"+counter).click(function(){showChildSpec(counter)});
	var offset 	= 	$("#clonediv"+counter).offset();
	var w = $(window);
	var width	=	$("#clonediv"+counter).width();
	var height	=	$("#clonediv"+counter).height();
	var	insideX1	=	parseFloat(offset.left-w.scrollLeft())-parseFloat(parentX);
	var	insideY1	=	parseFloat(offset.top-w.scrollTop())-parseFloat(parentY);
	var	insideX2	=	parseFloat(insideX1)+parseFloat(width);
	var	insideY2	=	parseFloat(insideY1)+parseFloat(height);
	var corData	=	("(x1,y1) => "+insideX1+","+insideY1 +" || (x2,y1)==>" +insideX2+","+insideY1 +" || (x1,y2)==>" +insideX1+","+insideY2 +" || (x2,y2)==>" +insideX2+","+insideY2);
	$("#div_id").data("data",{pX:parentX,pY:parentY,cX:insideX1,cY:insideY1,cW:width,cH:height});
	$("#chldImg"+counter).attr({width: width});
	$("#chldImg"+counter).attr({height: height});
	getChildSpecifications(counter);
}
/*----------------------------------------- Add Child Specification ----------------------------------------------*/
/*function addChildSpec(childWdth,childHeght,counter,chldX,chldY,childType)
{ 
	$('#specLoader').show();
	var childImgPath	=	$('input#chldImgName'+counter).val();
	var childText		=	$('textarea#chldTxt'+counter).val();
	var childTextClr	=	$('select#chldTxtClr'+counter).val();
	var childTextSize	=	$('select#chldTxtSize'+counter).val(); 
	var childVdoPath	=	$('input#childVdoPath'+counter).val(); 
	var childRefLink	=	$('input#childRefLink'+counter).val(); 
	var childRefPath	=	$('input#chldRefBgImg'+counter).val(); 
	var dataString		=	'childWdth='+childWdth+'&childHght='+childHeght+'&chldCnt='+counter+'&chldX='+chldX+'&chldY='+chldY+'&childType='+childType+'&childImgPath='+childImgPath+'&childText='+childText
						+'&childTextClr='+childTextClr+'&childTextSze='+childTextSize+'&childVdoPath='+childVdoPath+'&childRefLink='+childRefLink+'&childRefPath='+childRefPath;
	
	$.ajax({
		type: "POST",
		url: "Ajax/addChldSpec.php",
		cache: false,
		data: dataString,
		success: function(data) { 
			$('#specfcatnDiv').html(data);
			$('#specLoader').hide();
		}
	});
}*/
/*------------------------------------- On Change Function ----------------------------------------------*/
function chngChldSpec(chldCunt,childType)
{	
	var childWdth	=	parseFloat($('input#chldWdth').val());
	$("#clonediv"+chldCunt).css("width",childWdth);
	var childHeght	=	parseFloat($('input#chldHght').val());
	$("#clonediv"+chldCunt).css("height",childHeght);
	
	if(childType == 2){
		$('#chldImg'+chldCunt).css("width",childWdth);
		$('#chldImg'+chldCunt).css("height",childHeght);
	}
	if(childType == 3){	
		$("#chldVdO"+chldCnt).attr({width: childWdth});
		$("#chldVdO"+chldCnt).attr({height: childWdth});
	}
	if(childType == 4){
		$('#chldRefImg'+chldCunt).css("width",childWdth);
		$('#chldRefImg'+chldCunt).css("height",childHeght);
	}
	
	sessionStorage.getItem("width"+chldCunt,childWdth);
	sessionStorage.getItem("height"+chldCunt,childHeght);
}
/*------------------------------------ OnClick of Child Div function --------------------------------------*/
/*function showChildSpec(counter)
{	
	var dataStrng	=	'cunt='+counter;
	$.ajax({
		type: "POST",
		url: "Ajax/showChldSpec.php",
		cache: false,
		data: dataStrng,
		success: function(data) { 
			$('#specfcatnDiv').html(data);
		}
	});
}*/
/*------------------------------------- Text Child Function -------------------------------------------*/
function changeChildText(chldCunt,childType)
{	
	var childText	=	$('textarea#chldTxt'+chldCunt).val();
	$("#clonediv"+chldCunt).html(childText);
	
	var childWdth	=	parseFloat($('input#chldWdth').val());
	var childHeght	=	parseFloat($('input#chldHght').val());
	var childX		=	parseFloat($('input#childX').val());
	var childY		=	parseFloat($('input#childY').val());
	addChildSpec(childWdth,childHeght,chldCunt,childX,childY,childType);
}

function changeChildTextClr(chldCunt,childType)
{
	var textColor	=	$('select#chldTxtClr'+chldCunt).val();
	if(textColor != ""){
		$("#clonediv"+chldCunt).css("color",'#'+textColor);
	}
	else{
		textColor	=	'#000';
		$("#clonediv"+chldCunt).css("color",textColor);
	}
	
	var childWdth	=	parseFloat($('input#chldWdth').val());
	var childHeght	=	parseFloat($('input#chldHght').val());
	var childX		=	parseFloat($('input#childX').val());
	var childY		=	parseFloat($('input#childY').val());
	addChildSpec(childWdth,childHeght,chldCunt,childX,childY,childType);
}
function changeChildTextSize(chldCunt,childType)
{ 
	var textSize	=	$('select#chldTxtSize'+chldCunt).val();
	if(textSize != ""){
		var textSizeV	=	textSize+'px';
		$("#clonediv"+chldCunt).css("font-size",textSizeV);
	}
	else{
		var textSizeV	=	'8px';
		$("#clonediv"+chldCunt).css("font-size",textSizeV);
	}
	var childWdth	=	parseFloat($('input#chldWdth').val());
	var childHeght	=	parseFloat($('input#chldHght').val());
	var childX		=	parseFloat($('input#childX').val());
	var childY		=	parseFloat($('input#childY').val());
	addChildSpec(childWdth,childHeght,chldCunt,childX,childY,childType);
}
function changeFntWght(fontWght,chldCunt,childType)
{
	if(fontWght == 1)
	{	
		if($("#clonediv"+chldCunt).css("font-weight") == '700'){$("#clonediv"+chldCunt).css("font-weight",'normal');}
		else{$("#clonediv"+chldCunt).css("font-weight",'bold')};
	}
	if(fontWght == 2)
	{	
		if($("#clonediv"+chldCunt).css("font-style") == 'italic'){$("#clonediv"+chldCunt).css("font-style",'normal');}
		else{$("#clonediv"+chldCunt).css("font-style",'Italic')};
	}
	if(fontWght == 3)
	{	
		if($("#clonediv"+chldCunt).css("text-decoration") == 'underline'){$("#clonediv"+chldCunt).css("text-decoration",'none');}
		else{$("#clonediv"+chldCunt).css("text-decoration",'underline')};
	}
}
/*------------------------------------------- Set Image To Child Background --------------------------------*/
function ChldBgImgURL(upload_field,childType,chldCunt) { 
	if (upload_field.files && upload_field.files[0]) {
		var reader = new FileReader();
		var re_text = /\.jpg|\.gif|\.jpeg/i;
		var filename = upload_field.value;
		if (filename.search(re_text) == -1) {
			alert("File should be either jpg or gif or jpeg");
			$("#clonediv"+chldCunt).find('span.imgData').html("Image");
			return false;
		}
		else
		{
			reader.onload = function (e) { 
				var img = new Image();
				var chldWdth	=	$('input#chldWdth').val();
				var chldHght	=	$('input#chldHght').val();
				$('chldImg'+chldCunt).addClass('source-image');
				var ImgTag		=	'<img id="chldImg'+chldCunt+'" src="'+e.target.result+'" class="source-image" />';
				$("#clonediv"+chldCunt).find('span.imgData').html(ImgTag);
				$("#chldImg"+chldCunt).attr({width: chldWdth});
				$("#chldImg"+chldCunt).attr({height: chldHght});
				
				/*---------------------------------------------- Upload Image To Server Script --------------------------------*/
	
				upload_field.form.action = 'uploadChildImg.php';
				upload_field.form.target = 'upload_iframe';
				upload_field.form.submit();
				upload_field.form.action = '';
				upload_field.form.target = '';
				//document.getElementById('chldImgName'+chldCunt).value = filename;
				sessionStorage.setItem("chldImgName"+chldCunt, filename);
				
				/*var childX		=	parseFloat($('input#childX').val());
				var childY		=	parseFloat($('input#childY').val());
				addChildSpec(chldWdth,chldHght,chldCunt,childX,childY,childType);*/
			};
			reader.readAsDataURL(upload_field.files[0]);
		}
	}
}
function ChldRefBgImgURL(upload_field,childType,chldCunt)
{
	
	if (upload_field.files && upload_field.files[0]) {
  var reader = new FileReader();
  var re_text = /\.jpg|\.gif|\.jpeg/i;
  var filename = upload_field.value;
  if (filename.search(re_text) == -1) {
   alert("File should be either jpg or gif or jpeg");
   $("#clonediv"+chldCunt).find('span.imgRefData').html('References');
   return false;
  }
  else
  {
   reader.onload = function (e) { 
    var img = new Image();
    var chldWdth = $('input#chldWdth').val();
    var chldHght = $('input#chldHght').val();
    var ImgTag  = '<img id="chldRefImg'+chldCunt+'" src="'+e.target.result+'" class="source-image" />';
	$("#clonediv"+chldCunt).find('span.imgRefData').html(ImgTag);
    $("#chldRefImg"+chldCunt).attr({width: chldWdth});
    $("#chldRefImg"+chldCunt).attr({height: chldHght});
    
    /*---------------------------------------------- Upload Image To Server Script --------------------------------*/
    upload_field.form.action = 'uploadChildRefImg.php';
    upload_field.form.target = 'upload_iframe';
    upload_field.form.submit();
    upload_field.form.action = '';
    upload_field.form.target = '';
	sessionStorage.setItem("chldRefBgImg"+chldCunt, filename);
   };
   reader.readAsDataURL(upload_field.files[0]);
  }
}
}
/*------------------------------------- Function to change Child Video ----------------------------------*/
function changeChildVdo(upload_field,childType,chldCunt)
{
	if (upload_field.files && upload_field.files[0]) {
		var reader = new FileReader();
		var re_text = /\.mp4/i;
		var vidFlieName = upload_field.value;
		if (vidFlieName.search(re_text) == -1) {
			alert("Only mp4 Files");
			$('#clonediv'+chldCunt).html('Video');
			return false;
		}
		else{
			reader.onload = function (e) { 
				var childWdth	=	$('#chldWdth').val();
				var childHeght	=	$('#chldHght').val();
				var vdoTag		=	'<video id="childVdo'+chldCunt+'" controls><source src="'+e.target.result+'" type="video/mp4"></video>';
				$("#clonediv"+chldCunt).find('span.vdoData').html(vdoTag);
				//$('#clonediv'+chldCunt).html(vdoTag);
				$("#childVdo"+chldCunt).attr({width: childWdth});
				$("#childVdo"+chldCunt).attr({height: childHeght});
				
				/*------------------- Upload Video -------------------------------------------*/
				upload_field.form.action = 'uploadChildVdo.php';
				upload_field.form.target = 'upload_iframe';
				upload_field.form.submit();
				upload_field.form.action = '';
				upload_field.form.target = '';
				sessionStorage.setItem("chldVdoName"+chldCunt, vidFlieName);
				
				/*var childX		=	parseFloat($('input#childX').val());
				var childY		=	parseFloat($('input#childY').val());
				addChildSpec(childWdth,childHeght,chldCunt,childX,childY,childType);*/
			};
			reader.readAsDataURL(upload_field.files[0]);
		}
	}
}

/********************************************************************************************************************
											CHILD FUNCTION ENDS
*********************************************************************************************************************/


/**************************** function to generate an XML file*******************/
/*function saveDta()
{
	var parntX	=	$('#div_id').data("data").pX;
	var parntX	=	$('#div_id').data("data").pY;	
	var chldX	=	$('#div_id').data("data").cX;
	var chldY	=	$('#div_id').data("data").cY;
	var chldWd	=	$('#div_id').data("data").cW;
	var chldHg	=	$('#div_id').data("data").cH;			
	var dataString	=	"chldX="+chldX+"&chldY="+chldY+"&chldWd="+chldWd+"&chldHg="+chldHg;
	$.ajax({
		type: "POST",
		url: "slideXml.php",
		cache: false,
		data: dataString,
		success: function(data) {alert('sucess')
		}
	});
}*/




/*--------------------------------------------------------------SPECIFICATIONS-------------------------------------------*/
/*******************
##################################################################PARENT####################################################
*******************/
function getParentSpec(){

	var offset2 = $("#frame").offset();
	var w = $(window);
	var parentX = 	(offset2.left-w.scrollLeft());
	var parentY	=	(offset2.top-w.scrollTop());
	
	var parentName 		=	document.getElementById('paentName').value;
	var parentWdth	=	$("#frame").width();
	var parentHght	=	$("#frame").height();
	var pBgImgName	=	$("#pBgImgName").val();
	
	/*var rgb	=	$("#frame").css("background-color");
	alert(rgb);
	if(rgb != "")
	{
		rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		function hex(x) {
			return ("0" + parseInt(x).toString(16)).slice(-2);
		}
		var parentBgClr = hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
	}
	
	var parentName	=	$("#sepcName").val();
	var pBgImgName	=	$("#pBgImgName").val();
	
	//creating an color array
	var colorArray = 	[ 	'ffffff','ffce93','fffc9e','ffffc7','9aff99','96fffb','cdffff','185871','cbcefb','cfcfcf','fd6864',
							'fe996b','fffe65','fcff2f','67fd9a','38fff8','68fdff','9698ed','c0c0c0','fe0000','f8a102','ffcc67',
							'f8ff00','34ff34','68cbd0','34cdf9','6665cd','9b9b9b','cb0000','f56b00','ffcb2f','ffc702','32cb00',
							'00d2cb','3166ff','6434fc','656565','9a0000','ce6301','cd9934','999903','009901','329a9d','3531ff',
							'6200c9','343434','680100','963400','986536','646809','036400','34696d','00009b','303498','000000',
							'330001','643403','663234','343300','013300','003532','010066','340096'];
	*/
	//$( "#specfcatnDiv" ).html( "<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications</td></tr><tr height='5px'></tr><tr><td>Name</td><td>:</td><td><input type='text' name='sepcName' id='sepcName' onchange='return chngeParSpec()' value='test'/></td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='sepcWdth' id='sepcWdth' value='"+parentWdth+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='sepcHght' id='sepcHght' value='"+parentHght+"'/></td></tr><tr height='5px'></tr><tr><td>Bg Color</td><td>:</td><td><select id='sepcBgColor' name='sepcBgColor' onchange='return chngeParBgColor()' style='width:120px'><option>fe996b</option><option>fe896b</option></select></tr><tr height='5px'></tr><tr><td>Bg Image</td><td>:</td><td><form name='parentImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'><input type='file' name='sepcBgImg' id='sepcBgImg' onchange='return ParntBgImgURL(this)'/></form><input type='hidden' name='pBgImgName' id='pBgImgName' value='testimg' /></td></tr></table>");
	$( "#specfcatnDiv" ).html( "<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications</td></tr><tr height='5px'></tr><tr><td>Name</td><td>:</td><td><input type='text' name='sepcName' id='sepcName' onchange='return chngeParSpec()' value='test'/></td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='sepcWdth' id='sepcWdth' value='"+parentWdth+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='sepcHght' id='sepcHght' value='"+parentHght+"'/></td></tr><tr height='5px'></tr><tr height='5px'></tr><tr><td>Bg Image</td><td>:</td><td><form name='parentImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'><input type='file' name='sepcBgImg' id='sepcBgImg' onchange='return ParntBgImgURL(this)'/></form><input type='hidden' name='pBgImgName' id='pBgImgName' value='testimg' /></td></tr></table>");
	// Save parent data to the current session's store
	sessionStorage.setItem("parentName", parentName);
	sessionStorage.setItem("pBgImgName", pBgImgName);
	sessionStorage.setItem("parentWdth", parentWdth);
	sessionStorage.setItem("parentHght", parentHght);
	//sessionStorage.setItem("parentBgColor", rgb);

}
/**###############################Change Parent Bg-Color###############################**/
function chngeParBgColor(){
	
	var color = '#'+$("#sepcBgColor option:selected").text();
	$('#frame').css('background-color',color);
	sessionStorage.setItem("parentBgColor", color);
}

/**###############################Change Parent Bg-Image###############################**/
/*------------------------------------------- Set Image To Frame Background --------------------------------*/
function ParntBgImgURL(upload_field) { 
	if (upload_field.files && upload_field.files[0]) {
		var reader = new FileReader();
		var re_text = /\.jpg|\.gif|\.jpeg/i;
		var filename = upload_field.value;
		if (filename.search(re_text) == -1) {
			alert("File should be either jpg or gif or jpeg");
			/*var bColor  = $('#sepcBgColor').val();
			$("#frame").css("background",bColor);*/
			return false;
		}
		else
		{
			reader.onload = function (e) { 
				$('#frame').css("background","url('"+e.target.result+"') no-repeat");
				$('#frame').css("background-size","cover");
					
				/*---------------------------------------------- Upload Image To Server Script --------------------------------*/
				upload_field.form.action = 'uploadParentImg.php';
				upload_field.form.target = 'upload_iframe';
				upload_field.form.submit();
				upload_field.form.action = '';
				upload_field.form.target = '';
				sessionStorage.setItem("pBgImgName", filename);
			};
			reader.readAsDataURL(upload_field.files[0]);
		}
	}
}

/**###############################Displays Parent Specifications###############################**/
function showParSpec(){
	// Access Parent stored data
	alert( "parentName = " + sessionStorage.getItem("parentName"));
	alert( "parentWdth = " + sessionStorage.getItem("parentWdth"));
	alert( "parentHght = " + sessionStorage.getItem("parentHght"));
	alert( "parentBgColor = " + sessionStorage.getItem("parentBgColor"));
	//alert( "pBgImgName = " + sessionStorage.getItem("pBgImgName"));
}


/*******************
##################################################################CHILD####################################################
*******************/
/*function addChildSpec(childWdth,childHeght,counter,chldX,chldY,childType)
{ 
}*/

function getChildSpecifications(counter){
	
	//alert(counter);
	//Getting Parent X/Y Axis
	var parentX = sessionStorage.getItem("parentX");
	var parentY = sessionStorage.getItem("parentY");
	
	var childType1 = $("#clonediv"+counter).hasClass( "text" );
	var childType2 = $("#clonediv"+counter).hasClass( "image" );
	var childType3 = $("#clonediv"+counter).hasClass( "video" );
	var childType4 = $("#clonediv"+counter).hasClass( "ref" );
	
	if(childType1 == true){
		childType = 1;
	}
	else{
		childType1 = false;
	}
	if(childType2 == true){
		childType = 2;
	}
	else{
		childType2 = false;
	}
	if(childType3 == true){
		childType = 3;
	}
	else{
		childType3 = false;
	}
	if(childType4 == true){
		childType = 4;
	}
	else{
		childType4 = false;
	}
	
	var offset 	= 	$("#clonediv"+counter).offset();
	var w = $(window);
	var width	=	$("#clonediv"+counter).width();
	var height	=	$("#clonediv"+counter).height();
	var	insideX1	=	parseFloat(offset.left-w.scrollLeft())- parseFloat(parentX);
	var	insideY1	=	parseFloat(offset.top-w.scrollTop())-parseFloat(parentY);
	var	insideX2	=	parseFloat(insideX1)+parseFloat(width);
	var	insideY2	=	parseFloat(insideY1)+parseFloat(height);
	var corData	=	("(x1,y1) => "+insideX1+","+insideY1 +" || (x2,y1)==>" +insideX2+","+insideY1 +" || (x1,y2)==>" +insideX1+","+insideY2 +" || (x2,y2)==>" +insideX2+","+insideY2);
	
	if(childType == 1){
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications</td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"'/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Text</td><td>:</td><td style='text-align:center'><textarea name='chldTxt"+counter+"' id='chldTxt"+counter+"' onchange='changeText("+counter+")' ></textarea></td></tr><tr height='5px'></tr><tr><td>Color</td><td>:</td><td style=''><select name='chldTxtClr"+counter+"' id='chldTxtClr"+counter+"' style='width:120px' onchange='chngTextColor("+counter+")'><option value='red'>red</option><option value='green'>green</option></select></td></tr><tr height='5px'></tr><tr><td>Size</td><td>:</td><td style=''><select name='chldTxtSize"+counter+"' id='chldTxtSize"+counter+"' style='width:120px' onchange='chngTextSize("+counter+");'><option>12</option><option>16</option></select></td></tr><tr height='5px'></tr><tr><td>Style</td><td>:</td><td style=''><table><tr><td id='fontWeight"+counter+"' class='unclicked' width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;color:#fff;font-weight:bold;' onclick='changeFntWght("+counter+",1)'>B</td><td width='2px'></td><td id='fontStyle"+counter+"' class='unclicked' width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;font-style:Italic;color:#fff' onclick='changeFntStyle("+counter+",1)'>I</td><td width='2px'></td><td id='textDecor"+counter+"' class='unclicked' width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;color:#fff;text-decoration:underline;' onclick='changeTxtDecor("+counter+",1)' >U</td><td width='2px'></td></tr><tr height='5px'></tr><tr><td>Delete Child</td<td>:</td><td><a href='javascript:void(0)' name='delChild' id='delChild' onclick='return delChild("+childType+","+counter+")'><img src='images/del.png' alt=''/></a></td></tr></table>");
		
		//Displays the values changed for an element
		showTextDetails(counter);
	}
	
	//---------------------------------------------------------------------------- Image Child Type -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	if(childType == 2){
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications</td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"'/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Image</td><td>:</td><td><form name='childImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'><input type='file' name='chldImg' id='chldImg' onchange='return ChldBgImgURL(this,"+childType+","+counter+")'/></form></td></tr><tr height='5px'></tr><tr><td>Delete Child</td<td>:</td><td><a href='javascript:void(0)' name='delChild' id='delChild' onclick='return delChild("+childType+","+counter+")'><img src='images/del.png' alt=''/></a></td></tr></table>");
	}
	//--------------------------------------------------------------------------------- Video Child Type ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	if(childType == 3){
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications</td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"'/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Video</td><td>:</td><td><form name='childVdoFrm' method='post' autocomplete='off' enctype='multipart/form-data'><input type='file' name='childVdoPath' id='childVdoPath' onchange='return changeChildVdo(this,"+childType+","+counter+")'/></form></td></tr><tr height='5px'></tr><tr><td>Delete Child</td<td>:</td><td><a href='javascript:void(0)' name='delChild' id='delChild' onclick='return delChild("+childType+","+counter+")'><img src='images/del.png' alt=''/></a></td></tr></table>");
	}
	var refText = "";
	if(childType == 4){
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications</td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"' readonly/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr><tr><td style='width:120px;text-align:left'>Bg Image</td><td style='width:10px;text-align:left'>:</td><td style='width:150px;text-align:left'><form name='childRefImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'><input type='file' name='chldRefBgImg' id='chldRefBgImg' onchange='return ChldRefBgImgURL(this,"+childType+","+counter+")'/></form></td></tr><tr><td style='width:120px;text-align:left'>Link</td><td style='width:10px;text-align:left'>:</td><td style='width:150px;text-align:left'><input type='hidden' id='no' value='1'><span  value='' onclick='addRef("+counter+")' class='addBtn'></span><span  value='' onclick='delRef("+counter+")' class='delBtn'></span><span id='allRef'></span></td></tr><tr height='5px'></tr><tr><td>Delete Child</td<td>:</td><td><a href='javascript:void(0)' name='delChild' id='delChild' onclick='return delChild("+childType+","+counter+")'><img src='images/del.png' alt=''/></a></td></tr></table>");
		showRefDetails(counter);
	}
	
	//Getting Child Details on child dropped
	var textContent = changeText(counter);
	var textColor 	= chngTextColor(counter);
	var textSize 	= chngTextSize(counter);
	var flag = 0;
	var weightVal 	= changeFntWght(counter,flag);
	var italicVal 	= changeFntStyle(counter,flag);
	var decorVal 	= changeTxtDecor(counter,flag);
		
	// Saving textbox data for a particular child
	sessionStorage.setItem("#chldTxt"+counter, textContent);
	sessionStorage.setItem("#chldTxtClr"+counter, textColor);
	sessionStorage.setItem("#chldTxtSize"+counter, textSize);
	sessionStorage.setItem("#chldFontWeight"+counter, weightVal);
	sessionStorage.setItem("#chldFontStyle"+counter, italicVal);
	sessionStorage.setItem("#chldTxtDecor"+counter, decorVal);
	sessionStorage.setItem("width"+counter, width);
	sessionStorage.setItem("height"+counter, height);
	sessionStorage.setItem("xcoord"+counter, insideX1);
	sessionStorage.setItem("ycoord"+counter, insideY1);
}

/*-----------------------------------------------------TEXTBOX FUNCTIONS---------------------------------------------------------*/
function changeText(cnt){
	
	//alert(cnt);
	var textContent = $("#chldTxt"+cnt).val();
	if(textContent !=''){
		$("#clonediv"+cnt).find('p.textData').text(textContent);
		sessionStorage.setItem("#chldTxt"+cnt, textContent);
		
	return textContent;
	}
}

function chngTextColor(cnt){
	
	var textColor = $("#chldTxtClr"+cnt).val();
	$("#clonediv"+cnt).css('color',textColor);
	// Saving textbox text color for a particular child
	sessionStorage.setItem("#chldTxtClr"+cnt, textColor);
	
	return textColor;
}

function chngTextSize(cnt){
	
	var textSize = $("#chldTxtSize"+cnt).val();
	$("#clonediv"+cnt).css('font-size',textSize+'px');
	// Saving textbox text size for a particular child
	sessionStorage.setItem("#chldTxtSize"+cnt, textSize);
	
	return textSize;
}

function changeFntWght(cnt,flag){
	
	
	var weightVal = $("#clonediv"+cnt).css('font-weight');
	var clickStatus = $("#fontWeight"+cnt).attr('class');
	if(flag == 1){
		if(clickStatus == 'unclicked'){
			$("#clonediv"+cnt).css('font-weight','normal');
			$("#fontWeight"+cnt).removeClass('unclicked');
			$("#fontWeight"+cnt).addClass('clicked');
		}
		if(clickStatus == 'clicked'){
			$("#clonediv"+cnt).css('font-weight','bold');
			$("#fontWeight"+cnt).addClass('unclicked');
			$("#fontWeight"+cnt).removeClass ('clicked');
		}
	}
	// Saving textbox text size for a particular child
	sessionStorage.setItem("#chldFontWeight"+cnt, weightVal);
	
	return weightVal;
	
}

function changeFntStyle(cnt,flag){
	
	var italicVal = $("#clonediv"+cnt).css('font-style');
	var clickStatus = $("#fontStyle"+cnt).attr('class');
	if(flag == 1){
		if(clickStatus == 'unclicked'){
			$("#clonediv"+cnt).css('font-style','normal');
			$("#fontStyle"+cnt).removeClass('unclicked');
			$("#fontStyle"+cnt).addClass('clicked');
		}
		if(clickStatus == 'clicked'){
			$("#clonediv"+cnt).css('font-style','italic');
			$("#fontStyle"+cnt).addClass('unclicked');
			$("#fontStyle"+cnt).removeClass ('clicked');
		}
	}
	// Saving textbox text size for a particular child
	sessionStorage.setItem("#chldFontStyle"+cnt, italicVal);
	
	return italicVal;
}

function changeTxtDecor(cnt,flag){
	
	var decorVal = $("#clonediv"+cnt).css('text-decoration');
	
	var clickStatus = $("#textDecor"+cnt).attr('class');
	if(flag == 1){
		if(clickStatus == 'unclicked'){
			$("#clonediv"+cnt).css('text-decoration','none');
			$("#textDecor"+cnt).removeClass('unclicked');
			$("#textDecor"+cnt).addClass('clicked');
		}
		if(clickStatus == 'clicked'){
			$("#clonediv"+cnt).css('text-decoration','underline');
			$("#textDecor"+cnt).addClass('unclicked');
			$("#textDecor"+cnt).removeClass ('clicked');
		}
	}
	// Saving textbox text size for a particular child
	sessionStorage.setItem("#chldTxtDecor"+cnt, decorVal);
	
	return decorVal;
}
 

function showTextDetails(cnt){
	
	
	var textContent = $("#clonediv"+cnt).text();
	var textColor = $("#clonediv"+cnt).css('color');
	var textSize = $("#clonediv"+cnt).css('font-size');
	var weightVal = $("#clonediv"+cnt).css('font-size');
	var italicVal = $("#clonediv"+cnt).css('font-size');
	var decorVal = $("#clonediv"+cnt).css('font-size');
	
	size = textSize.slice(0,-2);
	//alert(size);
	
	if(textContent !=''){
		$("#chldTxt"+cnt).text(textContent);
	}	
	if(textColor !=''){
		$("#chldTxtClr"+cnt).val(textColor);
	}	
	if(textSize !=''){
		$("#chldTxtSize"+cnt).val(size);
	}
	if(weightVal !=''){
		$("#fontWeight"+cnt).val(weightVal);
	}
	/*if(italicVal !=''){
		$("#chldTxtSize"+cnt).val(italicVal);
	}
	if(decorVal !=''){
		$("#chldTxtSize"+cnt).val(decorVal);
	}*/
}
/*-----------------------------------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------------------REFERENCE FUNTIONS----------------------------------------------------------*/
function chngRefText(cnt){
	
	var refarr = $('#clonediv'+cnt).children('.refTextClass').each(function(){$(this).attr('id');});
	var refLen = refarr.length;
	
	var num = refLen;
	var refText = document.getElementById('childRefText'+num+'-'+cnt).value;
	$('#childRefLink'+num+'-'+cnt).val(refText);
	
	// Saving textbox text size for a particular child
	sessionStorage.setItem("childRefLink"+num+'-'+cnt, refText);
}


function addRef(cnt)
	{
		var refarr = $('#clonediv'+cnt).children('.refTextClass').each(function(){$(this).attr('id');});
		var refLen = refarr.length;
		
		var num = refLen;
		var refVal = $('#childRefText'+num+'-'+cnt).val();		
		if(refVal != ''){
			num = parseInt(num) + 1;
			document.getElementById('no').value = num;
			$('.delBtn').show();
			$('.delBtn').css("display","inline-block");
			
			//Creation of Reference textbox
			var refText = document.createElement("input");
			//Assign different attributes to the element.
			refText.setAttribute("type", 'text');
			refText.setAttribute("id", 'childRefText'+num+'-'+cnt);
			refText.setAttribute("name", 'childRefText'+num+'-'+cnt);
			refText.setAttribute("class", 'refTextbox');
			
			refText.setAttribute("onkeyup",'chngRefText('+cnt+')');
			
			var stick = document.getElementById("allRef");
			stick.appendChild(refText);
			
			//Creation of hidden field for Reference
			var hiddenRefText = document.createElement("input");
			//Assign different attributes to the element.
			hiddenRefText.setAttribute("type", 'hidden');
			hiddenRefText.setAttribute("id", 'childRefLink'+num+'-'+cnt);
			hiddenRefText.setAttribute("class", 'refTextClass');
			hiddenRefText.setAttribute("name", 'childRefLink'+num+'-'+cnt);
			hiddenRefText.setAttribute("value", '');
			
			var refBtn = document.getElementById('clonediv'+cnt);
			refBtn.appendChild(hiddenRefText);
			
		}
		else{
			//alert('empty');
		}
	}
	
function delRef(cnt){

	var refarr = $('#clonediv'+cnt).children('.refTextClass').each(function(){$(this).attr('id');});
	var refLen = refarr.length;
	
	var num = refLen;
	if(num !=1){
		$('#childRefText'+num+'-'+cnt).remove();
		$('#childRefLink'+num+'-'+cnt).remove();
		num = num - 1;
		document.getElementById('no').value = num;
		//sessionStorage.setItem("reference"+cnt, arr);
	}
	if(num ==1){
		$('.delBtn').hide();
	}
}
function showRefDetails(cnt){

	var refarr = $('#clonediv'+cnt).children('.refTextClass').each(function(){$(this).attr('id');});
											
	var refLen = refarr.length;
	
	if(refLen > 1){
		$('.delBtn').show();
		$('.delBtn').css("display","inline-block");
		
		for(var i=1;i<=refLen;i++){
			var refVal = $('#childRefLink'+i+'-'+cnt).val();
			//Creation of Reference textbox
			var refText = document.createElement("input");
			//Assign different attributes to the element.
			refText.setAttribute("type", 'text');
			refText.setAttribute("id", 'childRefText'+i+'-'+cnt);
			refText.setAttribute("name", 'childRefText'+i+'-'+cnt);
			refText.setAttribute("class", 'refTextbox');
			refText.setAttribute("value", refVal);
			
			refText.setAttribute("onkeyup",'chngRefText('+cnt+')');
			
			var stick = document.getElementById("allRef");
			//alert(stick);
			stick.appendChild(refText);
		}
	}
	else{
		var refVal = $('#childRefLink'+refLen+'-'+cnt).val();
		//Creation of Reference textbox
		var refText = document.createElement("input");
		//Assign different attributes to the element.
		refText.setAttribute("type", 'text');
		refText.setAttribute("id", 'childRefText'+refLen+'-'+cnt);
		refText.setAttribute("name", 'childRefText'+refLen+'-'+cnt);
		refText.setAttribute("class", 'refTextbox');
		refText.setAttribute("value", refVal);
		refText.setAttribute("onkeyup",'chngRefText('+cnt+')');
		
		var stick = document.getElementById("allRef");
		stick.appendChild(refText);
	}
}
/********************************************************************************************************************
											SAVE SLIDE FUNCTION STARTS
**********************************************************************************************************************/
function slideSaveCall()
{ 
	var r=confirm("Do You Want To Save ?");
	
	if (r==true)
	  {
	// Creating empty arrays and adding values
	var	mainArr			= [];
	var childArr 		= [];
	
	var parentName 	= 	sessionStorage.getItem("parentName");
	var parentWdth 	= 	sessionStorage.getItem("parentWdth");
	var parentHght 	= 	sessionStorage.getItem("parentHght");
	var pBgImgName	= 	sessionStorage.getItem("pBgImgName");
	var parentX		= 	sessionStorage.getItem("parentX");
	var parentY		= 	sessionStorage.getItem("parentY");
		
	wrappedParntArr	=	{'parntName':parentName,'parntWdth':parentWdth,'parntHght':parentHght,'parntBgImg':pBgImgName,'parentX':parentX,'parentY':parentY}
	mainArr.push(wrappedParntArr);
	
	// Get Parent data
	var parentName 		= sessionStorage.getItem("parentName");
	var parentWdth 		= sessionStorage.getItem("parentWdth");
	var parentHght 		= sessionStorage.getItem("parentHght");
	var parentBgColor 	= sessionStorage.getItem("parentBgColor");
	
	//Get All Childs
	$("#frame").find(".dragged1").each(function(){ childArr.push(this.id); });
	$("#frame").find(".dragged2").each(function(){ childArr.push(this.id); });
	
	var arrLen = childArr.length;
	
	for(var i=0;i<arrLen;i++){
		var childId 	= childArr[i];
		//alert(childArr[i]);		
		var counter 	= childId.match(/\d+$/)[0];
		var childName 	= 'child'+(i+1);
		var childWidth 	= sessionStorage.getItem("width"+counter);
		var childHeight = sessionStorage.getItem("height"+counter);
		var childXcoord = sessionStorage.getItem("xcoord"+counter);
		var childYcoord	= sessionStorage.getItem("ycoord"+counter);
		var childText 	= sessionStorage.getItem("#chldTxt"+counter);
		var txtColor	= sessionStorage.getItem("#chldTxtClr"+counter);
		var txtSize 	= sessionStorage.getItem("#chldTxtSize"+counter);
		var fontWeight 	= sessionStorage.getItem("#chldFontWeight"+counter);
		var fontStyle 	= sessionStorage.getItem("#chldFontStyle"+counter);
		var txtDecor 	= sessionStorage.getItem("#chldTxtDecor"+counter);
			
		var ChldimgName 	= 	sessionStorage.getItem("chldImgName"+counter);
		var ChldVdoName 	= 	sessionStorage.getItem("chldVdoName"+counter);
		var childType		=	sessionStorage.getItem("childType"+counter);
		//-----------------------------------------  Text Child --------------------------------------------------------------------------//
		if(childType == 1)
		{
			wrappedChildArr = {'childType':childType,'name':childName,'width':childWidth,'height':childHeight,'xaxis':childXcoord,'yaxis':childYcoord,'txt':childText,'txtColor':txtColor,'txtSize':txtSize};
		}
		//-----------------------------------------  Image Child --------------------------------------------------------------------------//
		if(childType == 2)
		{
			wrappedChildArr = {'childType':childType,'name':childName,'width':childWidth,'height':childHeight,'xaxis':childXcoord,'yaxis':childYcoord,'chldImgName':ChldimgName};
		}
		//-----------------------------------------  Video Child --------------------------------------------------------------------------//
		if(childType == 3)
		{
			wrappedChildArr = {'childType':childType,'name':childName,'width':childWidth,'height':childHeight,'xaxis':childXcoord,'yaxis':childYcoord,'chldImgName':ChldVdoName};
		}
		//-----------------------------------------  References Child --------------------------------------------------------------------------//
		if(childType == 4)
		{
			var refarr = $('#clonediv'+counter).children('.refTextClass').each(function(){$(this).attr('id');});
			var refLen = refarr.length;
			var ref = [];
			for(var i =1 ;i<=refLen; i++){
				ref.push(sessionStorage.getItem("childRefLink"+i+'-'+counter));
			}
			wrappedChildArr = {'childType':childType,'name':childName,'width':childWidth,'height':childHeight,'xaxis':childXcoord,'yaxis':childYcoord,'chldImgName':ChldVdoName,'references':ref};
		}
		
		mainArr.push(wrappedChildArr);
	}
	
	
	
   var dataStrng = JSON.stringify(mainArr);
   $.ajax({
		type: "POST",
		url: "Ajax/saveSlideProcess.php",
		cache: false,
		data:{data : dataStrng},
		success: function(data) { 
			setTimeout("window.location='add_slide.php?id="+btoa(data)+"'",300);
		}
	});
	}
	else{
	
	}
}
function delChild(childType,chldCnt)
{
	var d 		= 	document.getElementById('frame');
	var chlddiv = 	document.getElementById('clonediv'+chldCnt);
	
	sessionStorage.removeItem("height"+chldCnt);
	sessionStorage.removeItem("xcoord"+chldCnt);
	sessionStorage.removeItem("ycoord"+chldCnt);
	sessionStorage.removeItem("#chldTxt"+chldCnt);
	sessionStorage.removeItem("#chldTxtClr"+chldCnt);
	sessionStorage.removeItem("#chldTxtSize"+chldCnt);
	sessionStorage.removeItem("#chldFontWeight"+chldCnt);
	sessionStorage.removeItem("#chldFontStyle"+chldCnt);
	sessionStorage.removeItem("#chldTxtDecor"+chldCnt);
	sessionStorage.removeItem("chldImgName"+chldCnt);
	sessionStorage.removeItem("chldVdoName"+chldCnt);
	sessionStorage.removeItem("childType"+chldCnt);
	
	d.removeChild(chlddiv);
	getParentSpec();
}