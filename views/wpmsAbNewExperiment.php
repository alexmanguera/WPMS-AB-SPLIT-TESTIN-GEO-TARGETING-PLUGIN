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
		<a class="nav-tab nav-tab-active" href="#">Add Experiment</a>
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=how-to">How To</a>
		<a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=settings">Settings</a>
	</h2>

	<table>
    	<tr>
        	<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/icon.png" alt="wpms" /></td>
			<td><h2>WPMS AB Testing - Add New Experiment</h2></td>
        </tr>
	</table>
			
		<p>Please fill in all the fields that are marked as required and create at least one variation. If you set your start date to be in the future then the experiment will be set to pause until that date arrives.</p>

		<form action="<?php echo admin_url('admin-post.php'); ?>" method="post" name="submitnewexp" id="submitnewexp">
			<input type="hidden" name="save" value="save">
			<input type="hidden" name="action" value="apsubmitnewexp">
			
			<table id="newexperimenttable" width="100%">
				<tr>
					<td>
						<label class="wpms-ab-label" for="name">Experiment Name <span class="description">(required)</span></label>
						<input type="text" id="name" name="name" class="regular-text" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="wpms-ab-label" for="description">Experiment Description</label>
						<textarea name="description" id="description" class="regular-text"></textarea>
					</td>
				</tr>
				<tr>	
					<td>
						<label class="wpms-ab-label" for="startDate">Start Date <span class="description">(required)</span></label>
						<input type="text" name="startDate" id="wpms_startDate" class="ab-datepicker" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="wpms-ab-label" for="endDate">End Date <span class="description">(required)</span></label>
						<input type="text"  name="endDate" id="wpms_endDate"  class="ab-datepicker" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="wpms-ab-label" for="goal">Goal <span class="description">(required)</span></label>
						<input type="text" id="goal" name="goal" class="regular-text" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="wpms-ab-label" for="goalTrigger">Goal Trigger</label>
						<select name="goalTrigger" id="goalTrigger">
							<option value="page">Page View</option>
							<option value="clickEvent">Click Event</option>
							<option value="form">Submit a Form</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label class="wpms-ab-label" for="url">Goal URL <span class="description">(required)</span></label>
						<select id="url" name="url" required>
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
										echo "<option value=".get_permalink().">".get_the_title()."</option>";
										//echo "<option value=".get_the_ID().">".get_the_title()."</option>";
									}

									echo "</optgroup>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Variations</strong>
					</td>
				</tr>
			</table>
				
			<table id="variants">
				<tr>
					<td>
						<label class="variation-label-name" for="variationName[]">Name</label>
						<input type="text" name="variationName[]" class="variationField" required>
					</td>
					<td>
						<label class="variation-label" for="variation[]">Content</label>
						<input type="text" name="variation[]" class="variationField" required>
					</td>
					<td>
						<label class="class-label" for="variationClass[]">Element Class</label>
						<input type="text" name="variationClass[]" class="variationField">	
					</td>
					<td>
						&nbsp;
					</td>
				</tr>
			</table>
			
			<div>
				<a href="javascript:;" onclick="addRow();" class="add_field_button" style="text-decoration:none;">[+ add]</a>
			</div>
			
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="submit button button-primary" value="Save Experiment">
			</p>
		<!-- disable the closing form tag for dynamic input fields to submit. -->
		<!--</form>-->

</div>