<head>
  <title>PAGE_TITLE</title>
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
<body>
  
<script>
//Initialise the controler. There can be multiple controllers.
var controller = new ScrollMagic.Controller();

//Create scenes and tweets (animations/transforms) for the controler.
$(function () { // wait for document ready

	// build scenes
	var scene1 = new ScrollMagic.Scene({triggerElement: '#pin', duration: '800'})//pixel value of how long it should be pinned for
					.setPin('#target')
					.triggerHook('onLeave') // onLeave starts the scene when the top of the element reaches the top of the element
					.addIndicators({name: 'Debugging'}) // For debugging
					.addTo(controller);
});
</script>

<style>
.container{
  width:100vw;
  height:100vh;
  position:relative;
}
.container > .row{
  width:100%;
  height:100%;
  position:relative;
}

.row:after, .row:before{
  content: " ";
  display: table;
}

#target{
  background-color:#bada55;
}

h2{
  text-align:center;
}

</style>

<div class="main">
  <div class="container">
    <div class="row">
      <h2 class="text-center">Pin Demo</h2>
    </div>
  </div>
  
  <div id="pin"></div>
  
  <div id="target">
    <div class="container">
      <div class="row">
        <h2>This element will follow the page down</h2>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row">
      <h2 class="text-center">Pin Demo</h2>
    </div>
  </div>
  
  
</div>
</body>