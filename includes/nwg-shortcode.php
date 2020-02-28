<?php 

// The shortcode function
function ngw_gallery_shortcode($args) { 
    
    if ( empty( $args['id'] ) ) {
        return 'Error - no data found';
    } else {
        // Get post id
        $postId = $args['id'];

        // Get post layout
        $layout = get_post_meta($postId, "nwg_layout", true);
        ob_start();
        // Include layout 
        include_once(WP_PLUGIN_DIR.'/ng-wp-gallery/template/'.$layout.'.php');
        return ob_get_clean();
    }

}

// Register shortcode
add_shortcode('ngw_gallery', 'ngw_gallery_shortcode');
