<?php 

add_action('add_meta_boxes','nwg_meta_init');

function nwg_meta_init(){
	add_meta_box('nwg_meta_box','Gallery Images','nwg_meta_form', 'ng_gallery' ,'normal','default');
}


function nwg_meta_form()
{
	global $post;
	wp_nonce_field(basename(__FILE__),'nwg_meta_box_nonce');
    ?>
    <div id="nwg_images" class="ng_gallery_images">
		<ul class="nwg-data-list">
			<?php
				$imagesData = get_post_meta($post->ID, 'nwg_images', true);

				if (!empty($imagesData)) {
					foreach ($imagesData as $value) {
						if(file_exists(get_attached_file($value))){
						?>
							<li class='ng_gallery_listing'><img class="ng_gallery_img" src="<?php echo esc_url(wp_get_attachment_url($value)); ?>"><input type="hidden" name="nwg_images[]" value="<?php echo $value; ?>"><div class="img-option"><a href="<?php echo esc_url(wp_get_attachment_url($value)); ?>" class="thickbox dashicons dashicons-search alignleft"></a> <a class="dashicons dashicons-trash alignright remove-ngw-image"></a> </div></li>
						<?php	
						}
					}
				}
			?>
		</ul>
	</div>

	<!---Gallery images upload button -->
	<hr/>
	<button type="button" id="nwg_images_add" class="button button-primary button-large">Upload Image</button>
	
    <?php 
}

add_action('save_post','nwg_meta_save', 10,2);

function nwg_meta_save($post_id, $post){
	
	// check request and with authorization,
	if(!isset($_POST['nwg_meta_box_nonce']) || !wp_verify_nonce($_POST['nwg_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// Is the user allowed to edit the post
	if(!current_user_can('edit_post', $post->ID)) {
		return $post_id;
	}

	// Check post type and save meta data
	if(get_post_type($post_id)=='ng_gallery'){
		// Submit meta data into nwg_images key
		update_post_meta($post_id, 'nwg_images', $_POST['nwg_images']);
	}
} 