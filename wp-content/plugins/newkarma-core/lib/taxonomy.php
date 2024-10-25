<?php
/**
 * Custom taxonomy for topic in posts
 *
 * Author: Gian MR - http://www.gianmr.com
 *
 * @since 1.0.0
 * @package Newkarma Core
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'newkarma_core_create_post_tax' ) ) {
	/**
	 * Add new taxonomy in post
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_create_post_tax() {
		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => _x( 'Topics', 'taxonomy general name', 'newkarma-core' ),
			'singular_name'              => _x( 'Topic', 'taxonomy singular name', 'newkarma-core' ),
			'search_items'               => __( 'Search Topics', 'newkarma-core' ),
			'popular_items'              => __( 'Popular Topics', 'newkarma-core' ),
			'all_items'                  => __( 'All Topics', 'newkarma-core' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Topic', 'newkarma-core' ),
			'update_item'                => __( 'Update Topic', 'newkarma-core' ),
			'add_new_item'               => __( 'Add New Topic', 'newkarma-core' ),
			'new_item_name'              => __( 'New Topic Name', 'newkarma-core' ),
			'separate_items_with_commas' => __( 'Separate topics with commas', 'newkarma-core' ),
			'add_or_remove_items'        => __( 'Add or remove topics', 'newkarma-core' ),
			'choose_from_most_used'      => __( 'Choose from the most used topics', 'newkarma-core' ),
			'not_found'                  => __( 'No topics found.', 'newkarma-core' ),
			'menu_name'                  => __( 'Topics', 'newkarma-core' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_in_rest'          => true,
			'rewrite'               => array( 'slug' => 'topic' ),
		);
		register_taxonomy( 'newstopic', array( 'post' ), $args );

		unset( $args );
		unset( $labels );

		// Order by alphabetic.
		$args = array(
			'hierarchical'      => false,
			'label'             => __( 'Index', 'newkarma-core' ),
			'show_ui'           => false,
			'query_var'         => true,
			'show_admin_column' => false,
			'rewrite'           => array( 'slug' => 'index' ),
		);
		register_taxonomy( 'newsindex', array( 'post' ), $args );

	}
}
add_action( 'init', 'newkarma_core_create_post_tax', 0 );
