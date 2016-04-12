// Add this code at the top of the body tag to load the facebook feed.

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


/* Accompanying HTML 
go to this page https://developers.facebook.com/docs/plugins/page-plugin to create the element that goes within the page.
---

<div id="facebookFeed" class="sbBox hidden-sm hidden-xs">
	<div class="fb-page" data-href="https://www.facebook.com/mizunogolf" data-width="100%" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/mizunogolf"><a href="https://www.facebook.com/mizunogolf">Mizuno Golf EU</a></blockquote></div></div>					
</div><!-- Facebook feed -->	

---
*/