<?php
include "../../../wp-load.php";

set_time_limit(0);




global $wpdb;

$query1 = 
"
SELECT post_title 
FROM   wp_3_posts l 
WHERE  NOT EXISTS (
   SELECT 1
   FROM   wp_posts i
   WHERE  l.post_title = i.post_title
   )
   ";
   
/*$query2 = 
"
SELECT DISTINCT lm.post_title
FROM wp_3_posts AS lm
WHERE 
lm.post_type = 'maplist'
AND
lm.post_title NOT IN (SELECT lt.post_title)
                               FROM  wp_posts AS lt
							   WHERE lt.post_type = 'maplist') 
   ";*/
   
   $query2 = 
"
SELECT *
FROM wp_3_posts AS lm
WHERE 
lm.post_type = 'maplist'
AND
lm.post_status = 'publish'
   ";



$multisites = $wpdb->get_results($query2);

foreach($multisites as $mul)
{
	switch_to_blog( 3 );
	$store_parent_id = get_post_meta($mul->ID, 'store_parent_id', true);
	restore_current_blog();
	
	$parent = $wpdb->get_row("SELECT * FROM wp_posts WHERE ID = '$store_parent_id' AND post_type = 'maplist' AND post_status = 'publish'");
	
	//echo "SELECT * FROM wp_posts WHERE ID = $store_parent_id AND post_type = 'maplist' AND post_status = 'publish'";
	//exit;
	
	if($parent)
	{
		//echo 'PRESENT <br>';
	}
	else
	{
		echo $mul->ID." <strong>POST ID</strong> <br>";
		echo $mul->post_title." <strong>POST TITLE</strong> <br>";
		
	}
	
}
exit;
echo '<pre>';
print_r($multisites);
echo '</pre>';
exit;


function add_post_to_multisite_fnc(
	$meta_data, 
	$post_id, 
	$post_title,
	$user_ID, 
	$term_array
	)
{	
	global $wpdb;
	$multisites = $wpdb->get_results(
	"
		SELECT * FROM $wpdb->blogs WHERE blog_id <> 1
	"
	);
	
	if($multisites)
	{			
		$terms = $term_array;
			
		$terms = array_filter($terms);
		
		foreach($multisites as $multisite)
		{
			$blog_id = $multisite->blog_id;
			//$blog_id = 3;
			
			$term_array = array();
			foreach($terms as $term_id)
			{
				$term = get_term( $term_id, 'map_location_categories' );
				
				$main_parent = $term->parent;
				if($main_parent != 0)
				{
					$term_parent = get_term( $main_parent, 'map_location_categories' );
					$parent_name = $term_parent->name;
				}
				
				/*echo '<pre>';
				print_r($term);
				echo '</pre>';*/
				
				switch_to_blog( $blog_id );
				
				$parent_term_info = term_exists( $parent_name, 'map_location_categories' );
				
				/*echo '<pre>';
				print_r($parent_term_info);
				echo '</pre>';*/
				
				if($main_parent != 0)
				{
					$args = array(
						"parent" => $parent_term_info['term_id'],
						"slug" => $term->slug
					);
				}
				else
				{
					$args = array(
						"slug" => $term->slug
					);
				}
				
				/*echo '<pre>';
				print_r($args);
				echo '</pre>';
				
				echo $term->name;*/
				
				$new_term = wp_insert_term( $term->name, 'map_location_categories', $args );
				
				//$new_term = (array)$new_term;
				
				
				//echo $new_term['WP_Errorerror_data']['term_exists'];
				/*echo '<pre>';
				print_r($new_term->error_data['term_exists']);
				echo '</pre>';*/
				
				if(isset($new_term->error_data['term_exists']))
				{
					$final_term_id = $new_term->error_data['term_exists'];
				}
				else
				{
					$final_term_id = $new_term['term_id'];
				}
				
				/*echo '<pre>';
				print_r($new_term);
				echo '</pre>';*/
				
				array_push($term_array, $final_term_id);
				
				restore_current_blog();
			}
			
			
			/*echo '<pre>';
			print_r($term_array);
			echo '</pre>';
			
			exit;*/
			
			
			
			switch_to_blog( $blog_id );
			
			$my_post = array(
			  'post_title'    => $post_title,
			  'post_content'  => '',
			  'post_status'   => 'publish',
			  'post_author'   => $user_ID,
			  'post_type'	  => 'maplist'
			);
			// Insert the post into the database
			$new_post_id = wp_insert_post( $my_post );
							
			
			wp_set_post_terms( 
				$new_post_id, 
				$term_array, 
				'map_location_categories', 
				true 
			);
			
			$meta_data['_expiration-date-options']['id'] = $new_post_id;
			
			foreach($meta_data as $key => $val)
			{
				update_post_meta( $new_post_id, $key, $val );
			}
			
			restore_current_blog();
			
			// Store multisite store IDs in parent store also
			update_post_meta( $post_id, 'blog_id_'.$blog_id, $new_post_id );
		}	
	}
}




