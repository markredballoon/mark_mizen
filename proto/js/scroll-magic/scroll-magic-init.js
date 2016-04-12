
var controller = new ScrollMagic.Controller();
var pageHeight = $(window).height();

$(function () { // wait for document ready
		// build scene
		var scene = new ScrollMagic.Scene({triggerElement: "#trigger1", duration: 300})
						.setPin("#pin1")
						.triggerHook('onLeave')
						.addIndicators({name: "1 (duration: 900)"})
						.addTo(controller);
		var scene = new ScrollMagic.Scene({triggerElement: "#trigger2", duration: 300})
						.setPin("#pin2")
						.triggerHook('onLeave')
						.addTo(controller);
});