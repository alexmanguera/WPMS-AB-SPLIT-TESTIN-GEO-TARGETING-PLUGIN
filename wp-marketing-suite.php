<?php
/**
 * @package   wpms-marketing-suite
 * @author    Alex Manguera
 * @link      <>
 * @copyright 2016 AlexManguera
 *
 * @wordpress-plugin
 * Plugin Name: WP Marketing Suite
 * Plugin URI:  <>
 * Description: Contains a suite of Marketing tools for split testing and geolocation targeting content.
 * Version:     0.1
 * Author:      Alex Manguera
 * Author URI:  <>
 * Text Domain: wpms-locale
 *
 * ------------------------------------------------------------------------
 * Copyright 2016 Wordpress Marketing Suite
 *
 **/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// define constant variables here
define('PLUGIN_TITLE', 'WP Marketing Suite');
define('WPMS_AB_PLUGIN_NAME', 'wp-marketing-suite');
define('WPMS_AB_OPTION', 'wpms-ab-test');
define('WPMS_AB_OPTION_POINTER', 'wpms-ab-options-pointer');
define('WPMS_AB_OPTION_SETTINGS', 'wpms_ab_settings');
define('WPMS_AB_PLUGIN_URL_PATH', plugins_url('', __FILE__ ) );
define('WPMS_AB_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define('WPMS_AB_EXPERIMENTS_TABLE', 'wpms_ab_experiments' );
define('WPMS_AB_VARIATONS_TABLE', 'wpms_ab_variations' );
define('WPMS_AB_VISITS_TABLE', 'wpms_ab_visits' );
define('WPMS_AB_CONVERSIONS_TABLE', 'wpms_ab_conversions' );
define('WPMS_AB_URL_EXPERIMENTS', 'wpms_ab_experiments' );
define('WPMS_MAIN_URL', 'wpms_main' );
define('WPMS_AB_URL_SETTINGS', 'wpms_ab_settings' );
define('WPMS_AB_COOKIE_EXPIRY', 86400 );// 86400 for 1 day
define('WPMS_AB_EXPERIMENT_LIST_LIMIT', 8 );// limits the number of entries for pagination


// =====================================================================
// =====================================================================
/*updater start here*/
//define( 'EDD_SL_LICENSE_KEY_EXPIRED_BEFORE',10); //in days
// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'EDD_SL_STORE_URL', 'http://wpmarketingsuite.com' );
 
// the name of your product. This should match the download name in EDD exactly
define( 'EDD_SL_ITEM_NAME', 'WP Marketing Suite - 10 Site License - 1 Year Free Upgrade' );
 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include( WPMS_AB_PLUGIN_DIR_PATH . '/includes/EDD_SL_Plugin_Updater.php' );
}
// retrieve our license key from the DB
$license_key = get_option('wpms_options');

define( 'EDD_SL_LICENSE_KEY', $license_key['license_key']);
//$license_key = trim( get_option( 'edd_sample_license_key' ) );

