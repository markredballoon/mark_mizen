(function($) {

         

       	 $(document).on( 'mouseover', '.wcvaswatchinput', 
       	 	function( e ){
              var hoverimage    = $(this).attr('data-o-src');
              var parent        = $(this).closest('li');
              var parentdiv     = $(this).closest('div.shopswatchinput');
              var productimage  = $("img",parent).attr("src"); 
           
               if (hoverimage) {
                $("img",parent).attr("src",hoverimage);
                $(parentdiv).attr("prod-img",productimage);
               }
             }

               


         );
		 
	
        
        
})(jQuery);