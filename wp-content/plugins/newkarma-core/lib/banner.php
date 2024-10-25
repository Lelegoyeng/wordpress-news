<?php
/**
 * Banner features
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

if ( ! function_exists( 'newkarma_core_top_banner' ) ) {
	/**
	 * Adding banner at top via hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_top_banner() {
		$newkar_ads = get_option( 'newkar_ads' );

		if ( isset( $newkar_ads['ads_topbanner'] ) && ! empty( $newkar_ads['ads_topbanner'] ) ) {
			echo '<div class="newkarma-core-topbanner">';
			echo do_shortcode( $newkar_ads['ads_topbanner'] );
			echo '</div>';
		}
	}
}
add_action( 'newkarma_core_top_banner', 'newkarma_core_top_banner', 10 );

if ( ! function_exists( 'newkarma_core_top_banner_after_menu' ) ) {
	/**
	 * Adding banner at top via hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_top_banner_after_menu() {
		$newkar_ads = get_option( 'newkar_ads' );
		$newkar_amp = get_option( 'newkar_amp' );
		if ( newkarma_core_is_amp() ) {
			if ( isset( $newkar_amp['amp_ads_topbanner_aftermenu'] ) && ! empty( $newkar_amp['amp_ads_topbanner_aftermenu'] ) ) {
				echo '<div class="container">';
					echo '<div class="newkarma-core-topbanner-aftermenu">';
					echo do_shortcode( $newkar_amp['amp_ads_topbanner_aftermenu'] );
					echo '</div>';
				echo '</div>';
			}
		} else {
			if ( isset( $newkar_ads['ads_topbanner_aftermenu'] ) && ! empty( $newkar_ads['ads_topbanner_aftermenu'] ) ) {
				echo '<div class="container">';
					echo '<div class="newkarma-core-topbanner-aftermenu">';
					echo do_shortcode( $newkar_ads['ads_topbanner_aftermenu'] );
					echo '</div>';
				echo '</div>';
			}
		}
	}
}
add_action( 'newkarma_core_top_banner_after_menu', 'newkarma_core_top_banner_after_menu', 10 );

if ( ! function_exists( 'newkarma_core_banner_before_content' ) ) {
	/**
	 * Adding banner at before content via hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_banner_before_content() {
		$newkar_ads = get_option( 'newkar_ads' );
		$newkar_amp = get_option( 'newkar_amp' );
		if ( newkarma_core_is_amp() ) {
			if ( isset( $newkar_amp['amp_ads_before_content'] ) && ! empty( $newkar_amp['amp_ads_before_content'] ) ) {
				echo '<div class="container">';
					echo '<div class="newkarma-core-banner-beforecontent newkarma-core-center-ads">';
					echo do_shortcode( $newkar_amp['amp_ads_before_content'] );
					echo '</div>';
				echo '</div>';
			}
		} else {
			if ( isset( $newkar_ads['ads_before_content'] ) && ! empty( $newkar_ads['ads_before_content'] ) ) {
				if ( isset( $newkar_ads['ads_before_content_position'] ) && 'left' === $newkar_ads['ads_before_content_position'] ) {
					$class = ' pull-left';
				} elseif ( isset( $newkar_ads['ads_before_content_position'] ) && 'right' === $newkar_ads['ads_before_content_position'] ) {
					$class = ' pull-right';
				} elseif ( isset( $newkar_ads['ads_before_content_position'] ) && 'center' === $newkar_ads['ads_before_content_position'] ) {
					$class = ' newkarma-core-center-ads';
				} else {
					$class = '';
				}
				echo '<div class="newkarma-core-banner-beforecontent' . esc_html( $class ) . '">';
				echo do_shortcode( $newkar_ads['ads_before_content'] );
				echo '</div>';
			}
		}
	}
}

if ( ! function_exists( 'newkarma_core_add_banner_before_content' ) ) :
	/**
	 * Insert content after box content single
	 *
	 * @since 1.0.0
	 * @param string $content Content Posts.
	 * @return string
	 */
	function newkarma_core_add_banner_before_content( $content ) {
		if ( is_singular( array( 'post' ) ) && in_the_loop() ) {
			$content = newkarma_core_banner_before_content() . $content;
		}
		return $content;
	}
