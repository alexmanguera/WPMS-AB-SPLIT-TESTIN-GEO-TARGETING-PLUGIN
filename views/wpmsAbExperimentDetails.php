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
	if($results = wpms_abtest_dbase_get_specific_experiment( $_GET['expid'] ))
	{
		foreach ($results as $experiment) {
			$experiment_id = $experiment->id;
			$experiment_name = $experiment->name;
			$experiment_description = $experiment->description;
			$experiment_status = $experiment->status;
			$experiment_start_date = $experiment->start_date;
			$experiment_end_date = $experiment->end_date;
			$experiment_goal_type = $experiment->goal_type;
			$experiment_goal = $experiment->goal;
			$experiment_url = $experiment->url;
			$experiment_original_visits = $experiment->original_visits;
			$experiment_original_convertions = $experiment->original_convertions;
		}
	}	
	$results_avail_experiments = wpms_abtest_dbase_get_experiments();
	$variations = wpms_abtest_dbase_get_variations( $experiment->id );
	
	// visitors
	$visits_array = wpms_abtest_dbase_get_monthly_total_visits( $experiment->id );
	$visits_time_array = wpms_abtest_dbase_get_hourly_visits( $experiment->id );
	foreach($visits_time_array as $visit_time)
	{
		$hours[] = date("H:i:s",strtotime($visit_time->date_created));
	}
	if(count($hours) > 0)
	{
		$show_visitors_by_time = true;
	}else{
		$show_visitors_by_time = false;
	}
	// conversions
	$conversions_array = wpms_abtest_dbase_get_monthly_total_conversions( $experiment->id );
	$conversions_time_array = wpms_abtest_dbase_get_hourly_conversions( $experiment->id );
	foreach($conversions_time_array as $conversions_time)
	{
		$conversions_hours[] = date("H:i:s",strtotime($conversions_time->date_created));
	}
	if(count($conversions_hours) > 0)
	{
		$show_conversions_by_time = true;
	}else{
		$show_conversions_by_time = false;
	}
	
	
