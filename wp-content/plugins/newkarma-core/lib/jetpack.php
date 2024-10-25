<?php
/**
 * Jetpack Functionally
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

if ( ! function_exists( 'newkarma_core_remove_jetpack_rp' ) ) :
	/**
	 * Remove jetpack related post and we use functionally using shortcode
	 *
	 * @since 1.0.0
	 * @link https://jetpack.com/support/related-posts/customize-related-posts/#delete
	 */
	function newkarma_core_remove_jetpack_rp() {
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp     = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}
endif; // endif newkarma_core_remove_jetpack_rp.
add_filter( 'wp', 'newkarma_core_remove_jetpack_rp', 20 );
