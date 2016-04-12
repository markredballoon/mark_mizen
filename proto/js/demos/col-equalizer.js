/* 
Plugin for equalizing the height of columns in a row.
create a document ready function after 

Add this code after jQuery is loaded:
jQuery(window).load(function($) {
	colEqualizer([target element selector]);
});

For a demo check here: https://github.com/markredballoon/col-equalizer-js
*/
var respMinWidth 		= 767;
var respMaxWidth 		= 9999;

var noColumn 			= 0;
var elementName 		= '';

var noElements 			= 0;
var noRows 				= 0;

// Variable for while loop
var n 					= 0;

//inti function
function colEqualizer(selector, lowerBreakpoint, upperBreakpoint){
	// Name of elements 
	elementName = selector;

	// Number of elements
	noElements = $(elementName).length;

	// Calculates number of columns per row
	n = 0;
	while (n < noElements){
		if ( $(''+elementName+':eq('+n+')').offset().top == $(''+elementName+':eq(0)').offset().top ) {
			noColumn++;
			n++;
		}
		else{
			n = n + 9999;
		};
	};
	//console.log(noColumn);

	// Number of rows
	noRows = Math.ceil( noElements / noColumn );

	// Sets up break points. If a value of 0 is given then the default values are kept.
	var lowerBound = 0;
	var upperBound = 99999;

	if (typeof lowerBreakpoint === 'number' && typeof upperBreakpoint === 'number') {
		if (lowerBreakpoint < upperBreakpoint) {
			lowerBound = lowerBreakpoint;
			upperBound = upperBreakpoint;
		} 
		else{
			console.log('col-equalizer: Breakpoints not set up correctly. Make sure that the upper breakpoint is higher than the lower breakpoint');
		};
	}
	else{
		if (typeof lowerBreakpoint === 'number' || typeof upperBreakpoint === 'number') {
			console.log('col-equalizer: Breakpoints not set up correctly. Make sure you set both an upper and lower breakpoint.');
		};
	};


	if ( lowerBound < $(window).width() && $(window).width() < upperBound)
	{
		resizeElementHeight();
	}
	else{
		resetHeight();
	};


	$(window).on('resize', function(){
		if ( lowerBound < $(window).width() && $(window).width() < upperBound)
		{
			resizeElementHeight();
		}
		else{
			resetHeight();
		};
	});

};


function resizeElementHeight(){
	n = 0;
	noColumn = 0;
	while (n < noElements){
		if ( $(''+elementName+':eq('+n+')').offset().top == $(''+elementName+':eq(0)').offset().top ) {
			noColumn++;
			n++;
		}
		else{
			n = n + 9999;
		};
	};

	//console.log(noColumn);
	noRows = Math.ceil( noElements / noColumn );

	for (var row = 0; row < noRows; row++) {
		var rowHeightArray = [];
		var rowHeightMax = 0;

		i = row * noColumn;

		// Resets the column height to auto to check 'real' height of elements.
		for (var j = 0; j < noColumn; j++) {
			if ($(''+elementName+':eq('+(i+j)+')').length)
			{
				$(''+elementName+':eq('+(i+j)+')').css('min-height', 'auto');
			};
		};

		// Loop for every element in row
		for (var j = 0; j < noColumn; j++) {
			//Checks if element exists
			if ($(''+elementName+':eq('+(i+j)+')').length)
			{
				// Adds height of element into rowHeightArray
				rowHeightArray.push($(''+elementName+':eq('+(i+j)+')').height());
			}
			else
			{
				// Adds 0 to array if element doesn't exist
				rowHeightArray.push(0);
			};
		};

		// Changes column heights to equal largest hight in row 
		rowHeightMax = Math.max.apply(Math, rowHeightArray);
		rowHeightMax = rowHeightMax + 2;

		for (var j = 0; j < noColumn; j++) {
			if ($(''+elementName+':eq('+(i+j)+')').length)
			{
				$(''+elementName+':eq('+(i+j)+')').css('min-height', rowHeightMax+'px');
			};
		};
	};
};

function resetHeight(){
	for (var row = 0; row < noRows; row++) {
		i = row * noColumn;
		for (var j = 0; j < noColumn; j++) {
			if ($(''+elementName+':eq('+(i+j)+')').length)
			{
				$(''+elementName+':eq('+(i+j)+')').css('min-height', 'auto');
			};
		};
	}
};

/* 
Known bugs:

1.	Images that load after the js file can cause the initial column sizes to go to the wrong value. Need to find a way of making the script wait until after the images are loaded.
2.	May have an issue with border box in some applications.
3.	Needs testing on all browzers and devices.

Future development:

1.	Make plugin work for columns with multiple width values.
*/