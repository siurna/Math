<?php
function math_register_my_cpts() {

	/**
	 * Post Type: Experts.
	 */

	$labels = [
		"name" => __( "Experts", "math" ),
		"singular_name" => __( "Expert", "math" ),
	];

	$args = [
		"label" => __( "Experts", "math" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "experts", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"menu_icon" => "dashicons-awards",
	];

	register_post_type( "experts", $args );

	/**
	 * Post Type: Events.
	 */

	$labels = [
		"name" => __( "Events", "math" ),
		"singular_name" => __( "Event", "math" ),
	];

	$args = [
		"label" => __( "Events", "math" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "events", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"menu_icon" => "dashicons-calendar-alt",

	];

	register_post_type( "events", $args );
}

add_action( 'init', 'math_register_my_cpts' );


function math_register_my_taxes() {

	/**
	 * Taxonomy: Product badges.
	 */

	$labels = [
		"name" => __( "Product badges", "math" ),
		"singular_name" => __( "Product badge", "math" ),
	];

	
	$args = [
		"label" => __( "Product badges", "math" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'product_badges', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "product_badges",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "product_badges", [ "product" ], $args );

	/**
	 * Taxonomy: Ingredients.
	 */

	$labels = [
		"name" => __( "Ingredients", "math" ),
		"singular_name" => __( "Ingredient", "math" ),
	];

	
	$args = [
		"label" => __( "Ingredients", "math" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'ingredients', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "ingredients",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "ingredients", [ "product" ], $args );
}
add_action( 'init', 'math_register_my_taxes' );
