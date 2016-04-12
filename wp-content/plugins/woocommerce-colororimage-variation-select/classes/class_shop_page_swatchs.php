<?php
class wcva_shop_page_swatches {

    public function __construct() {

	    add_action('init', array(&$this, 'wcva_shop_page_init'));
	    add_action( 'wp_enqueue_scripts', array(&$this,'wcva_register_shop_scripts' ));
	}
	
	public function wcva_shop_page_init() {
		$swatch_location  = get_option('woocommerce_shop_swatches_display',"01");
		
		switch($swatch_location) {
			
			case "01":
			  add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'wcva_change_shop_attribute_swatches'));
			  break;
			  
			case "02":
			  add_action('woocommerce_before_shop_loop_item_title', array(&$this, 'wcva_change_shop_attribute_swatches'));
			  break;
			
			case "03":
			  add_action('woocommerce_after_shop_loop_item', array(&$this, 'wcva_change_shop_attribute_swatches'));
			  break;
			 
			default:
			  add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'wcva_change_shop_attribute_swatches'));
			
		}
		
	   
	}
    
	public function wcva_register_shop_scripts() {
       
       if (is_shop() || (is_product_category()) || is_product_tag()) {
		   wp_enqueue_script('jquery');
           wp_enqueue_script( 'wcva-shop-frontend', ''.wcva_PLUGIN_URL.'js/shop-frontend.js');
		   wp_enqueue_style( 'wcva-shop-frontend', ''.wcva_PLUGIN_URL.'css/shop-frontend.css');
       }

	}
	
	public function wcva_change_shop_attribute_swatches($product) {
	  global $product; 
	  
	  $product_type             =  $product->product_type;
	  $shop_swatches            =  get_post_meta( $product->id, '_shop_swatches', true );
	  $shop_swatches_attribute  =  get_post_meta( $product->id, '_shop_swatches_attribute', true );
	  $fullarray                =  get_post_meta( $product->id, '_coloredvariables', true );
	  $template                 =  '';

	  if (isset($fullarray[$shop_swatches_attribute]['values']) )
	      $_values                  =  $fullarray[$shop_swatches_attribute]['values'];
	
	
	  
	    
	  if (($product_type == 'variable') && isset($shop_swatches) && ($shop_swatches == "yes") ) {
	     
		 if (isset($shop_swatches_attribute) && ($fullarray[$shop_swatches_attribute]['display_type'] == "colororimage")) {
		   $template=$this->wcva_variable_swatches_template($_values,$shop_swatches_attribute,$product->id);
	     } 
		 
	 }
	  
	  return $template;
	 }



	 /**
	  * Shows text for variable products with swatches enabled
	  * @$values- attribute value array of swatch settings
	  * @name- attribute name
	  * $pid - product id to get product url
	  */
	 public function wcva_variable_swatches_template($values,$name,$pid ) { 
	  
	        $imagewidth  = get_option('woocommerce_shop_swatch_width',"32");  

	        $imageheight = get_option('woocommerce_shop_swatch_height',"32");  
			
			$direct_link = get_option('woocommerce_shop_swatch_link', 0);  
			
			$product_url = get_permalink( $pid );
			
			
        ?>
      
	   <div class="shopswatchinput productitle" prod-img="">
	     <?php  if (is_shop() || (is_product_category()) || is_product_tag()) {          ?>
	     <?php  foreach ($values as $key=>$value) { 

             
			 $lower_name       =   strtolower( $name );
			 $clean_name       =   str_replace( 'pa_', '', $lower_name );
			 $lower_key        =   rawurldecode($key);
			 
			 
             $direct_url       =  ''.$product_url.'?'.$clean_name.'='.$lower_key.'';
			 
             $swatchimage      =  $value['image'];

             $swatchimageurl   =  wp_get_attachment_thumb_url($swatchimage);

             $hoverimage       =  $value['hoverimage'];
             
             $thumb_url = wp_get_attachment_image_src( $hoverimage, 'full' );

             $hoverimageurl    =  $thumb_url[0];
           
            switch ($value['type']) {
             	case 'Color':
             		?>
                    <a <?php if (isset($direct_link) && ($direct_link == "yes")) { ?> href="<?php echo $direct_url; ?>" <?php } ?> class="wcvaswatchinput" data-o-src="<?php if (isset($hoverimageurl)) { echo $hoverimageurl; } ?>" >
                       <div class="wcvashopswatchlabel" style="background-color:<?php if (isset($value['color'])) { echo $value['color']; } else { echo '#ffffff'; } ?>; width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px;">
                       </div>
                    </a>
             		<?php
             		break;

             	case 'Image':
             		?>
                    <a <?php if (isset($direct_link) && ($direct_link == "yes")) { ?> href="<?php echo $direct_url; ?>" <?php } ?> class="wcvaswatchinput" data-o-src="<?php if (isset($hoverimageurl)) { echo $hoverimageurl; } ?>" >
                      <div class="wcvashopswatchlabel"  style="background-image:url(<?php if (isset($swatchimageurl)) { echo $swatchimageurl; } ?>); background-size: <?php echo $imagewidth; ?>px <?php echo $imageheight; ?>px; width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px;">
                      </div>
                    </a>
             		<?php
             		break;
             	
             
             } 
            

        
         ?>
	     <?php } ?>
		 <?php } ?>
	   </div>
	     
	 <?php }



}

new wcva_shop_page_swatches();
?>