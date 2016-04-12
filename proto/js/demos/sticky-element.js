var $container 				=  $('.static-hero');
var stickyElementWrap 		= 'page-title-wrap';


function stickTitle(){
	$container.each(function(index, el) {
		var parentHeight = $(this).height();
		var staticOffset = 115;

		if( $(window).width()< 1200 ){ staticOffset = 71; };
		if( $(window).width()< 696 ){ 
			staticOffset = ( $main.height() )/2 - ( $(this).find('span').height() )/2 - 72 - 80;
		};

		var childHeight = $(this).find(stickyElementWrap).height() - staticOffset;
		if (parentHeight >= childHeight && $(this).offset().top <= -(staticOffset) ) {
			if ( -($(this).offset().top) < (parentHeight - childHeight ) ){
				//$(this).find('.page-title-wrap').css('top',   - ( ($(this).offset().top) + (staticOffset) )  +'px');
				$(this).find(stickyElementWrap).addClass('moving');
				$(this).find(stickyElementWrap).css({
					'top': -( ($(this).offset().top) + (staticOffset) ) + 'px',
					'opacity': 1 + ( ($(this).offset().top) / (parentHeight - childHeight ))
				});
			}
			if( -($(this).offset().top) >= (parentHeight - childHeight + staticOffset) ){
				//$(this).find('.page-title-wrap').css('top',   (parentHeight - childHeight - (staticOffset) ) +'px');
				$(this).find(stickyElementWrap).removeClass('moving');
				$(this).find(stickyElementWrap).css({
					'top': (parentHeight - childHeight - (staticOffset) ) +'px',
					'opacity': 0
				});
			}
		}
		else{
			$(this).find(stickyElementWrap).removeClass('moving');
			$(this).find(stickyElementWrap).css({
				'top' : 0,
				'opacity' : 1
			});
		};
	});
}
