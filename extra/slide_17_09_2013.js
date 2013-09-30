$(document).ready(function(){



/*-----------------------------------------Resize Element---------------------------------------------*/

/*--------------------------------------------Drag and Resize--------------------------------------------------------*/
		var dragresize = new DragResize('dragresize', { minWidth: 50, minHeight: 50, minLeft: 20, minTop: 20, maxLeft: 600, maxTop: 600 });
		
		/*-------------------------Rectangle Script----------------------------*/
		dragresize.isElement = function(elm)
		{
		 if (elm.className && elm.className.indexOf('drsTextElement') > -1) return true;
		};
		dragresize.isHandle = function(elm)
		{
		 if (elm.className && elm.className.indexOf('drsMoveRectHandle') > -1) return true;
		};
		
		/*--------------------------Text Script------------------------------------*/
		dragresize.isElement = function(elm)
		{
		 if (elm.className && elm.className.indexOf('drsTextElement') > -1) return true;
		};
		dragresize.isHandle = function(elm)
		{
		 if (elm.className && elm.className.indexOf('drsMoveTextHandle') > -1) return true;
		};
		
		dragresize.ondragfocus = function() { };
		dragresize.ondragstart = function(isResize) { };
		dragresize.ondragmove = function(isResize) { };
		dragresize.ondragend = function(isResize) { };
		dragresize.ondragblur = function() { };
		
		dragresize.apply(document);








/*-----------------------------------------------------------------------------------------------------*/

	$("#frame").click(function(){showParSpec()});
	var offset2 = $("#frame").offset();
	var w = $(window);
	var parentX = 	(offset2.left-w.scrollLeft());
	var parentY	=	(offset2.top-w.scrollTop());
	
	/*------------------------------------- Get Parent Frame Specification ----------------------------------*/
	addParentSpec();
	
	counter = 0;
	/*-------------------------------------- function to drag an element -------------------------------------*/
	$(".drag").draggable({
		helper:'clone',
		containment: 'frame',
		/*--------------------------------------- first time drag -----------------------------------------------*/
		stop:function(ev, ui) { 
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
					/*----------------------------------------- Function To Get Cordinates ----------------------------------*/
					var cordData = calCordinates(parentX,parentY,counter);
				}
			});
			/*------------------------------------Function To Get Cordinates ---------------------------------------------*/
			var cordData = calCordinates(parentX,parentY,counter);
		}
	});
	/*------------------------------------------ drop an element function -----------------------------------------------*/
	$("#frame").droppable({ 
		drop: function(ev, ui) { 
			if (ui.helper.attr('id').search(/drag[0-9]/) != -1){
				counter++;
				var element=$(ui.draggable).clone();
				element.addClass("tempclass");
				element.addClass("drsTextElement");
				$(this).append(element);
				$(".tempclass").attr("id","clonediv"+counter);
				$("#clonediv"+counter).removeClass("tempclass");
				/*---------------------------------- Get the dynamically item id -------------------------------*/
				draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
				itemDragged = "dragged" + RegExp.$1
				console.log(itemDragged)
				$("#clonediv"+counter).addClass(itemDragged);
				//var cordData = calCordinates(parentX,parentY,counter);
			}
		}
	});
});

/********************************************************************************************************************
											PARENT FUNCTIONS START
*********************************************************************************************************************/

/*--------------------------------------------- Add Parent Specification Function ------------------------------------*/
function addParentSpec()
{ 
	var offset2 = $("#frame").offset();
	var w = $(window);
	var parentX = 	(offset2.left-w.scrollLeft());
	var parentY	=	(offset2.top-w.scrollTop());
	
	var parentWdth	=	$("#frame").width();
	var parentHght	=	$("#frame").height();
	var parentBgClr	=	$("#frame").css("background-color");
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
}
/*------------------------------------ OnChange Function ------------------------------------------------*/
function chngeParSpec()
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
	else{$("#frame").css("background",bColor);}
	
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
}
/*------------------------------------- On click On Frame Function ------------------------------*/
function showParSpec()
{
	$('#frame').click( function(event) {
		if(event.target.id == 'frame')
		{
			$.ajax({
				type: "POST",
				url: "Ajax/showParSpec.php",
				cache: false,
				success: function(data) { 
					$('#specfcatnDiv').html(data);
				}
			});
		}
	});
}
/*------------------------------------------- Set Image To Frame Background --------------------------------*/
function ParntBgImgURL(upload_field) { 
	if (upload_field.files && upload_field.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) { 
			$('#frame').css("background","url('"+e.target.result+"')no-repeat");
		};
		reader.readAsDataURL(upload_field.files[0]);
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
	chngeParSpec();
}
/********************************************************************************************************************
											PARENT FUNCTIONS ENDS
*********************************************************************************************************************/


/********************************************************************************************************************
											CHILD FUNCTION START
*********************************************************************************************************************/

