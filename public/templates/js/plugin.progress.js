(function( $ ){
$.fn.progress = function(speed) {
return this.each(function(){
			var thiss=$(this);
			var sp=speed/1000;
			
			var par_width = thiss.parent().width();
			if (par_width == 0) par_width = 622;
			
			
			var value = thiss.css('width');
			
			var prev = new Date().getTime() ;
			var raz = 0;


			if(value.indexOf('px') +1) {
				value = thiss.width() / par_width * 100;
			}else{
				value = thiss.width();
			}
			

			var sets = setInterval(function(){
				now = new Date().getTime() ;
				raz=now-prev;
				value=value+sp*raz;
				
				if(value>100) value = 100;
				
				thiss.css('width',value.toFixed(2)+'%');
				prev=now;
			},100);
			
});
};
}( jQuery ));