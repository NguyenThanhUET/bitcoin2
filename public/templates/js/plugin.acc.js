(function( $ ){
$.fn.accrued = function(setup) {
	

			

return this.each(function(){
			var thiss=$(this);
			var prev = new Date().getTime() ;
			var raz = 0;

			
			
			
		

			//console.log(value);
			
			
			
			if(thiss.data('active')){
					window.clearInterval(thiss.data('interval'));
					setup0 = thiss.data('setup');
					
					if(setup.speed === undefined)	{	setup.speed 	= setup0.speed; }
					if(setup.dig === undefined)	{	setup.dig 	= setup0.dig; }
					if(setup.max === undefined)	{	setup.max 	= setup0.max; }
					if(setup.min === undefined)	{	setup.min 	= setup0.min; }
					if(setup.val === undefined )	{	setup.val 	= setup0.val; }
			}
			
			

			var speed = setup.speed;
			var dig = setup.dig;
			var max = setup.max;
			var min = setup.min;
			var val = setup.val;
			
			var sp=speed/1000;
			var value = parseFloat( thiss.text() );
			
			if(val !== undefined) {
				value = val;
			}
			
			// GO
			
			var obj = {id: thiss.attr('id'), text: thiss.text(), data: thiss.data()};
			//console.log(obj);
			//return false;
			var sets = setInterval(function(){
				now = new Date().getTime() ;
				raz=now-prev;
				value=value+sp*raz;
				
			
				if(value>max) value=max;
			
			
				if(value<min) value=min;
			
				
				
				thiss.text(value.toFixed(dig));
				prev=now;
			},100);
			
			thiss.data('active',true);
			thiss.data('interval', sets);
			thiss.data('setup', setup);

			
			
});
};
}( jQuery ));