<?php // phpcs:ignore
/**
 * Plugin Name: Newkarma Core
 * Plugin URI: https://www.idtheme.com/newkarma/
 * Description: Newkarma Core - Add functionally to magazine theme for easy maintenance. This plugin using only for theme with blog type from idtheme.com
 * Author: Gian Mokhammad R
 *
 * @package Newkarma Core
 * Version: 2.0.7
 * Author URI: http://www.gianmr.com
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * If using amp endpoint
 *
 * @since v.1.1.3
 */
function newkarma_core_is_amp() {
	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}

if ( ! class_exists( 'Newkarma_Core_Init' ) ) {
	/**
	 * Main Plugin Class
	 */
	class Newkarma_Core_Init {

		/**
		 * Contract
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function __construct() {
			// Define.
			define( 'NEWKARMA_CORE_VER', '2.0.5' );
			define( 'NEWKARMA_CORE_DIRNAME', plugin_dir_path( __FILE__ ) );
			define( 'NEWKARMA_CORE_URL', plugin_dir_url( __FILE__ ) );

			// this is the URL our updater / license checker pings. This should be the URL of the site.
			define( 'NEWKARMA_API_URL_CHECK', 'https://member.kentooz.com/softsale/api/check-license' );
			define( 'NEWKARMA_API_URL', 'https://member.kentooz.com/softsale/api/activate' );
			define( 'NEWKARMA_API_URL_DEACTIVATED', 'https://member.kentooz.com/softsale/api/deactivate' );

			// the name of the settings page for the license input to be displayed.
			define( 'NEWKARMA_PLUGIN_LICENSE_PAGE', 'newkarma-license' );

			// Include widget.
			include NEWKARMA_CORE_DIRNAME . 'widgets/feedburner-widget.php';

			// Include library.
			include NEWKARMA_CORE_DIRNAME . 'lib/breadcrumbs.php';
			include NEWKARMA_CORE_DIRNAME . 'lib/banner.php';
			include NEWKARMA_CORE_DIRNAME . 'lib/relatedpost.php';
			include NEWKARMA_CORE_DIRNAME . 'lib/headfooterscript.php';
			include NEWKARMA_CORE_DIRNAME . 'lib/jetpack.php';
			include NEWKARMA_CORE_DIRNAME . 'lib/video.php';
			include NEWKARMA_CORE_DIRNAME . 'lib/taxonomy.php';

			// Load only if dashboard.
			if ( is_admin() ) {
				include NEWKARMA_CORE_DIRNAME . 'lib/external/class.settings-api.php';
				include_once NEWKARMA_CORE_DIRNAME . 'lib/lcs.php';
			}

			// Action.
			add_action( 'plugins_loaded', array( $this, 'newkarma_core_load_textdomain' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

			// Enable the use of shortcodes in text widgets.
			add_filter( 'widget_text', 'do_shortcode' );

			$newkar_social = get_option( 'newkar_social' );

			if ( isset( $newkar_social['enable_fb_comment'] ) && '' !== $newkar_social['enable_fb_comment'] ) {
				// option, section, default.
				$option = $newkar_social['enable_fb_comment'];
			} else {
				$option = 'off';
			}

			// if option on then using fb comment.
			if ( 'on' === $option ) {
				add_filter( 'comments_template', array( $this, 'fb_comments_template' ), 20 );
			}

			// Other functionally.
			include_once NEWKARMA_CORE_DIRNAME . 'lib/update/plugin-update-checker.php';
			$MyUpdateChecker = PucFactory::buildUpdateChecker( //phpcs:ignore
				'https://www.kentooz.com/files/newkarma-core/newkarcoreautupdtebos.json',
				__FILE__,
				'newkarma-core'
			);

		}

		/**
		 * Activated plugin
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public static function newkarma_core_activate() {
			// nothing to do yet.
		}

		/**
		 * Deativated plugin
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public static function newkarma_core_deactivate() {
			// nothing to do yet.
		}

		/**
		 * Fb comment
		 *
		 * @since 1.0.2
		 * @access public
		 */
		public function fb_comments_template() {
			return NEWKARMA_CORE_DIRNAME . 'lib/fb-comment.php';
		}

		/**
		 * Enqueue assets
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function register_scripts() {
			wp_register_style( 'newkarma-core', NEWKARMA_CORE_URL . 'css/newkarma-core.css', '', NEWKARMA_CORE_VER );
			wp_enqueue_style( 'newkarma-core' );
		}

		/**
		 * Load languange
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function newkarma_core_load_textdomain() {
			load_plugin_textdomain( 'newkarma-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

	}
}


if ( class_exists( 'Newkarma_Core_Init' ) ) {

	// Installation and uninstallation hooks.
	register_activation_hook( __FILE__, array( 'Newkarma_Core_Init', 'newkarma_core_activate' ) );
	register_deactivation_hook( __FILE__, array( 'Newkarma_Core_Init', 'newkarma_core_deactivate' ) );

	// Initialise Class.
	$newkarma_core_init_by_gianmr = new Newkarma_Core_Init();

}
