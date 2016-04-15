<?php
/*
Plugin Name: Module Base
Plugin URI: http://redballoon.io
Description: Website Modular system to allow content to be distributed cross site whilst allowing ultimate customisation.
Version: 0.1
Author: Red Balloon Design Ltd
Author URI: http://redballoon.io
License: GPLv2
*/
add_action( 'init', 'register_cpt_modules' );
function register_cpt_modules() {

        $labels = array(
            'name' => __( 'Modules', 'modules' ),
            'singular_name' => __( 'Module', 'module' ),
            'add_new' => __( 'Add New', 'module' ),
            'add_new_item' => __( 'Add New Module', 'module' ),
            'edit_item' => __( 'Edit Module', 'module' ),
            'new_item' => __( 'New Module', 'module' ),
            'view_item' => __( 'View Module', 'module' ),
            'search_items' => __( 'Search Module', 'module' ),
            'not_found' => __( 'No modules found', 'module' ),
            'not_found_in_trash' => __( 'No module found in Trash', 'module' ),
            'parent_item_colon' => __( 'Parent module:', 'module' ),
            'menu_name' => __( 'Modules', 'modules' ),
        );

        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'Website Modular system to allow content to be distributed cross site whilst allowing ultimate customisation.',
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( 'category', 'post_tag', 'video_categories' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 6,
            'show_in_nav_menus' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'page'
        );

        register_post_type( 'module', $args );
}
function module_shortcode( $atts, $content = null)  {

    extract( shortcode_atts( array(
                'type' => ''               // Type of module eg 'forged_in_hiroshima'
            ), $atts
        )
    );

	$queried_post = get_page_by_path($type,OBJECT,'module');
	// $queried_post = get_id_by_slug($type);
    if ($type === 'forged') {
		$output .= _get_project_info('0', $queried_post->post_content);
    }
    if ($type === 'stamping') {
		$output .= _get_project_info('0', $queried_post->post_content);
    }

    return $output ;

}
add_shortcode('module', 'module_shortcode');



function quote_shortcode( $atts, $content)  {

    extract( shortcode_atts( array(
                'cite' => ''               // Name of person to be cited in the quote
            ), $atts
        )
    );

    if ($cite === 'david') {
		$quote_img = 'david.jpg';
		$quote_title = 'David Llewellyn – Head of Design';
    }
    if ($cite === 'chris') {
		$quote_img = 'chris.jpg';
		$quote_title = 'Chris Voshall';
    }
    if ($cite === 'tetsuo') {
		$quote_img = 'tetsuo.jpg';
		$quote_title = 'Testuo';
    }

    $output = '<div class="quote alt-quote clearfix"><div class="quote-image" ><div class="image-wrap"><img src="'.get_bloginfo( 'template_url' ).'/images/quote/'.$quote_img.'" alt="'.$quote_title.'"/></div></div><div class="container"><div class="row"><div class="the-quote col-md-10 col-md-offset-14 col-xs-24 col-xs-offset-0 text-center">';
	$output .= '<p>' . $content . '</p>';
	$output .= '<p><strong>' . $quote_title . '</strong></p>';
	$output .= '</div></div></div></div>';
    return $output;

}
add_shortcode('quote', 'quote_shortcode');

// Add css and js files for video base plugin.
function add_module_base_files(){
  $plugin_url = plugin_dir_url( __FILE__ );
  wp_enqueue_script( 'modules-script', $plugin_url . 'js/randomize-images.js' );
}
// Added to the enqueue hook.
add_action( 'wp_enqueue_scripts', 'add_module_base_files' );
