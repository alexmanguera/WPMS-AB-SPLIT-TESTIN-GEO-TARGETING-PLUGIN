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

<?php
$expid = $_GET['expid'];
$experiments = wpms_abtest_dbase_get_specific_experiment( $expid );
?>
<div class="wrap">

	<h2><?php echo PLUGIN_TITLE; ?> - AB Testing</h2>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>">Overview</a>
		<a class="nav-tab nav-tab-active" href="#">Edit Experiment</a>
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=how-to">How To</a>
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=settings">Settings</a>
	</h2>

	<table>
    	<tr>
        	<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/icon.png" alt="Alex Plugin" /></td>
			<td><h2>WPMS AB Testing - Edit Experiment</h2></td>
        </tr>
	</table>
		
	<p>Please fill in all the fields that are marked as required. If you set your start date to be in the future then the experiment will be set to pause until that date arrives.</p>
	<?php
	foreach( $experiments as $experiment ){
	?>
	<form action="<?php echo admin_url('admin-post.php'); ?>" method="post" enctype="multipart/form-data" class="apsubmitupdatedexperiment">
		<input type="hidden" name="save" value="save">
		<input type="hidden" name="action" value="apsubmitupdatedexperiment">
		<input type="hidden" name="expid" value="<?php echo $experiment->id; ?>">
		<input type="hidden" name="paging" value="<?php if(!empty($_GET['paging']) && $_GET['paging'] != "0"){ echo $_GET['paging']; }else{ echo "0"; } ?>">
		
		<div>
			<label class="wpms-ab-label" for="name">Experiment ID</label>
			<div>
				<input type="text" id="name" name="name" class="regular-text" value="<?php echo $experiment->id; ?>" disabled>
			</div>
		</div>
		
		<div>
			<label class="wpms-ab-label" for="name">Experiment Name <span class="description">(required)</span></label>
			<div>
				<input type="text" id="name" name="name" class="regular-text" value="<?php echo $experiment->name; ?>">
			</div>
		</div>

		<div>
			<label class="wpms-ab-label" for="description">Experiment Description</label>
			<div>
				<textarea name="description" id="description"><?php echo $experiment->description; ?></textarea>
			</div>
		</div>

		<div>
			<label class="wpms-ab-label" for="startDate">Start Date <span class="description">(required)</span></label>
			<div>
				<input type="text" name="startDate" id="wpms_startDate" class="ab-datepicker" value="<?php echo $experiment->start_date; ?>">
			</div>
		</div>

		<div>
			<label class="wpms-ab-label" for="endDate">End Date <span class="description">(required)</span></label>
			<div>
				<input type="text"  name="endDate" id="wpms_endDate"  class="ab-datepicker" value="<?php echo $experiment->end_date; ?>">
			</div>
		</div>

		<div>
			<label class="wpms-ab-label" for="goal">Goal <span class="description">(required)</span></label>
			<div>
				<input type="text" id="goal" name="goal" class="regular-text" value="<?php echo $experiment->goal; ?>">
			</div>
		</div>

		<div>
			<label class="wpms-ab-label" for="goalTrigger">Goal Trigger</label>
			<div>
				<select name="goalTrigger" id="goalTrigger">
					<option value="page"<?php echo ($experiment->goal_type == "page" ? ' selected="selected"' : ''); ?>>Page View</option>
					<option value="clickEvent"<?php echo ($experiment->goal_type == "clickEvent" ? ' selected="selected"' : ''); ?>>Click Event</option>
					<option value="form"<?php echo ($reexperimentsult->goal_type == "form" ? ' selected="selected"' : ''); ?>>Submit a Form</option>
				</select>
			</div>
		</div>

		<div id="ab-urlGroup">
			<label class="wpms-ab-label" for="url">Goal URL <span class="description">(required)</span></label>
			<div>
				<select id="url" name="url">
					<option value="" >Select a Page</option>
					<?php 
						foreach( get_post_types( array('public' => true) ) as $post_type ) {
						  if ( in_array( $post_type, array('attachment') ) )
						    continue;
						  	$pt = get_post_type_object( $post_type );
							
							echo "  <optgroup label=".$pt->labels->name.">";

							query_posts('post_type='.$post_type.'&posts_per_page=-1');
							while( have_posts() ) {
								the_post();
								$permalink = get_permalink();
								if($permalink == $experiment->url){
									$selected = ' selected="selected"';
								}else{
									$selected = '';
								}
								echo "<option value=".$permalink.$selected.">".get_the_title()."</option>";
							}

							echo "</optgroup>";
						}
					?>
				</select>
			</div>
		</div>

		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Update Experiment">
			<button name="cancel" id="cancel" class="button button-default" onClick="goBack();">Cancel</button>
		</p>

	</form>
	<?php } //end foreach ?>
</div>