<?php
/**
 * Related Post Features
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

if ( ! function_exists( 'newkarma_related_post' ) ) {
	/**
	 * Adding the related post to the end of your single post
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function newkarma_related_post() {
		global $post;

		if ( is_singular( 'attachment' ) ) {
			$postids = $post->post_parent;
		} else {
			$postids = $post->ID;
		}

		$newkar_relpost = get_option( 'newkar_relpost' );

		if ( isset( $newkar_relpost['relpost_number'] ) && ! empty( $newkar_relpost['relpost_number'] ) ) {
			// option, section, default.
			$number = intval( $newkar_relpost['relpost_number'] );
		} else {
			$number = 8;
		}

		if ( isset( $newkar_relpost['relpost_taxonomy'] ) && 'category' === $newkar_relpost['relpost_taxonomy'] ) {
			$categories = get_the_category( $postids );
			if ( $categories ) {
				$category_ids = array();
				foreach ( $categories as $individual_category ) {
					$category_ids[] = $individual_category->term_id;
				}
				$args = array(
					'category__in'           => $category_ids,
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					// start improve performance.
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		} elseif ( isset( $newkar_relpost['relpost_taxonomy'] ) && 'topics' === $newkar_relpost['relpost_taxonomy'] ) {
			$topics = wp_get_object_terms( $postids, 'newstopic', array( 'fields' => 'ids' ) );
			if ( $topics ) {
				$args = array(
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					'tax_query'              => array(
						array(
							'taxonomy' => 'newstopic',
							'field'    => 'id',
							'terms'    => $topics,
						),
					),
					// start improve performance.
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		} else {
			$tags = wp_get_post_tags( $postids );
			if ( $tags ) {
				$tag_ids = array();

				foreach ( $tags as $individual_tag ) {
					$tag_ids[] = $individual_tag->term_id;
				}
				$args = array(
					'tag__in'                => $tag_ids,
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					// start improve performance.
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		}

		if ( ! isset( $args ) ) {
			$args = '';
		}

		$newkarma_query = new WP_Query( $args );

		$content = '';
		if ( $newkarma_query->have_posts() ) {

			if ( isset( $newkar_relpost['relpost_text'] ) && ! empty( $newkar_relpost['relpost_text'] ) ) {
				// option, section, default.
				$titletext = esc_attr( $newkar_relpost['relpost_text'] );
			} else {
				$titletext = __( 'Related Posts', 'newkarma-core' );
			}

			$content .= '<div class="newkarma-core-related-post site-main gmr-single gmr-list-related">';
			$content .= '<h3 class="widget-title"><span>' . $titletext . '</span></h3>';
			$content .= '<ul>';

			while ( $newkarma_query->have_posts() ) :
				$newkarma_query->the_post();

				$categories_list = get_the_category_list( esc_html__( ', ', 'newkarma-core' ) );

				$content     .= '<li>';
					$content .= '<div class="newkarma-core-related-title">';
					$content .= '<a href="' . get_permalink() . '" itemprop="url" class="rp-title" title="' . the_title_attribute(
						array(
							'before' => __( 'Permalink to: ', 'newkarma-core' ),
							'after'  => '',
							'echo'   => false,
						)
					) . '" rel="bookmark">' . get_the_title() . '</a>';
					$content .= '</div>';
				$content     .= '</li>';

			endwhile;
			wp_reset_postdata();

			$content .= '</ul>';

			$content .= '</div>';
		} // if have posts

		return $content;
	}
}

if ( ! function_exists( 'newkarma_core_related_post' ) ) :
	/**
	 * Returning Related Posts
	 */
	function newkarma_core_related_post() {
		$related = newkarma_related_post();
		return $related;
	}
endif; // endif newkarma_core_related_post.

