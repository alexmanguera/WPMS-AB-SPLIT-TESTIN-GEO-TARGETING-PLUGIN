<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   wpms-ab-test
 * @author    Alex Manguera
 * @link      http://alexmanguera.com
 * @copyright 2016 Alex Manguera
 */
?>
<div class="wrap">

	<h2><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/icon.png" alt="wpms" /> Welcome To WP Marketing Suite</h2>
	
	<div class="wpms-main-cat">
		<table>
			<tr>
				<td><h2>WPMS AB Testing</h2>
				<a href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>" id="abtest" class="button button-primary">Click Here</a></td>
			</tr>
		</table>
	</div>
	<div class="wpms-main-cat">
		<table>
			<tr>
				<td><h2>WPMS Geolocation Settings</h2>
				<a href="?page=<?php echo WPMS_AB_PLUGIN_NAME . '/includes/geolocation.php'; ?>" id="geolocate-settings" class="button button-primary">Click Here</a></td>
			</tr>
		</table>
	</div>
	<div class="wpms-main-cat">
		<table>
			<tr>
				<td><h2>WPMS Geolocation Conditional Custom Shortcode</h2>
				<a href="?page=conditional-custom-shortcode" id="geolocate-custom-shortcode" class="button button-primary">Click Here</a></td>
			</tr>
		</table>
	</div>
</div>