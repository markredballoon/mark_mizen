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
	<title>Inline SVGs</title>

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

</head>
<body id="body" class="page-template-homepage page-id-# page-slug">
<div id="main">

<div class="container">
	<div class="bg" style="background-color:rgb(199,199,199);"></div>
	<div class="row">
    <div class="col-xs-24">
      <h1>Inline SVGs</h1>
      <p>
        Add the svg file to the proto/inline_svgs/ folder.
      </p>
      <p>
        css and js for the transition effect: inline at the bottom of the html.
      </p>
    </div>
		<div class="col-xs-8 col-xs-offset-8">
			<div class="image-wrap">
				<?php
				echo file_get_contents('inline_svgs/example_arrow.svg');
				?>
			</div>
		</div>

	</div>
</div>


</div><!--main-->

<!-- JS files -->
<!-- Jquery -->
<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8" ></script>

<!-- Bootstrap core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

<!-- Custom JS files -->
<script src="js/custom.js" type="text/javascript" charset="utf-8"></script>

<script>
  // Colors to cycle through
	var colors = ['#333','#999','#101','#00f'];
	var counter = 0;

	jQuery(window).load(function() {
		var svgInterval = setInterval( function(){
			if (counter < colors.length ) {
				jQuery('#target').attr('fill', (colors[counter]));
				counter++;
			}
			else{
				counter = 0;
				jQuery('#target').attr('fill', (colors[counter]));
				counter++;
			};
		},3000);
	});
</script>
<style>
/* The changes can also be animated with CSS */
#target{
	transition: fill 0.8s;
}
</style>
<!-- Analytics -->
<? /*
<script src="js/analytics.js" type="text/javascript" charset="utf-8" async defer></script>

<noscript>
	<div>
		<img src="//mc.yandex.ru/watch/29248395"  style="position:absolute;left:-9999px;" alt="" />
	</div>
</noscript>
*/?>

</body>
</html>
