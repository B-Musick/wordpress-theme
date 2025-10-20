<?php
require_once get_template_directory() . '/inc/class-bootstrap-5-navwalker.php';

/***
 * LOAD STYLES AND SCRIPTS
 */
function load_css() {
    // Minified version of Bootstrap
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    // Main stylesheet - put this after so bootstrap doesnt overwrite main.css styles
    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
    wp_enqueue_style('main');

     // Load style.css (the default theme stylesheet)
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('main'), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'load_css');

// Load JS
function load_js(){
    wp_enqueue_script('jquery'); // jQuery comes bundled with WordPress

    // wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);
    // wp_enqueue_script('bootstrap');
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true);
wp_enqueue_script('bootstrap');

}
add_action('wp_enqueue_scripts', 'load_js');

function mytheme_enqueue_scripts() {
    // Enqueue your main CSS (if not already)
    wp_enqueue_style('main-css', get_template_directory_uri() . '/main.css');

    // Enqueue the search toggle script
    wp_enqueue_script(
        'search-toggle', // Handle name
        get_template_directory_uri() . '/js/search-toggle.js', // Path to JS file
        array(), // No dependencies
        null, // No specific version
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

/************************************************
 * REGISTER BLOCKS IN /SRC
 ***********************************************/
function create_block_ucn_blocks_block_init() {
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		return;
	}

	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	}

	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( __DIR__ . "/build/{$block_type}" );
	}
}
add_action( 'init', 'create_block_ucn_blocks_block_init' );

/**
 * REGISTER MENUS
 */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'top-menu' => __('Top Menu', 'ucn-theme'),
        'footer-menu' => __('Footer Menu', 'ucn-theme'),
        'header-top-menu' => __('Header Top Menu', 'ucn-theme'),
        'sign-in-menu' => __('Sign In Menu', 'ucn-theme'),
        'dropdown-bottom-menu' => __('Dropdown Bottom Menu', 'ucn-theme'),
    ]);
});


/**
 * Search filter (check ucn files to see what previously had)
 */

function filter_query_by_category_or_post_type($query) {
  if (!is_admin() && $query->is_main_query()) {

    // Category filter for 'news' or 'stories'
    if (!empty($_GET['filter_category'])) {
      $query->set('post_type', 'post'); // default WP post type
      $query->set('category_name', sanitize_text_field($_GET['filter_category']));
    }

    // Custom post type filter for 'faculty'
    if (!empty($_GET['post_type']) && $_GET['post_type'] === 'faculty') {
      $query->set('post_type', 'faculty');
    }
  }
}
add_action('pre_get_posts', 'filter_query_by_category_or_post_type');

/**
 * Icons
 */
function mytheme_enqueue_dashicons_frontend() {
    wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_dashicons_frontend' );