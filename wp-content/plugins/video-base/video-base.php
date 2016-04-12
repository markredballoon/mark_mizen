<?php
/*
Plugin Name: Video Base
Plugin URI: http://redballoon.io
Description: A base for all your videos
Version: 0.1
Author: Red Balloon Design Ltd
Author URI: http://redballoon.io
License: GPLv2
*/
add_action( 'init', 'register_cpt_video' );
function register_cpt_video() {

        $labels = array(
            'name' => __( 'Videos', 'video' ),
            'singular_name' => __( 'Video', 'video' ),
            'add_new' => __( 'Add New', 'video' ),
            'add_new_item' => __( 'Add New Video', 'video' ),
            'edit_item' => __( 'Edit Video', 'video' ),
            'new_item' => __( 'New Video', 'video' ),
            'view_item' => __( 'View Video', 'video' ),
            'search_items' => __( 'Search Videos', 'video' ),
            'not_found' => __( 'No videos found', 'video' ),
            'not_found_in_trash' => __( 'No videos found in Trash', 'video' ),
            'parent_item_colon' => __( 'Parent Video:', 'video' ),
            'menu_name' => __( 'Videos', 'video' ),
        );

        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'description' => 'A place to base all your videos for the website.',
            'supports' => array( 'title', 'excerpt', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( 'category', 'post_tag', 'video_categories' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );

        register_post_type( 'video', $args );
}
function video_shortcode( $atts, $content = null)  {

    extract( shortcode_atts( array(
                'id' => '',                 // id of the video - required to the hook into the video post
                'url' => '',                // url of the video - if no id and want to link to a youtube video embed
                'title' => '',              // SHOW/HIDE the title - default is show.
                'thumbnail' => '',          // whether or not to SHOW/HIDE the thumbnail. default to show and only available on embedded video.
                'excerpt' => '',            // whether to SHOW, HIDE or replace the excerpt.
                'type' => ''                // As a MODAL or as an in post EMBED? Default is embed
            ), $atts
        )
    );


    //if we have an id, get the video post and populate based on users options
    if ( !empty($id) ) {
        $video              = get_post( $id );
        $videoTitle         = $video->post_title;
        $videoURL           = get_post_meta($video->ID, 'video_url_test', true);
        $video_url_id		= get_post_meta($video->ID, 'video_url_id', true);
        $videoThumb         = get_the_post_thumbnail($video->ID);
        $videoDescription   = apply_filters('the_excerpt', get_post_field('post_excerpt', $video));
		
		if ( !empty($url) ) {
            $urlOUT = $url;
        } else {
        	$urlOUT = $video_url_id;
        }
        
        // get the video id
        $getVideoId = $video_url_id;

        // do this things we can only do if we have an id:
        // decide to show/hide excerpt
        if ( $excerpt === 'show') {
            $descriptionOUT = $videoDescription;
        }
        // decide to replace the title
        if ( $title != 'hide') {
            if ( !empty($videoTitle) ) {
                $titleOUT = $videoTitle;
            }
        }
        // we can also only show video thumbs videos with id's, but tat code is currently below.
    }

    // Embed or modal? Only embeds can manipulate video
    if ( $type === 'embed' || $type === 'thumbnail') {
        if ( $thumbnail === 'show') {
            if ( !empty($videoThumb) ) {
	            $thumbcodesrc = (string) reset(simplexml_import_dom(DOMDocument::loadHTML($videoThumb))->xpath("//img/@src"));
	        } else {
	        	$thumbcodesrc = 'http://img.youtube.com/vi/'.$getVideoId.'/hqdefault.jpg';
	        }
            $thumbcode = '<img src="'.$thumbcodesrc.'" alt="Video thumbnail">';
        } else {
            $thumbcode = '<img src="http://img.youtube.com/vi/'.$getVideoId.'/hqdefault.jpg">';
        }
        $typeOUT = $type;
    } else if ( $type === 'modal') {
        $typeOUT = 'modal';
    }

    if ($typeOUT === 'embed' || $typeOUT === 'thumbnail') {
        $embed .= '<div class="video-base '.$type.'" onclick="VBplayVideo(this)"><div class="video-title"><div class="video-title-wrap"><h4>' . $titleOUT . '</h4></div></div>';
        $embed .= '<div class="iframe-wrap outer"><div class="video-thumbnail">'.$thumbcode.'</div>';
        $embed .= '<div class="iframe-wrap inner"><iframe width="800" height="800" src="https://www.youtube.com/embed/' . $urlOUT . '?feature=oembed&enablejsapi=1" frameborder="0" allowfullscreen=""></iframe></div></div></div>';
        $embed .= $descriptionOUT;
    }
    if ($typeOUT === 'modal') {
        $embed .= '<p>this hasnt been developed yet</p>';
        $embed .= $descriptionOUT;
    }

    //return $url . ' ' . $thumbcode . ' ' . $embed ;
    return $embed;

}
add_shortcode('video', 'video_shortcode');



function shortcode( $atts, $content = null ) {

    extract( shortcode_atts( array(
                'att1' => '',
                'att2' => '',
                // ...etc
            ), $atts ) );

    $class = 'class01';

    if ( $att1 || $att2 ) {
        $class = 'class1';
        $class .= ( $att1 ) ? ' ' . $att1 : '';
        $class .= ( $att2 ) ? ' ' . $att2 : '';
    }

    $output = '<div class="' . $class . '">' . do_shortcode( $content ) . '</div>';

    return $output;
}