?>
<script type="text/javascript">
window.onload = function () {
	// -------------------------------------------------------
	var chart1 = new CanvasJS.Chart("chart_total_visits",
	{
		title:{
			text: "<?php echo $combined_total_visits = wpms_abtest_dbase_get_combined_total_visits($_GET['expid']); ?> Total Visits "
		},
		legend: {
			maxWidth: 350,
			itemWidth: 120
		},
		data: [
		{
			type: "pie",

			dataPoints: [
			<?php 
			$i = 0;
			$variation_visits = 0;
			foreach( $variations as $variation_chart ) {
				$i++;
				$variation_visits += $variation_chart->visits;
				if($experiment_original_visits < 1){
					$original_visits = "0";
				}else{
					$original_visits = $experiment_original_visits-$variation_visits;
				}
			?>
				{ y: <?php echo $variation_chart->visits; ?>, indexLabel: "<?php echo $variation_chart->name; ?>" },
		  <?php } ?>
				{ y: <?php echo $experiment_original_visits; ?>, indexLabel: "Original" }
			]
		}
		]
	});
	// -------------------------------------------------------
	var chart2 = new CanvasJS.Chart("chart_thirty_days",
    {      
      title:{
        text: "Visitors for the past 30 days"
      },
      axisY :{
        includeZero: false
      },
      axisX: {
        valueFormatString: "MM/DD",
        interval: 1,
        intervalType: "day"
      },
      data: [
      {        
        type: "spline",  
        indexLabelFontColor: "orangered",      
        dataPoints: [
		<?php
		$i = 0;
		foreach($visits_array as $visit){
			$date_array = explode("-", $visit->date_created);
			$month = $date_array[1]-1;
			$day = explode(" ", $date_array[2]);
			$day = $day[0];
			$i++;
		?>
        { x: new Date(2016, <?php echo $month; ?>, <?php echo $day; ?>), y: <?php echo $visit->total;?> }<?php if(count($visits_array) != $i) { echo ","; } ?>
		<?php
		}
		?>
        ]
      }
      ]
    });
	// -------------------------------------------------------
	var chart3 = new CanvasJS.Chart("chart_hourly_time",
    {      
      title:{
        text: "Number of visitors by time."
      },
      axisY :{
        includeZero: false
      },
      axisX: {
        interval: 24,
        intervalType: "hour"
      },
      data: [
      {        
        type: "line",  
        indexLabelFontColor: "orangered",      
        dataPoints: [
		<?php
		for($x=1;$x<=24;$x++)
		{
			$total_hours = 0;
			foreach($hours as $hour)
			{
				$get_hour = explode(":", $hour);
				$get_hour = $get_hour[0];
				if($get_hour == $x)
				{
					$total_hours++;
				}
			}
			?>
			{ x: <?php echo $x; ?>, y: <?php echo $total_hours; ?> }<?php if($x != 24) { echo ","; } ?>
		<?php
		}
		?>
        ]
      }
      ]
    });
	// -------------------------------------------------------
	var chart4 = new CanvasJS.Chart("chart_conversions_thirty_days",
    {      
      title:{
        text: "Conversions for the past 30 days"
      },
      axisY :{
        includeZero: false
      },
      axisX: {
        valueFormatString: "MM/DD",
        interval: 1,
        intervalType: "day"
      },
      data: [
      {        
        type: "spline",  
        indexLabelFontColor: "orangered",      
        dataPoints: [
		<?php
		$i = 0;
		foreach($conversions_array as $conversion){
			$conversion_date_array = explode("-", $conversion->date_created);
			$conversion_month = $conversion_date_array[1]-1;
			$conversion_day = explode(" ", $conversion_date_array[2]);
			$conversion_day = $conversion_day[0];
			$i++;
		?>
        { x: new Date(2016, <?php echo $conversion_month; ?>, <?php echo $conversion_day; ?>), y: <?php echo $conversion->total;?> }<?php if(count($conversions_array) != $i) { echo ","; } ?>
		<?php
		}
		?>
        ]
      }
      ]
    });
	// -------------------------------------------------------
	var chart5 = new CanvasJS.Chart("chart_conversions_hourly_time",
    {      
      title:{
        text: "Number of conversions by time."
      },
      axisY :{
        includeZero: false
      },
      axisX: {
        interval: 24,
        intervalType: "hour"
      },
      data: [
      {        
        type: "line",  
        indexLabelFontColor: "orangered",      
        dataPoints: [
		<?php
		for($xx=1;$xx<=24;$xx++)
		{
			$conversions_total_hours = 0;
			if(true === $show_conversions_by_time)
			{
				foreach($conversions_hours as $conversions_hour)
				{
					$get_conversions_hour = explode(":", $conversions_hour);
					$get_conversions_hour = $get_conversions_hour[0];
					if($get_conversions_hour == $xx)
					{
						$conversions_total_hours++;
					}
				}
			}else{
				$conversions_total_hours = 0;
			}
			?>
			{ x: <?php echo $xx; ?>, y: <?php echo $conversions_total_hours; ?> }<?php if($xx != 24) { echo ","; } ?>
		<?php
		}
		?>
        ]
      }
      ]
    });
	// -------------------------------------------------------
	chart1.render();
	chart2.render();
	chart3.render();
	chart4.render();
	chart5.render();
}
</script>