// setup the updater
$edd_updater = new EDD_SL_Plugin_Updater( EDD_SL_STORE_URL, __FILE__, array( 
		'version' 	=> '0.42', 		// current version number
		'license' 	=>  EDD_SL_LICENSE_KEY, 	// license key (used get_option above to retrieve from DB)
		'item_name'     => EDD_SL_ITEM_NAME, 	// name of this plugin
		'author' 	=> 'WP Marketing Suite',  // author of this plugin
		'url'           => home_url()
	)
);
/*updater ends here*/
/*check if license key is valid*/
function edd_check_license() {

	$store_url = EDD_SL_STORE_URL;
	$item_name = EDD_SL_ITEM_NAME;
	$license = EDD_SL_LICENSE_KEY;
	$today = date("Y-m-d H:i:s");
		
	$api_params = array( 
		'edd_action' => 'check_license', 
		'license' => $license, 
		'item_name' => urlencode( $item_name ) 
	);
	
	$response = wp_remote_get( add_query_arg( $api_params, $store_url ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return '';

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );
//	echo 'asdfasdf'.print_r($license_data,true);
	
	if( $license_data->payment_id)
	{
		$days_left = round((strtotime($license_data->expires)-strtotime($today))/86400);	
		$exp_date = strtotime($license_data->expires);
		if($days_left <= 0)
		{
			return 'Your license key has been expired on '.date('Y-m-d', $exp_date)."."; 
		}
		if($days_left > 0)
		{
			return "License valid till: ".date('Y-m-d', $exp_date)."."; 
		}	
	}
	else
	{
		return 'Your license key is invalid.'; 
	}
}
/*check if license key is valid ends here*/
// =====================================================================
// =====================================================================


require_once( WPMS_AB_PLUGIN_DIR_PATH . '/includes/functions.php' );

// include  GEOLOCATION SCRIPT
require_once( WPMS_AB_PLUGIN_DIR_PATH . '/includes/geolocation.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );
// Geolocation
register_activation_hook(__FILE__, 'wpms_add_defaults');
register_uninstall_hook(__FILE__, 'wpms_delete_plugin_options');

if(!isset($_SESSION) && is_admin()) {
   session_start();
}

// Add the options page and menu item.
add_action( 'admin_menu', 'wpms_abtest_establish_menus' );

//delete_transient( 'wpms_experiment_status' );
// Initiate transient / check Experiment status (running, paused or complete)
add_action( 'init', 'wpms_abtest_check_experiment_status');

if( !is_admin() ) {
	//add_action( 'init', 'cookie_handler');
	add_action( 'init', 'wpms_abtest_detect_conversion');
}
// initiate wordpress pointer
add_action('admin_head','wpms_abtest_meta_pointer');

// ----------------------------------------------------
// load stylesheet and javascript for both admin and frontend all the time.
/* 
wp_enqueue_style( 'apPluginStylesheet', WPMS_AB_PLUGIN_URL_PATH . '/css/admin.css' );
wp_enqueue_script( 'apPluginScript', WPMS_AB_PLUGIN_URL_PATH . '/js/admin.js' );
*/
// ----------------------------------------------------
//-----------------------------------------------------
// load stylesheet and/or javascript for this plugin.
//if(isset($_GET['page']) && $_GET['page'] == WPMS_AB_URL_EXPERIMENTS) {
	//admin enqueue will only load scripts/styles on admin.
	add_action( 'admin_enqueue_scripts', 'wpms_abtest_enqueue_styles_scripts' );
//}
// ----------------------------------------------------

// ----------------------------------------------------
// form data handling via admin-post.php hook.
add_action( 'admin_post_apsubmitnewexp', 'prefix_admin_apsubmitnewexp' );
function prefix_admin_apsubmitnewexp() {
    //print_r($_POST);
	wpms_abtest_dbase_insert_new_experiment( $_POST );
	// redirect to an admin page after data processing.
    wp_redirect(admin_url('admin.php?page='.WPMS_AB_URL_EXPERIMENTS));
   //exit();
}

add_action( 'admin_post_apsubmitselectexperiment', 'prefix_admin_apsubmitselectexperiment' );
function prefix_admin_apsubmitselectexperiment() {
	// just redirect to a page.
    wp_redirect(admin_url('admin.php?page='.WPMS_AB_URL_EXPERIMENTS.'&action=details&expid='.$_POST['experiments']));
}

add_action( 'admin_post_apsubmitsettings', 'prefix_admin_apsubmitsettings' );
function prefix_admin_apsubmitsettings() {
	if( $_POST['test'] ) {
		$value = "true";
	} else {
		$value = "false";
	}
	update_option(WPMS_AB_OPTION_SETTINGS, $value);
	wpms_abtest_createTempMessage("success|Settings have been saved.|");
	// redirect to an admin page after data processing.
    wp_redirect(admin_url('admin.php?page='.WPMS_AB_URL_EXPERIMENTS.'&action=settings'));
}

add_action( 'admin_post_apsubmitupdatedvariation', 'prefix_admin_apsubmitupdatedvariation' );
function prefix_admin_apsubmitupdatedvariation() {
	wpms_abtest_dbase_update_variation( $_POST );
    wp_redirect(admin_url('admin.php?page='.WPMS_AB_URL_EXPERIMENTS.'&action=details&expid='.$_POST['expid']));
}

add_action( 'admin_post_apsubmitupdatedexperiment', 'prefix_admin_apsubmitupdatedexperiment' );
function prefix_admin_apsubmitupdatedexperiment() {
	wpms_abtest_dbase_update_experiment( $_POST );
	if($_POST['paging'] == 0){
		$paging = "";
	}else{
		$paging = "&paging=".$_POST['paging'];
	}
    wp_redirect(admin_url('admin.php?page='.WPMS_AB_URL_EXPERIMENTS.$paging));
}
// ----------------------------------------------------

function cookie_handler() {
	$experiments = wpms_abtest_dbase_get_running_experiments();
	foreach($experiments as $experiment){
		$randomize = rand(0,2);
		if($randomize == 1) {
			$variation_id = wpms_abtest_dbase_get_running_variation( $experiment->id );
		}else{
			$variation_id = "null";
		}
		if(empty($_COOKIE['wpms_experiment_'.$experiment->id]))
		{
			setcookie("wpms_experiment_".$experiment->id, $variation_id, time()+WPMS_AB_COOKIE_EXPIRY, "/"); // 86400 for 1 day
			//setcookie("wpms_experiment_".$experiment->id, "null", time()+WPMS_AB_COOKIE_EXPIRY, "/"); // 86400 for 1 day
		}
	}
}

// ----------------------------------------------------
// COOKIES
function set_cookies( $exp_id, $var_id, $day, $type ) {
	
	?>
	<script type="text/javascript">
		// Cookies
		function createCookie(name, value, days) {
			if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
				var expires = "; expires=" + date.toGMTString();
			}
			else var expires = "";

			document.cookie = name + "=" + value + expires + "; path=/";
		}

		function readCookie(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') c = c.substring(1, c.length);
				if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
			}
			return null;
		}

		function eraseCookie(name) {
			createCookie(name, "", -1);
		}
	<?php	
		if($type == "initial")
		{
	?>
			createCookie("wpms_experiment_<?php echo $exp_id; ?>", "<?php echo $var_id; ?>", <?php echo $day; ?>);
	<?php
		}
		if($type == "conversion")
		{
	?>
			createCookie("wpms_experiment_conversion_<?php echo $exp_id; ?>", "<?php echo $var_id; ?>", <?php echo $day; ?>);
	<?php
		}
		if($type == "clear_conversion")
		{
	?>
			eraseCookie("wpms_experiment_conversion_<?php echo $exp_id; ?>");
	<?php
		}
	?>
	</script>
		<?php	
}

