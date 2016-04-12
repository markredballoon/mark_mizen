/*
=== === === === === === ===
	Global Variables
=== === === === === === ===

Variables used throughout the javascript.
*/

var $window 			= $(window); // explination if required
var $main 				= $('#main');

/*
=== === === === === === ===
	Callback Functions
=== === === === === === ===

Functions that are called multiple times.
*/

// Function documentation
function exampleFunc(variable){
	return false;
}

// Basic toggle for navigation objects. target is the object that will have to 'show' class toggled
function toggleShow(target){
	var $target = $main;
	if ( typeof target !== 'object' ) {
		$target = $(target);
	}
	else{
		$target = target;
	}
	$target.toggleClass('show');
}


//Swap between tabs (snippets/tabs_lip.php)
function changeTab(selector, tabIndex){
	$('.tab-selector li a').removeClass('active-tab');
	$('.tab-selector li a[data-tab="'+tabIndex+'"]').addClass('active-tab');
	$(selector).removeClass('active-tab');
	$(selector).eq(tabIndex).addClass('active-tab');
}


/*
=== === === === === === ===
	Ready function
=== === === === === === ===

Fires when the page is ready to start running javascript. 
This happens as soon as the browser is ready, so it won't wait for media (images, videos ect.) to load.
*/
jQuery(document).ready(function($) {
	

	// Navigation toggle
	$('.toggle').click(function(event) {
		$(this).toggleClass('open');
		if ($(this).find('.sub-menu').length > 0) {
			toggleShow( $(this).find('.sub-menu') );
		};
	});

/*
=== === === === === === ===
	Resize function
=== === === === === === ===

Fires every time the window is resized
*/
$window.resize(function(event) {

});// Close Resize function

/*
=== === === === === === ===
	Scroll function
=== === === === === === ===

Fires every time the user scrolls the page.
*/
$window.scroll(function(event) {
	
});// Close Scroll function


});// Close document ready function.


/*
=== === === === === === ===
	Load function
=== === === === === === ===

different from the ready function as it waits for all the media on the page to load
*/

$window.load(function() {
});// Close Load function