
jQuery(document).ready(function($j) {


	   $j('form.variations_form').on( 'click', 'label', function() {
	      $j( this ).closest('.attribute-swatch').find('.selectedswatch').removeClass('selectedswatch').addClass('wcvaswatchlabel');
	      $j( this ).removeClass('wcvaswatchlabel').addClass( 'selectedswatch' );
			
         var selectid= $j(this).attr("selectid");
         var option = $j(this).attr("data-option");

        //find the option to select
        var optionToSelect = parent.jQuery("form.variations_form #" + selectid + "").children("[value='" + option + "']");

         //mark the option as selected
        optionToSelect.prop("selected", "selected").change();

        
       } );	   
  

        
	
});


