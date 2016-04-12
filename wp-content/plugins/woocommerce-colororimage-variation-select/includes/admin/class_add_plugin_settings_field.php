<?php
class wcva_add_shop_swatch_settings {
      
      public function __construct() {
      	add_action( 'woocommerce_product_settings', array(&$this,'wcva_add_product_settings_field' ));
		add_filter( 'plugin_action_links_' . wcva_base_url , array(&$this,'wcva_add_action_links' ) );


      }
	  
	  public function wcva_add_action_links ( $links ) {
           $mylinks = array(
              '<a href="' . admin_url( '/admin.php?page=wc-settings&tab=products&section=display' ) . '">Settings</a>',
             );
           return array_merge( $links, $mylinks );
      }


      public function wcva_add_product_settings_field($settings) {
          
          $updated_settings = array();
		  
		    

            foreach ( $settings as $section ) {
				
				

             if ( isset( $section['id'] ) && 'catalog_options' == $section['id'] && isset( $section['type'] ) && 'sectionend' == $section['type'] ) {
                 
				
				 $updated_settings[] =array(

                          'name'     => __( 'Woocommerce color or image variation swatches Purchase Code', 'wcva' ),

                          'desc_tip' => __( 'Enter your envato item purchase code.Visit codecanyon.net/downloads to get your item purchase code.Valid item purchase code is required to receive automatic updates', 'wcva' ),

                          'id'       => 'woocommerce_wcva_purchase_code',

                          'type'     => 'text',

                          'css'      => 'width:350px;margin-top:36px;',
          
                          'default'  => '', 

                          'desc'     => '<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-">How to get it ?</a>'

                   );
				   
							 $updated_settings[] =array(

                          'name'     => __( 'Product page custom swatches height', 'wcva' ),

                          'desc_tip' => __( 'Custom swatch height on product page.you will need to chose custom as display type in variation select tab.', 'wcva' ),

                          'id'       => 'woocommerce_custom_swatch_height',

                          'type'     => 'text',

                          'css'      => 'width:35px;',
          
                          'default'  => '32', 

                          'desc'     => 'px'

                   );

                 $updated_settings[] =array(

                          'name'     => __( 'Product page custom swatches width', 'wcva' ),

                          'desc_tip' => __( 'Custom swatch height on product page.you will need to chose custom as display type in variation select tab.', 'wcva' ),

                          'id'       => 'woocommerce_custom_swatch_width',

                          'type'     => 'text',

                          'css'      => 'width:35px;',
          
                          'default'  => '32', 

                          'desc'     => 'px'

                   );
				
				$updated_settings[] = array(
					'title'    => __( 'Shop swatches location', 'wcva' ),
					'desc'     => __( 'This controls location of shop swatches on shop/category/archive pages.', 'woocommerce' ),
					'id'       => 'woocommerce_shop_swatches_display',
					'class'    => 'chosen_select',
					'css'      => 'min-width:300px;',
					'default'  => '01',
					'type'     => 'select',
					'options'  => array(
						'01'              => __( 'After Item Title and Price', 'wcva' ),
						'02'              => __( 'Before Item Title and Price', 'wcva' ),
						'03'              => __( 'After Select Options button', 'wcva' ),
						
					),
					'desc_tip' =>  true,
				);
				
				 $updated_settings[] =array(

                          'name'     => __( 'Shop swatches height', 'wcva' ),

                          'desc_tip' => __( 'Swatches height on shop page.', 'wcva' ),

                          'id'       => 'woocommerce_shop_swatch_height',

                          'type'     => 'text',

                          'css'      => 'width:35px;',
          
                          'default'  => '32', 

                          'desc'     => 'px'

                   );

                 $updated_settings[] =array(

                          'name'     => __( 'Shop swatches width', 'wcva' ),

                          'desc_tip' => __( 'Swatches width on shop page.', 'wcva' ),

                          'id'       => 'woocommerce_shop_swatch_width',

                          'type'     => 'text',

                          'css'      => 'width:35px;',
          
                          'default'  => '32', 

                          'desc'     => 'px'

                   );
				   
				    $updated_settings[] =array(

                          'name'     => __( 'Enable direct variation link on shop swatches', 'wcva' ),

                          'id'       => 'woocommerce_shop_swatch_link',

                          'type'     => 'checkbox',
          
                          'default'  => 'no', 

                          'desc_tip'     => 'You will require <a href="https://wordpress.org/plugins/woocommerce-direct-variation-link/">WooCommerce Direct Variation Link</a> Plugin activated before using this feature.'

                   );

    

             }

             $updated_settings[] = $section;

             }
          
          return $updated_settings;
       }
   }

new wcva_add_shop_swatch_settings();
?>