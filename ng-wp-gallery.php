<?php
/**
 * Plugin Name:       NG WP Gallery
 * Plugin URI:        https://www.kcsinfo.ca/
 * Description:       Ng wp gallery plugin use for images gallery
 * Version:           1.0
 * Requires at least: 4.*
 * Requires PHP:      5.6
 * Author:            Naveen Gaur
 * Author URI:        https://www.kcsinfo.ca/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ng-wp-gallery
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define('NG_WP_GALLERY_PLUGIN',  plugin_dir_url(__FILE__));

add_action( 'admin_enqueue_scripts', 'nwg_load_admin_files' );
function nwg_load_admin_files() {
	wp_enqueue_media();
	add_thickbox();
	wp_enqueue_script( 'ng-gallery', NG_WP_GALLERY_PLUGIN.'assets/js/nwg-script.js', array('jquery'), '1.0', true );
	wp_enqueue_style( 'admin_css', NG_WP_GALLERY_PLUGIN.'assets/css/nwg-admin-style.css', false, '1.0' );
}

add_action( 'wp_enqueue_scripts', 'nwg_frontend_files');
function nwg_frontend_files()
{
	// infinite scroll js include
	wp_enqueue_script( 'ng-gallery-infinite', NG_WP_GALLERY_PLUGIN.'assets/js/infinite-scroll-docs.min.js', array('jquery'), '1.0', true );

	// fancybox js
	wp_enqueue_script( 'fancybox', NG_WP_GALLERY_PLUGIN.'assets/js/jquery.fancybox.min.js', array('jquery'), '3.5', true );
	wp_enqueue_style( 'ng-gallery-infinite-style', NG_WP_GALLERY_PLUGIN.'assets/css/infinite-scroll-docs.css', false, '1.0' );	
	wp_enqueue_style( 'ng-gallery-grid-style', NG_WP_GALLERY_PLUGIN.'assets/css/nwg-grid.css', false, '1.0' );
	wp_enqueue_style( 'fancybox-style', NG_WP_GALLERY_PLUGIN.'assets/css/jquery.fancybox.min.css', false, '1.0' );}


// Custom post type register
include_once('includes/admin/nwg-post-register.php');

// Add meta box for multiple image upload
include_once('includes/admin/nwg-metabox-image.php');

// Setting meta box
include_once('includes/admin/nwg-metabox-setting.php');


// Include shortcode file
include_once('includes/nwg-shortcode.php');