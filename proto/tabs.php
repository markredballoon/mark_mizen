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
	<title>Tabs</title>

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
  <div class="row">
    <div class="col-xs-24">
      <h1>Tabs</h1>
      <p>
        clicking on one of the tabs at the top will open a different content section at the bottom.
      </p>
      <p>
        css: proto/bootstrap/less/rb/tabs.less
        <br>
        js: proto/js/custom.js
      </p>
    </div>
  </div>
	<div class="row">

	<div id="tabs1" class="tabs-outer">
		<div class="tab-selector">
			<ul class="text-center">
				<li class="col-xs-8">
					<a href="#/" onclick="changeTab('#tabs1 .tab', 0)" class="active-tab" data-tab="0">
						<div class="image-wrap">
							<img src="images/placeholder.png" alt="1">
						</div>
						<h4>Tab 0</h4>
					</a>
				</li>
				<li class="col-xs-8">
					<a href="#/" onclick="changeTab('#tabs1 .tab', 1)" data-tab="1">
						<div class="image-wrap">
							<img src="images/placeholder.png" alt="1">
						</div>
						<h4>Tab 1</h4>
					</a>
				</li>
				<li class="col-xs-8">
					<a href="#/" onclick="changeTab('#tabs1 .tab', 2)" data-tab="2">
						<div class="image-wrap">
							<img src="images/placeholder.png" alt="1">
							<div class="overlay hover"></div>
							<div class="hover-text">
								<div class="hover-text">
									<span class="h3">Tab 2</span>
								</div>
							</div>
						</div>
					</a>
				</li>
			</ul>
		</div>

		<div class="tabs-wrap">
			<ul>
				<li class="tab active-tab clearfix">
					<div class="col-xs-6">
						<div class="image-wrap">
							<img src="images/placeholder.png" alt="">
						</div>
					</div>
					<div class="col-xs-18">
						<h3>TITLE 0</h3>
						<p>Content</p>
					</div>
				</li>
				<li class="tab clearfix">
					<div class="col-xs-6">
						<div class="image-wrap">
							<img src="images/placeholder.png" alt="">
						</div>
					</div>
					<div class="col-xs-18">
						<h3>TITLE 1</h3>
						<p>Content</p>
					</div>
				</li>
				<li class="tab clearfix">
					<div class="col-xs-6">
						<div class="image-wrap">
							<img src="images/placeholder.png" alt="">
						</div>
					</div>
					<div class="col-xs-18">
						<h3>TITLE 2</h3>
						<p>Content</p>
					</div>
				</li>
			</ul>
		</div>
	</div><!--/tabs1-->

	</div>
</div>





</div><!--/main-->
<!-- JS files -->
<!-- Jquery -->

<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8" ></script>

<!-- Bootstrap core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>


<!-- Custom JS files -->
<script src="js/custom.js" type="text/javascript" charset="utf-8"></script>


</body>
</html>
