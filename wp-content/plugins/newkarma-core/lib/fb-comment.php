<?php
/**
 * FB comments template file.
 * This replaces the theme's comment template when fb comments are enable
 *
 * @since 1.0.0
 * @package Newkarma Core
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$newkar_social = get_option( 'newkar_social' );

if ( isset( $newkar_social['social_app_id_facebook'] ) && ! empty( $newkar_social['social_app_id_facebook'] ) ) {
	// option, section, default.
	$appid = $newkar_social['social_app_id_facebook'];
} else {
	$appid = '1703072823350490';
}
?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/<?php bloginfo( 'language' ); ?>/sdk.js#xfbml=1&version=v9.0&appId=<?php echo esc_attr( $appid ); ?>&autoLogAppEvents=1" nonce="4G7nS4tr"></script>
<div id="comment-wrap" class="gmr-box-content-single site-main clearfix">
<h3 class="widget-title"><span><?php esc_html_e( 'Comment', 'newkarma' ); ?></span></h3>
	<div id="comments" class="newkarma-core-fb-comments">
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-lazy="true" data-numposts="5" data-width="100%"></div>
	</div>
</div>
