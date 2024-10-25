<?php
/**
 * WordPress settings API
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

if ( ! class_exists( 'Newkarma_Core_Settings_API' ) ) :
	/**
	 * Class.
	 */
	class Newkarma_Core_Settings_API {

		/**
		 * Variable Setting API
		 *
		 * @var $settings_api Setting API.
		 */
		private $settings_api;
		/**
		 * Construct
		 */
		public function __construct() {
			$this->settings_api = new WeDevs_Settings_API();

			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		}
		/**
		 * Admin Init
		 */
		public function admin_init() {

			// set the settings.
			$this->settings_api->set_sections( $this->get_settings_sections() );
			$this->settings_api->set_fields( $this->get_settings_fields() );

			// initialize settings.
			$this->settings_api->admin_init();
		}
		/**
		 * Admin Menu
		 */
		public function admin_menu() {
			add_options_page( 'Newkarma Core', 'Newkarma Core', 'manage_options', 'newkarma-core-settings', array( $this, 'plugin_page' ) );
		}
		/**
		 * Get Settings Sections
		 */
		public function get_settings_sections() {
			$sections = array(
				array(
					'id'    => 'newkar_relpost',
					'title' => __( 'Related Post', 'newkarma-core' ),
				),
				array(
					'id'    => 'newkar_breadcrumbs',
					'title' => __( 'Breadcrumbs', 'newkarma-core' ),
				),
				array(
					'id'    => 'newkar_ads',
					'title' => __( 'Ads', 'newkarma-core' ),
				),
				array(
					'id'    => 'newkar_social',
					'title' => __( 'Social', 'newkarma-core' ),
				),
				array(
					'id'    => 'newkar_other',
					'title' => __( 'Other', 'newkarma-core' ),
				),
				array(
					'id'    => 'newkar_amp',
					'title' => __( 'AMP (New)', 'newkarma-core' ),
				),
			);
			return $sections;
		}

		/**
		 * Returns all the settings fields
		 *
		 * @return array settings fields
		 */
		public function get_settings_fields() {
			$settings_fields = array(
				'newkar_relpost'     => array(
					array(
						'name'    => 'enable_relpost',
						'label'   => __( 'Enable first related post', 'newkarma-core' ),
						'desc'    => __( 'Check this if you want enable related post in single after post.', 'newkarma-core' ),
						'type'    => 'checkbox',
						'default' => 'on',
					),
					array(
						'name'    => 'relpost_text',
						'label'   => __( 'Title Text', 'newkarma-core' ),
						'desc'    => __( 'Enter your title text for this related posts.', 'newkarma-core' ),
						'type'    => 'text',
						'default' => __( 'Related Posts', 'newkarma-core' ),
					),
					array(
						'name'              => 'relpost_number',
						'label'             => __( 'Number post', 'salespro-core' ),
						'desc'              => __( 'How much number post want to display on related post.', 'salespro-core' ),
						'type'              => 'number',
						'default'           => '8',
						'sanitize_callback' => 'intval',
					),
					array(
						'name'    => 'relpost_taxonomy',
						'label'   => __( 'Taxonomy', 'newkarma-core' ),
						'desc'    => __( 'Choice related post by topics, tags or category', 'newkarma-core' ),
						'type'    => 'radio',
						'options' => array(
							'tags'     => 'Tags',
							'topics'   => 'Topics',
							'category' => 'Category',
						),
						'default' => 'tags',
					),
					array(
						'name'    => 'enable_relpost_2',
						'label'   => __( 'Enable second related post', 'newkarma-core' ),
						'desc'    => __( 'Check this if you want enable related post in single after box post and before comments.', 'newkarma-core' ),
						'type'    => 'checkbox',
						'default' => 'on',
					),
					array(
						'name'    => 'relpost_text_2',
						'label'   => __( 'Title Text', 'newkarma-core' ),
						'desc'    => __( 'Enter your title text for this related posts.', 'newkarma-core' ),
						'type'    => 'text',
						'default' => __( 'Don\'t Miss', 'newkarma-core' ),
					),
					array(
						'name'              => 'relpost_number_2',
						'label'             => __( 'Number post', 'salespro-core' ),
						'desc'              => __( 'How much number post want to display on related post.', 'salespro-core' ),
						'type'              => 'number',
						'default'           => '6',
						'sanitize_callback' => 'intval',
					),
					array(
						'name'    => 'relpost_taxonomy_2',
						'label'   => __( 'Taxonomy', 'newkarma-core' ),
						'desc'    => __( 'Choice related post by topics, tags or category', 'newkarma-core' ),
						'type'    => 'radio',
						'options' => array(
							'tags'     => 'Tags',
							'topics'   => 'Topics',
							'category' => 'Category',
						),
						'default' => 'category',
					),

					array(
						'name'    => 'enable_relpost_3',
						'label'   => __( 'Enable infinite scroll related post', 'newkarma-core' ),
						'desc'    => __( 'Check this if you want enable infinite scroll related post in single after comments.', 'newkarma-core' ),
						'type'    => 'checkbox',
						'default' => 'on',
					),
					array(
						'name'    => 'relpost_text_3',
						'label'   => __( 'Title Text', 'newkarma-core' ),
						'desc'    => __( 'Enter your title text for this related posts.', 'newkarma-core' ),
						'type'    => 'text',
						'default' => __( 'News Feed', 'newkarma-core' ),
					),
					array(
						'name'              => 'relpost_number_3',
						'label'             => __( 'Number post', 'salespro-core' ),
						'desc'              => __( 'How much number post want to display on related post.', 'salespro-core' ),
						'type'              => 'number',
						'default'           => '6',
						'sanitize_callback' => 'intval',
					),
					array(
						'name'    => 'relpost_taxonomy_3',
						'label'   => __( 'Taxonomy', 'newkarma-core' ),
						'desc'    => __( 'Choice related post by topics, tags or category', 'newkarma-core' ),
						'type'    => 'radio',
						'options' => array(
							'tags'     => 'Tags',
							'topics'   => 'Topics',
							'category' => 'Category',
						),
						'default' => 'category',
					),
				),

				'newkar_breadcrumbs' => array(
					array(
						'name'    => 'enable_breadcrumbs',
						'label'   => __( 'Enable breadcrumbs', 'newkarma-core' ),
						'desc'    => __( 'Check this if you want enable breadcrumbs.', 'newkarma-core' ),
						'type'    => 'checkbox',
						'default' => 'on',
					),
					array(
						'name'    => 'breadcrumbs_hometext',
						'label'   => __( 'Homepage Text', 'salespro-core' ),
						'desc'    => '',
						'type'    => 'text',
						'default' => 'Homepage',
					),
					array(
						'name'    => 'breadcrumbs_blogtext',
						'label'   => __( 'Blog Text', 'salespro-core' ),
						'desc'    => __( 'Display only if you using blog page.', 'newkarma-core' ),
						'type'    => 'text',
						'default' => 'Blog',
					),
					array(
						'name'    => 'breadcrumbs_errortext',
						'label'   => __( '404 Error Text', 'salespro-core' ),
						'desc'    => '',
						'type'    => 'text',
						'default' => '404 Not found',
					),
					array(
						'name'  => '',
						'label' => __( 'Note', 'newkarma-core' ),
						'desc'  => __( 'This breadcrumbs support breadcrumb navxt or yoast breadcrumb too. If you want change this breadcrumb with that plugin, just install plugin breadcrumb navxt or wordpress SEO by seo. Display using <strong>do_action( \'newkarma_core_view_breadcrumbs\' );</strong>', 'newkarma-core' ),
						'type'  => 'html',
					),
				),

				'newkar_ads'         => array(
					array(
						'name'  => 'ads_topbanner',
						'label' => __( 'Top Banner', 'newkarma-core' ),
						'desc'  => __( 'Display ads on top after top navigation.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'ads_topbanner_aftermenu',
						'label' => __( 'Top Banner After Menu', 'newkarma-core' ),
						'desc'  => __( 'Display ads after menu. You can add adsense or manual banner.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'ads_after_betweenpost',
						'label' => __( 'Banner Between Post', 'newkarma-core' ),
						'desc'  => __( 'Display ads between post in index and archive page. You can add adsense or manual banner.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'ads_after_betweenpost_position',
						'label'   => '',
						'desc'    => __( 'Position', 'newkarma-core' ),
						'type'    => 'select',
						'default' => '1',
						'options' => array(
							'1' => __( 'After First Post', 'newkarma-core' ),
							'2' => __( 'After Second Post', 'newkarma-core' ),
							'3' => __( 'After Third Post', 'newkarma-core' ),
							'4' => __( 'After Fourth Post', 'newkarma-core' ),
						),
					),
					array(
						'name'  => 'ads_before_content',
						'label' => __( 'Before Single Content', 'newkarma-core' ),
						'desc'  => __( 'Display ads before single content. You can add adsense or manual banner.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'ads_before_content_position',
						'label'   => '',
						'desc'    => __( 'Position', 'newkarma-core' ),
						'type'    => 'select',
						'default' => 'default',
						'options' => array(
							'default' => 'Default',
							'left'    => 'Float left',
							'right'   => 'Float right',
							'center'  => 'Center',
						),
					),
					array(
						'name'  => 'ads_after_content',
						'label' => __( 'After Single Content', 'newkarma-core' ),
						'desc'  => __( 'Display ads after single content. You can add adsense or manual banner.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'ads_after_content_position',
						'label'   => '',
						'desc'    => __( 'Alignment', 'newkarma-core' ),
						'type'    => 'select',
						'default' => 'default',
						'options' => array(
							'default' => 'Default',
							'right'   => 'Right',
							'center'  => 'Center',
						),
					),
					array(
						'name'  => 'ads_inside_content',
						'label' => __( 'Inside Single Content', 'newkarma-core' ),
						'desc'  => __( 'Display ads inside paragraph single content. You can add adsense or manual banner. Ads will not display if you have less than three paragraph in your post.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'ads_inside_content_position',
						'label'   => '',
						'desc'    => __( 'Alignment', 'newkarma-core' ),
						'type'    => 'select',
						'default' => 'default',
						'options' => array(
							'default' => 'Default',
							'right'   => 'Right',
							'center'  => 'Center',
						),
					),
					array(
						'name'  => 'ads_before_content_attachment',
						'label' => __( 'Before Attachment Content', 'newkarma-core' ),
						'desc'  => __( 'Display ads before attachment content. You can add adsense or manual banner.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'ads_before_content_attachment_position',
						'label'   => '',
						'desc'    => __( 'Position', 'newkarma-core' ),
						'type'    => 'select',
						'default' => 'default',
						'options' => array(
							'default' => 'Default',
							'left'    => 'Float left',
							'right'   => 'Float right',
							'center'  => 'Center',
						),
					),
					array(
						'name'  => 'ads_after_content_attachment',
						'label' => __( 'After Attachment Content', 'newkarma-core' ),
						'desc'  => __( 'Display ads after attachment content. You can add adsense or manual banner.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'ads_after_content_attachment_position',
						'label'   => '',
						'desc'    => __( 'Alignment', 'newkarma-core' ),
						'type'    => 'select',
						'default' => 'default',
						'options' => array(
							'default' => 'Default',
							'right'   => 'Right',
							'center'  => 'Center',
						),
					),
					array(
						'name'  => 'ads_floatbanner_left',
						'label' => __( 'Floating Banner Left', 'newkarma-core' ),
						'desc'  => __( 'Display floating banner in left side. You can add adsense or manual banner. Display only on desktop.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'ads_floatbanner_right',
						'label' => __( 'Floating Banner Right', 'newkarma-core' ),
						'desc'  => __( 'Display floating banner in right side. You can add adsense or manual banner. Display only on desktop.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'ads_floatbanner_footer',
						'label' => __( 'Floating Banner Footer', 'newkarma-core' ),
						'desc'  => __( 'Display floating banner in footer. You can add adsense or manual banner. Display only on desktop.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'ads_before_dontmiss',
						'label' => __( 'Banner before second related posts', 'newkarma-core' ),
						'desc'  => __( 'Display banner in single before second related posts. You can add adsense or manual banner.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => '',
						'label' => __( 'Note', 'newkarma-core' ),
						'desc'  => __( 'Some ad place maybe conflict with Term of Use ad provider like adsense. Please read TOS first before you insert the ads. Adsense TOS: https://www.google.com/adsense/policies. All field above support shortcode too.<br /> For anti adblock, will give overlay notification, effect will cause a drop visitors in your website.', 'newkarma-core' ),
						'type'  => 'html',
					),
				),

				'newkar_social'      => array(
					array(
						'name'    => 'social_app_id_facebook',
						'label'   => __( 'Facebook App ID', 'newkarma-core' ),
						'desc'    => __( 'Enter your facebook App ID here, some function require app ID, better if you fill your own, or you can using default app ID from plugin.', 'newkarma-core' ),
						'type'    => 'text',
						'default' => '1703072823350490',
					),
					array(
						'name'    => 'enable_fb_comment',
						'label'   => __( 'Enable Facebook Comment', 'newkarma-core' ),
						'desc'    => __( 'Check this Facebook Comment, if you check this default comment will replace with Facebook Comment.', 'newkarma-core' ),
						'type'    => 'checkbox',
						'default' => 'off',
					),
					array(
						'name'  => '',
						'label' => __( 'Note', 'newkarma-core' ),
						'desc'  => __( 'This social support jetpack too. If you want change this share post with jetpack, just install jetpack and activated module Sharedaddy For Jetpack, sharedaddy will automatically replace default social share. Display using <strong>add_filter( \'the_content\', \'newkarma_core_add_share_the_content\', 30 );</strong>. If you activated opengraph, opengraph from jetpack will disappear. So if you want using jetpack open graph, you can disable this opengraph. If you using another opengraph plugin, please disable opengraph. Do not using opengraph plugin more then one. Opengraph display using <strong>add_action( \'wp_head\', \'newkarma_opengraph_meta_tags\', 1 );</strong>', 'newkarma-core' ),
						'type'  => 'html',
					),
				),

				'newkar_other'       => array(
					array(
						'name'  => 'other_fbpixel_id',
						'label' => __( 'Facebook Pixel ID', 'newkarma-core' ),
						'desc'  => __( 'If you want adding Facebook Conversion Pixel code to WordPress sites, enter your facebook pixel ID here or you can add complate code via Head Script.', 'newkarma-core' ),
						'type'  => 'text',
					),
					array(
						'name'  => 'other_analytics_code',
						'label' => __( 'Google Analytics Code', 'newkarma-core' ),
						'desc'  => __( 'Enter your Google Analytics code (Ex: UA-XXXXX-X) or you can add complate code via Footer Script.', 'newkarma-core' ),
						'type'  => 'text',
					),
					array(
						'name'  => 'other_head_script',
						'label' => __( 'Head script', 'newkarma-core' ),
						'desc'  => __( 'These scripts will be printed in the <code>&lt;head&gt;</code> section.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'other_footer_script',
						'label' => __( 'Footer script', 'newkarma-core' ),
						'desc'  => __( 'These scripts will be printed above the <code>&lt;/body&gt;</code> tag.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'other_remove_data_when_uninstall',
						'label'   => __( 'Remove data uninstaller', 'newkarma-core' ),
						'desc'    => __( 'Check this if you want remove data from database when plugin is uninstall.', 'newkarma-core' ),
						'type'    => 'checkbox',
						'default' => 'off',
					),
				),

				'newkar_amp'         => array(
					array(
						'name'  => 'amp_head_script',
						'label' => __( 'AMP Head Script.', 'newkarma-core' ),
						'desc'  => __( 'You can insert amp page level adsense here or other amp script. Learn more here: https://amp.dev/documentation/components/amp-ad/. These scripts will be printed in the <code>&lt;head&gt;</code> section.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'amp_ads_topbanner_aftermenu',
						'label' => __( 'Top Banner After Menu (AMP page)', 'newkarma-core' ),
						'desc'  => __( 'Display amp ads after menu. Learn more here: https://amp.dev/documentation/components/amp-ad/.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'amp_ads_after_betweenpost',
						'label' => __( 'Banner Between Post (AMP page)', 'newkarma-core' ),
						'desc'  => __( 'Display amp ads between post in index and archive page. Learn more here: https://amp.dev/documentation/components/amp-ad/.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'    => 'amp_ads_after_betweenpost_position',
						'label'   => '',
						'desc'    => __( 'Position', 'newkarma-core' ),
						'type'    => 'select',
						'default' => '1',
						'options' => array(
							'1' => __( 'After First Post', 'newkarma-core' ),
							'2' => __( 'After Second Post', 'newkarma-core' ),
							'3' => __( 'After Third Post', 'newkarma-core' ),
							'4' => __( 'After Fourth Post', 'newkarma-core' ),
						),
					),
					array(
						'name'  => 'amp_ads_before_content',
						'label' => __( 'Before Single Content (AMP Page)', 'newkarma-core' ),
						'desc'  => __( 'Display amp ads before single content. Learn more here: https://amp.dev/documentation/components/amp-ad/.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'amp_ads_after_content',
						'label' => __( 'After Single Content (AMP Page)', 'newkarma-core' ),
						'desc'  => __( 'Display amp ads after single content. Learn more here: https://amp.dev/documentation/components/amp-ad/.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'amp_ads_inside_content',
						'label' => __( 'Inside Single Content (AMP Page)', 'newkarma-core' ),
						'desc'  => __( 'Display amp ads inside paragraph single content. Learn more here: https://amp.dev/documentation/components/amp-ad/. Ads will not display if you have less than three paragraph in your post.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'amp_ads_before_dontmiss',
						'label' => __( 'Banner before second related posts (AMP Page)', 'newkarma-core' ),
						'desc'  => __( 'Display banner in single before second related posts. Learn more here: https://amp.dev/documentation/components/amp-ad/.', 'newkarma-core' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => '',
						'label' => __( 'Note', 'newkarma-core' ),
						'desc'  => __( 'This options only effect in AMP page, for enable amp you must install recommended plugin AMP plugin https://wordpress.org/plugins/amp/', 'newkarma-core' ),
						'type'  => 'html',
					),
				),

			);

			return $settings_fields;
		}

		/**
		 * Plugin page.
		 */
		public function plugin_page() {
			echo '<div class="wrap">';

			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();

			echo '</div>';
		}

		/**
		 * Get all the pages
		 *
		 * @return array page names with key value pairs
		 */
		public function get_pages() {
			$pages         = get_pages();
			$pages_options = array();
			if ( $pages ) {
				foreach ( $pages as $page ) {
					$pages_options[ $page->ID ] = $page->post_title;
				}
			}

			return $pages_options;
		}

	}

endif;

new Newkarma_Core_Settings_API();
