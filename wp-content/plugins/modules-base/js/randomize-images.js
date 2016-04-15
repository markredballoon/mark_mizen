var $panelElement;
// get a radom number between 1 and 3
var randNum = Math.floor(Math.random() * 3 + 1);

$(document).ready(function() {
  $('.ez-forge').addClass( 'background-'+randNum );
});
