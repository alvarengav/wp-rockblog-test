<?php

function rockblog_theme_setup() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'rockblog' ),
		)
	);

	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'rockblog_theme_setup' );

function rockblog_enqueue_assets() {
	wp_enqueue_style( 'rockblog-fonts', 'https://fonts.googleapis.com/css2?family=Spartan:wght@400;600;700&family=Mulish:wght@400;600;700&display=swap', array(), null );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'rockblog-style', get_template_directory_uri() . '/build/index.css', array(), filemtime( get_template_directory() . '/build/index.css' ) );

	$asset_file = include get_template_directory() . '/build/index.asset.php';

	wp_enqueue_script( 'rockblog-script', get_template_directory_uri() . '/build/index.js', array_merge( $asset_file['dependencies'], array( 'jquery' ) ), $asset_file['version'], true );
}
add_action( 'wp_enqueue_scripts', 'rockblog_enqueue_assets' );

function add_additional_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'add_additional_class_on_li', 1, 3 );

function add_menu_link_class( $atts, $item, $args ) {
	if ( isset( $args->add_a_class ) ) {
		$atts['class'] = $args->add_a_class;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

function create_cpt_article() {
	$labels = array(
		'name'                  => _x( 'Articles', 'Post Type General Name', 'textdomain' ),
		'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'textdomain' ),
		'menu_name'             => __( 'Articles', 'textdomain' ),
		'name_admin_bar'        => __( 'Article', 'textdomain' ),
		'archives'              => __( 'Article Archives', 'textdomain' ),
		'attributes'            => __( 'Article Attributes', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Article:', 'textdomain' ),
		'all_items'             => __( 'All Articles', 'textdomain' ),
		'add_new_item'          => __( 'Add New Article', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'new_item'              => __( 'New Article', 'textdomain' ),
		'edit_item'             => __( 'Edit Article', 'textdomain' ),
		'update_item'           => __( 'Update Article', 'textdomain' ),
		'view_item'             => __( 'View Article', 'textdomain' ),
		'view_items'            => __( 'View Articles', 'textdomain' ),
		'search_items'          => __( 'Search Article', 'textdomain' ),
		'not_found'             => __( 'Not found', 'textdomain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'textdomain' ),
		'featured_image'        => __( 'Featured Image', 'textdomain' ),
		'set_featured_image'    => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image'    => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item'      => __( 'Insert into article', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'textdomain' ),
		'items_list'            => __( 'Articles list', 'textdomain' ),
		'items_list_navigation' => __( 'Articles list navigation', 'textdomain' ),
		'filter_items_list'     => __( 'Filter articles list', 'textdomain' ),
	);

	$args = array(
		'label'               => __( 'Article', 'textdomain' ),
		'description'         => __( 'Custom Post Type for Articles', 'textdomain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array( 'slug' => 'article' ),
	);

	register_post_type( 'cpt-article', $args );
}

add_action( 'init', 'create_cpt_article', 0 );

require get_template_directory() . '/inc/meta-description.php';

// Helpers
function get_inline_svg( $path, $class = '' ) {
	if ( file_exists( $path ) ) {
		$svg_content = file_get_contents( $path );

		if ( ! empty( $class ) ) {
			$svg_content = str_replace( '<svg', '<svg class="' . esc_attr( $class ) . '"', $svg_content );
		}

		return $svg_content;
	} else {
		return 'SVG not found';
	}
}

add_theme_support( 'title-tag' );
