<?php
set_time_limit(0);
include('../../../wp-load.php');

global $wpdb;

function getGeoCounty($geoAddress) {
	$url = 'https://maps.google.com/maps/api/geocode/json?key=AIzaSyBHK4rfdHYPJwxMIUrPo7JIIKgJ9DwHnmI&address=' . urlencode($geoAddress) .'&sensor=false'; 
	
    $get     = file_get_contents($url);
    $geoData = json_decode($get);
	
	/*echo "<pre>";
	print_r($geoData);
	exit;*/
	
    if(isset($geoData->results[0])) {
        $return = array();
        foreach($geoData->results[0]->address_components as $addressComponet) {
            //if(in_array('political', $addressComponet->types)) {
                /*if($addressComponet->short_name != $addressComponet->long_name)
                    $return[] = $addressComponet->short_name. " - " . $addressComponet->long_name; 
                else*/
                    //$return[] = $addressComponet->long_name; 
					
			if(in_array('country', $addressComponet->types)) {		
				$return = $addressComponet->long_name; 	
            }
        }
        //return implode(", ",$return);
		return $return;
    }
    return null;
}

//echo getGeoCounty('48.86998,2.325604');
//exit;

$getExistingRec = $wpdb->get_results("SELECT post_id FROM wp_french_stores WHERE `id` > 0");
//$getExistingRec = $wpdb->get_results("SELECT post_id FROM wp_french_passed_rec WHERE `id` > 0");

$postIds = array();
foreach($getExistingRec as $o => $v){
	$postIds[] = $v->post_id;
}


$args =
	array( 
	'post_type' => 'maplist',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	'post__not_in' => $postIds,
	'order' => 'ASC',
	'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'maplist_latitude',
						'value' => '',
						'compare' => '!='
					),
					array(
						'key' => 'maplist_longitude',
						'value' => '',
						'compare' => '!='
					)
		),

	);

 $frenchStoreQ = new WP_QUERY($args);	
 
 /*$header_row = array(
			0 => 'Store Name',
			1 => 'Address',
			2 => 'Latitude',
			3 => 'Longitude',
		);
 $data_rows = array();*/
 
 if ( $frenchStoreQ->have_posts() ) : 
    $c = 1;
	
	/*$fh = @fopen( 'french_data.csv', 'w' );
	fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
	fputcsv( $fh, $header_row );*/
	
 	while ( $frenchStoreQ->have_posts() ) : $frenchStoreQ->the_post(); 
		
		$postTitle = $post->post_title;
	
		$postId = $post->ID;
		$latVal = get_post_meta($postId, 'maplist_latitude', true);
		$lngVal = get_post_meta($postId, 'maplist_longitude', true);
		
		$countryName = getGeoCounty($latVal.",".$lngVal);

		//$countryName = getGeoCounty('48.86998,2.325604');
		
		if($countryName=="France"){
			$addressVal = get_post_meta($postId, 'maplist_address', true);
			
			$wpdb->insert( 
					'wp_french_stores', 
					array( 
						'post_id' => $postId, 
						'store_name' => $postTitle,
						'store_address' => $addressVal,
						'lat' => $latVal, 
						'lang' => $lngVal
					)
				);
			
			/*$row[0] = $postTitle;
			$row[1] = $addressVal;
			$row[2] = $latVal;
			$row[3] = $lngVal;

			$data_rows[] = $row;
			
			$fh = @fopen( 'french_data.csv', 'w' );
			fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
			foreach ( $data_rows as $data_row ) {
				fputcsv( $fh, $data_row );
			}*/
			
			/*echo $c." post id ".$postId;
			echo "<br/>";*/
			
			$c++;
		}
	
	$wpdb->insert( 
			'wp_french_passed_rec', 
			array( 
				'post_id' => $postId
			)
		);
		
	endwhile; 
	wp_reset_postdata();
	else : ?>
 		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
 	<?php endif; ?>
    
    <table border="0">
    	<tr>
        	<td width="28">
            	<span>No.</span>
            </td>
        	<td width="76">
            	<span>Post Id</span>
            </td>
            <td width="161">
            	<span>Store Name</span>
            </td>
            <td width="265">
            	<span>Store Address</span>
            </td>
            <td width="87">
            	<span>Lat</span>
            </td>
            <td width="108">
            	<span>Lang</span>
            </td>
        </tr>
    <?php
		$getExistingStores = $wpdb->get_results("SELECT * FROM wp_french_stores WHERE `id` > 0");
		
		if(count($getExistingStores)>0){
			$cnt = 1;
			foreach($getExistingStores as $off => $val1){
	?>
    			<tr>
                    <td>
                        <span><?php echo $cnt; ?></span>
                    </td>
                    <td>
                        <span><?php echo $val1->post_id; ?></span>
                    </td>
                    <td>
                        <span><?php echo $val1->store_name; ?></span>
                    </td>
                    <td>
                        <span><?php echo $val1->store_address; ?></span>
                    </td>
                    <td>
                        <span><?php echo $val1->lat; ?></span>
                    </td>
                    <td>
                        <span><?php echo $val1->lang; ?></span>
                    </td>
                </tr>
    
    <?php		
				$cnt++;	
			}
		}
		
	?>
    </table>
 
<?php 
/*AIzaSy CuY8lp4XuuCswBO_e982inyXeoM_GTTnY

AIzaSy AKBPc2d9ZAGhe3vt8SgGmAgoZdOHXECW8

AIzaSy DDjSdajs5EXv-ZV20-xDTDV8HhO9Wmc0k

AIzaSy CSxX4s2Vcl3EH-hrZFLupzQ7OA9JB4TmQ

numbers range
5, 6*/
?>  