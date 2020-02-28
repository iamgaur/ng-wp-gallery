<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register custom post type NG Gallery
function nwg_post_register() {
    $labels = array(
      'name'               => _x( 'NG Gallery', 'post type general name' ),
      'singular_name'      => _x( 'NG Gallery', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'ng-wp-gallery' ),
      'add_new_item'       => __( 'Add New Gallery' ),
      'edit_item'          => __( 'Edit Gallery' ),
      'new_item'           => __( 'New Gallery' ),
      'all_items'          => __( 'All NG Gallery' ),
      'view_item'          => __( 'View Gallery' ),
      'search_items'       => __( 'Search' ),
      'not_found'          => __( 'No Gallery found' ),
      'not_found_in_trash' => __( 'No Gallery found in the Trash' ), 
      'menu_name'          => 'NG Gallery'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our NG WP Gallery specific data',
      'public'             => false,
		  'show_ui'            => true,
		  'show_in_menu'       => true,
		  'query_var'          => true,
		  'capability_type'    => 'post',
		  'has_archive'        => false,
      'hierarchical'       => false,
      'menu_icon'			 => 'dashicons-format-gallery',
      'menu_position' => 5,
      'supports'      => array( 'title',),
      'has_archive'   => true,
    );
    register_post_type( 'ng_gallery', $args ); 
  }
  add_action( 'init', 'nwg_post_register');


// Add the custom columns to the NG Gallery post type:
add_filter( 'manage_ng_gallery_posts_columns', 'set_custom_edit_ng_gallery_columns' );
function set_custom_edit_ng_gallery_columns($columns) {
   unset( $columns['author'] );
   // Remove Date
   unset($columns['date']);

    $columns['shortcode'] = __( 'Shortcode', 'ng-wp-gallery' );
    $columns['date'] = 'Date';

    return $columns;
}

// Add the data to the custom columns for the NG Gallery post type:
add_action( 'manage_ng_gallery_posts_custom_column' , 'custom_ng_gallery_column', 10, 2 );
function custom_ng_gallery_column( $column, $post_id ) {
  if($column == 'shortcode')  {
    echo '<input type="text" class="nwg-text" width="30%" autocomplete="off" readonly="readonly" name="nwg_shortcode" value="[ngw_gallery id='.$post_id.']" />';
  }
}