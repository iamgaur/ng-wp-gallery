<?php 

add_action('add_meta_boxes','nwg_layout_setting_init');

function nwg_layout_setting_init(){
	add_meta_box('nwg_layout_setting','Setting','nwg_image_layout_setting', 'ng_gallery' ,'side','default');
}


function nwg_image_layout_setting()
{
    global $post;
    wp_nonce_field(basename(__FILE__), "nwg_meta_layout_box_nonce");
    
   ?>
   
   <strong >Layout - </strong>
            <select name="nwg_layout">
                <?php 
                    $option_values = array('nwg-masonry'=>'Masonry Layout', 'nwg-masonry-scroll-load'=> 'Masonry with Scroll Load', 'nwg-grid'=>'Grid Layout');

                    foreach($option_values as $key => $value) 
                    {
                        if($key == get_post_meta($post->ID, "nwg_layout", true))
                        {
                            ?>
                                <option selected value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php    
                        }
                        else
                        {
                            ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
           <hr/>         
           <strong >Border: </strong> 
            <?php 
                $nwgBorder = get_post_meta($post->ID, "nwg_border", true); 
            ?>         
                <input type="checkbox" name="nwg_border" value="1" <?php checked( $nwgBorder != "" ); ?> />
            <hr/>
            <strong >Border Radius: </strong> 
            <?php 
                $nwgBorderRadius = get_post_meta($post->ID, "nwg_border_radius", true); 
            ?>         
                <input type="checkbox" name="nwg_border_radius" value="1" <?php checked( $nwgBorderRadius != "" ); ?> />
            <hr/>
            <strong >Shortcode: </strong>
            <input type="text" class="large-text" autocomplete="off" readonly="readonly" name="nwg_shortcode" value='[ngw_gallery id="<?php echo $post->ID; ?>"]' />
            
       <?php     

}

add_action('save_post','nwg_layout_meta_save', 10,2);

function nwg_layout_meta_save($post_id, $post){
	
	// check request and with authorization,
	if(!isset($_POST['nwg_meta_layout_box_nonce']) || !wp_verify_nonce($_POST['nwg_meta_layout_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// Is the user allowed to edit the post
	if(!current_user_can('edit_post', $post->ID)) {
		return $post_id;
	}

	// Check post type and save meta data
	if(get_post_type($post_id)=='ng_gallery'){
		// Submit meta data into nwg_images key
        update_post_meta($post_id, 'nwg_layout', $_POST['nwg_layout']);
        update_post_meta($post_id, 'nwg_border', $_POST['nwg_border']);
        update_post_meta($post_id, 'nwg_border_radius', $_POST['nwg_border_radius']);
	}
} 