if ( ! function_exists( 'newkarma_core_add_related_the_content' ) ) :
	/**
	 * Insert content after box content single
	 *
	 * @since 1.0.0
	 * @link https://jetpack.com/support/related-posts/customize-related-posts/#delete
	 * @return void
	 */
	function newkarma_core_add_related_the_content() {
		if ( is_singular( array( 'post', 'attachment' ) ) && in_the_loop() ) {
			$newkar_relpost = get_option( 'newkar_relpost' );
			if ( isset( $newkar_relpost['enable_relpost'] ) && ! empty( $newkar_relpost['enable_relpost'] ) ) {
				// option, section, default.
				$option = $newkar_relpost['enable_relpost'];
			} else {
				$option = 'on';
			}

			if ( 'on' === $option ) :
				echo newkarma_core_related_post(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			endif;
		}
	}
endif; // endif newkarma_core_add_related_the_content.
add_action( 'newkarma_core_add_related_the_content', 'newkarma_core_add_related_the_content', 40 );

if ( ! function_exists( 'newkarma_related_post_second' ) ) {
	/**
	 * Adding the related post to the end of single post in box before menu
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function newkarma_related_post_second() {
		global $post;

		$newkar_relpost = get_option( 'newkar_relpost' );

		if ( is_singular( 'attachment' ) ) {
			$postids = $post->post_parent;
		} else {
			$postids = $post->ID;
		}

		if ( isset( $newkar_relpost['relpost_number_2'] ) && ! empty( $newkar_relpost['relpost_number_2'] ) ) {
			// option, section, default.
			$number = intval( $newkar_relpost['relpost_number_2'] );
		} else {
			$number = 6;
		}

		if ( isset( $newkar_relpost['relpost_taxonomy_2'] ) && 'tags' === $newkar_relpost['relpost_taxonomy_2'] ) {
			$tags = wp_get_post_tags( $postids );
			if ( $tags ) {
				$tag_ids = array();

				foreach ( $tags as $individual_tag ) {
					$tag_ids[] = $individual_tag->term_id;
				}
				$args = array(
					'tag__in'                => $tag_ids,
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					// start improve performance.
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		} elseif ( isset( $newkar_relpost['relpost_taxonomy_2'] ) && 'topics' === $newkar_relpost['relpost_taxonomy_2'] ) {
			$topics = wp_get_object_terms( $postids, 'newstopic', array( 'fields' => 'ids' ) );
			if ( $topics ) {
				$args = array(
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					'tax_query'              => array(
						array(
							'taxonomy' => 'newstopic',
							'field'    => 'id',
							'terms'    => $topics,
						),
					),
					// start improve performance.
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		} else {
			$categories = get_the_category( $postids );
			if ( $categories ) {
				$category_ids = array();
				foreach ( $categories as $individual_category ) {
					$category_ids[] = $individual_category->term_id;
				}
				$args = array(
					'category__in'           => $category_ids,
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					// start improve performance.
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		}

		if ( ! isset( $args ) ) {
			$args = '';
		}

		$newkarma_query = new WP_Query( $args );

		$content = '';
		if ( $newkarma_query->have_posts() ) {

			if ( isset( $newkar_relpost['relpost_text_2'] ) && ! empty( $newkar_relpost['relpost_text_2'] ) ) {
				// option, section, default.
				$titletext = esc_attr( $newkar_relpost['relpost_text_2'] );
			} else {
				$titletext = __( 'Don\'t Miss', 'newkarma-core' );
			}

			$content .= '<div class="newkarma-core-related-post site-main gmr-single gmr-gallery-related">';

			$content .= '<h3 class="widget-title"><span>' . $titletext . '</span></h3>';

			$content .= '<ul>';

			while ( $newkarma_query->have_posts() ) :
				$newkarma_query->the_post();

				$categories_list = get_the_category_list( esc_html__( ', ', 'newkarma-core' ) );

				$content .= '<li>';

				$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				if ( ! empty( $featured_image_url ) ) :
					$content .= '<div class="other-content-thumbnail">';
					$content .= '<a href="' . get_permalink() . '" itemprop="url" title="' . the_title_attribute(
						array(
							'before' => __( 'Permalink to: ', 'newkarma-core' ),
							'after'  => '',
							'echo'   => false,
						)
					) . '" class="image-related" rel="bookmark">';
					$content .= get_the_post_thumbnail( $post->ID, 'large' );
					$content .= '</a>';
					if ( has_post_format( 'gallery' ) ) {
						$content .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path d="M864 260H728l-32.4-90.8a32.07 32.07 0 0 0-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 260H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V340c0-44.2-35.8-80-80-80zM512 716c-88.4 0-160-71.6-160-160s71.6-160 160-160s160 71.6 160 160s-71.6 160-160 160zm-96-160a96 96 0 1 0 192 0a96 96 0 1 0-192 0z" fill="currentColor"/></svg>';
					} elseif ( has_post_format( 'video' ) ) {
						$content .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z" fill="currentColor"/><path d="M719.4 499.1l-296.1-215A15.9 15.9 0 0 0 398 297v430c0 13.1 14.8 20.5 25.3 12.9l296.1-215a15.9 15.9 0 0 0 0-25.8zm-257.6 134V390.9L628.5 512L461.8 633.1z" fill="currentColor"/></svg>';
						$h        = get_post_meta( $post->ID, '_durh', true );
						$m        = get_post_meta( $post->ID, '_durm', true );
						$s        = get_post_meta( $post->ID, '_durs', true );
						if ( ! empty( $h ) || ! empty( $m ) || ! empty( $s ) ) {
							$content .= '<div class="duration">';
							if ( ! empty( $h ) && 0 !== $h ) {
								$content .= esc_html( str_pad( absint( $h ), 2, '0', STR_PAD_LEFT ) . ':' );
							}
							if ( ! empty( $m ) ) {
								$content .= esc_html( str_pad( absint( $m ), 2, '0', STR_PAD_LEFT ) . ':' );
							} else {
								$content .= '00';
							}
							if ( ! empty( $s ) ) {
								$content .= esc_html( str_pad( absint( $s ), 2, '0', STR_PAD_LEFT ) );
							} else {
								$content .= '00';
							}
							$content .= '</div>';
						}
					}
					$content .= '</div>';
				endif;
				$content .= '<div class="newkarma-core-related-title">';
				$content .= '<a href="' . get_permalink() . '" itemprop="url" class="rp-title" title="' . the_title_attribute(
					array(
						'before' => __( 'Permalink to: ', 'newkarma-core' ),
						'after'  => '',
						'echo'   => false,
					)
				) . '" rel="bookmark">' . get_the_title() . '</a>';
				$content .= '</div>';

				$content .= '</li>';

			endwhile;
			wp_reset_postdata();

			$content .= '</ul>';

			$content .= '</div>';
		} // if have posts

		return $content;
	}
}

if ( ! function_exists( 'newkarma_core_add_second_related_the_content' ) ) :
	/**
	 * Insert content after box content single
	 *
	 * @since 1.0.0
	 * @link https://jetpack.com/support/related-posts/customize-related-posts/#delete
	 * @return void
	 */
	function newkarma_core_add_second_related_the_content() {
		if ( is_singular( array( 'post', 'attachment' ) ) && in_the_loop() ) {
			$newkar_relpost = get_option( 'newkar_relpost' );
			if ( isset( $newkar_relpost['enable_relpost_2'] ) && ! empty( $newkar_relpost['enable_relpost_2'] ) ) {
				// option, section, default.
				$option = $newkar_relpost['enable_relpost_2'];
			} else {
				$option = 'on';
			}

			if ( 'on' === $option ) :
				echo newkarma_related_post_second(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			endif;
		}
	}
endif; // endif newkarma_core_add_second_related_the_content.
add_action( 'newkarma_core_add_second_related_the_content', 'newkarma_core_add_second_related_the_content', 40 );

if ( ! function_exists( 'newkarma_related_post_infinite' ) ) {
	/**
	 * Adding the related post to the end of single post in box before menu
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function newkarma_related_post_infinite() {
		global $post;
		global $wp_rewrite;
		global $paged;
		global $wp_query;

		$newkar_relpost = get_option( 'newkar_relpost' );

		if ( is_singular( 'attachment' ) ) {
			$postids = $post->post_parent;
		} else {
			$postids = $post->ID;
		}

		if ( isset( $newkar_relpost['relpost_number_3'] ) && ! empty( $newkar_relpost['relpost_number_3'] ) ) {
			// option, section, default.
			$number = intval( $newkar_relpost['relpost_number_3'] );
		} else {
			$number = 6;
		}

		if ( isset( $newkar_relpost['relpost_text_3'] ) && ! empty( $newkar_relpost['relpost_text_3'] ) ) {
			// option, section, default.
			$titletext = esc_attr( $newkar_relpost['relpost_text_3'] );
		} else {
			$titletext = __( 'News Feed', 'newkarma-core' );
		}

		$paged = isset( $_REQUEST['pgrelated'] ) ? $_REQUEST['pgrelated'] : 1;

		if ( isset( $newkar_relpost['relpost_taxonomy_3'] ) && 'tags' === $newkar_relpost['relpost_taxonomy_3'] ) {
			$tags = wp_get_post_tags( $postids );
			if ( $tags ) {
				$tag_ids = array();
				foreach ( $tags as $individual_tag ) {
					$tag_ids[] = $individual_tag->term_id;
				}
				$args = array(
					'tag__in'                => $tag_ids,
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					// start improve performance.
					'paged'                  => $paged,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		} elseif ( isset( $newkar_relpost['relpost_taxonomy_3'] ) && 'topics' === $newkar_relpost['relpost_taxonomy_3'] ) {
			$topics = wp_get_object_terms( $postids, 'newstopic', array( 'fields' => 'ids' ) );
			if ( $topics ) {
				$args = array(
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					'tax_query'              => array(
						array(
							'taxonomy' => 'newstopic',
							'field'    => 'id',
							'terms'    => $topics,
						),
					),
					// start improve performance.
					'paged'                  => $paged,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		} else {
			$categories = get_the_category( $postids );
			if ( $categories ) {
				$category_ids = array();
				foreach ( $categories as $individual_category ) {
					$category_ids[] = $individual_category->term_id;
				}
				$args = array(
					'category__in'           => $category_ids,
					'post__not_in'           => array( $post->ID ),
					'posts_per_page'         => $number,
					// start improve performance.
					'paged'                  => $paged,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false,
					// End improve performance.
					'ignore_sticky_posts'    => 1,
				);
			}
		}

		if ( ! isset( $args ) ) {
			$args = '';
		}

		$newkarma_query = new WP_Query( $args );

		$orig_post  = $post;
		$temp_query = $wp_query;
		$wp_query   = null;
		$wp_query   = $newkarma_query;

		$content = '';
		if ( $newkarma_query->have_posts() ) {

			$content .= '<div class="gmr-box-content-single">';

			$content .= '<h3 class="widget-title"><span>' . $titletext . '</span></h3>';

			$content .= '<div class="site-main gmr-single gmr-infinite-selector gmr-related-infinite">';

			$content .= '<div id="gmr-main-load">';

			while ( $newkarma_query->have_posts() ) :
				$newkarma_query->the_post();

				$categories_list = get_the_category_list( esc_html__( ', ', 'newkarma-core' ) );

				$content .= '<div class="item-infinite">';
				$content .= '<div class="item-box clearfix ' . join( ' ', get_post_class() ) . '">';

				$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				if ( ! empty( $featured_image_url ) ) :
					$content .= '<div class="other-content-thumbnail">';
					$content .= '<a href="' . get_permalink() . '" itemprop="url" title="' . the_title_attribute(
						array(
							'before' => __( 'Permalink to: ', 'newkarma-core' ),
							'after'  => '',
							'echo'   => false,
						)
					) . '" class="image-related" rel="bookmark">';
					$content .= get_the_post_thumbnail( $post->ID, 'large' );
					$content .= '</a>';
					if ( has_post_format( 'gallery' ) ) {
						$content .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path d="M864 260H728l-32.4-90.8a32.07 32.07 0 0 0-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 260H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V340c0-44.2-35.8-80-80-80zM512 716c-88.4 0-160-71.6-160-160s71.6-160 160-160s160 71.6 160 160s-71.6 160-160 160zm-96-160a96 96 0 1 0 192 0a96 96 0 1 0-192 0z" fill="currentColor"/></svg>';
					} elseif ( has_post_format( 'video' ) ) {
						$content .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z" fill="currentColor"/><path d="M719.4 499.1l-296.1-215A15.9 15.9 0 0 0 398 297v430c0 13.1 14.8 20.5 25.3 12.9l296.1-215a15.9 15.9 0 0 0 0-25.8zm-257.6 134V390.9L628.5 512L461.8 633.1z" fill="currentColor"/></svg>';
						$h        = get_post_meta( $post->ID, '_durh', true );
						$m        = get_post_meta( $post->ID, '_durm', true );
						$s        = get_post_meta( $post->ID, '_durs', true );
						if ( ! empty( $h ) || ! empty( $m ) || ! empty( $s ) ) {
							$content .= '<div class="duration">';
							if ( ! empty( $h ) && 0 !== $h ) {
								$content .= esc_html( str_pad( absint( $h ), 2, '0', STR_PAD_LEFT ) . ':' );
							}
							if ( ! empty( $m ) ) {
								$content .= esc_html( str_pad( absint( $m ), 2, '0', STR_PAD_LEFT ) . ':' );
							} else {
								$content .= '00';
							}
							if ( ! empty( $s ) ) {
								$content .= esc_html( str_pad( absint( $s ), 2, '0', STR_PAD_LEFT ) );
							} else {
								$content .= '00';
							}
							$content .= '</div>';
						}
					}
					$content .= '</div>';
				endif;

					$content .= '<h4 class="infinite-related-title">';
					$content .= '<a href="' . get_permalink() . '" class="rp-title" itemprop="url" title="' . the_title_attribute(
						array(
							'before' => __( 'Permalink to: ', 'newkarma-core' ),
							'after'  => '',
							'echo'   => false,
						)
					) . '" rel="bookmark">' . get_the_title() . '</a>';
					$content .= '</h4>';

				$content .= '</div>';
				$content .= '</div>';

			endwhile;

				$content .= '</div>';

				$loadmore = get_theme_mod( 'gmr_blog_pagination', 'gmr-more' );
			if ( ( 'gmr-infinite' === $loadmore ) || ( 'gmr-more' === $loadmore ) && ! newkarma_core_is_amp() ) {
				$class = 'inf-pagination';
			} else {
				$class = 'pagination';
			}

			if ( ( 'gmr-infinite' === $loadmore ) || ( 'gmr-more' === $loadmore ) && ! newkarma_core_is_amp() ) {
				$content .= '<div class="' . esc_html( $class ) . '">';

				$paged_qp = 'pgrelated'; // the query parameter for pagination.
				$base     = remove_query_arg( $paged_qp, get_pagenum_link() ) . '%_%'; // remove current lists query parameter from base, other lists qr will be kept.
				$base     = str_replace( '#038;', '&', $base );

				// if base already have a query parameter, use &.
				if ( strpos( $base, '?' ) ) {
					$format = '&' . $paged_qp . '=%#%';
				} else {
					$format = '?' . $paged_qp . '=%#%';
				}

				$paged = isset( $_REQUEST['pgrelated'] ) ? $_REQUEST['pgrelated'] : 1;

				$navigation = paginate_links(
					apply_filters(
						'gmr_get_pagination_args',
						array(
							'base'      => $base,
							'show_all'  => false,
							'format'    => $format,
							'current'   => $paged,
							'total'     => $newkarma_query->max_num_pages,
							'prev_text' => __( 'Prev', 'newkarma-core' ),
							'next_text' => __( 'Next', 'newkarma-core' ),
							'add_args'  => false,
							'type'      => 'list',
						)
					)
				);

				$navigation = str_replace( '<a ', '<a rel="nofollow" ', $navigation );

				$content .= $navigation;

				$content .= '</div>';

				$content .= '
					<div class="text-center gmr-newinfinite">
						<div class="page-load-status">
							<div class="loader-ellips infinite-scroll-request gmr-ajax-load-wrapper gmr-loader">
								<div class="gmr-ajax-wrap">
									<div class="gmr-ajax-loader">
										<div></div>
										<div></div>
									</div>
								</div>
							</div>
							<p class="infinite-scroll-last">' . esc_attr__( 'No More Posts Available.', 'newkarma-core' ) . '</p>
							<p class="infinite-scroll-error">' . esc_attr__( 'No more pages to load.', 'newkarma-core' ) . '</p>
						</div>';
				if ( 'gmr-more' === $loadmore ) {
					$content .= '<p><button class="view-more-button heading-text">' . esc_attr__( 'View More', 'newkarma-core' ) . '</button></p>';
				}
				$content .= '
					</div>
					';

			}

			$content .= '</div>';

			$content .= '</div>';
		} // if have posts

		$post = $orig_post;
		// Reset main query object.
		$wp_query = null;
		$wp_query = $temp_query;
		wp_reset_postdata(); // reset the query.

		return $content;
	}
}

if ( ! function_exists( 'newkarma_core_add_related_post_infinite' ) ) :
	/**
	 * Insert content after box content single
	 *
	 * @since 1.0.0
	 * @link https://jetpack.com/support/related-posts/customize-related-posts/#delete
	 * @return void
	 */
	function newkarma_core_add_related_post_infinite() {
		if ( is_singular( array( 'post', 'attachment' ) ) ) {
			$newkar_relpost = get_option( 'newkar_relpost' );
			if ( isset( $newkar_relpost['enable_relpost_3'] ) && ! empty( $newkar_relpost['enable_relpost_3'] ) ) {
				// option, section, default.
				$option = $newkar_relpost['enable_relpost_3'];
			} else {
				$option = 'on';
			}

			if ( 'on' === $option ) :
				echo newkarma_related_post_infinite(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			endif;
		}
	}
endif; // endif newkarma_core_add_related_post_infinite.
add_action( 'newkarma_core_add_related_post_infinite', 'newkarma_core_add_related_post_infinite', 40 );
