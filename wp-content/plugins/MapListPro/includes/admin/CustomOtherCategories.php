<div class="wrap">

    <?php screen_icon();?>

    <h2><?php _e('Other Categories','maplistpro') ?></h2>
	
   
    <?php
		global $wpdb;
		
			$args = array(
			'type'                     => 'post',
			'child_of'                 => 122,
			'hide_empty'               => 0,
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'taxonomy'                 => 'map_location_categories',
			'pad_counts'               => false 
		
		); 
		$subCats = get_categories( $args );
		
		$mainCat = get_term_by('id', 122, 'map_location_categories');
		
	?>
    	<ul>
        	<li><strong><a title="Edit <?php echo $mainCat->name; ?>" href="<?php echo admin_url(); ?>edit-tags.php?action=edit&amp;taxonomy=map_location_categories&amp;tag_ID=122&amp;post_type=maplist" class="row-title"><?php echo $mainCat->name; ?></a></strong></li>
    <?php	
		if(count($subCats)>0){
			foreach($subCats as $k => $val){
	?>	
    			<li><strong><a title="Edit <?php echo $val->name; ?>" href="<?php echo admin_url(); ?>edit-tags.php?action=edit&amp;taxonomy=map_location_categories&amp;tag_ID=<?php echo $val->term_id; ?>&amp;post_type=maplist" class="row-title"><span style="margin-left:10px;">--</span><?php echo $val->name; ?></a></strong></li>	
    <?php
			}
		}
	?>
    	</ul>
    
</div>