<?php
/**
 * Widget API: Newkarma_Feedburner_form class
 *
 * Author: Gian MR - http://www.gianmr.com
 *
 * @package Newkarma Core
 * @subpackage Widgets
 * @since 1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add the Feedburner widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class Newkarma_Feedburner_form extends WP_Widget {
	/**
	 * Sets up a Feedburner widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'newkarma-core-form', 'description' => __( 'Add simple feedburner form in your widget.','newkarma-core' ) );
		parent::__construct( 'newkarma-core-feedburner', __( 'Feedburner Form (Newkarma Core)','newkarma-core' ), $widget_ops );

		// add action for admin_register_scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_register_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'admin_print_scripts' ), 9999 );
	}
	
	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0
	 *
	 * @param string $hook_suffix
	 */
	public function admin_register_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );
	}

	/**
	 * Print scripts.
	 *
	 * @since 1.0
	 */
	public function admin_print_scripts() {
		?>
		<script>
			( function( $ ){
				function initColorPicker( widget ) {
					widget.find( '.color-picker' ).wpColorPicker( {
						change: _.throttle( function() { // For Customizer
							$(this).trigger( 'change' );
						}, 3000 )
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}
	
	/**
	 * Outputs the content for Feedburner Form.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for Feedburner Form.
	 */
    public function widget($args, $instance) {
		
		// Title
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		// Base Id Widget
		$newkar_widget_ID = $this->id_base . '-' . $this->number;
		// Feedburner ID option
        $newkar_feed_id        	 	= empty( $instance['newkar_feed_id'] ) ? '' : strip_tags( $instance['newkar_feed_id'] );
		// Email placeholder
        $newkar_placeholder_email    = empty( $instance['newkar_placeholder_email'] ) ? 'Enter Your Email Address' : strip_tags( $instance['newkar_placeholder_email'] );
		// Button placeholder
        $newkar_placeholder_btn     	= empty( $instance['newkar_placeholder_btn'] ) ? 'Subscribe Now' : strip_tags( $instance['newkar_placeholder_btn'] );
		// Force input 100%
        $newkar_force_100          	= empty( $instance['newkar_force_100'] ) ? '0' : '1';
		// Intro text
        $newkar_introtext    		= empty( $instance['newkar_introtext'] ) ? '' : strip_tags( $instance['newkar_introtext'] );
		// Spam Text
        $newkar_spamtext    			= empty( $instance['newkar_spamtext'] ) ? '' : strip_tags( $instance['newkar_spamtext'] );
		// Style
		$bgcolor = ( ! empty( $instance['bgcolor'] ) ) ? strip_tags( $instance['bgcolor'] ) : '';
		$color_text = ( ! empty( $instance['color_text'] ) ) ? strip_tags( $instance['color_text'] ) : '#222';
		$color_button = ( ! empty( $instance['color_button'] ) ) ? strip_tags( $instance['color_button'] ) : '#fff';
		$bgcolor_button = ( ! empty( $instance['bgcolor_button'] ) ) ? strip_tags( $instance['bgcolor_button'] ) : '#1b3682';
		?>

			<div class="newkarma-core-form-widget<?php if ( $newkar_force_100 ) { echo ' force-100'; } ?>"<?php if ( $bgcolor ) { echo ' style="padding:10px;background-color:'.$bgcolor.'"'; } ?>>
				<?php if ( $newkar_introtext ) { ?>
					<p class="intro-text" style="color:<?php echo esc_attr( $color_text ); ?>;"><?php echo $newkar_introtext; ?></p>
				<?php } ?>
				<form class="newkarma-core-form-wrapper" id="<?php echo esc_attr( $newkar_widget_ID ); ?>" name="<?php echo esc_attr( $newkar_widget_ID ); ?>" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open( 'https://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( $newkar_feed_id ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					
					<input type="email" name="email" id="" class="newkarma-core-form-email" placeholder="<?php echo esc_attr( $newkar_placeholder_email ); ?>" />
					<input type="submit" name="submit" style="border-color:<?php echo esc_attr( $bgcolor_button ); ?>;background-color:<?php echo esc_attr( $bgcolor_button ); ?>;color:<?php echo esc_attr( $color_button ); ?>;" value="<?php echo esc_attr( $newkar_placeholder_btn ); ?>" />
					
					<input type="hidden" value="<?php echo esc_attr( $newkar_feed_id ); ?>" name="uri" />
					<input type="hidden" name="loc" value="en_US" />
					
				</form>
						
				<?php if ( $newkar_spamtext ) { ?>
					<div class="spam-text" style="color:<?php echo esc_attr( $color_text ); ?>;"><?php echo $newkar_spamtext; ?></div>
				<?php } ?>	
			</div>
			
		<?php
		echo $args['after_widget'];
    }
	
	/**
	 * Handles updating settings for the current Feedburner widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            Newkarma_Feedburner_form::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
    public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, 
			array( 
				'title' => '', 
				'newkar_feed_id' => '', 
				'newkar_placeholder_email' => 'Enter Your Email Address',
				'newkar_placeholder_btn' => 'Subscribe Now',
				'newkar_force_100' => '0',
				'newkar_introtext' => '',
				'newkar_spamtext' => '',
				'bgcolor' => '',
				'color_text' => '#222',
				'color_button' => '#fff',
				'bgcolor_button' => '#1b3682'
			) 
		);
		// Title
		$instance['title'] 								= sanitize_text_field( $new_instance['title'] );
		// Feed ID option
        $instance['newkar_feed_id']           			= strip_tags($new_instance['newkar_feed_id']);
		// Email placeholder
        $instance['newkar_placeholder_email']            = strip_tags($new_instance['newkar_placeholder_email']);
		// Button placeholder
        $instance['newkar_placeholder_btn']              = strip_tags($new_instance['newkar_placeholder_btn']);
		// Force
        $instance['newkar_force_100']          			= strip_tags( $new_instance['newkar_force_100'] ? '1' : '0' );
		// Intro Text
        $instance['newkar_introtext']             	 	= strip_tags( $new_instance['newkar_introtext'] );
		// Spam Text
        $instance['newkar_spamtext']             	 	= strip_tags( $new_instance['newkar_spamtext'] );
		// Style
		$instance['bgcolor']							= strip_tags( $new_instance['bgcolor'] );
		$instance['color_text']							= strip_tags( $new_instance['color_text'] );
		$instance['color_button']						= strip_tags( $new_instance['color_button'] );
		$instance['bgcolor_button']						= strip_tags( $new_instance['bgcolor_button'] );

        return $instance;
    }
	
	/**
	 * Outputs the settings form for the Feedburner widget.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, 
			array( 
				'title' => '', 
				'newkar_feed_id' => 'gianmr', 
				'newkar_placeholder_email' => 'Enter Your Email Address',
				'newkar_placeholder_btn' => 'Subscribe Now',
				'newkar_force_100' => '1',
				'newkar_introtext' => '',
				'newkar_spamtext' => '',
				'bgcolor' => '',
				'color_text' => '#222',
				'color_button' => '#fff',
				'bgcolor_button' => '#1b3682'
			) 
		);
		// Title
		$title 							= sanitize_text_field( $instance['title'] );
		// Feed ID option
        $newkar_feed_id           		= strip_tags( $instance['newkar_feed_id'] );
		// Email placeholder
        $newkar_placeholder_email       	= strip_tags( $instance['newkar_placeholder_email'] );
		// Button placeholder
        $newkar_placeholder_btn        	= strip_tags( $instance['newkar_placeholder_btn'] );
		// Force 100%
        $newkar_force_100          		= strip_tags( $instance['newkar_force_100'] ? '1' : '0' );
		// Intro text
        $newkar_introtext        		= strip_tags( $instance['newkar_introtext'] );
		// Spam text
        $newkar_spamtext        			= strip_tags( $instance['newkar_spamtext'] );
		// Style
		$bgcolor						= strip_tags( $instance['bgcolor'] );
		$color_text						= strip_tags( $instance['color_text'] );
		$color_button					= strip_tags( $instance['color_button'] );
		$bgcolor_button					= strip_tags( $instance['bgcolor_button'] );
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:','newkarma-core' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('newkar_feed_id'); ?>"><?php _e( 'Feedburner ID *(Required)','newkarma-core' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('newkar_feed_id'); ?>" name="<?php echo $this->get_field_name('newkar_feed_id'); ?>" type="text" value="<?php echo esc_attr($newkar_feed_id); ?>" />
			<br />
            <small><?php _e( 'Example: gianmr for https://feeds.feedburner.com/gianmr feed address.','newkarma-core' ); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('newkar_placeholder_email'); ?>"><?php _e( 'Placeholder For Email Address Field','newkarma-core' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('newkar_placeholder_email'); ?>" name="<?php echo $this->get_field_name('newkar_placeholder_email'); ?>" type="text" value="<?php echo esc_attr($newkar_placeholder_email); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('newkar_placeholder_btn'); ?>"><?php _e( 'Submit Button Text','newkarma-core' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('newkar_placeholder_btn'); ?>" name="<?php echo $this->get_field_name('newkar_placeholder_btn'); ?>" type="text" value="<?php echo esc_attr($newkar_placeholder_btn); ?>" />
		</p>
		<p>
			<input class="checkbox" value="1" type="checkbox"<?php checked( $instance['newkar_force_100'], 1 ); ?> id="<?php echo $this->get_field_id('newkar_force_100'); ?>" name="<?php echo $this->get_field_name('newkar_force_100'); ?>" /> 
			<label for="<?php echo $this->get_field_id('newkar_force_100'); ?>"><?php _e( 'Force Input 100%','newkarma-core' ); ?></label>
		</p>
			<label for="<?php echo $this->get_field_id( 'newkar_introtext' ); ?>"><?php _e( 'Intro Text:' ); ?></label>
			<textarea class="widefat" rows="6" id="<?php echo $this->get_field_id('newkar_introtext'); ?>" name="<?php echo $this->get_field_name('newkar_introtext'); ?>"><?php echo esc_textarea( $instance['newkar_introtext'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newkar_spamtext' ); ?>"><?php _e( 'Spam Text:' ); ?></label>
			<textarea class="widefat" rows="6" id="<?php echo $this->get_field_id('newkar_spamtext'); ?>" name="<?php echo $this->get_field_name('newkar_spamtext'); ?>"><?php echo esc_textarea( $instance['newkar_spamtext'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('bgcolor'); ?>"><?php _e( 'Background Color','newkarma-core' ); ?></label><br /> 
			<input class="widefat color-picker" id="<?php echo $this->get_field_id('bgcolor'); ?>" name="<?php echo $this->get_field_name('bgcolor'); ?>" type="text" value="<?php echo esc_attr($bgcolor); ?>" data-default-color="" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color_text'); ?>"><?php _e( 'Text Color','newkarma-core' ); ?></label><br /> 
			<input class="widefat color-picker" id="<?php echo $this->get_field_id('color_text'); ?>" name="<?php echo $this->get_field_name('color_text'); ?>" type="text" value="<?php echo esc_attr($color_text); ?>" data-default-color="#222" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color_button'); ?>"><?php _e( 'Button Text Color','newkarma-core' ); ?></label><br /> 
			<input class="widefat color-picker" id="<?php echo $this->get_field_id('color_button'); ?>" name="<?php echo $this->get_field_name('color_button'); ?>" type="text" value="<?php echo esc_attr($color_button); ?>" data-default-color="#fff" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('bgcolor_button'); ?>"><?php _e( 'Button Background Color','newkarma-core' ); ?></label><br /> 
			<input class="widefat color-picker" id="<?php echo $this->get_field_id('bgcolor_button'); ?>" name="<?php echo $this->get_field_name('bgcolor_button'); ?>" type="text" value="<?php echo esc_attr($bgcolor_button); ?>" data-default-color="#1b3682" />
		</p>
		
		<?php
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'Newkarma_Feedburner_form' );
} );