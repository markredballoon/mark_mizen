// Javascript for the video plugin
var loadedPage = false;  //Was used to prevent click before loading. Doesn't work on ios however.
var isIOS = false;

if ( navigator.userAgent.match(/(iPod|iPhone|iPad)/) ) {
  isIOS = true;
}


function VBcallPlayer(frame_id, func, args) {
    if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
    var iframe = document.getElementById(frame_id);
    if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
        iframe = iframe.getElementsByTagName('iframe')[0];
    }
    if (iframe) {
        iframe.contentWindow.postMessage(JSON.stringify({
            "event": "command",
            "func": func,
            "args": args || [],
            "id": frame_id
        }), "*");
    }
}

function addIDstoVideos(){
  $('.video-base iframe').each(function(index, el) {
    $(this).attr('id', 'vid_' + index);
  });
  loadedPage = true;
}

function VBplayVideo(target){
  // Plays video within target element
  if(loadedPage){
    $target = $(target);
    $target.addClass('play-video');
    if( !isIOS ){
      VBcallPlayer( $target.find('iframe').attr('id'), 'playVideo' );
    }
  } else {
    addIDstoVideos();
    VBplayVideo(target);
  };
}


$(document).ready(function() {
  addIDstoVideos();
});
