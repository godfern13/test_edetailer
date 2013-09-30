$(document).ready(function(){
	var offset2 = $("#frame").offset();
	var w = $(window);
	var parentX = 	(offset2.left-w.scrollLeft());
	var parentY	=	(offset2.top-w.scrollTop());
	
	/********************************* Get Parent Frame Specification *****************************/
	var parentWdth	=	$("#frame").width();
	var parentHght	=	$("#frame").height();
	var parentBgClr	=	$("#frame").css("background-color");
	
	
	
	$('#sepcWdth').val(parentWdth);$('#sepcWdth').attr("disabled", true);
	$('#sepcHght').val(parentHght);$('#sepcHght').attr("disabled", true);
	$('#sepcBgColor').val(parentBgClr);
	/************************************************************************************************/
	counter = 0;
	/*************************** function to drag an element ****************************/
	$(".drag").draggable({
		helper:'clone',
		containment: 'frame',
		//********************* first time drag ******************************/
		stop:function(ev, ui) {
			var pos=$(ui.helper).offset();
			objName = "#clonediv"+counter
			$(objName).css({"left":pos.left,"top":pos.top});
			$(objName).removeClass("drag");
			/******************************* drag element within the frame ***********************/
			$(objName).draggable({
				containment: 'parent',
				stop:function(ev, ui) { alert('sdfdsgfjhg');
					var pos=$(ui.helper).offset();
					console.log($(this).attr("id"));
					console.log(pos.left)
					console.log(pos.top);
					/*********************************Function To Get Cordinates *****************/
					var cordData = calCordinates(parentX,parentY);
					alert(cordData)
				}
			});
			/*********************************Function To Get Cordinates *****************/
			var cordData = calCordinates(parentX,parentY);
			alert(cordData)
		}
	});
	/***************** drop an element function *****************************************/
	$("#frame").droppable({
		drop: function(ev, ui) {
			if (ui.helper.attr('id').search(/drag[0-9]/) != -1){
				counter++;
				var element=$(ui.draggable).clone();
				element.addClass("tempclass");
				$(this).append(element);
				$(".tempclass").attr("id","clonediv"+counter);
				$("#clonediv"+counter).removeClass("tempclass");

				//Get the dynamically item id
				draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
				itemDragged = "dragged" + RegExp.$1
				console.log(itemDragged)
				$("#clonediv"+counter).addClass(itemDragged);
			}
		}
	});
	
	/***********************Getting the div id on mouseover*******************************/
	$("#frame").mouseenter(function(){
		//$(this).children()
		$(this).children().click(function(){
			//$(this).attr('id'));
			$(this).addClass('selected')
			
		});
		return false;
	});
});
/************************************ Function For Cordinates Calctn ************************/
function calCordinates(parentX,parentY)
{
	var offset 	= 	$(".dragged1").offset();
	var w = $(window);
	var width	=	$(".dragged1").width();
	var height	=	$(".dragged1").height();
	var	insideX1	=	parseFloat(offset.left-w.scrollLeft())-parseFloat(parentX);
	var	insideY1	=	parseFloat(offset.top-w.scrollTop())-parseFloat(parentY);
	var	insideX2	=	parseFloat(insideX1)+parseFloat(width);
	var	insideY2	=	parseFloat(insideY1)+parseFloat(height);
	var corData	=	("(x1,y1) => "+insideX1+","+insideY1 +" || (x2,y1)==>" +insideX2+","+insideY1 +" || (x1,y2)==>" +insideX1+","+insideY2 +" || (x2,y2)==>" +insideX2+","+insideY2);
	$("#div_id").data("data",{pX:parentX,pY:parentY,cX:insideX1,cY:insideY1,cW:width,cH:height});
	
	$('#sepcWdth').val(width);$('#sepcWdth').attr("disabled", false);
	$('#sepcHght').val(height);$('#sepcHght').attr("disabled", false);
	$('#sepcBgColor').val();$('#sepcBgColor').attr("disabled", false);
	return corData;
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
/******************************* Change Width Css ************************/
function changeWdth()
{
	var width	=	$('#sepcWdth').val();
	$(".dragged1").css("width",300);
}
function changeHght()
{
	var heght	=	$('#sepcHght').val();
	$(".dragged1").css("height",300);
}
function changeColor()
{
	var bColor	=	$('#sepcBgColor').val();
	$("#frame").css("background",bColor)
}

