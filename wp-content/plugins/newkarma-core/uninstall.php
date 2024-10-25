<?php
/**
 * Uninstall NEWKARMA Core plugin and delete all options from database
 *
 * @package Newkarma Core
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$newkar_other = get_option( 'newkar_other' );

if ( isset( $newkar_other['other_remove_data_when_uninstall'] ) && '' !== $newkar_other['other_remove_data_when_uninstall'] ) {
	// option, section, default.
	$option = $newkar_other['other_remove_data_when_uninstall'];
} else {
	$option = 'off';
}

if ( 'on' === $option ) {
	// Delete option from database.
	delete_option( 'newkar_autbox' );
	delete_option( 'newkar_relpost' );
	delete_option( 'newkar_breadcrumbs' );
	delete_option( 'newkar_ads' );
	delete_option( 'newkar_gallery' );
	delete_option( 'newkar_social' );
	delete_option( 'newkar_other' );
}