$locationArgs = array(
	'post_type' => 'maplist',
	'post_status' => 'publish',
	'posts_per_page'  => 100,
	'meta_query' => array(
		array(
			'key'     => 'store_existense_check',
			'compare' => 'NOT EXISTS'
		)
	),
);

$theQuery = new WP_Query( $locationArgs );
$mapLocations = $theQuery->posts;

/*echo '<pre>';
print_r($mapLocations);
echo '</pre>';*/
if($mapLocations)
{
	$i = 0;
	foreach($mapLocations as $loc)
	{
		$post_id = $loc->ID;
		
		$terms = get_the_terms( $post_id, 'map_location_categories' );
		
		if($terms)
		{
			$term_array = array();
			foreach($terms as $term)
			{
				array_push($term_array, $term->term_id);
			}	
		}
		
		$opt = get_post_meta($post_id, '_expiration-date-options', true);
		
		/*echo '<pre>';
		print_r($opt);
		echo '</pre>';
		
		exit;*/
		
		/*echo '<pre>';
		print_r($term_array);
		print_r($terms);
		echo '</pre>';
		exit;
		
		exit;*/
		
		/*$loc->post_title;
		$loc->post_author;
		
		get_post_meta($loc->ID, 'maplist_latitude', true);
		get_post_meta($loc->ID, 'maplist_longitude', true);
		get_post_meta($loc->ID, 'maplist_description', true);
		get_post_meta($loc->ID, 'maplist_address', true);
		get_post_meta($loc->ID, 'maplist_alternateurl', true);
		get_post_meta($loc->ID, 'maplist_marker', true);
		get_post_meta($loc->ID, 'maplist_hours', true);*/
		
		
		$store_data = array(
			"maplist_latitude" 			=> get_post_meta($post_id, 'maplist_latitude', true),
			"maplist_longitude" 		=> get_post_meta($post_id, 'maplist_longitude', true),
			"maplist_description" 		=> get_post_meta($post_id, 'maplist_description', true),
			"maplist_address" 			=> get_post_meta($post_id, 'maplist_address', true),
			"maplist_alternateurl" 		=> get_post_meta($post_id, 'maplist_alternateurl', true),
			"maplist_marker" 			=> get_post_meta($post_id, 'maplist_marker', true),
			"maplist_hours" 			=> get_post_meta($post_id, 'maplist_hours', true),
			"_expiration-date" 			=> get_post_meta($post_id, '_expiration-date', true),
			"_expiration-date-options" 	=> $opt,
			"_expiration-date-status" 	=> get_post_meta($post_id, '_expiration-date-status', true),
			"store_parent_id" 			=> $post_id
		);
		
		
		add_post_to_multisite_fnc(
			$store_data,
			$post_id,
			sanitize_text_field($loc->post_title),
			$loc->post_author,
			$term_array
		);
		
		update_post_meta($post_id, 'store_existense_check', 1);
		
		echo ++$i . ". " .$loc->post_title. " <strong>Store Inserted Successfully</strong><br>";
	}
}
else
{
	echo "<strong>No More Stores</strong>";
}

/*echo '<pre>';
print_r($theQuery);
echo '</pre>';*/
exit;