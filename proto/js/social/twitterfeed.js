$(function(){

	var currentProt = window.location.protocol;
	var currentHost = window.location.host;

	var getTweetsUrl = currentProt + '//' + currentHost + '/inc/get_tweets.php'

	if (currentHost === 'domain.local'){
		var url = window.location.href;
		var urlarray = url.split('/');
		var domain = urlarray.indexOf('domain.local');

		getTweetsUrl = 'http://domain.local/'+urlarray[(domain+1)]+'/inc/twitterfeed/get_tweets.php';
	}


	$.ajax({
		//url: 'http://ppj.balloonhost.co.uk/wp-content/themes/papajohns/inc/get_tweets.php',
		url:  getTweetsUrl,
		type: 'GET',
		success: function(response) {

			if (typeof response.errors === 'undefined' || response.errors.length < 1) {

				var $tweets = $('<ul></ul>');
				var count = 0;
				var outputNo = 0;

				$.each(response, function(i, obj) {
					if (outputNo < 3){
						if ( obj.in_reply_to_user_id === null) {
							// Before the append, JS to work out links and emojis from the content of the post.
							// Also need a loop to turn special characters into &# values.

							// Text validation
							var textContent = obj.text ;
							textContent = textContent.replace(/[']/g, '&#39;' );
							var textContentSplit = textContent.split(" ");

							count ++;



							for (var k = 0; k<textContentSplit.length; k++){
								var firstLetter = textContentSplit[k].charAt(0);

								// Removes RT @username from retweets.
								if ("retweeted_status" in obj && (k == 0 || k==1) ){
									textContentSplit[k] ='';
								}
								// Hashtags
								if (firstLetter === '#') {
									textContentSplit[k] = '<a href="https://twitter.com/hashtag/' + textContentSplit[k].substring(1) + '" > ' + textContentSplit[k] + '</a>';
								}
								// Mentions
								if (firstLetter === '@') {
									textContentSplit[k] = '<a href="https://twitter.com/' + textContentSplit[k].substring(1) + '" > ' + textContentSplit[k] + '</a>';
								};

								// Links
								if ( "urls" in obj.entities){
									if(obj.entities.urls.length > 0) {
										for (var j = 0; j < obj.entities.urls.length; j++){
											if (obj.entities.urls[j].url === textContentSplit[k]){
												textContentSplit[k] = '<a href="'+obj.entities.urls[j].url+'">'+obj.entities.urls[j].url+'</a>';
											}
										}
									};
								};

								// Images
								if ( "media" in obj.entities){
									if(obj.entities.media.length > 0) {
										for (var j = 0; j < obj.entities.media.length; j++){
											if (obj.entities.media[j].url === textContentSplit[k]){
												textContentSplit[k] = '</div><div class= "linked_img"><img class="linked_img" src="'+obj.entities.media[j].media_url+'">';
											}
										}
									};
								};

							};

							// Re-format date
							var postDate = obj.created_at.split(" ") ;
							var dayMonth = postDate[1] + ' ' + postDate[2];

							// Text for if it is a retweet:
							var ppjReTweet = '<span class="is-retweeted">PapaJohn&#39;s retweeted:</span>';

							// Re-join the text
							var textParsed = textContentSplit.join(' ');

							// Should Item be shown
							var shouldShowTweet = 'hide-tweet';

							if(count < 4){
								shouldShowTweet = 'tweet-top3';
							};
							if(count < 7 && count > 3){
								shouldShowTweet = 'tweet-top6 hide-tweet';
							};

							// For retweets
							if ("retweeted_status" in obj){
								$tweets.append('<li class="box tweet-single '+ shouldShowTweet +'"> <div class="tweet-wrap" id="' + obj.id_str + '"> <div class="profile_pic"> <a href="https://twitter.com/' + obj.retweeted_status.user.screen_name + '"> <img src="https://twitter.com/' + obj.retweeted_status.user.screen_name + '/profile_image?size=original" alt="User Profile Image" /> </a> </div> <span class="is-retweeted">PapaJohn&#39;s retweeted:</span> <div class="post-info"> <span class="twitter-user">' + obj.retweeted_status.user.name + ' <a href="https://twitter.com/' + obj.retweeted_status.user.screen_name + '">@' + obj.retweeted_status.user.screen_name + '</a> </span> <span class="post-date">' + dayMonth + '</span></div><div class="tweet-contents">'+ textParsed +'</div></li>');
							}
							// Tweets
							else{
								$tweets.append('<li class="box tweet-single '+ shouldShowTweet +'"> <div class="tweet-wrap" id="' + obj.id_str + '"> <div class="profile_pic"> <a href="https://twitter.com/' + obj.user.screen_name + '"> <img src="https://twitter.com/' + obj.user.screen_name + '/profile_image?size=original" alt="User Profile Image" /> </a> </div> <div class="post-info"> <span class="twitter-user">' + obj.user.name + ' <a href="https://twitter.com/' + obj.user.screen_name + '">@' + obj.user.screen_name + '</a> </span> <span class="post-date">' + dayMonth + '</span></div><div class="tweet-contents">'+ textParsed +'</div></li>');
							};

							outputNo ++;

						};
					};
				});

				$tweets.append('<span class="follow-twitter hide-tweet"><a href="https://twitter.com/intent/follow?screen_name=PapajohnsUK">Follow Us on Twitter</a></span>')
				$('.tweets-container').html($tweets);

			} else {
				$('.tweets-container p:first').text('Response error');
			};
		},
		error: function(errors) {
			$('.tweets-container p:first').text('Request error');

		}
	});
});
jQuery(document).ready(function($) {
	$('#show-more').click(function() {
		/* Act on the event */
		$('.tweet-top6').removeClass('hide-tweet');
		$('.follow-twitter').removeClass('hide-tweet');
	});
});
// <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
