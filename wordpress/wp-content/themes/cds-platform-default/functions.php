<?php
function platform_setup() {
	
	//Features
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'gallery',
			'caption',
		)
	);
	
	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	
	// Menus
	register_nav_menus(
		array(
		'header-menu' => 'Header Menu',
		'footer-menu' => 'Footer Menu', 
		'contact-menu' => 'Contact Menu',
		)
	  );	

}
add_action( 'after_setup_theme', 'platform_setup' );

// Documentation CPT

function create_documentation_post_type()
{
	$labels = array(
		'name'               => __('Documentation'),
		'singular_name'      => __('Documentation'),
		'add_new'            => __('Add New'),
		'add_new_item'       => __('Add New Documentation'),
		'edit_item'          => __('Edit Documentation'),
		'new_item'           => __('New Documentation'),
		'all_items'          => __('All Documentation'),
		'view_item'          => __('View Documentation'),
		'search_items'       => __('Search Documentation'),
		'not_found'          => __('No Documentation found'),
		'not_found_in_trash' => __('No Documentation found in Trash'),
		'parent_item_colon'  => __(''),
		'menu_name'          => __('Documentation')
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'documentation' ),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-book',
		'taxonomies' 		 => array( 'post_tag', 'category' ),
		'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'tags', 'taxonomies', 'page-attributes')
	);
	register_post_type( 'documentation', $args );
}

add_action( 'init', 'create_documentation_post_type' );

function platform_widgets_init() {
  register_sidebar( array(
    'name' => 'Footer',
    'id' => 'footer-about',
    'class' => 'footer-about',
    'description' => 'Footer about',
    'before_widget' => '<div id="%1$s" class="widget %2$s footer-about">',
		'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'platform_widgets_init' );


//custom theme scripts
add_action( 'wp_enqueue_scripts', 'platform_theme' );
function platform_theme() {
	
	wp_register_script('platform_main', get_theme_file_uri('/assets/js/main.js'), array('jquery'), wp_get_theme()->get( 'Version' ), true);
	
	
	global $wp_query;
	wp_localize_script( 'platform_main', 'platform_ajax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	
	wp_enqueue_script('platform_main');
	
	wp_enqueue_style('platform', get_theme_file_uri('/assets/css/style.css'), array(), wp_get_theme()->get( 'Version' ));
	wp_enqueue_style('material_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array());
	
}

/**
 * Path utils.
 *
 * @param mixed $icon
 */
function get_favicon($icon)
{
    return get_template_directory_uri().'/assets/'.$icon;
}

/**
 * Path utils.
 *
 * @param mixed $image
 */
function get_image_directory($image)
{
    return get_template_directory_uri().'/assets/img/'.$image;
}



// Register Custom Navigation Walker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// Register Template functions
require_once get_template_directory() . '/inc/template-functions.php';