// ----------------------------------------------------
// Shortcode implementation (display content either original or a variation based on experiment id)
// this triggers visit counts for either original or variation
// will depend on the cookie of experiment id to set a fixed variation id for a user per experiment.
// sample shortcode = [wpmsABTest expid="15"]This is the Original Content[/wpmsABTest]
function wpms_abtest_implement_shortcode( $atts, $content = null ) {
    $args = shortcode_atts( array(
        'expid' => ''
    ), $atts );
	
	// check first if search engine bot, else proceed with variation and updating impression.
	if(false == wpms_abtest_is_search_engine_bots())
	{
		if(empty($_COOKIE['wpms_experiment_'.$args['expid']]))
		{
			$show_original_content_only = rand(0, 2);
			if($show_original_content_only == "1")
			{
				$variation_id = "null";
				$variation_content = $content;
				wpms_abtest_dbase_update_original_impression($args['expid'], $type = null);
			}
			else
			{
				// only update impression if experiment status is set to running.
				if($variation_id = wpms_abtest_dbase_get_running_variation( $args['expid'] ))
				{
					$variation_content = wpms_abtest_dbase_get_variation( $args['expid'], $variation_id, $update = true );
				}
			}
			set_cookies( $args['expid'], $variation_id, 1, "initial" );
			// delete cookie for checking conversion.
			set_cookies( $args['expid'], "null", 1, "clear_conversion" );
		} 
		else
		{
			if($_COOKIE['wpms_experiment_'.$args['expid']] == "null")
			{
				// update the original_visits if cookie value of current experiment is null.
				//wpms_abtest_dbase_update_original_impression($args['expid'], $type = null);
				$variation_content = $content;
			}
			else
			{
				$variation_content = wpms_abtest_dbase_get_variation( $args['expid'], $_COOKIE['wpms_experiment_'.$args['expid']], $update = false );
			}
		}
		
		$proper_content = $variation_content;
	}
	else
	{
		$proper_content = $content;
	}
	$proper_content = stripslashes( $proper_content );
	
	return $proper_content;
}

// add_shortcode(shortcode_name, hook)
add_shortcode( 'wpmsABTest', 'wpms_abtest_implement_shortcode' );
add_shortcode( 'wpmsabtest', 'wpms_abtest_implement_shortcode' );
// --------------------------------------------------------------