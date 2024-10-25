<?php
/**
 * Displaying function for head and footer section
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

if ( ! function_exists( 'newkarma_core_head_script' ) ) :
	/**
	 * Insert script in head section
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_head_script() {
		$newkar_other = get_option( 'newkar_other' );
		$newkar_amp   = get_option( 'newkar_amp' );
		if ( newkarma_core_is_amp() ) {
			if ( isset( $newkar_amp['amp_head_script'] ) && ! empty( $newkar_amp['amp_head_script'] ) ) {
				echo htmlspecialchars_decode( $newkar_amp['amp_head_script'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		} else {
			if ( isset( $newkar_other['other_head_script'] ) && ! empty( $newkar_other['other_head_script'] ) ) {
				echo htmlspecialchars_decode( $newkar_other['other_head_script'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif; // endif newkarma_core_head_script.
add_action( 'wp_head', 'newkarma_core_head_script' );

if ( ! function_exists( 'newkarma_core_footer_script' ) ) :
	/**
	 * Insert script in footer section
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_footer_script() {
		$newkar_other = get_option( 'newkar_other' );
		if ( ! newkarma_core_is_amp() ) {
			if ( isset( $newkar_other['other_footer_script'] ) && ! empty( $newkar_other['other_footer_script'] ) ) {
				echo htmlspecialchars_decode( $newkar_other['other_footer_script'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif; // endif newkarma_core_footer_script.
add_action( 'wp_footer', 'newkarma_core_footer_script' );

if ( ! function_exists( 'newkarma_core_facebook_pixel' ) ) :
	/**
	 * Insert facebook pixel script via wp_head hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_facebook_pixel() {
		$newkar_other = get_option( 'newkar_other' );
		if ( isset( $newkar_other['other_fbpixel_id'] ) && ! empty( $newkar_other['other_fbpixel_id'] ) ) {
			if ( newkarma_core_is_amp() ) {
				echo '<amp-pixel src="https://www.facebook.com/tr?id=' . esc_attr( $newkar_other['other_fbpixel_id'] ) . '&ev=PageView&noscript=1" layout="nodisplay"></amp-pixel>';
			} else {
				echo '
				<!-- Facebook Pixel -->
				<script>
				!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
				n.push=n;n.loaded=!0;n.version=\'2.0\';n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
				document,\'script\',\'https://connect.facebook.net/en_US/fbevents.js\');

				fbq(\'init\', \'' . esc_attr( $newkar_other['other_fbpixel_id'] ) . '\');
				fbq(\'track\', "PageView");</script>
				<noscript><img height="1" width="1" style="display:none"
				src="https://www.facebook.com/tr?id=' . esc_attr( $newkar_other['other_fbpixel_id'] ) . '&ev=PageView&noscript=1"
				/></noscript>';
			}
		}
	}
endif; // endif newkarma_core_facebook_pixel.
add_action( 'wp_head', 'newkarma_core_facebook_pixel', 10 );

if ( ! function_exists( 'newkarma_core_google_analytic' ) ) :
	/**
	 * Insert google analytics script via wp_footer hook
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function newkarma_core_google_analytic() {
		$newkar_other = get_option( 'newkar_other' );
		if ( isset( $newkar_other['other_analytics_code'] ) && ! empty( $newkar_other['other_analytics_code'] ) ) {
			if ( newkarma_core_is_amp() ) {
				echo '<amp-analytics type="gtag" data-credentials="include">
				<script type="application/json">
				{
				  "vars" : {
					"gtag_id": "' . esc_attr( $newkar_other['other_analytics_code'] ) . '",
					"config" : {
					  "' . esc_attr( $newkar_other['other_analytics_code'] ) . '": { "groups": "default" }
					}
				  }
				}
				</script>
				</amp-analytics>
				';
			} else {
				echo '
				<!-- Google analytics -->
				<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr( $newkar_other['other_analytics_code'] ) . '"></script>
				<script>
					window.dataLayer = window.dataLayer || [];
					function gtag(){dataLayer.push(arguments);}
					gtag(\'js\', new Date());
					gtag(\'config\', \'' . esc_attr( $newkar_other['other_analytics_code'] ) . '\');
				</script>';
			}
		}
	}
endif; // endif newkarma_core_google_analytic.
add_action( 'wp_footer', 'newkarma_core_google_analytic', 10 );