endif; // endif newkarma_core_add_banner_before_content.
add_filter( 'the_content', 'newkarma_core_add_banner_before_content', 30, 1 );

if ( ! function_exists( 'newkarma_core_banner_after_content' ) ) {
	/**
	 * Adding banner at before content via hook
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function newkarma_core_banner_after_content() {
		$newkar_ads = get_option( 'newkar_ads' );
		$newkar_amp = get_option( 'newkar_amp' );
		$banner     = '';
		if ( newkarma_core_is_amp() ) {
			if ( isset( $newkar_amp['amp_ads_after_content'] ) && ! empty( $newkar_amp['amp_ads_after_content'] ) ) {
				$banner .= '<div class="newkarma-core-banner-aftercontent newkarma-core-center-ads">';
				$banner .= do_shortcode( $newkar_amp['amp_ads_after_content'] );
				$banner .= '</div>';
			}
		} else {
			if ( isset( $newkar_ads['ads_after_content'] ) && ! empty( $newkar_ads['ads_after_content'] ) ) {
				if ( isset( $newkar_ads['ads_after_content_position'] ) && 'right' === $newkar_ads['ads_after_content_position'] ) {
					$class = ' newkarma-core-center-right';
				} elseif ( isset( $newkar_ads['ads_after_content_position'] ) && 'center' === $newkar_ads['ads_after_content_position'] ) {
					$class = ' newkarma-core-center-ads';
				} else {
					$class = '';
				}
				$banner .= '<div class="newkarma-core-banner-aftercontent' . esc_html( $class ) . '">';
				$banner .= do_shortcode( $newkar_ads['ads_after_content'] );
				$banner .= '</div>';
			}
		}
		return $banner;
	}
}

if ( ! function_exists( 'newkarma_core_add_banner_after_content' ) ) :
	/**
	 * Insert content after box content single
	 *
	 * @since 1.0.0
	 * @param string $content Content Posts.
	 * @return string
	 */
	function newkarma_core_add_banner_after_content( $content ) {
		if ( is_singular( array( 'post' ) ) && in_the_loop() ) {
			$content = $content . newkarma_core_banner_after_content();
		}
		return $content;
	}
endif; // endif newkarma_core_add_banner_after_content.
add_filter( 'the_content', 'newkarma_core_add_banner_after_content', 30 );

if ( ! function_exists( 'newkarma_core_helper_after_paragraph' ) ) :
	/**
	 * Helper add content after paragprah
	 *
	 * @param String $insertion Code.
	 * @param Number $paragraph_id ID Paraghrap.
	 * @param String $content Code.
	 * @since 1.0.0
	 * @link http://stackoverflow.com/questions/25888630/place-ads-in-between-text-only-paragraphs
	 * @return string
	 */
	function newkarma_core_helper_after_paragraph( $insertion, $paragraph_id, $content ) {
		if ( is_singular( array( 'post' ) ) && in_the_loop() ) {

			$closing_p  = '</p>';
			$paragraphs = explode( $closing_p, wptexturize( $content ) );
			$count      = count( $paragraphs );

			foreach ( $paragraphs as $index => $paragraph ) {
				$word_count = count( explode( ' ', $paragraph ) );
				if ( trim( $paragraph ) && $paragraph_id == $index + 1 ) {
					$paragraphs[ $index ] .= $closing_p;
				}
				if ( $paragraph_id == $index + 1 && $count >= 4 ) {
					$paragraphs[ $index ] .= $insertion;
				}
			}
		}
		return implode( '', $paragraphs );
	}
endif; // endif newkarma_core_helper_after_paragraph.

if ( ! function_exists( 'newkarma_core_add_banner_inside_content' ) ) :
	/**
	 * Insert content inside content single
	 *
	 * @since 1.0.0
	 * @param string $content Content Posts.
	 * @return string
	 */
	function newkarma_core_add_banner_inside_content( $content ) {
		if ( is_singular( array( 'post' ) ) && in_the_loop() ) {
			$newkar_ads = get_option( 'newkar_ads' );
			$newkar_amp = get_option( 'newkar_amp' );
			if ( newkarma_core_is_amp() ) {
				if ( isset( $newkar_amp['amp_ads_inside_content'] ) && ! empty( $newkar_amp['amp_ads_inside_content'] ) ) {
					$ad_code = '<div class="newkarma-core-banner-insidecontent newkarma-core-center-ads">' . do_shortcode( $newkar_amp['amp_ads_inside_content'] ) . '</div>';
					if ( is_singular( array( 'post' ) ) && in_the_loop() ) {
						return newkarma_core_helper_after_paragraph( $ad_code, 2, $content );
					}
				}
			} else {
				if ( isset( $newkar_ads['ads_inside_content'] ) && ! empty( $newkar_ads['ads_inside_content'] ) ) {
					if ( isset( $newkar_ads['ads_inside_content_position'] ) && 'right' === $newkar_ads['ads_inside_content_position'] ) {
						$class = ' newkarma-core-center-right';
					} elseif ( isset( $newkar_ads['ads_inside_content_position'] ) && 'center' === $newkar_ads['ads_inside_content_position'] ) {
						$class = ' newkarma-core-center-ads';
					} else {
						$class = '';
					}
					$ad_code = '<div class="newkarma-core-banner-insidecontent' . esc_html( $class ) . '">' . do_shortcode( $newkar_ads['ads_inside_content'] ) . '</div>';
					if ( is_singular( array( 'post' ) ) && in_the_loop() ) {
						return newkarma_core_helper_after_paragraph( $ad_code, 2, $content );
					}
				}
			}
		}
		return $content;
	}
endif; // endif newkarma_core_add_banner_inside_content.
add_filter( 'the_content', 'newkarma_core_add_banner_inside_content' );

if ( ! function_exists( 'newkarma_core_banner_before_content_attachment' ) ) {
	/**
	 * Adding banner at before content via hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_banner_before_content_attachment() {
		$newkar_ads = get_option( 'newkar_ads' );
		if ( ! newkarma_core_is_amp() ) {
			if ( isset( $newkar_ads['ads_before_content_attachment'] ) && ! empty( $newkar_ads['ads_before_content_attachment'] ) ) {
				if ( isset( $newkar_ads['ads_before_content_attachment_position'] ) && 'left' === $newkar_ads['ads_before_content_attachment_position'] ) {
					$class = ' pull-left';
				} elseif ( isset( $newkar_ads['ads_before_content_attachment_position'] ) && 'right' === $newkar_ads['ads_before_content_attachment_position'] ) {
					$class = ' pull-right';
				} elseif ( isset( $newkar_ads['ads_before_content_attachment_position'] ) && 'center' === $newkar_ads['ads_before_content_attachment_position'] ) {
					$class = ' newkarma-core-center-ads';
				} else {
					$class = '';
				}
				echo '<div class="gmr-box-content-single' . esc_html( $class ) . '">';
				echo do_shortcode( $newkar_ads['ads_before_content_attachment'] );
				echo '</div>';
			}
		}
	}
}
add_action( 'newkarma_core_banner_before_content_attachment', 'newkarma_core_banner_before_content_attachment' );

if ( ! function_exists( 'newkarma_core_banner_after_content_attachment' ) ) {
	/**
	 * Adding banner at before content via hook
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function newkarma_core_banner_after_content_attachment() {
		$newkar_ads = get_option( 'newkar_ads' );
		$banner     = '';
		if ( ! newkarma_core_is_amp() ) {
			if ( isset( $newkar_ads['ads_after_content_attachment'] ) && ! empty( $newkar_ads['ads_after_content_attachment'] ) ) {
				if ( isset( $newkar_ads['ads_after_content_attachment_position'] ) && 'right' === $newkar_ads['ads_after_content_attachment_position'] ) {
					$class = ' newkarma-core-center-right';
				} elseif ( isset( $newkar_ads['ads_after_content_attachment_position'] ) && 'center' === $newkar_ads['ads_after_content_attachment_position'] ) {
					$class = ' newkarma-core-center-ads';
				} else {
					$class = '';
				}
				$banner .= '<div class="gmr-box-content-single' . esc_html( $class ) . '">';
				$banner .= do_shortcode( $newkar_ads['ads_after_content_attachment'] );
				$banner .= '</div>';
			}
		}
		echo $banner;
	}
}
add_action( 'newkarma_core_banner_after_content_attachment', 'newkarma_core_banner_after_content_attachment' );

if ( ! function_exists( 'newkarma_core_floating_banner_left' ) ) {
	/**
	 * Adding banner at top via hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_floating_banner_left() {
		$newkar_ads = get_option( 'newkar_ads' );

		if ( isset( $newkar_ads['ads_floatbanner_left'] ) && ! empty( $newkar_ads['ads_floatbanner_left'] ) ) {
			echo '<div class="newkarma-core-floatbanner newkarma-core-floatbanner-left">';
				echo '<div class="inner-float-left">';
				echo '<button onclick="parentNode.remove()" title="' . esc_html__( 'close', 'newkarma-core' ) . '">' . esc_html__( 'close', 'newkarma-core' ) . '</button>';
				echo do_shortcode( $newkar_ads['ads_floatbanner_left'] );
				echo '</div>';
			echo '</div>';
		}
	}
}
add_action( 'newkarma_core_floating_banner_left', 'newkarma_core_floating_banner_left', 10 );

if ( ! function_exists( 'newkarma_core_floating_banner_right' ) ) {
	/**
	 * Adding floating banner
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_floating_banner_right() {
		$newkar_ads = get_option( 'newkar_ads' );

		if ( isset( $newkar_ads['ads_floatbanner_right'] ) && ! empty( $newkar_ads['ads_floatbanner_right'] ) ) {
			echo '<div class="newkarma-core-floatbanner newkarma-core-floatbanner-right">';
				echo '<div class="inner-float-right">';
				echo '<button onclick="parentNode.remove()" title="' . esc_html__( 'close', 'newkarma-core' ) . '">' . esc_html__( 'close', 'newkarma-core' ) . '</button>';
				echo do_shortcode( $newkar_ads['ads_floatbanner_right'] );
				echo '</div>';
				echo '</div>';
		}
	}
}
add_action( 'newkarma_core_floating_banner_right', 'newkarma_core_floating_banner_right', 15 );

if ( ! function_exists( 'newkarma_core_floating_banner_footer' ) ) {
	/**
	 * Adding floating banner
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_floating_banner_footer() {
		$newkar_ads = get_option( 'newkar_ads' );

		if ( isset( $newkar_ads['ads_floatbanner_footer'] ) && ! empty( $newkar_ads['ads_floatbanner_footer'] ) ) {

			echo '<div class="newkarma-core-floatbanner newkarma-core-floatbanner-footer">';
				echo '<div class="container">';
					echo '<div class="inner-floatbanner-bottom">';
					echo '<button onclick="parentNode.remove()" title="' . esc_html__( 'close', 'newkarma-core' ) . '">' . esc_html__( 'close', 'newkarma-core' ) . '</button>';
					echo do_shortcode( $newkar_ads['ads_floatbanner_footer'] );
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}
	}
}
add_action( 'newkarma_core_floating_footer', 'newkarma_core_floating_banner_footer', 20 );

if ( ! function_exists( 'newkarma_core_banner_between_posts' ) ) {

	/**
	 * Adding banner between posts in archive and index post
	 *
	 * @since 1.0.5
	 * @return void
	 */
	function newkarma_core_banner_between_posts() {
		global $wp_query;

		$newkar_ads = get_option( 'newkar_ads' );
		$newkar_amp = get_option( 'newkar_amp' );
		if ( newkarma_core_is_amp() ) {
			// Check if we're at the right position and option not empty.
			if ( isset( $newkar_amp['amp_ads_after_betweenpost'] ) && ! empty( $newkar_amp['amp_ads_after_betweenpost'] ) ) {
				if ( isset( $newkar_amp['amp_ads_after_betweenpost_position'] ) && '2' === $newkar_amp['amp_ads_after_betweenpost_position'] ) {
					$numb = 1;
				} elseif ( isset( $newkar_amp['amp_ads_after_betweenpost_position'] ) && '3' === $newkar_amp['amp_ads_after_betweenpost_position'] ) {
					$numb = 2;
				} elseif ( isset( $newkar_amp['amp_ads_after_betweenpost_position'] ) && '4' === $newkar_amp['amp_ads_after_betweenpost_position'] ) {
					$numb = 3;
				} else {
					$numb = 0;
				}

				if ( $wp_query->current_post == intval( $numb ) ) {
					// Display the banner.
					echo '<div class="gmr-between-post-banner item">';
						echo '<div class="gmr-box-content">';
							echo do_shortcode( $newkar_amp['amp_ads_after_betweenpost'] );
						echo '</div>';
					echo '</div>';

				}
			}
		} else {
			// Check if we're at the right position and option not empty.
			if ( isset( $newkar_ads['ads_after_betweenpost'] ) && ! empty( $newkar_ads['ads_after_betweenpost'] ) ) {
				if ( isset( $newkar_ads['ads_after_betweenpost_position'] ) && '2' === $newkar_ads['ads_after_betweenpost_position'] ) {
					$numb = 1;
				} elseif ( isset( $newkar_ads['ads_after_betweenpost_position'] ) && '3' === $newkar_ads['ads_after_betweenpost_position'] ) {
					$numb = 2;
				} elseif ( isset( $newkar_ads['ads_after_betweenpost_position'] ) && '4' === $newkar_ads['ads_after_betweenpost_position'] ) {
					$numb = 3;
				} else {
					$numb = 0;
				}

				if ( $wp_query->current_post == intval( $numb ) ) {
					// Display the banner.
					echo '<div class="gmr-between-post-banner item">';
						echo '<div class="gmr-box-content">';
							echo do_shortcode( $newkar_ads['ads_after_betweenpost'] );
						echo '</div>';
					echo '</div>';

				}
			}
		}
	}
}
add_action( 'newkarma_core_banner_between_posts', 'newkarma_core_banner_between_posts', 20 );

if ( ! function_exists( 'newkarma_core_banner_before_dontmiss' ) ) {
	/**
	 * Adding banner at top via hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_banner_before_dontmiss() {
		$newkar_ads = get_option( 'newkar_ads' );
		$newkar_amp = get_option( 'newkar_amp' );
		if ( newkarma_core_is_amp() ) {
			if ( isset( $newkar_amp['amp_ads_before_dontmiss'] ) && ! empty( $newkar_amp['amp_ads_before_dontmiss'] ) ) {
				echo '<div class="newkarma-core-before-dontmiss">';
				echo do_shortcode( $newkar_amp['amp_ads_before_dontmiss'] );
				echo '</div>';
			}
		} else {
			if ( isset( $newkar_ads['ads_before_dontmiss'] ) && ! empty( $newkar_ads['ads_before_dontmiss'] ) ) {
				echo '<div class="newkarma-core-before-dontmiss">';
				echo do_shortcode( $newkar_ads['ads_before_dontmiss'] );
				echo '</div>';
			}
		}
	}
}
add_action( 'newkarma_core_banner_before_dontmiss', 'newkarma_core_banner_before_dontmiss', 10 );
