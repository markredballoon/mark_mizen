/*
=== === === === === === ===
This is the javascript for the bg-carousel page.
html: ../proto/bg-carousel.php
css: ../proto/bootstrap/less/rb/bg-carousel.less
=== === === === === === ===
*/

/*
=== === === === === === ===
  Global Variables
=== === === === === === ===

Variables used throughout the javascript.

The variable backgroundImages is set in the php of the page. This is where the sources for the background elements are bought in.

*/

var $window = $(window);

var $bgWrap             = $('.bg-carousel-wrap');
var $staticDiv          = $('.bg-carousel-wrap .bg-carousel-static');
var $animateDiv         = $('.bg-carousel-wrap .bg-carousel-animate');
var $controls           = $('.bg-carousel-control .move-background');
var noBackgrounds       = backgroundImages.length - 1;
var curBackground       = 0;
var bgArray             = backgroundImages ;


// Throttle to prevent spamming of the moveBackground function
var throttleAction = false;
function throttle(){
  if (throttleAction == true){
    return false
  }
  else if (throttleAction == false){
    throttleAction = true;
    setTimeout( function(){
      throttleAction = false;
    }, 900 );
    return true;
  };
};

/*
=== === === === === === ===
  Callback Functions
=== === === === === === ===

Functions that are called multiple times.

*/

// Changes which of the carousel controls has the 'current' class. Background color is for clarity of which element has the current class
function changePagination(){
  $controls.removeClass('current').css('background-color', 'transparent');
  $controls.eq(curBackground).addClass('current').css('background-color', 'green');
};

// Moves the background to the target
// direction can equal left or right
function moveBackground(target, direction){
  if ( !throttleAction && target != curBackground){
    $staticDiv.css('background-image', 'url('+bgArray[curBackground]+')');

    // Which direction is the carousel going:
    var directionClass = '';

    if (direction === 'left') {
      directionClass = 'from-left';
    }
    else if( direction === 'right' ){
      directionClass = 'from-right';
    }
    else if (curBackground < target){
      directionClass = 'from-right';
    }
    else {
      directionClass = 'from-left';
    };

    $('.bg-carousel-wrap').addClass('clear');
    $animateDiv.css('background-image', 'url('+bgArray[target]+')');
    $animateDiv.addClass(directionClass);
    setTimeout( function(){
      $animateDiv.addClass('animate')
    }, 10 );
    setTimeout( function(){
      $animateDiv.removeClass(directionClass).removeClass('animate');
      $staticDiv.css('background-image', 'url('+bgArray[curBackground]+')');
      $('.bg-carousel-wrap').removeClass('clear');
    }, 800);
    curBackground = target;
    setTimeout( function(){
      textToggle = false;
    }, 10);

    updateControl();
  }

};

// Functions for going to the next or previous slides:
function nextSlide(){
  var nextBackground = curBackground + 1;
  if (nextBackground > noBackgrounds){ nextBackground = 0 };
  moveBackground(nextBackground, 'right');
}
function prevSlide(){
  var prevBackground = curBackground - 1;
  if (prevBackground < 0){ prevBackground = noBackgrounds};
  moveBackground(prevBackground, 'left');
}

function updateControl(){
  $controls.removeClass('current');
  $controls.eq(curBackground).addClass('current');
}

// Ready function
jQuery(document).ready(function($) {
  updateControl();
  $staticDiv.css('background-image', 'url('+bgArray[0]+')');
});
