var colors = ['333','999','101','00f'];
var counter = 0;

jQuery(window).load(function() {
	setInterval( function(){
		if (counter < colors.length ) {
			jQuery('#target').attr('fill', '#'+(colors[counter]));
			counter++;
		}
		else{
			counter = 0;
			jQuery('#target').attr('fill', '#'+(colors[counter]));
			counter++;
		};
	},3000);
});