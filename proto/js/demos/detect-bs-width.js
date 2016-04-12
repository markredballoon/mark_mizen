// Detect the current bootstrap screen size (xs, sm, md or lg)
/*
At this html to the bottom of the body tag:
*/
var currentScreenSize = 'lg';

function checkScreenSize(target){
	$target = target;
	if ( $target.find('.visible-xs').css('display') === 'block' ){
		currentScreenSize = 'xs';
	}
	else if ( $target.find('.visible-sm').css('display') === 'block' ){
		currentScreenSize = 'sm';
	}
	else if ( $target.find('.visible-md').css('display') === 'block' ){
		currentScreenSize = 'md';
	}
	else{
		currentScreenSize = 'lg';
	}
}

jQuery(document).ready(function($) {
	checkScreenSize('#bs-size-check');
	$(window).resize(function(event) {
		checkScreenSize('#bs-size-check');
	});
});