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
	<title>PAGE TITLE</title>

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

<header>

	<div class="bg"></div>

	<div class="container">
		<div class="row">

			<div class="logo">
				<a href="#/">
					<span class="">LOGO</span>
				</a>
			</div><!--/logo-->

			<button type="button" class="nav-toggle toggle visible-xs visible-sm" id="menu-toggle" onclick="toggleShow('.mobile-nav')">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<nav class="main-nav">
				<ul>
					<li>
						<a href="#/">
							<span>
								Item_primary
							</span>
						</a>
					</li>

					<li class="dropdown toggle">
						<a href="#/">
							<span>
								Item (dropdown)
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#/">
									<span>
										Dropdown Item
									</span>
								</a>
							</li>

							<li>
								<a href="#/">
									<span>
										Dropdown Item
									</span>
								</a>
							</li>

							<li>
								<a href="#/">
									<span>
										Dropdown Item
									</span>
								</a>
							</li>
						</ul>
					</li><!--/dropdown-->
					
					<li class="mega-menu toggle">
						<a href="#/">
							<span>
								Item_megamenu
							</span>
						</a>
						<ul class="sub-menu">
							<div class="container">
							<div class="image-wrap">
								<img src="images/placeholder.png" alt="">
							</div><!--/image-wrap-->
							<div class="image-wrap">
								<img src="images/placeholder.png" alt="">
								<div class="overlay"></div>
							</div><!--/image-wrap-->
							<div class="image-wrap">
								<img src="images/placeholder.png" alt="">
							</div><!--/image-wrap-->
							</div>

							<li>
								<a href="">
									<span>
										Megamenu_Item
									</span>
								</a>
							</li>

							<li>
								<ul>
									<li>
										<a href="">
											<span>Sub_menu_within_mega</span>
										</a>
									</li>
									<li>
										<a href="">
											<span>Sub_menu_within_mega</span>
										</a>
									</li>
								</ul>
							</li>

						</ul><!--/sub-menu-->

					</li><!--/mega-menu-->

					<li class="secondary hidden-sm hidden-xs">
						<a href="#/">
							<span>
								Item_secondary
							</span>
						</a>
					</li>

					<li class="secondary hidden-sm hidden-xs">
						<a href="#/">
							<span>
								Item_secondary
							</span>
						</a>
					</li>

				</ul>
			</nav><!--/main-nav-->

			<nav class="header-links">
				<ul>
					<li>
						<a href="#/">
							<span>
								Link_1
							</span>
						</a>
					</li>

					<li>
						<a href="#/">
							<span>
								Link_2
							</span>
						</a>
					</li>
				</ul>
			</nav><!--/header-links-->

		</div><!--/row-->

		<div class="row">
			<nav class="mobile-nav">
				<ul>

					<li>
						<a href="#/">
							<span>
								Mobile_Item_1
							</span>
						</a>
					</li>

					<li>
						<a href="#/">
							<span>
								Mobile_Item_2
							</span>
						</a>
					</li>

				</ul>
			</nav><!--/mobile-nav-->
		</div><!--/row-->

	</div><!--/container-->
</header>

<div class="container">
	<div class="row">
		<p>The megamenu is a menu with lots of content within. A dropdown is a dropdown list. The secondary menu items disapear at sm screen sizes when the mobile-nav appears(breakpoints may be better to add with media queries not with hidden-{{}} and visible-{{}} classes).</p>
		<p>The onclick toggle should be targeted to the section you want to toggle a class on. The styles for what happens when they swap should be addded in the less.</p>
	</div>
</div>

<!-- JS files -->
<!-- Jquery -->
<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8" ></script>

<!-- Bootstrap core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>  

<!-- Custom JS files -->
<script src="js/custom.js" type="text/javascript" charset="utf-8"></script>


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