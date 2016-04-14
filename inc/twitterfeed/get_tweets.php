<?php

require_once('twitter_proxy.php');

// Twitter OAuth Config options
$oauth_access_token = '3621147675-2eH2AbJ7BMgD3rWOqtEOhMI3ECXWNYZGKjmygQU';
$oauth_access_token_secret = 'EbztXx7Qh3m0pKTFRrzlzbnbXM7FMW66M9MRMx8qnVE4L';
$consumer_key = '56A5exIKimTug0CqbNKJ7ZYGj';
$consumer_secret = 'BvSTgz2u4B5KRRfeTMoVWzIGBGaNXain9B6GWCgGM3vzMV5K9h';
$user_id = '9016959';
$screen_name = 'papajohnsuk';
$count = 200;
$exclude_replies = 'true';

$twitter_url = 'statuses/user_timeline.json';
$twitter_url .= '?user_id=' . $user_id;
$twitter_url .= '&screen_name=' . $screen_name;
$twitter_url .= '&count=' . $count;

// Create a Twitter Proxy object from our twitter_proxy.php class
$twitter_proxy = new TwitterProxy(
	$oauth_access_token,								// 'Access token' on https://apps.twitter.com
	$oauth_access_token_secret,					// 'Access token secret' on https://apps.twitter.com
	$consumer_key,											// 'API key' on https://apps.twitter.com
	$consumer_secret,										// 'API secret' on https://apps.twitter.com
	$user_id,														// User id (http://gettwitterid.com/)
	$screen_name,												// Twitter handle
	$count															// The number of tweets to pull out
);

// Invoke the get method to retrieve results via a cURL request
$tweets = $twitter_proxy->get($twitter_url);

echo $tweets;

?>
