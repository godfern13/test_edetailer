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
		containment: 'frame',
		/*--------------------------------------- first time drag -----------------------------------------------*/
		stop:function(ev, ui) { 
			$(this).css("z-index", zindexval); 
			if(ui.helper.attr('id') == 'drag1'){ var childType=1;}//Text
			else if(ui.helper.attr('id') == 'drag2'){ var childType=2;}//Image
			else if(ui.helper.attr('id') == 'drag3'){ var childType=3;}//Video
			else if(ui.helper.attr('id') == 'drag4'){ var childType=4;}//References
			
			var pos=$(ui.helper).offset();
			objName = "#clonediv"+counter
			$(objName).css({"left":pos.left,"top":pos.top});
			$(objName).removeClass("drag");
			
			/*------------------------------------------- drag element within the frame --------------------------------*/
			$(objName).draggable({
				containment: 'parent',
				stop:function(ev, ui) {  
					var pos=$(ui.helper).offset();
					console.log($(this).attr("id"));
					console.log(pos.left)
					console.log(pos.top);
					/*----------------------------------------- Function To Get Coordinates ----------------------------------*/
					var cordData = calCordinates(parentX,parentY,counter,childType);
				}
			}).resizable({ handles: "n, e, s, w" });
			//$(objName).resizable({ handles: "n, e, s, w" });
			/*----------------------------------------- Function To Get Cordinates ----------------------------------*/
				//var cordData = calCordinates(parentX,parentY,counter,childType);
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
				
				sessionStorage.setItem("#clonediv"+counter, "#clonediv"+counter);
				
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
	
	var shwStatus = false;
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
	});
	
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
/*function chngeParSpec()
{
	var offset2 = $("#frame").offset();
	var w = $(window);
	var parentX = 	(offset2.left-w.scrollLeft());
	var parentY	=	(offset2.top-w.scrollTop());
	
	$('#specLoader').show();
	var bColor		=	$('#sepcBgColor').val();
	var parentWdth	=	$("#sepcWdth").val();
	var parentHght	=	$("#sepcHght").val();
	var parentName	=	$("#sepcName").val();
	var pBgImgName	=	$("#pBgImgName").val();
	if(pBgImgName != ""){ $('#frame').css("background","url('images/parent/"+pBgImgName+"')no-repeat"); }
	else{$("#frame").css("background",'#'+bColor);}
	
	var dataString	=	'parentWdth='+parentWdth+'&parentHght='+parentHght+'&parentBgClr='+bColor+'&parentName='+parentName+'&pBgImgName='+pBgImgName+'&parentX='+parentX+'&parentY='+parentY;
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
	//addChildSpec(width,height,counter,insideX1,insideY1,childType);
	
	$("#chldImg"+counter).attr({width: width});
	$("#chldImg"+counter).attr({height: height});
	return corData;
	
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
	
	var childX			=	parseFloat($('input#childX').val());
	var childY			=	parseFloat($('input#childY').val());
	
	addChildSpec(childWdth,childHeght,chldCunt,childX,childY,childType);
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
function ChldBgImgURL(upload_field,chldCunt,childType) { 
	if (upload_field.files && upload_field.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) { 
			var img = new Image();
			var chldWdth	=	$('#chldWdth').val();
			var chldHght	=	$('#chldHght').val();
			$('chldImg'+chldCunt).addClass('source-image');
			var ImgTag		=	'<img id="chldImg'+chldCunt+'" src="'+e.target.result+'" class="source-image" />';
			$('#clonediv'+chldCunt).html(ImgTag);
			$("#chldImg"+chldCunt).attr({width: chldWdth});
			$("#chldImg"+chldCunt).attr({height: chldHght});
		};
		reader.readAsDataURL(upload_field.files[0]);
	}
	/*---------------------------------------------- Upload Image To Server Script --------------------------------*/
	var re_text = /\.jpg|\.gif|\.jpeg/i;
	var filename = upload_field.value;
	if (filename.search(re_text) == -1) {
		alert("File should be either jpg or gif or jpeg");
		var bColor		=	$('#sepcBgColor').val();
		$("#frame").css("background",bColor);
		return false;
	}
	upload_field.form.action = 'uploadChildImg.php';
	upload_field.form.target = 'upload_iframe';
	upload_field.form.submit();
	upload_field.form.action = '';
	upload_field.form.target = '';
	document.getElementById('chldImgName'+chldCunt).value = filename;
	
	var childWdth	=	parseFloat($('input#chldWdth').val());
	var childHeght	=	parseFloat($('input#chldHght').val());
	var childX		=	parseFloat($('input#childX').val());
	var childY		=	parseFloat($('input#childY').val());
	addChildSpec(childWdth,childHeght,chldCunt,childX,childY,childType);
}
function ChldRefBgImgURL(upload_field,chldCunt,childType)
{
	if (upload_field.files && upload_field.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) { 
			var img = new Image();
			var chldWdth	=	$('#chldWdth').val();
			var chldHght	=	$('#chldHght').val();
			var ImgTag		=	'<img id="chldRefImg'+chldCunt+'" src="'+e.target.result+'" class="source-image" />';
			$('#clonediv'+chldCunt).html(ImgTag);
			$("#chldRefImg"+chldCunt).attr({width: chldWdth});
			$("#chldRefImg"+chldCunt).attr({height: chldHght});
		};
		reader.readAsDataURL(upload_field.files[0]);
	}
	/*---------------------------------------------- Upload Image To Server Script --------------------------------*/
	var re_text = /\.jpg|\.gif|\.jpeg/i;
	var filename = upload_field.value;
	if (filename.search(re_text) == -1) {
		alert("File should be either jpg or gif or jpeg");
		$('#clonediv'+chldCunt).html('');
		return false;
	}
	upload_field.form.action = 'uploadChildRefImg.php';
	upload_field.form.target = 'upload_iframe';
	upload_field.form.submit();
	upload_field.form.action = '';
	upload_field.form.target = '';
	document.getElementById('chldRefBgImg'+chldCunt).value = filename;
	
	var childWdth	=	parseFloat($('input#chldWdth').val());
	var childHeght	=	parseFloat($('input#chldHght').val());
	var childX		=	parseFloat($('input#childX').val());
	var childY		=	parseFloat($('input#childY').val());
	addChildSpec(childWdth,childHeght,chldCunt,childX,childY,childType);
}
/*------------------------------------- Function to change Child Video ----------------------------------*/
function changeChildVdo(chldCnt,childType)
{
	var childWdth	=	parseFloat($('input#chldWdth').val());
	var childHeght	=	parseFloat($('input#chldHght').val());
	var childVdo	=	$('input#childVdoPath'+chldCnt).val();
	var chldVdoFrm	=	"<video width='200' height='100' controls autoplay><source src="+childVdo+" type='video/ogg'> <source src="+childVdo+" type='video/mp4'><source src="+childVdo+" type='video/wmv'><object data="+childVdo+" width='320' height='240'><embed width='320' height='240' src='movie.swf'> </object></video>";
	//<iframe src="'+childVdo+'" frameborder="0" id="chldVdO'+chldCnt+'"></iframe>';
	$("#clonediv"+chldCnt).html(chldVdoFrm);
	$("#chldVdO"+chldCnt).attr({width: childWdth});
	$("#chldVdO"+chldCnt).attr({height: childHeght});
	
	
	var childX		=	parseFloat($('input#childX').val());
	var childY		=	parseFloat($('input#childY').val());
	addChildSpec(childWdth,childHeght,chldCnt,childX,childY,childType);
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
	
	//creating an color array
	var colorArray = 	[ 	'ffffff','ffce93','fffc9e','ffffc7','9aff99','96fffb','cdffff','185871','cbcefb','cfcfcf','fd6864',
							'fe996b','fffe65','fcff2f','67fd9a','38fff8','68fdff','9698ed','c0c0c0','fe0000','f8a102','ffcc67',
							'f8ff00','34ff34','68cbd0','34cdf9','6665cd','9b9b9b','cb0000','f56b00','ffcb2f','ffc702','32cb00',
							'00d2cb','3166ff','6434fc','656565','9a0000','ce6301','cd9934','999903','009901','329a9d','3531ff',
							'6200c9','343434','680100','963400','986536','646809','036400','34696d','00009b','303498','000000',
							'330001','643403','663234','343300','013300','003532','010066','340096'];
	
	$( "#specfcatnDiv" ).html( "<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications</td></tr><tr height='5px'></tr><tr><td>Name</td><td>:</td><td><input type='text' name='sepcName' id='sepcName' onchange='return chngeParSpec()' value='test'/></td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='sepcWdth' id='sepcWdth' value='"+parentWdth+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='sepcHght' id='sepcHght' value='"+parentHght+"'/></td></tr><tr height='5px'></tr><tr><td>Bg Color</td><td>:</td><td><select id='sepcBgColor' name='sepcBgColor' onchange='return chngeParBgColor()' style='width:120px'><option>fe996b</option><option>fe896b</option></select></tr><tr height='5px'></tr><tr><td>Bg Image</td><td>:</td><td><form name='parentImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'><input type='file' name='sepcBgImg' id='sepcBgImg' onchange='return ParntBgImgURL(this)'/></form><input type='hidden' name='pBgImgName' id='pBgImgName' value='testimg' /></td></tr></table>");
	
	// Save parent data to the current session's store
	sessionStorage.setItem("parentName", parentName);
	sessionStorage.setItem("pBgImgName", pBgImgName);
	sessionStorage.setItem("parentWdth", parentWdth);
	sessionStorage.setItem("parentHght", parentHght);
	sessionStorage.setItem("parentBgColor", rgb);

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
		reader.onload = function (e) { 
			$('#frame').css("background","url('"+e.target.result+"')no-repeat");
			$('#frame').css("background-size","cover");
		};
		reader.readAsDataURL(upload_field.files[0]);
		
		sessionStorage.setItem("pBgImgName", e.target.result);
	}
/*---------------------------------------------- Upload Image To Server Script --------------------------------*/
	var re_text = /\.jpg|\.gif|\.jpeg/i;
	var filename = upload_field.value;
	if (filename.search(re_text) == -1) {
		alert("File should be either jpg or gif or jpeg");
		//upload_field.form.reset();
		var bColor		=	$('#sepcBgColor').val();
		$("#frame").css("background",bColor);
		return false;
	}
	upload_field.form.action = 'uploadParentImg.php';
	upload_field.form.target = 'upload_iframe';
	upload_field.form.submit();
	upload_field.form.action = '';
	upload_field.form.target = '';
	document.getElementById('pBgImgName').value = filename;
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
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications<input type='hidden' name='chldCnt' id='chldCnt' value='testChild'></td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"'/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Text</td><td>:</td><td style='text-align:center'><textarea name='chldTxt"+counter+"' id='chldTxt"+counter+"' onchange='changeText("+counter+")' ></textarea></td></tr><tr height='5px'></tr><tr><td>Color</td><td>:</td><td style=''><select name='chldTxtClr"+counter+"' id='chldTxtClr"+counter+"' style='width:120px' onchange='chngTextColor("+counter+")'><option value='red'>red</option><option value='green'>green</option></select></td></tr><tr height='5px'></tr><tr><td>Size</td><td>:</td><td style=''><select name='chldTxtSize"+counter+"' id='chldTxtSize"+counter+"' style='width:120px' onchange='chngTextSize("+counter+");'><option>12</option><option>16</option></select></td></tr><tr height='5px'></tr><tr><td>Style</td><td>:</td><td style=''><table><tr><td width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;color:#fff' onclick='changeFntWght("+counter+")'><b>B</b></td><td width='2px'></td><td width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;font-style:Italic;color:#fff' onclick='changeFntStyle("+counter+")'>I</td><td width='2px'></td><td width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;color:#fff' onclick='changeTxtDecor("+counter+")' ><u>U</u></td><td width='2px'></td></tr></table>");
		
		//Displays the values changed for an element
		showTextDetails(counter);
	}
	
	if(childType == 2){
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications<input type='hidden' name='chldCnt' id='chldCnt' value='testChild'></td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"'/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr></table>");
	}
	
	if(childType == 3){
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications<input type='hidden' name='chldCnt' id='chldCnt' value='testChild'></td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"'/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr></table>");
	}
	
	if(childType == 4){
		$( "#specfcatnDiv" ).html("<table id='specfcatnTabl'><tr><td colspan='3' style='text-align:center'>Specifications<input type='hidden' name='chldCnt' id='chldCnt' value='testChild'></td></tr><tr height='5px'></tr><tr><td>Width</td><td>:</td><td><input type='text' name='chldWdth' id='chldWdth' value='"+width+"'/></td></tr><tr height='5px'></tr><tr><td>Height</td><td>:</td><td><input type='text' name='chldHght' id='chldHght' value='"+height+"'/></td></tr><tr height='5px'></tr><tr><td>X-Cordinate</td><td>:</td><td><input type='text' name='childX' id='childX' value='"+insideX1+"' readonly/></td></tr><tr height='5px'></tr><tr><td>Y-Cordinate</td><td>:</td><td><input type='text' name='childY' id='childY' value='"+insideY1+"' readonly/></td></tr><tr height='5px'></tr></table>");
	}
	
	//Getting Child Details on child dropped
	var textContent = changeText(counter);
	var textColor 	= chngTextColor(counter);
	var textSize 	= chngTextSize(counter);
	
	// Saving textbox data for a particular child
	sessionStorage.setItem("#chldTxt"+counter, textContent);
	sessionStorage.setItem("#chldTxtClr"+counter, textColor);
	sessionStorage.setItem("#chldTxtSize"+counter, textSize);
	sessionStorage.setItem("width"+counter, width);
	sessionStorage.setItem("height"+counter, height);
	sessionStorage.setItem("xcoord"+counter, insideX1);
	sessionStorage.setItem("ycoord"+counter, insideY1);
}

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

