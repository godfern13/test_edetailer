(function($) {
    $.fn.resize = function(opt) {
		//alert('hi');
		
		opt = $.extend({handle:""}, opt);
		var clicking = false;
		var oldpos;
		if(opt.handle === "") {
            var $el = this;
        } else {
            var $el = this.find(opt.handle);
        }
		
		return $el.bind("dblclick", function(e) {
		
		//$(this).off("drag");
		$(this).unbind( "click.drag" );
		
			//alert('im clicked');
			//alert($(this).height()+''+$(this).width());
			var elemWidth 	= $(this).width();
			var elemHeight 	= $(this).height();
			$(this).append( $("<div id='n' class='horizontal' style='width:"+elemWidth+"px;cursor:ns-resize;'></div>") );
			$(this).append( $ ("<div id='w' class='vertical' style='height:"+elemHeight+"px;cursor:ew-resize;'></div>") );
			$(this).append( $ ("<div id='e' class='vertical' style='height:"+elemHeight+"px;cursor:ew-resize;'></div>") );
			$(this).append( $ ("<div id='s' class='horizontal' style='width:"+elemWidth+"px;cursor:ns-resize;'></div>") );
			
			$('#n').mousedown(function(){
				clicking = true;
				oldpos = e.clientY;
				var ycurrent = $(this).outerHeight();
				
				//alert(oldpos);
			});
			$('#n').mouseup(function(){
				clicking = false;
				//$(this).unbind('mousemove');
				//alert(oldpos);
			});			
			$('#n').mousemove(function(e){//alert(oldpos);
			if(clicking == false) return;
			else{
				//alert(oldpos);
				//alert(e.pageY);
				//$('#n').height(e.pageY -oldpos);
			}
						
			
			});
			
		});
			
			
			$('#w').mouseover(function(){
				//alert('hi');
				
			});
			
			$('#e').mouseover(function(){
				//alert('hi');
				
			});
			
			$('#s').mouseover(function(){
				//alert('hi');
				
			});
	//	});
		
		
	}
})(jQuery);