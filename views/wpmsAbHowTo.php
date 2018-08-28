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
		<a class="nav-tab nav-tab-active" href="#">How To</a>
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=settings">Settings</a>
	</h2>
	
	<table>
    	<tr>
        	<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/icon.png" alt="wpms" /></td>
			<td><h2>WPMS - How To</h2></td>
        </tr>
	</table>
	
	<div id="wpms_ab_tabs">
	  <ul>
		<li><a href="#wpms_ab_tabs-1">Add New Experiments</a></li>
		<li><a href="#wpms_ab_tabs-2">Implement Shortcodes</a></li>
	  </ul>
	  <div id="wpms_ab_tabs-1" class="wpms-ab-tabs-content">
		<h2>Add New Experiments</h2>
		<p>
		<ul class="wpms-how-to-list">
			<li>Click on the tab <strong>Add Experiment</strong> to go to adding a new experiment.</li>
			<li>Populate the form while taking note of the required fields.</li>
			<li>You need to provide a name for the Experiment that you will be creating, along with a short description.</li>
			<li>Assign a date for when you want your experiment to run. Note that choosing a start date in the future will assign the experiment status as "paused" and will only set as "running" when start date is current date or until end date. Experiment is "completed" when end date has passed.</li>
			<li>Name your goal that this experiment wishes to achieve.</li>
			<li>Assign a goal trigger (page view, click event, submit a form).</li>
			<li>Select an existing page/post of where you will trigger the goal (conversion).</li>
			<li>Under <strong>Variations</strong>, you will need to add at least one variation for this experiment. (maximum of 5)</li>
			<li>Assign a name for the variation.</li>
			<li>Input the content that your variation will display in replacement of the original content (control).</li>
			<li>Save the Experiment when done.</li>
		</ul>
		</p>
	  </div>
	  <div id="wpms_ab_tabs-2">
		<h2>Implement Shortcodes</h2>
		<p>
		Upon creating an experiment, it will be assigned with a unique experiment ID (expid) which you will then use to apply the shortcodes to any 
posts/page you wish to do an experiment with.
		</br>
		</br>
		<strong>Shortcode:</strong>
		</br>
		</br>
		[wpmsABTest expid="{experiment id}"]{your original content}[/wpmsABTest]
		</br>
		</br>
		where <strong>{experiment id}</strong> is the assigned id of the experiment you will be testing. And <strong>{your original content}</strong> will be the control to which your variation will be replacing when a variation of the content is applied to the post/page.
		</br>
		</br>
		<strong>Example:</strong>
		</br>
		</br>
		[wpmsABTest expid="12"]Check this out![/wpmsABTest]
		</p>
	  </div>
	</div>

</div>