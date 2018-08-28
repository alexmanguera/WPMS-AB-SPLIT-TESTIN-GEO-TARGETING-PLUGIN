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
	/*
	* pagination logic
	*
	*/
	$pagenum = isset( $_GET['paging'] ) ? absint( $_GET['paging'] ) : 1;
	
	$limit = WPMS_AB_EXPERIMENT_LIST_LIMIT;
	$offset = ( $pagenum - 1 ) * $limit;

	$experiments = wpms_abtest_dbase_get_experiments( $offset, $limit );
	
	$total = count(wpms_abtest_dbase_get_experiments());
	$num_of_pages = ceil( $total / $limit );

	$page_links = paginate_links( array(
		'base' => add_query_arg( 'paging', '%#%' ),
		'format' => '',
		'prev_text' => __( '&laquo;', 'aag' ),
		'next_text' => __( '&raquo;', 'aag' ),
		'total' => $num_of_pages,
		'current' => $pagenum
	) );
?>
<div class="wrap">

	<h2><?php echo PLUGIN_TITLE; ?> - AB Testing</h2>
	
	<h2 class="nav-tab-wrapper">
	  <a class="nav-tab nav-tab-active" href="#">Overview</a>
	  <a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=new">Add Experiment</a>
	  <a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=how-to">How To</a>
	  <a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=settings">Settings</a>
	</h2>

	<table>
    	<tr>
        	<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/icon.png" alt="wpms" /></td>
			<td><h2>WPMS AB Testing - Experiments</h2></td>
        </tr>
	</table>
	
	<?php
	if(isset($_SESSION['message']))
	{
		$message = explode("|", $_SESSION['message']);
		if($message[0] == "success")
			echo "<div id='message' class='updated below-h2'><p>".$message[1]." | Experiment ID: ".$message[2]."</p></div>";
		else
			echo "<div id='message' class='below-h2 error'><p>".$message[1]."</p></div>";
		wpms_abtest_deleteTempMessage();
	}
	?>
	
	<script type="text/javascript">
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer",
		{      
		  theme:"theme2",
		  title:{
			text: "WPMS AB Testing - Total Visitors Overview"
		  },
		  animationEnabled: true,
		  axisY :{
			includeZero: false,
			// suffix: " k",
			valueFormatString: "#,,.",
			suffix: ""
			
		  },
		  toolTip: {
			shared: "true"
		  },
		  data: [
		<?php 
		$i = 0;
		foreach( $experiments as $exp_chart ) {
			$i++;
		?>
			{        
			type: "column", 
			showInLegend: true,
			name: "Exp ID:<?php echo $exp_chart->id; ?>",
			// markerSize: 0,        
			// color: "rgba(54,158,173,.6)",
			dataPoints: [
				 
			{label: "Visitors", y: <?php echo number_format(wpms_abtest_dbase_get_combined_total_visits( $exp_chart->id )); ?>}        

			]
		  }<?php if ( count($experiments) != $i ) { echo ","; } ?>
		  <?php } ?>
		
		  ],
		  legend:{
			cursor:"pointer",
			itemclick : function(e) {
			  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
				e.dataSeries.visible = false;
			  }
			  else {
				e.dataSeries.visible = true;
			  }
			  chart.render();
			}
			
		  },
		});

	chart.render();
	}
	</script>
	
	<div id="chartContainer" style="margin-bottom: 20px; height: 300px; width: 100%;"></div>
	
	<!-- Start Modal Form [Add New Experiment] -->
	<?php add_thickbox(); ?>
	<div id="content_form_add_new_experiment" style="display:none;">
		 <h2>New Experiment</h2>
			
		<p>Please fill in all the fields that are marked as required and create at least one variation. If you set your start date to be in the future then the experiment will be set to pause until that date arrives.</p>

		<form action="<?php echo admin_url('admin-post.php'); ?>" method="post" name="submitnewexp" id="submitnewexp">
			<input type="hidden" name="save" value="save">
			<input type="hidden" name="action" value="apsubmitnewexp">
			
			<table id="newexperimenttable" width="100%">
				<tr>
					<td>
						<label class="ab-press-label" for="name">Experiment Name <span class="description">(required)</span></label>
						<input type="text" id="name" name="name" class="regular-text" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="ab-press-label" for="description">Experiment Description</label>
						<textarea name="description" id="description" class="regular-text"></textarea>
					</td>
				</tr>
				<tr>	
					<td>
						<label class="ab-press-label" for="startDate">Start Date <span class="description">(required)</span></label>
						<input type="text" name="startDate" id="startDate" class="ab-datepicker" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="ab-press-label" for="endDate">End Date <span class="description">(required)</span></label>
						<input type="text"  name="endDate" id="endDate"  class="ab-datepicker" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="ab-press-label" for="goal">Goal <span class="description">(required)</span></label>
						<input type="text" id="goal" name="goal" class="regular-text" required>
					</td>
				</tr>
				<tr>
					<td>
						<label class="ab-press-label" for="goalTrigger">Goal Trigger</label>
						<select name="goalTrigger" id="goalTrigger">
							<option value="page">Page View</option>
							<option value="clickEvent">Click Event</option>
							<option value="form">Submit a Form</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label class="ab-press-label" for="url">URL <span class="description">(required)</span></label>
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
				<a href="#" onclick="addRow();" class="add_field_button" style="text-decoration:none;">[+ add]</a>
			</div>
			
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="submit button button-primary" value="Save Experiment">
			</p>
		<!-- disable the closing form tag for dynamic input fields to submit. -->
		<!--</form>-->
	</div>
	<!-- End Modal Form [Add New Experiment] -->

	<?php 
	/*
	* output the pagination results
	*/
	if ( $page_links ) {
		echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
	}
	?>
	<table class="widefat">
		<thead>
		    <tr>
		        <th>Action</th>
		        <th>ID</th>
		        <th>Name</th>
		        <th>Visitors</th>       
		        <th>Conversions</th>
		        <th>Conversions Rate</th>
		        <th>Variations</th>
		        <th>Experiment Date</th>
		        <th>Status</th>
		    </tr>
		</thead>
		<tfoot>
		     <tr>
		        <th>Action</th>
		        <th>ID</th>
		        <th>Name</th>
		        <th>Visitors</th>       
		        <th>Conversions</th>
		        <th>Conversions Rate</th>
		        <th>Variations</th>
		        <th>Experiment Dates</th>
		        <th>Status</th>
		    </tr>
		</tfoot>
		<tbody>
		<?php foreach ($experiments as $experiment) { ?>
		<?php 
		if($experiment->status == "complete"){
			$status_class = "expstatus_complete";
		}elseif($experiment->status == "running"){
			$status_class = "expstatus_running";
		}else{
			$status_class = "expstatus_paused";
		}
		
		//$total_visits = wpms_abtest_dbase_get_specific_total_visits_experiment( $experiment->id );
		$total_visits = wpms_abtest_dbase_get_combined_total_visits( $experiment->id );
		$total_conversions = wpms_abtest_dbase_get_combined_total_conversions( $experiment->id );
		?>
		<tr>
			<th><a href="<?php echo admin_url('admin.php'); ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=edit&expid=<?php echo $experiment->id; ?><?php if(!empty($_GET['paging'])){ echo "&paging=".$_GET['paging']; } ?>" class="edit">Edit</a> | <a href="admin.php?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=delete-experiment&expid=<?php echo $experiment->id; ?>" class="delete" onclick="return confirm('Delete Experiment ID: <?php echo $experiment->id; ?> - <?php echo $experiment->name; ?>?');">Delete</a></th>
			<th><?php echo ucwords($experiment->id); ?></th>
			<th><a href="<?php echo admin_url('admin.php'); ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=details&expid=<?php echo $experiment->id; ?>"><?php echo ucwords($experiment->name); ?></a></th>
			<th><?php echo number_format($total_visits); ?></th>
			<th><?php echo number_format($total_conversions);  ?></th>
			<th><?php echo wpms_get_conversion_rate( $total_visits, $total_conversions ); ?>%</th>
			<th><?php echo wpms_abtest_dbase_get_specific_total_variations( $experiment->id ); ?></th>
			<th><?php echo date("m-d-Y", strtotime($experiment->start_date)) ?> - <?php echo date("m-d-Y", strtotime($experiment->end_date)) ?></th>
			<th><span class="<?php echo $status_class; ?>"><?php echo ucwords($experiment->status); ?></span></th>
		</tr>
		<?php } //end foreach ?>
			
		</tbody>
	</table>

	
</div>