function changeFntWght(cnt){
	
	$("#clonediv"+cnt).css('font-weight','bold');
	var weightVal = $("#clonediv"+cnt).css('font-weight');
	
	// Saving textbox text size for a particular child
	//sessionStorage.setItem("#chldTxtSize"+cnt, textSize);
	
}

function changeFntStyle(cnt){
	
	$("#clonediv"+cnt).css('font-style','italic');
	var italicVal = $("#clonediv"+cnt).css('font-style');
	// Saving textbox text size for a particular child
	//sessionStorage.setItem("#chldTxtSize"+cnt, textSize);
}

function changeTxtDecor(cnt){
	
	$("#clonediv"+cnt).css('text-decoration','underline');
	var decorVal = $("#clonediv"+cnt).css('text-decoration');
	// Saving textbox text size for a particular child
	//sessionStorage.setItem("#chldTxtSize"+cnt, textSize);
}
 

function showTextDetails(cnt){
	
	var textContent = $("#clonediv"+cnt).text();
	var textColor = $("#clonediv"+cnt).css('color');
	var textSize = $("#clonediv"+cnt).css('font-size');
	size = textSize.slice(0,-2);
	
	if(textContent !=''){
		$("#chldTxt"+cnt).text(textContent);
	}	
	if(textColor !=''){
		$("#chldTxtClr"+cnt).val(textColor);
	}	
	if(textSize !=''){
		$("#chldTxtSize"+cnt).val(size);
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
		var counter 	= childId.match(/\d+$/)[0];
		var childName 	= 'child'+(i+1);
		var childWidth 	= sessionStorage.getItem("width"+(i+1));
		alert(childWidth);
		var childHeight = sessionStorage.getItem("height"+(i+1));
		var childXcoord = sessionStorage.getItem("xcoord"+(i+1));
		var childYcoord	= sessionStorage.getItem("ycoord"+(i+1));
		var childText 	= sessionStorage.getItem("#chldTxt"+(i+1));
		var txtColor	= sessionStorage.getItem("#chldTxtClr"+(i+1));
		var txtSize 	= sessionStorage.getItem("#chldTxtSize"+(i+1));
		//var childText 	= sessionStorage.getItem("chldTxt"+(i+1));
		//var childText 	= sessionStorage.getItem("chldTxt"+(i+1));
		
		var wrappedChildArr	= {'name':childName,'width':childWidth,'height':childHeight,'xaxis':childXcoord,'yaxis':childYcoord,'txt':childText,'txtColor':txtColor,'txtSize':txtSize};
		
		mainArr.push(wrappedChildArr);
	}
	
	//alert(mainArr);
	
   var dataStrng = JSON.stringify(mainArr);
   
	$.ajax({
		type: "POST",
		url: "Ajax/saveSlideProcess.php",
		cache: false,
		data:{data : dataStrng},
		success: function(data) { 
			//setTimeout("window.location='add_slide.php?id="+btoa(data)+"'",300);
		}
	});
	}
	else{
	
	}
}