<div class="wrap">

	<h2><?php echo PLUGIN_TITLE; ?> - AB Testing</h2>

	<h2 class="nav-tab-wrapper">
	 <a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>">Overview</a>
	  <a class="nav-tab nav-tab-active" href="#">Details</a>
	  <a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=new">Add Experiment</a>
	  <a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=how-to">How To</a>
	  <a class="nav-tab" href="<?php echo admin_url('admin.php') ?>?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=settings">Settings</a>
	</h2>
	
	<table>
    	<tr>
        	<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/icon.png" alt="wpms" /></td>
			<td><h2>WPMS AB Testing - Experiment Details</h2></td>
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
	
	<div style="float: left;">
		<div id="chart_total_visits" style="height: 280px; width: 30%;"></div>
	</div>

	<div style="float: left; margin: 0px 0px 50px 530px;">
		<div style="margin-bottom: 20px;">
			<form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
				<?php if ( function_exists('wp_nonce_field') ) wp_nonce_field('ap-settings'); ?>
				<input type="hidden" name="selectexperiment" value="selectexperiment">
				<input type="hidden" name="action" value="apsubmitselectexperiment">
				
				<div class="">
					<label class="" for="name">Choose Experiment:</label>
					<select name="experiments" onChange="this.form.submit();">
						<?php if(!isset($_GET['expid']) || $_GET['expid'] == ""){ ?>
						<option value="">-- select --</option>
						<?php } ?>
						<?php
						foreach ($results_avail_experiments as $avail_experiment) { 
							if($avail_experiment->id == $experiment_id) {
								$selected = ' selected="selected"';
							}else{
								$selected = '';
							}
						?>
						<option value="<?php echo $avail_experiment->id; ?>"<?php echo $selected; ?>>(Exp ID: <?php echo $avail_experiment->id.') '.$avail_experiment->name; ?></option>
						<?php } ?>
					</select>
				</div>
			</form>
		</div>
		
		<div>
			<table>
				<tr>
					<td><strong>Experiment ID:</strong> <?php echo $experiment_id; ?></td>
				</tr>
				<tr>
					<td><strong>Name:</strong> <?php echo ucwords($experiment_name); ?></td>
				</tr>
				<tr>
					<td><strong>Description:</strong> <?php echo $experiment_description; ?></td>
				</tr>
				<tr>
					<td><strong>Status:</strong> <?php echo ucwords($experiment_status); ?></td>
				</tr>
				<tr>
					<td><strong>Start Date:</strong> <?php echo $experiment_start_date; ?></td>
				</tr>
				<tr>
					<td><strong>End Date:</strong> <?php echo $experiment_end_date; ?></td>
				</tr>
				<tr>
					<td><strong>Goal Type:</strong> <?php echo $experiment_goal_type; ?></td>
				</tr>
				<tr>
					<td><strong>Goal:</strong> <?php echo $experiment_goal; ?></td>
				</tr>
				<tr>
					<td><strong>Goal URL:</strong> <a href="<?php echo $experiment_url; ?>" target="_blank"><?php echo $experiment_url; ?></a></td>
				</tr>
				<tr>
					<td><strong>Visits:</strong> <?php echo $combined_total_visits; ?></td>
				</tr>
			</table>
		</div>
	</div>
	
	<?php if($variations = wpms_abtest_dbase_get_variations( $experiment_id )){ ?>
	<div>
	<table class="widefat"  id="variationtable" width="100%">
		<thead>
		    <tr>
		        <th>Action</th>
		        <th>Name</th>
		        <th>Text Variation</th>
		        <th>Visitors</th>       
		        <th>Conversions</th>
		        <th>Conversions Rate</th>
		    </tr>
		</thead>
		<tfoot>
		     <tr>
		        <th>Action</th>
		        <th>Name</th>
		        <th>Text Variation</th>
		        <th>Visitors</th>       
		        <th>Conversions</th>
		        <th>Conversions Rate</th>
		    </tr>
		</tfoot>
		<tbody>
		<tr>
			<th> -- </th>
			<th>Control</th>
			<th> -- </th>
			<th><?php echo number_format($experiment_original_visits); ?></th>
			<th><?php echo number_format($experiment_original_convertions); ?></th>
			<th><?php echo wpms_get_conversion_rate( $experiment_original_visits, $experiment_original_convertions ); ?>%</th>
		</tr>
		<?php foreach($variations as $variation) { ?>
			<?php 
			
			$total_visits = wpms_abtest_dbase_get_specific_total_visits_variation( $variation->id );
			
			if($_GET['action'] == "edit-variation" && $_GET['varid'] != "" && $variation->id == $_GET['varid'])
			{
			?>
			<form method="post" action="<?php echo admin_url('admin-post.php'); ?>" id="apsubmitupdatedvariation">
			<input type="hidden" name="save" value="save">
			<input type="hidden" name="action" value="apsubmitupdatedvariation">
			<input type="hidden" name="expid" value="<?php echo $experiment_id;?>">
			<input type="hidden" name="varid" value="<?php echo $variation->id;?>">
			<tr>
				<th><a href="this<?php echo $variation->id;?>"></a><input type="submit" name="submit" id="submit" class="submit button button-primary" value="Save"> | <a href="admin.php?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=details&expid=<?php echo $experiment_id;?>" class="cancel" onclick="return confirm('Cancel edit of this variation?');">Cancel</a></th>
				<th><input name="variation_name" id="variation_name" type="text" value="<?php echo ucwords($variation->name); ?>" class="regular-text" required></th>
				<th><input name="variation_value" id="variation_value" type="text" value="<?php echo esc_html_e( $variation->value ); ?>" class="regular-text" required></th>
				<th><?php echo number_format(wpms_abtest_dbase_get_specific_total_visits_variation( $variation->id )); ?></th>
				<th><?php echo number_format($variation->convertions); ?></th>
				<th><?php echo wpms_get_conversion_rate( $total_visits, $variation->convertions ); ?>%</th>
			</tr>
			</form>
			<?php
			}else{
				
			?>
			<tr>
				<th><a href="admin.php?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=edit-variation&varid=<?php echo $variation->id; ?>&expid=<?php echo $experiment_id;?>#this<?php echo $variation->id;?>" class="edit">Edit</a> | <a href="admin.php?page=<?php echo WPMS_AB_URL_EXPERIMENTS; ?>&action=delete-variation&varid=<?php echo $variation->id; ?>&expid=<?php echo $experiment_id;?>" class="delete" onclick="return confirm('Delete Variation: <?php echo $variation->name; ?>?');">Delete</a></th>
				<th><?php echo ucwords($variation->name); ?></th>
				<th><?php echo esc_html_e( $variation->value ); ?></th>
				<th><?php echo number_format($total_visits); ?></th>
				<th><?php echo number_format($variation->convertions); ?></th>
				<th><?php echo wpms_get_conversion_rate( $total_visits, $variation->convertions ); ?>%</th>
			</tr>
			<?php } // end if ?>
		<?php } //end foreach ?>
		</tbody>
	</table>
	</div>
	<?php } // end if ?>
	
	<div id="spacing" style="margin: 20px 0;"></div>
	
	<!-- 
	<div id="wpms_ab_tabs">
	  <ul>
		<li><a href="#wpms_ab_tabs-1">Visitors - 30 days</a></li>
		<li><a href="#wpms_ab_tabs-2">Visitors - by Time</a></li>
		<li><a href="#wpms_ab_tabs-3">Conversions - 30 days</a></li>
		<li><a href="#wpms_ab_tabs-4">Conversions - by Time</a></li>
	  </ul>
	  <div id="wpms_ab_tabs-1">
		<div id="chart_thirty_days" style="height: 210px; width: 100%;"></div>
	  </div>
	  <div id="wpms_ab_tabs-2">
		<div id="chart_hourly_time" style="height: 210px; width: 100%;"></div>
	  </div>
	  <div id="wpms_ab_tabs-3">
	  </div>
	  <div id="wpms_ab_tabs-4">
	  </div>
	</div>
	-->
	
	<div id="chart_thirty_days" style="margin-top: 20px; height: 210px; width: 100%;"></div>
	<div id="chart_hourly_time" style="margin-top: 20px; height: 210px; width: 100%;"></div>
	<div id="chart_conversions_thirty_days" style="margin-top: 20px; height: 210px; width: 100%;"></div>
	<div id="chart_conversions_hourly_time" style="margin-top: 20px; height: 210px; width: 100%;"></div>
	
</div>