<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   wpms-marketing-suite
 * @author    Alex Manguera
 * @link      http://wpmarketingsuite.com
 * @copyright 2016 AlexManguera
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

global $wpdb;

delete_option('wpms_ab_settings');
delete_option('wpms-ab-options-pointer');
delete_option('wpms-ab-test');

delete_transient( 'wpms_experiment_status' );

$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpms_ab_experiments" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpms_ab_variations" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpms_ab_visits" );
// Geolocation
//$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}ms_custom_shortcode" );