/*----------------------------------- Get Child Cordinates Function ---------------------------------*/
function calCordinates(parentX,parentY,counter)
{	
	$("#clonediv"+counter).click(function(){showChildSpec(counter)});
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
	addChildSpec(width,height,counter,insideX1,insideY1);
	return corData;
	
}
/*----------------------------------------- Add Child Specification ----------------------------------------------*/
function addChildSpec(childWdth,childHeght,counter,chldX,chldY)
{  
	var childType		=	$('select#chldCntSel').val();
	var childImgPath	=	$('input#chldImgName').val();
	var childText		=	$('textarea#chldTxt').val();
	var dataString	=	'childWdth='+childWdth+'&childHght='+childHeght+'&chldCnt='+counter+'&chldX='+chldX+'&chldY='+chldY+'&childType='+childType+'&childImgPath='+childImgPath+'&childText='+childText;
	$('#specLoader').show();
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
}
/*------------------------------------- On Change Function ----------------------------------------------*/
function chngChldSpec(chldCunt)
{	
	var childWdth	=	parseFloat($('input#chldWdth').val());
	$("#clonediv"+chldCunt).css("width",childWdth);
	var childHeght	=	parseFloat($('input#chldHght').val());
	$("#clonediv"+chldCunt).css("height",childHeght);
	
	$('#chldImg'+chldCunt).css("width",childWdth);
	$('#chldImg'+chldCunt).css("height",childHeght);
	
	var childX	=	parseFloat($('input#childX').val());
	var childY	=	parseFloat($('input#childY').val());
	
	var childType		=	$('select#chldCntSel').val();
	var childText		=	$('textarea#chldTxt').val();
	var childImgPath	=	$('input#chldImgName').val();
	
	var dataString	=	'childWdth='+childWdth+'&childHght='+childHeght+'&chldCnt='+chldCunt+'&chldX='+childX+'&chldY='+childY+'&childType='+childType+'&childImgPath='+childImgPath+'&childText='+childText;
	$.ajax({
		type: "POST",
		url: "Ajax/addChldSpec.php",
		cache: false,
		data: dataString,
		success: function(data) { 
			$('#specfcatnDiv').html(data);
		}
	});
}
/*------------------------------------ OnClick of Child Div function --------------------------------------*/
function showChildSpec(counter)
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
}

/*----------------------------------- ----------------------------------------------------------*/
function displyChdCont(counter)
{
	var chldCntSel = $('select#chldCntSel').val();
	if(chldCntSel == '1')
	{
		$('#chldTxtCnt').show();
		$('#chldImgCnt').hide();
	}
	else if(chldCntSel == '2')
	{
		$('#chldImgCnt').show();
		$('#chldTxtCnt').hide();
	}
	else
	{
		$('#chldTxtCnt').hide();
		$('#chldImgCnt').hide();
	}
}
function changeChildText(counter)
{	
	var childText	=	$('textarea#chldTxt').val();
	$("#clonediv"+counter).html(childText);
}
/*------------------------------------------- Set Image To Child Background --------------------------------*/
function ChldBgImgURL(upload_field,chldCunt) { 
	if (upload_field.files && upload_field.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) { 
			var chldWdth	=	$('#chldWdth').val();
			var chldHght	=	$('#chldHght').val();
			var ImgTag		=	'<img id="chldImg'+chldCunt+'" src="'+e.target.result+'" width="'+chldWdth+'" height="'+chldHght+'"/>';
			$('#clonediv'+chldCunt).html(ImgTag);
		};
		reader.readAsDataURL(upload_field.files[0]);
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
	upload_field.form.action = 'uploadChildImg.php';
	upload_field.form.target = 'upload_iframe';
	upload_field.form.submit();
	upload_field.form.action = '';
	upload_field.form.target = '';
	document.getElementById('chldImgName').value = filename;
	chngChldSpec(chldCunt);
}
/********************************************************************************************************************
											CHILD FUNCTION ENDS
*********************************************************************************************************************/

/********************************************************************************************************************
											SAVE SLIDE FUNCTION STARTS
**********************************************************************************************************************/
function slideSaveCall()
{ 
	//document.getElementById("frame").disabled = true;
	//document.getElementById("rightDiv").disabled = true;
	var chldCunter	=	$('input#chldCnt').val();
	var prntId	=	$('input#prntId').val();
	
	var dataStrng	=	'chldCunter='+chldCunter + '&parent_id=' + prntId;
	
   // alert(dataStrng)
	$.ajax({
		type: "POST",
		url: "Ajax/saveSlideProcess.php",
		cache: false,
		data:dataStrng,
		success: function(data) { 
			//alert("Presentation Slide Added Sucessfully");
			alert(data);
			setTimeout("window.location='slide.php?id="+btoa(data)+"'",1000);
		}
	});
}

/**************************** function to generate an XML file*******************/
function saveDta()
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
}