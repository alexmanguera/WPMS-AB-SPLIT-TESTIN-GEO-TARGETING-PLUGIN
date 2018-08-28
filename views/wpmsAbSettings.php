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

	<h2><?php echo PLUGIN_TITLE; ?> - AB Testing</h2>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>">Overview</a>
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=new">Add Experiment</a>
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=how-to">How To</a>
		<a class="nav-tab nav-tab-active" href="#">Settings</a>
	</h2>
	
	<table>
    	<tr>
        	<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/icon.png" alt="wpms" /></td>
			<td><h2>WPMS AB Testing - Settings</h2></td>
        </tr>
	</table>
	
	<?php
	if(isset($_SESSION['message']))
	{
		$message = explode("|", $_SESSION['message']);
		if($message[0] == "success")
			echo "<div id='message' class='updated below-h2'><p>".$message[1]."</p></div>";
		else
			echo "<div id='message' class='below-h2 error'><p>".$message[1]."</p></div>";
		wpms_abtest_deleteTempMessage();
	}
	?>
	
	<form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
		<?php if ( function_exists('wp_nonce_field') ) wp_nonce_field('ap-settings'); ?>
		<input type="hidden" name="save" value="save">
		<input type="hidden" name="action" value="apsubmitsettings">
		
		<div>
			<table>
				<tr>
					<td>
					<?php 
						if(get_option( WPMS_AB_OPTION_SETTINGS ) == "true") {
							$checked = 'checked="checked"';
						} else{
							$checked = '';
						}
					?>
					<input type="checkbox" id="test" name="test" <?php echo $checked; ?>>
					</td>
					<td><label for="test">Lorem Ipsum Dolor</label></td>
				</tr>
			</table>
		</div>
		<div>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Settings">
			</p>
		</div>
	</form>
</div>