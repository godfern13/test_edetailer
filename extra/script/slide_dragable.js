 $("#frame").click(function(){showParSpec()});
 var offset2 = $("#frame").offset();
 var w = $(window);
 var parentX =  (offset2.left-w.scrollLeft());
 var parentY = (offset2.top-w.scrollTop());
 
 /*------------------------------------- Get Parent Frame Specification ----------------------------------*/
 addParentSpec();
 
 counter = 0;
 /*-------------------------------------- function to drag an element -------------------------------------*/
 $(".drag").draggable({
  helper:'clone',
  containment: 'frame',
  /*--------------------------------------- first time drag -----------------------------------------------*/
  stop:function(ev, ui) { 
  
   if(ui.helper.attr('id') == 'drag1'){ var childType=1;}
   else if(ui.helper.attr('id') == 'drag2'){ var childType=2;}
   else if(ui.helper.attr('id') == 'drag3'){ var childType=3;}
   else if(ui.helper.attr('id') == 'drag4'){ var childType=4;}
   
   var pos=$(ui.helper).offset();
   objName = "#clonediv"+counter
   $(objName).css({"left":pos.left,"top":pos.top});
   $(objName).removeClass("drag");
   $(objName).addClass("drsElement");
   $(objName).addClass("drsMoveHandle");
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
   });
   /*----------------------------------------- Function To Get Cordinates ----------------------------------*/
    var cordData = calCordinates(parentX,parentY,counter,childType);
  }
 });
 /*------------------------------------------ drop an element function -----------------------------------------------*/
 $("#frame").droppable({ 
  drop: function(ev, ui) { 
   if (ui.helper.attr('id').search(/drag[0-9]/) != -1){
    counter++;
    var element=$(ui.draggable).clone();
    element.addClass("tempclass");
    $(this).append(element);
    $(".tempclass").attr("id","clonediv"+counter);
    $("#clonediv"+counter).removeClass("tempclass");
    /*---------------------------------- Get the dynamically item id -------------------------------*/
    draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
    itemDragged = "dragged1"
    console.log(itemDragged)
    $("#clonediv"+counter).addClass(itemDragged);
    //var cordData = calCordinates(parentX,parentY,counter);
   }
  }
 });
});