<?php
/**
 * Add Simple Metaboxes Settings
 *
 * Author: Gian MR - http://www.gianmr.com
 *
 * @since 1.0.0
 * @package Newkarma Core
 */

/**
 * Register a meta box using a class.
 *
 * @since 1.0.0
 */
class Newkarma_Core_Metabox_Settings {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_footer', array( $this, 'newkarma_core_admin_enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'newkarma_core_admin_enqueue_style' ) );
		add_action( 'load-post.php', array( $this, 'post_metabox_setup' ) );
		add_action( 'load-post-new.php', array( $this, 'post_metabox_setup' ) );
	}

	/**
	 * Metabox setup function
	 */
	public function post_metabox_setup() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ), 10, 2 );
	}

	/**
	 * Register the JavaScript.
	 */
	public function newkarma_core_admin_enqueue_scripts() {
		global $post_type;
		if ( 'post' === $post_type ) {
			?>
			<script type="text/javascript">
				(function( $ ) {
					'use strict';

					/**
					 * From this point every thing related to metabox
					 */
					$('document').ready(function(){

						$('h3.nav-tab-wrapper span:first').addClass('current');
						$('.tab-content:first').addClass('current');
						$('h3.nav-tab-wrapper span').click(function(){
							var t = $(this).attr('id');

							$('h3.nav-tab-wrapper span').removeClass('current');
							$('.tab-content').removeClass('current');

							$(this).addClass('current');
							$('#'+ t + 'C').addClass('current');
						});

						// First tab inner
						$('ul.nav-tab-wrapper li:first').addClass('current');
						$('.tab-content-inner:first').addClass('current');
						$('ul.nav-tab-wrapper li').click(function(){
							var t = $(this).attr('id');

							$('ul.nav-tab-wrapper li').removeClass('current');
							$('.tab-content-inner').removeClass('current');

							$(this).addClass('current');
							$('#'+ t + 'C').addClass('current');
						});
					});
				})( jQuery );
			</script>
			<?php
		}
	}

	/**
	 * Register Script.
	 */
	public function newkarma_core_admin_enqueue_style() {
		global $post_type;
		if ( 'post' === $post_type ) {
			?>
			<style type="text/css">
			body.post-new-php #titlediv #title-prompt-text {display: none !important;}
			ul.nav-tab-wrapper {display:block;width: 100%;}
			ul.nav-tab-wrapper li{background: none;color: #0073aa;padding: 3px 5px;display: inline-block;cursor: pointer;margin-right:3px;}
			h3.nav-tab-wrapper span{background: none;color: #0073aa;display: inline-block;padding: 10px 15px;cursor: pointer;}
			ul.nav-tab-wrapper li.current,
			h3.nav-tab-wrapper span.current{background: #ededed;color: #222;cursor: default;}
			.tab-content-inner,
			.tab-content{display: none;}
			.tab-content-inner.current,
			.tab-content.current{display: inherit;padding-top: 20px;}
			.newkarma-core-metabox-common-fields p {margin-bottom: 20px;}
			.newkarma-core-metabox-common-fields input.display-block,
			.newkarma-core-metabox-common-fields textarea.display-block{display:block;width:100%;}
			.newkarma-core-metabox-common-fields input[type="button"].display-block {margin-top:10px;}
			.newkarma-core-metabox-common-fields label {display: block;margin-bottom: 5px;}
			.newkarma-core-metabox-common-fields input[disabled] {background: #ddd;}
			.newkarma-core-metabox-common-fields .nav-tab-active,
			.newkarma-core-metabox-common-fields .nav-tab-active:focus,
			.newkarma-core-metabox-common-fields .nav-tab-active:focus:active,
			.newkarma-core-metabox-common-fields .nav-tab-active:hover {border-bottom: 1px solid #ffffff !important;background: #ffffff !important;color: #000;}
			</style>
			<?php
		}
	}

	/**
	 * Adds the meta box.
	 *
	 * @param string $post_type Post type.
	 */
	public function add_meta_box( $post_type ) {
		$post_types = array( 'post' );
		if ( in_array( $post_type, $post_types, true ) ) {
			add_meta_box(
				'newkarma_core_video_meta_metabox',
				__( 'Post Settings', 'newkarma-core' ),
				array( $this, 'metabox_callback' ),
				$post_type,
				'advanced',
				'default'
			);
		}
	}

	/**
	 * Save the meta box.
	 *
	 * @param int $post_id Post ID.
	 * @param int $post Post ID.
	 *
	 * @return int $post_id
	 */
	public function save( $post_id, $post ) {
		/* Verify the nonce before proceeding. */
		if ( ! isset( $_POST['newkarma_core_video_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['newkarma_core_video_meta_nonce'] ) ), basename( __FILE__ ) ) ) {
			return $post_id;
		}
		/* Get the post type object. */
		$post_type = get_post_type_object( $post->post_type );

		/* Check if the current user has permission to edit the post. */
		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		/* List of meta box fields (name => meta_key) */
		$fields = array(
			'source-value'               => 'MAJPRO_Source',
			'writer-value'               => 'MAJPRO_Writer',
			'editor-value'               => 'MAJPRO_Editor',
			'newkarma-core-eombed-value' => 'MAJPRO_Oembed',
			'newkarma-core-iframe-value' => 'MAJPRO_Iframe',
		);

		foreach ( $fields as $name => $meta_key ) {
			/* Check if meta box fields has a proper value */
			if ( isset( $_POST[ $name ] ) && 'N/A' !== $_POST[ $name ] ) {
				$new_meta_value = sanitize_text_field( wp_unslash( $_POST[ $name ] ) );
			} else {
				$new_meta_value = '';
			}

			/* Get the meta value of the custom field key */
			$meta_value = get_post_meta( $post_id, $meta_key, true );

			if ( ! empty( $new_meta_value ) ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			} else {
				/*
				 * Do you really expect to have multiple meta keys named exactly the same ('city_id')?
				 * If you don't, you can skip the third parameter from 'delete_post_meta'.
				 */

				delete_post_meta( $post_id, $meta_key );
			}
		}
		
		// Sanitize the user input using boolean.
		$durh         = isset( $_POST['durh_field'] ) ? absint( $_POST['durh_field'] ) : '';
		$durm         = isset( $_POST['durm_field'] ) ? absint( $_POST['durm_field'] ) : '';
		$durs         = isset( $_POST['durs_field'] ) ? absint( $_POST['durs_field'] ) : '';

		// Update the meta field.
		update_post_meta( $post_id, '_durh', $durh );
		update_post_meta( $post_id, '_durm', $durm );
		update_post_meta( $post_id, '_durs', $durs );
	}

	/**
	 * Meta box html view
	 *
	 * @param array  $object Object Post Type.
	 * @param string $box returning string.
	 */
	public function metabox_callback( $object, $box ) {
		global $post;
		// Add an nonce field so we can check for it later.
		wp_nonce_field( basename( __FILE__ ), 'newkarma_core_video_meta_nonce' );

		$saved_durh  = get_post_meta( $post->ID, '_durh', true );
		$saved_durm  = get_post_meta( $post->ID, '_durm', true );
		$saved_durs  = get_post_meta( $post->ID, '_durs', true );
		
		$hm         = md5( newkarma_core_get_home() );
		$license    = trim( get_option( 'newkarma_core_license_key' . $hm ) );
		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['basedir'] ) ) {
			$upldir = $upload_dir['basedir'] . '/' . $hm;

			if ( @file_exists( $upldir ) ) {
				$fl = $upload_dir['basedir'] . '/' . $hm . '/' . $license . '.json';
				if ( @file_exists( $fl ) ) {
				?>
				<div id="col-container">
					<div class="metabox-holder newkarma-core-metabox-common-fields">

						<h3 class="nav-tab-wrapper">
							<span class="nav-tab tab-link" id="tab-1"><?php esc_attr_e( 'Post Settings:', 'newkarma-core' ); ?></span>
							<span class="nav-tab tab-link" id="tab-2"><?php esc_attr_e( 'Video Settings:', 'newkarma-core' ); ?></span>
						</h3>
						<div id="tab-1C" class="group tab-content">
							<p>
								<label for="opsi-source"><strong><?php esc_html_e( 'Source URL:', 'newkarma-core' ); ?></strong></label>
								<input type="url" class="regular-text display-block" id="opsi-source" placeholder="http://" name="source-value" value="<?php echo esc_attr( get_post_meta( $object->ID, 'MAJPRO_Source', true ) ); ?>" />
								<span class="howto"><?php esc_html_e( 'Please insert post source URL.', 'newkarma-core' ); ?></span>
							</p>
							<p>
								<label for="opsi-writer"><strong><?php esc_html_e( 'News Writer:', 'newkarma-core' ); ?></strong></label>
								<input type="text" class="regular-text display-block" id="opsi-writer" placeholder="Writer" name="writer-value" value="<?php echo esc_attr( get_post_meta( $object->ID, 'MAJPRO_Writer', true ) ); ?>" />
								<span class="howto"><?php esc_html_e( 'Please insert name of news writer.', 'newkarma-core' ); ?></span>
							</p>
							<p>
								<label for="opsi-editor"><strong><?php esc_html_e( 'News Editor:', 'newkarma-core' ); ?></strong></label>
								<input type="text" class="regular-text display-block" id="opsi-editor" placeholder="Editor" name="editor-value" value="<?php echo esc_attr( get_post_meta( $object->ID, 'MAJPRO_Editor', true ) ); ?>" />
								<span class="howto"><?php esc_html_e( 'Please insert name of news editor.', 'newkarma-core' ); ?></span>
							</p>
						</div>
						<div id="tab-2C" class="group tab-content">
							<label for="opsi-duration"><strong><?php esc_html_e( 'Duration', 'newkarma-core' ); ?></strong></label>
							<table class="wp-list-table widefat striped table-view-list" width="100%">
								<thead>
									<tr>
										<th width="5%"><label for="durh_field"><?php esc_html_e( 'Hour', 'newkarma-core' ); ?></label></th>
										<th width="5%"><label for="durm_field"><?php esc_html_e( 'Minutes', 'newkarma-core' ); ?></label></th>
										<th width="5%"><label for="durs_field"><?php esc_html_e( 'Seconds', 'newkarma-core' ); ?></label></th>
										<th width="85%"></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<select name="durh_field" id="durh_field">
												<?php
												$numbs = range(0, 24);
												$select_options   = '';
												$default_options  = '<option value="" selected="selected">';
												$default_options .= esc_attr__( 'Hours', 'newkarma-core' );
												$default_options .= '</option>';
												foreach ( $numbs as $numb ) {
													$option          = '<option value="' . absint( $numb ) . '">';
													$option         .= absint( $numb );
													$option         .= '</option>';
													$select_options .= $option;
												}
												if ( ! empty( $saved_durh ) ) {
													$select_options = str_replace( 'value="' . absint( $saved_durh ) . '"', 'value="' . absint( $saved_durh ) . '" selected="selected"', $select_options );
												} else {
													$select_options = $default_options . $select_options;
												}
												echo $select_options;
												?>
											</select>
										</td>
										<td>
											<select name="durm_field" id="durm_field">
												<?php
												$numbs = range(0, 60);
												$select_options   = '';
												$default_options  = '<option value="" selected="selected">';
												$default_options .= esc_attr__( 'Minutes', 'newkarma-core' );
												$default_options .= '</option>';
												foreach ( $numbs as $numb ) {
													$option         = '<option value="' . absint( $numb ) . '">';
													$option         .= absint( $numb );
													$option         .= '</option>';
													$select_options .= $option;
												}
												if ( ! empty( $saved_durm ) ) {
													$select_options = str_replace( 'value="' . absint( $saved_durm ) . '"', 'value="' . absint( $saved_durm ) . '" selected="selected"', $select_options );
												} else {
													$select_options = $default_options . $select_options;
												}
												echo $select_options;
												?>
											</select>
										</td>
										<td>
											<select name="durs_field" id="durs_field">
												<?php
												$numbs = range(0, 60);
												$select_options   = '';
												$default_options  = '<option value="" selected="selected">';
												$default_options .= esc_attr__( 'Seconds', 'newkarma-core' );
												$default_options .= '</option>';
												foreach ( $numbs as $numb ) {
													$option          = '<option value="' . absint( $numb ) . '">';
													$option         .= absint( $numb );
													$option         .= '</option>';
													$select_options .= $option;
												}
												if ( ! empty( $saved_durs ) ) {
													$select_options = str_replace( 'value="' . absint( $saved_durs ) . '"', 'value="' . absint( $saved_durs ) . '" selected="selected"', $select_options );
												} else {
													$select_options = $default_options . $select_options;
												}
												echo $select_options;
												?>
											</select>
										</td>
										<td></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4">
											<span class="howto"><?php esc_html_e( 'Please insert video duration', 'newkarma-core' ); ?></span>
										</th>
									</tr>
								</tfoot>

							</table>

							<!-- Start Video Settings -->
							<br /><br />
							<ul class="subsubsub nav-tab-wrapper">
								<li class="nav-tab tab-link" id="tabserver-1"><?php esc_attr_e( 'Oembed', 'newkarma-core' ); ?></li>
								<li class="nav-tab tab-link" id="tabserver-2"><?php esc_attr_e( 'Iframe', 'newkarma-core' ); ?></li>
							</ul>
							<div class="clear"></div>
							<p id="tabserver-1C" class="innergroup tab-content-inner">
								<label for="opsi-player1"><strong><?php esc_attr_e( 'Oembed URL:', 'newkarma-core' ); ?></strong></label>
								<input type="url" class="regular-text display-block" id="opsi-player1" placeholder="http://" name="newkarma-core-eombed-value" value="<?php echo esc_attr( get_post_meta( $object->ID, 'MAJPRO_Oembed', true ) ); ?>" />
								<span class="howto"><?php esc_attr_e( 'Please insert full URL from youtube, vimeo or other oembed service, please see https://codex.wordpress.org/Embeds for information.', 'newkarma-core' ); ?></span>
							</p>
							<p id="tabserver-2C" class="innergroup tab-content-inner">
								<label for="opsi-player2"><strong><?php esc_attr_e( 'Iframe Code:', 'newkarma-core' ); ?></strong></label>
								<textarea name="newkarma-core-iframe-value" id="opsi-player2" rows="4" cols="55" class="regular-text display-block"><?php echo esc_attr( get_post_meta( $object->ID, 'MAJPRO_Iframe', true ) ); ?></textarea>
								<span class="howto"><?php esc_attr_e( 'Please insert html iframe here, if you using oembed url, this will not display.', 'newkarma-core' ); ?></span>
							</p>
						</div>
					</div>
				</div>
					<?php
				} else {
					?>
					<div id="col-container">
						<div class="metabox-holder newkarma-metabox-common-fields">
							<p>
								<?php echo __( '<a href="plugins.php?page=newkarma-license" style="font-weight: 700;">Please insert your own license key here</a>.<br /><br /> If you bought from kentooz, you can get license key in your memberarea. <a href="https://member.kentooz.com/softsale/license" target="_blank">https://member.kentooz.com/softsale/license</a>', 'newkarma-core' ); ?>
							</p>
						</div>
					</div>
					<?php
				}
			} else {
				?>
				<div id="col-container">
					<div class="metabox-holder newkarma-metabox-common-fields">
						<p>
							<?php echo __( '<a href="plugins.php?page=newkarma-license" style="font-weight: 700;">Please insert your own license key here</a>.<br /><br /> If you bought from kentooz, you can get license key in your memberarea. <a href="https://member.kentooz.com/softsale/license" target="_blank">https://member.kentooz.com/softsale/license</a>', 'newkarma-core' ); ?>
						</p>
					</div>
				</div>
				<?php
			}
		}
	}

}

// Load only if dashboard.
if ( is_admin() ) {
	new Newkarma_Core_Metabox_Settings();
}
