<!DOCTYPE html>
<html>
<head>
	<!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Page Title -->
	<title>ScrollMagic</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="/favicons/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="/favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#254c75">
	<meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">

	<!-- CSS Files -->
	<link rel="stylesheet" href="style.css?version=1" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<!--lookbook JS-->
	<script type="text/javascript" src="js/scroll-magic/jquery.min.js"></script>
	<script type="text/javascript" src="js/scroll-magic/highlight.pack.js"></script>
	<script type="text/javascript" src="js/scroll-magic/modernizr.custom.min.js"></script>
	<script type="text/javascript" src="js/scroll-magic/ScrollMagic.min.js"></script>
	<script type="text/javascript" src="js/scroll-magic/debug.addIndicators.min.js"></script>
	<script type="text/javascript" scr="js/scroll-magic/scroll-magic-init.js"></script>


	<script type="text/javascript" src="js/scroll-magic/greensock/plugins/ScrollToPlugin.min.js"></script>
	<script type="text/javascript" src="js/scroll-magic/greensock/TweenMax.min.js"></script>
	<script type="text/javascript" src="js/scroll-magic/animation.gsap.js"></script>

</head>
<body id="body" class="page-template-homepage page-id-# page-slug">

<script>

/* This requires a lot more then can be put into this proto file.
Check the documentation: http://janpaepke.github.io/ScrollMagic/docs/index.html
and the demos: http://scrollmagic.io/examples/index.html

It is very complicated and anything beyond simple pinning can take a long time to get working fully. There are also tons of options for fine tuning the animations.
*/
	var controller = new ScrollMagic.Controller();

	$(function () { // wait for document ready
		// build tweens
		var tween1 = new TimelineMax ()
		tween1.to('#page2 .bg', 1, {opacity:1}, 0);

		// build scenes
		var scene1 = new ScrollMagic.Scene({triggerElement: "#trigger2", duration: 800})
						.setPin("#page2")
						.triggerHook('onLeave')
						.setTween(tween1)
						.addIndicators({name: "1 (duration: 500)"})
						.addTo(controller);

		// change behaviour of controller to animate scroll instead of jump
		controller.scrollTo(function (newpos) {
			TweenMax.to(window, 0.7, {scrollTo: {y: newpos}});
		});

		//  bind scroll to anchor links
		$(document).on("click", "a[href^='#']", function (e) {
			var id = $(this).attr("href");
			if ($(id).length > 0) {
				e.preventDefault();

				// trigger scroll
				controller.scrollTo(id);
				// if supported by the browser we can even update the URL.
				if (window.history && window.history.pushState) {
					history.pushState("", document.title, id);
				}
			}
		});
	});

</script>

<div id="main">

<div id="static-ui">
	<nav>
		<ul class="v-list">
			<li><a href="#page1" class=""><span>Page1</span></a></li>
			<li><a href="#page2" class=""><span>Page2</span></a></li>
			<li><a href="#page3" class=""><span>Page3</span></a></li>
		</ul>
	</nav>
</div>

<div id="trigger1" class="spacer s0"></div>
<div class="full-width" id="page1">
	<div class="bg" style="background-color:#eed;"></div>
	<div class="container window-height">
		<div class="row">
			<h3 class="text-center">Panel_1</h3>
			<p>Scroll down</p>
		</div>
	</div>
</div>

<div id="trigger2" class="spacer s0"></div>
<div class="full-width" id="page2">
	<div class="bg" style="background-color:#bbb; opacity: 0;"></div>
	<div class="container window-height">
		<div class="row">
			<h3 class="text-center">Panel_2</h3>
			<p>The background of this pannel fades in as you scroll down the page</p>
			<p>The panel also follows you down the page</p>
		</div>
	</div>
</div>

<div id="trigger3" class="spacer s0"></div>
<div class="full-width" id="page3">
	<div class="bg" style="background-color:#eed;"></div>
	<div class="container window-height">
		<div class="row">
			<h3 class="text-center">Panel_3</h3>

		</div>
	</div>
</div>

</div><!--main-->
<!-- JS files -->
<!-- Jquery [brought in in head]-->

<!-- Bootstrap core JavaScript [brought in in head]
<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>  -->

<!-- Custom JS files -->
<script src="js/custom.js" type="text/javascript" charset="utf-8"></script>

<!-- Analytics -->
<?/*
<script src="js/analytics.js" type="text/javascript" charset="utf-8" async defer></script>

<noscript>
	<div>
		<img src="//mc.yandex.ru/watch/29248395"  style="position:absolute;left:-9999px;" alt="" />
	</div>
</noscript>
*/?>

</body>
</html>
