<?php
/**
 * Widget API: Newkarma_Custom_form class
 *
 * Author: Gian MR - http://www.gianmr.com
 *
 * @package Newkarma Core
 * @subpackage Widgets
 * @since 1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add the Custom Subscribe Form widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class Newkarma_Custom_form extends WP_Widget {
	/**
	 * Sets up a Custom Form widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'newkarma-core-form', 'description' => __( 'Add simple custom subscribe form in your widget.','newkarma-core' ) );
		parent::__construct( 'newkarma-core-custom-sf', __( 'Custom Subscribe Form (Newkarma Core)','newkarma-core' ), $widget_ops );

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
	 * Outputs the content for Custom Subscribe Form.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for Custom Subscribe Form.
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
		// Custom Subscribe Action URL
		$newkar_action_url       	= empty( $instance['newkar_action_url'] ) ? '' : strip_tags( $instance['newkar_action_url'] );
		// Method Form
		$newkar_method_form       	= empty( $instance['newkar_method_form'] ) ? 'post' : strip_tags( $instance['newkar_method_form'] );
		// Activated name input
        $newkar_name_check          	= empty( $instance['newkar_name_check'] ) ? '0' : '1';
		// Activated Email input
        $newkar_email_check          = empty( $instance['newkar_email_check'] ) ? '0' : '1';
		// Hidden input
		$newkar_hidden_input       	= empty( $instance['newkar_hidden_input'] ) ? '' : $instance['newkar_hidden_input'];
		// Other input
		$newkar_other_input       	= empty( $instance['newkar_other_input'] ) ? '' : $instance['newkar_other_input'];
		// Force input 100%
        $newkar_force_100          	= empty( $instance['newkar_force_100'] ) ? '0' : '1';
		// Name placeholder
        $newkar_placeholder_name    	= empty( $instance['newkar_placeholder_name'] ) ? 'Enter Your Name' : strip_tags( $instance['newkar_placeholder_name'] );
		// Email placeholder
        $newkar_placeholder_email    = empty( $instance['newkar_placeholder_email'] ) ? 'Enter Your Email Address' : strip_tags( $instance['newkar_placeholder_email'] );
		// Button placeholder
        $newkar_placeholder_btn     	= empty( $instance['newkar_placeholder_btn'] ) ? 'Subscribe Now' : strip_tags( $instance['newkar_placeholder_btn'] );
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

			<div class="newkarma-form-widget<?php if ( $newkar_force_100 ) { echo ' force-100'; } ?>"<?php if ( $bgcolor ) { echo ' style="padding:10px;background-color:'.$bgcolor.'"'; } ?>>
				<?php if ( $newkar_introtext ) { ?>
					<p class="intro-text" style="color:<?php echo esc_attr( $color_text ); ?>;"><?php echo $newkar_introtext; ?></p>
				<?php } ?>
				<form class="newkarma-form-wrapper" id="<?php echo esc_attr( $newkar_widget_ID ); ?>" method="<?php echo esc_attr( $newkar_method_form ); ?>" name="<?php echo esc_attr( $newkar_widget_ID ); ?>" action="<?php echo esc_url( $newkar_action_url ); ?>">
					
					<?php if ( $newkar_name_check ) { ?>
						<input type="text" name="name" id="" class="newkarma-form-name" placeholder="<?php echo esc_attr( $newkar_placeholder_name ); ?>" value="" />
					<?php } ?>
					
					<?php if ( $newkar_email_check ) { ?>
						<input type="email" name="email" id="" class="newkarma-form-email" placeholder="<?php echo esc_attr( $newkar_placeholder_email ); ?>" />
					<?php } ?>
					
					<?php if ( $newkar_other_input ) {
						echo $newkar_other_input;
					} ?>
					
					<input type="submit" name="submit" style="border-color:<?php echo esc_attr( $bgcolor_button ); ?>;background-color:<?php echo esc_attr( $bgcolor_button ); ?>;color:<?php echo esc_attr( $color_button ); ?>;" value="<?php echo esc_attr( $newkar_placeholder_btn ); ?>" />
						
					<?php if ( $newkar_hidden_input ) {
						echo $newkar_hidden_input;
					} ?>	
						
				</form>				
				<?php if ( $newkar_spamtext ) { ?>
					<div class="spam-text" style="color:<?php echo esc_attr( $color_text ); ?>;"><?php echo $newkar_spamtext; ?></div>
				<?php } ?>	
			</div>
			
		<?php
		echo $args['after_widget'];
    }
	
	/**
	 * Handles updating settings for the current Custom form widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            Newkarma_Custom_form::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
    public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, 
			array( 
				'title' => '', 
				'newkar_action_url' => '', 
				'newkar_method_form' => 'post', 
				'newkar_name_check' => '0',
				'newkar_email_check' => '0',
				'newkar_hidden_input' => '',
				'newkar_other_input' => '',
				'newkar_force_100' => '0',
				'newkar_placeholder_name' => 'Enter Your Name',
				'newkar_placeholder_email' => 'Enter Your Email Address',
				'newkar_placeholder_btn' => 'Subscribe Now',
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
		// Action URL
        $instance['newkar_action_url']           		= strip_tags( $new_instance['newkar_action_url'] );
		// Method Form
        $instance['newkar_method_form']           		= strip_tags( $new_instance['newkar_method_form'] );
		// Activated name input
        $instance['newkar_name_check']          			= strip_tags( $new_instance['newkar_name_check'] ? '1' : '0' );
		// Activated email input
        $instance['newkar_email_check']          		= strip_tags( $new_instance['newkar_email_check'] ? '1' : '0' );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['newkar_hidden_input'] = $new_instance['newkar_hidden_input'];
			$instance['newkar_other_input'] = $new_instance['newkar_other_input'];
		} else {
			$instance['newkar_hidden_input'] = wp_kses_post( $new_instance['newkar_hidden_input'] );
			$instance['newkar_other_input'] = wp_kses_post( $new_instance['newkar_other_input'] );
		}
		// Force
        $instance['newkar_force_100']          			= strip_tags( $new_instance['newkar_force_100'] ? '1' : '0' );
		// Name placeholder
        $instance['newkar_placeholder_name']        		= strip_tags( $new_instance['newkar_placeholder_name'] );
		// Email placeholder
        $instance['newkar_placeholder_email']            = strip_tags( $new_instance['newkar_placeholder_email'] );
		// Button placeholder
        $instance['newkar_placeholder_btn']              = strip_tags( $new_instance['newkar_placeholder_btn'] );
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
	 * Outputs the settings form for the Custom form widget.
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
				'newkar_action_url' => '', 
				'newkar_method_form' => 'post', 
				'newkar_thx_link' => '',
				'newkar_name_check' => '0',
				'newkar_email_check' => '0',
				'newkar_hidden_input' => '',
				'newkar_other_input' => '',
				'newkar_force_100' => '1',
				'newkar_placeholder_name' => 'Enter Your Name',
				'newkar_placeholder_email' => 'Enter Your Email Address',
				'newkar_placeholder_btn' => 'Subscribe Now',
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
		// Action URL
        $newkar_action_url           	= strip_tags( $instance['newkar_action_url'] );
		// Method Form
        $newkar_method_form           	= strip_tags( $instance['newkar_method_form'] );
		// Activated name input
        $newkar_name_check          		= strip_tags( $instance['newkar_name_check'] ? '1' : '0' );
		// Activated email input
        $newkar_email_check          	= strip_tags( $instance['newkar_email_check'] ? '1' : '0' );
		// Force 100%
        $newkar_force_100          		= strip_tags( $instance['newkar_force_100'] ? '1' : '0' );
		// Name placeholder
        $newkar_placeholder_name        	= strip_tags( $instance['newkar_placeholder_name'] );
		// Email placeholder
        $newkar_placeholder_email       	= strip_tags( $instance['newkar_placeholder_email'] );
		// Button placeholder
        $newkar_placeholder_btn        	= strip_tags( $instance['newkar_placeholder_btn'] );
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
			<label for="<?php echo $this->get_field_id('newkar_action_url'); ?>"><?php _e( 'Action URL *(Required)','newkarma-core' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('newkar_action_url'); ?>" name="<?php echo $this->get_field_name('newkar_action_url'); ?>" type="text" value="<?php echo esc_attr($newkar_action_url); ?>" />
			<br />
            <small><?php _e( 'For example, you get form code with &lt;form action="http://example.com/subscribeform" method="post"&gt; just fill with http://example.com/subscribeform','newkarma-core' ); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newkar_method_form' ); ?>"><?php _e( 'Select Method:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'newkar_method_form' ); ?>" name="<?php echo $this->get_field_name( 'newkar_method_form' ); ?>">
				<option value="post"<?php selected( $instance['newkar_method_form'], 'post' ); ?>><?php _e( 'post','newkarma-core' ); ?></option>
				<option value="get"<?php selected( $instance['newkar_method_form'], 'get' ); ?>><?php _e( 'get','newkarma-core' ); ?></option>
			</select>
		</p>
		<p>
			<input class="checkbox" value="1" type="checkbox"<?php checked( $instance['newkar_name_check'], 1 ); ?> id="<?php echo $this->get_field_id('newkar_name_check'); ?>" name="<?php echo $this->get_field_name('newkar_name_check'); ?>" /> 
			<label for="<?php echo $this->get_field_id('newkar_name_check'); ?>"><?php _e( 'Enable Full Name Field','newkarma-core' ); ?></label>
		</p>
		<p>
			<input class="checkbox" value="1" type="checkbox"<?php checked( $instance['newkar_email_check'], 1 ); ?> id="<?php echo $this->get_field_id('newkar_email_check'); ?>" name="<?php echo $this->get_field_name('newkar_email_check'); ?>" /> 
			<label for="<?php echo $this->get_field_id('newkar_email_check'); ?>"><?php _e( 'Enable Email Field','newkarma-core' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newkar_hidden_input' ); ?>"><?php _e( 'Hidden Input:' ); ?></label>
			<textarea class="widefat" rows="6" id="<?php echo $this->get_field_id('newkar_hidden_input'); ?>" name="<?php echo $this->get_field_name('newkar_hidden_input'); ?>"><?php echo esc_textarea( $instance['newkar_hidden_input'] ); ?></textarea>
			<br />
            <small><?php _e( 'Fill with hidden field for example <br />&lt;input name="hidden_name1" type="hidden" value="hidden_value1" /&gt;
							<br />&lt;input name="hidden_name2" type="hidden" value="hidden_value2" /&gt;','newkarma-core' ); ?></small>		
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newkar_other_input' ); ?>"><?php _e( 'Other Input:' ); ?></label>
			<textarea class="widefat" rows="6" id="<?php echo $this->get_field_id('newkar_other_input'); ?>" name="<?php echo $this->get_field_name('newkar_other_input'); ?>"><?php echo esc_textarea( $instance['newkar_other_input'] ); ?></textarea>
			<br />
            <small><?php _e( 'Fill with other field if you need other input for your subscribe form. For example <br />&lt;input name="city" type="text" placeholder="Enter your city" value="" /&gt;
							<br />&lt;input name="age" type="text" placeholder="Enter your age" value="" /&gt;','newkarma-core' ); ?></small>		
		</p>
		<p>
			<input class="checkbox" value="1" type="checkbox"<?php checked( $instance['newkar_force_100'], 1 ); ?> id="<?php echo $this->get_field_id('newkar_force_100'); ?>" name="<?php echo $this->get_field_name('newkar_force_100'); ?>" /> 
			<label for="<?php echo $this->get_field_id('newkar_force_100'); ?>"><?php _e( 'Force Input 100%','newkarma-core' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('newkar_placeholder_name'); ?>"><?php _e( 'Placeholder For Name Field','newkarma-core' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('newkar_placeholder_name'); ?>" name="<?php echo $this->get_field_name('newkar_placeholder_name'); ?>" type="text" value="<?php echo esc_attr($newkar_placeholder_name); ?>" />
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
    register_widget( 'Newkarma_Custom_form' );
} );