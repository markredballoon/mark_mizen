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
	<title>TwitterFeed</title>

	<!-- CSS Files -->
	<link rel="stylesheet" href="style.css?version=1" />

</head>
<body id="body" class="page-template-homepage page-id-# page-slug">
<div id="main">

<div class="container">
  <div class="row">
    <div class="col-xs-24">
      <h1>This is the twitter feed developed for the Papa Johns blog site</h1>
      <p>
        js: proto/js/social/twitterfeed.js
        <br/>
        css: proto/css/twitterfeed.css
        <br/>
        php backend: ./inc/twitterfeed/*
      </p>
      <p>
        The html that is output can be changed in the css file. Change the target twitter page by changing the '$screen_name' variable on line 11 of ./inc/twitterfeed/get_tweets.php
      </p>
    </div>
  </div>
  <div class="row">
    <div class="tweets-container">
    </div>

  </div>

</div>


</div><!--main-->

<!-- JS files -->
<!-- Jquery -->
<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8" ></script>

<!-- Bootstrap core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

<!--twitterfeed files-->
<script src="js/social/twitterfeed.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/twitterfeed.css" />


</body>
</html>
