/*
=== === === === === === ===
  Global Variables
=== === === === === === ===

Variables used throughout the javascript.
*/

var $window = $(window);

var $bgWrap = $('.bg-carousel-wrap');
var $staticDiv = $('.bg-carousel-wrap .bg-carousel-static');
var $animateDiv = $('.bg-carousel-wrap .bg-carousel-animate');
var controls = '.moveBackground';
var noBackgrounds = backgroundImages.length - 1;
var curBackground = 0;
var bgArray = backgroundImages ;



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
function changePagination(){
  $(controls).removeClass('current');
  $('.bg-carousel-control '+controls).eq(curBackground).addClass('current');
};


function moveBackground(target){
  if ( !throttleAction ){
    $staticDiv.css('background-image', 'url('+bgArray[curBackground]+')');
     
    if (curBackground < target){
      $('.bg-carousel-wrap').addClass('clear');
      $animateDiv.css('background-image', 'url('+bgArray[target]+')');
      $animateDiv.addClass('from-right');
      setTimeout( function(){$animateDiv.addClass('animate')}, 10 );
      setTimeout( function(){
        $animateDiv.removeClass('from-right').removeClass('animate');
        $staticDiv.css('background-image', 'url('+bgArray[curBackground]+')');
        $('.bg-carousel-wrap').removeClass('clear');
      }, 800);
      curBackground = target;
      setTimeout( function(){
        $('body').addClass('hide-all-text');
        textToggle = false;
      }, 10);
    }
    if(curBackground > target){
      $bgWrap.addClass('clear');
      $animateDiv.css('background-image', 'url('+bgArray[target]+')');
      $animateDiv.addClass('from-left');
      setTimeout( function(){$animateDiv.addClass('animate')}, 10 );
      setTimeout( function(){
        $animateDiv.removeClass('from-left').removeClass('animate');
        $staticDiv.css('background-image', 'url('+bgArray[curBackground]+')');
        $bgWrap.removeClass('clear');
      }, 800);
      curBackground = target;
      setTimeout( function(){
        $('body').addClass('hide-all-text');
        textToggle = false;
      }, 10);
    };
    changePagination();
    throttle();
  }
};

//Swipe controls

//Swipe functions only load when jquery mobile is loaded
/*
$(function() {
  $('.infinite-carousel-wrap:not(".clear")').swipe( {
    swipeLeft:function(event, direction, distance, duration, fingerCount) {
      if( noBackgrounds > 1 && !throttleAction ){
        var newSlide = 0;
        if (curBackground === noBackgrounds-1){
          $('.infinite-carousel-wrap').addClass('clear');
          newSlide = 0;
          $animateDiv.css('background-image', 'url('+bgArray[newSlide]+')');
          $animateDiv.addClass('from-right');
          setTimeout( function(){$animateDiv.addClass('animate')}, 10 );
          setTimeout( function(){
            $animateDiv.removeClass('from-right').removeClass('animate');
            $staticDiv.css('background-image', 'url('+bgArray[curBackground]+')');
            $('.infinite-carousel-wrap').removeClass('clear');
          }, 800);
          curBackground = newSlide;
          changePagination();
          setTimeout( function(){
            $('body').addClass('hide-all-text');
            textToggle = false;
          }, 10);
          throttle();
        }
        else {
          newSlide = curBackground+1;
          moveBackground(newSlide);
        };
      };
    }
  });
});
$(function() {
  $('.infinite-carousel-wrap:not(".clear")').swipe( {
    swipeRight:function(event, direction, distance, duration, fingerCount) {
      if( noBackgrounds > 1 && !throttleAction ){
        var newSlide = 0;
        if (curBackground === 0){
          $('.bg-carousel-wrap').addClass('clear');
          newSlide = noBackgrounds-1;
          $animateDiv.css('background-image', 'url('+bgArray[newSlide]+')');
          $animateDiv.addClass('from-left');
          setTimeout( function(){$animateDiv.addClass('animate')}, 10 );
          setTimeout( function(){
            $animateDiv.removeClass('from-left').removeClass('animate');
            $staticDiv.css('background-image', 'url('+bgArray[curBackground]+')');
            $('.infinite-carousel-wrap').removeClass('clear');
          }, 800);
          curBackground = newSlide;
          changePagination();
          setTimeout( function(){
            $('body').addClass('hide-all-text');
            textToggle = false;
          }, 10);
          throttle();
        }
        else {
          newSlide = curBackground-1;
          moveBackground(newSlide);
        };
      };
    }
  });
});
*/
jQuery(document).ready(function($) {
  $staticDiv.css('background-image', 'url('+bgArray[0]+')');
});