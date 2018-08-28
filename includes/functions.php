<?php 

// ----------------
// delete a variation from under experiment details page.
// requires experiment id and variation id - GET method.
if($_GET['page'] == WPMS_AB_URL_EXPERIMENTS && $_GET['action'] == "delete-variation"){
	wpms_abtest_trigger_delete_variation( $_GET['varid'], $_GET['expid'] );
}

function wpms_abtest_trigger_delete_variation( $var_id, $exp_id ) {
	wpms_abtest_delete_variation( $var_id );
	wpms_abtest_createTempMessage("success|Variation has been deleted.|".$var_id);
	header('Location: admin.php?page='.WPMS_AB_URL_EXPERIMENTS.'&action=details&expid='.$exp_id);
}
// ----------------


// ----------------
// delete an experiment along with its variation/s from experiments page.
// requires experiment id - GET method.
if($_GET['page'] == WPMS_AB_URL_EXPERIMENTS && $_GET['action'] == "delete-experiment"){
	wpms_abtest_trigger_delete_experiment( $_GET['expid'] );
}

function wpms_abtest_trigger_delete_experiment( $exp_id ) {
	wpms_abtest_delete_experiment( $exp_id );
	wpms_abtest_createTempMessage("success|Experiment has been deleted.|".$exp_id);
	header('Location: admin.php?page='.WPMS_AB_URL_EXPERIMENTS.'&expid='.$exp_id);
}
// ----------------




/**
 * hook when plugin is activated.
 */
function activate() {
	wpms_abtest_dbase_create_experiments();
	wpms_abtest_dbase_create_variations();
	wpms_abtest_dbase_create_visits();
	wpms_abtest_dbase_create_conversions();
	
	update_option( WPMS_AB_OPTION_SETTINGS, "false");
	// update the pointer options.
	update_option( WPMS_AB_OPTION_POINTER, "true" );
}

/**
 * hook when plugin is deactivated.
 */
function deactivate() {
	//delete_option( WPMS_AB_OPTION );
	//wpms_abtest_dbase_drop_experiments();
}

/**
 * Enqueue styles/scripts.
 */
 // custom enqueue should have unique name
function wpms_abtest_enqueue_styles_scripts() { 
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_style('jquery-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	wp_enqueue_script( 'apPluginScriptCustom', WPMS_AB_PLUGIN_URL_PATH . '/js/custom-admin.js' );
	wp_enqueue_style( 'apPluginStylesheet', WPMS_AB_PLUGIN_URL_PATH . '/css/custom-admin.css' );
	wp_enqueue_script( 'apPluginScript', WPMS_AB_PLUGIN_URL_PATH . '/js/canvasjs.min.js' );
	// for vertical tabs (How-To page)
	wp_enqueue_script( 'jquery-script-tabs', '//code.jquery.com/jquery-1.8.2.js' );
	wp_enqueue_script( 'jquery-script-tabs-also', '//code.jquery.com/ui/1.9.1/jquery-ui.js' );
}

/**
 * Create the Admin Menus.
 */
function wpms_abtest_establish_menus() {
	add_menu_page(PLUGIN_TITLE, PLUGIN_TITLE, 'manage_options', WPMS_MAIN_URL, 'wpms_abtest_render_pages', WPMS_AB_PLUGIN_URL_PATH . '/assets/icon.png' );
	
	add_submenu_page( WPMS_MAIN_URL, 'WP Marketing Suite', 'Main Menu', 'manage_options', WPMS_MAIN_URL, 'wpms_abtest_render_pages' );
	
	add_submenu_page( WPMS_MAIN_URL, 'WPMS AB Testing', 'AB Testing', 'manage_options', WPMS_AB_URL_EXPERIMENTS, 'wpms_abtest_render_pages' );
	//add_submenu_page( WPMS_AB_URL_EXPERIMENTS, 'WPMS AB Test - How To', 'How To', 'manage_options', 'wpms_ab_experiments&action=how-to', 'wpms_abtest_render_settings' );
	
	// Geolocation
	add_submenu_page( WPMS_MAIN_URL, 'WPMS Geolocation - Settings', 'Geolocation Settings', 'manage_options', WPMS_AB_PLUGIN_DIR_PATH . '/includes/geolocation.php', 'wpms_geolocation_render_form' ); 
	add_submenu_page( WPMS_MAIN_URL, 'WPMS Geolocation - Conditional Custom Shortcode', 'Geolocation Custom Shortcode', 'manage_options', 'conditional-custom-shortcode', 'wpms_render_conditional_custom_shortcode' ); 
	
	// add a page without creating a menu link (set 'null' as parent-slug)
	//add_submenu_page( null, 'Add New Experiment', 'Experiments', 'manage_options', 'alex-plugin-new-experiment', 'wpms_abtest_render_new_experiment' );
	
	// fix to remove duplicate submenu of main menu
	//remove_submenu_page(WPMS_AB_URL_EXPERIMENTS, 'wpms_ab_experiments&action=how-to');
}

/**
 * Render the view for "Experiments" page.
 */
function wpms_abtest_render_pages() {
	if(!empty($_GET['page']) && $_GET['page'] == "wpms_main")
	{
		include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsMain.php' );
	}
	else
	{
		// show edit experiment page else show all experiments page
		if(!empty($_GET['action']) && $_GET['action'] == "edit" && !empty($_GET['expid'])) {
			include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbEditExperiment.php' );
		}elseif(!empty($_GET['action']) && $_GET['action'] == "new") {
			include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbNewExperiment.php' );
		}elseif(!empty($_GET['action']) && $_GET['action'] == "details" && !empty($_GET['expid'])) {
			include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbExperimentDetails.php' );
		}elseif(!empty($_GET['action']) && $_GET['action'] == "edit-variation" && !empty($_GET['expid'])) {
			include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbExperimentDetails.php' );
		}elseif(!empty($_GET['action']) && $_GET['action'] == "settings") {
			include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbSettings.php' );
		}elseif(!empty($_GET['action']) && $_GET['action'] == "how-to") {
			include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbHowTo.php' );
		}else{
			include_once( WP_PLUGIN_DIR.  '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbExperiment.php' );
		}
	}
}

/**
 * Render the view for "Settings" page.
 */
function wpms_abtest_render_settings() {
	include_once( WP_PLUGIN_DIR. '/'.WPMS_AB_PLUGIN_NAME.'/views/wpmsAbSettings.php' );
}

//-----------------------------------------------------
/**
 * Create the experiments table when plugin is installed and activated.
 */
function wpms_abtest_dbase_create_experiments() {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					name VARCHAR(250) NOT NULL DEFAULT '',
					description VARCHAR(500) NOT NULL DEFAULT '',
					status VARCHAR(25) NOT NULL DEFAULT '',
					start_date DATE NOT NULL DEFAULT '0000-00-00 00:00:00',
					end_date DATE NOT NULL DEFAULT '0000-00-00 00:00:00',
					goal VARCHAR(500) NOT NULL DEFAULT '', 
					goal_type VARCHAR(100) NOT NULL DEFAULT '',
					url VARCHAR(500) NOT NULL DEFAULT '',
					original_visits INT NOT NULL DEFAULT 0,
					original_convertions INT NOT NULL DEFAULT 0,
					date_created DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
					) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta( $sql );
}

/**
 * Create the variations table when plugin is installed and activated.
 */
function wpms_abtest_dbase_create_variations() {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	
	$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					experiment_id INT NOT NULL,
					type VARCHAR(100) NOT NULL DEFAULT '',
					name VARCHAR(250) NOT NULL DEFAULT '',
					value TEXT NOT NULL DEFAULT '',
					class VARCHAR(500) NOT NULL DEFAULT '',
					visits INT NOT NULL DEFAULT 0,
					convertions INT NOT NULL DEFAULT 0,
					date_created DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
					);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta( $sql );
}

/**
 * Create the visits table when plugin is installed and activated.
 */
function wpms_abtest_dbase_create_visits() {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VISITS_TABLE;
	
	$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					experiment_id INT NOT NULL,
					variation INT NOT NULL,
					date_created DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
					);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta( $sql );
}

/**
 * Create the conversions (for chart use) table when plugin is installed and activated.
 */
function wpms_abtest_dbase_create_conversions() {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_CONVERSIONS_TABLE;
	
	$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					experiment_id INT NOT NULL,
					variation INT NOT NULL,
					date_created DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
					);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta( $sql );
}


/**
 * Remove the DBASE when plugin is uninstalled.
 */
function wpms_abtest_dbase_drop_experiments( $table ) {
	//$table = WPMS_AB_EXPERIMENTS_TABLE;
	global $wpdb;
	$table_name = $wpdb->prefix . $table;
	$sql = "DROP TABLE IF EXISTS {$table_name}";
	$wpdb->query( $sql ); // only $wpdb->query() works with DROP statement
}

/**
 * Insert to DBASE new experiment.
 */
function wpms_abtest_dbase_insert_new_experiment( $arr_post ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	
	$today = date("Y-m-d");
	
	if($today > $arr_post['endDate']) {
		$status = 'complete';
	}elseif($today < $arr_post['startDate']) {
		$status = 'paused';
	}elseif($today >= $arr_post['startDate'] && $today <= $arr_post['endDate']) {
		$status = 'running';
	}
	
	// format -- $wpdb->insert( $table, $data, $format );
	$wpdb->insert( 
					$table_name, 
					array( 
						'name' => $arr_post['name'], 
						'description' => $arr_post['description'],
						'start_date' => $arr_post['startDate'],
						'end_date' => $arr_post['endDate'],
						'status' => $status,
						'goal' => $arr_post['goal'],
						'goal_type' => $arr_post['goalTrigger'],
						'url' => $arr_post['url'],
						'date_created' => date('Y-m-d H:i:s')
					)
				);
	$new_experiment_id = $wpdb->insert_id; // retrieve the id of the last insert.
		
	for($i = 0; $i <= count($arr_post['variationName']); $i++) {
		$name = $arr_post['variationName'][$i];
		$value = $arr_post['variation'][$i];
		$class = $arr_post['variationClass'][$i];
		
		wpms_abtest_dbase_insert_new_variations( $new_experiment_id, $name, $value, $class );
	}
	
	wpms_abtest_createTempMessage("success|New Experiment has been created|".$new_experiment_id);
}

/**
 * Insert to DBASE variations from new experiments.
 */
function wpms_abtest_dbase_insert_new_variations( $new_experiment_id, $name, $value, $class ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	
	// format -- $wpdb->insert( $table, $data, $format );
	$wpdb->insert( 
					$table_name, 
					array( 
						'experiment_id' => $new_experiment_id,
						'type' => 'text',
						'name' => $name ,
						'value' => $value ,
						'class' => $class,
						'date_created' => date('Y-m-d H:i:s')
					)
				);
}

/**
 * get all experiments from DBASE (either paginated results).
 *
 * @return array
 */
function wpms_abtest_dbase_get_experiments($offset = null, $limit = null) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	
	if(is_null($offset)) {
		$sql = "SELECT * FROM {$table_name} Order By id DESC";
	} else {
		$sql = "SELECT * FROM {$table_name} Order By id DESC LIMIT {$offset},{$limit}";
	}
	$results = $wpdb->get_results( $sql, OBJECT );
	return $results;
}

/**
 * get an experiment from DBASE by experiment_id.
 *
 * @params	$experiment_id	integer
 * @return array
 */
function wpms_abtest_dbase_get_specific_experiment( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$sql = "SELECT * FROM {$table_name} WHERE id = '{$experiment_id}'";
	$results = $wpdb->get_results( $sql, OBJECT );
	return $results;
}

/**
 * check the status of an experiment if valid (running).
 *
 * @params	$experiment_id	integer
 * @return	boolean
 */
function wpms_abtest_dbase_check_experiment_status( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$sql = "SELECT status FROM {$table_name} WHERE id = '{$experiment_id}'";
	$results = $wpdb->get_results( $sql, OBJECT );
	
	if($results)
	{
		foreach($results as $result){
			if($result->status == 'running') {
				return true;
			}else{
				return false;
			}
		}
	}
	else
	{
		return false;
	}
}

/**
 * get all experiments from DBASE for COOKIES implementation (only running experiments).
 *
 * @return array
 */
function wpms_abtest_dbase_get_running_experiments() {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$sql = "SELECT * FROM {$table_name} WHERE status LIKE '%running%' Order By id DESC";
	$results = $wpdb->get_results( $sql, OBJECT );
	return $results;
}

/**
 * get all total variations per experiment.
 *
 * @return integer
 */
function wpms_abtest_dbase_get_specific_total_variations( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "SELECT COUNT(*) AS total FROM {$table_name} WHERE experiment_id = {$experiment_id}";
	$results = $wpdb->get_results( $sql, OBJECT );
	foreach($results as $total)
	{
		$total_visits = $total->total;
	}	
	return $total_visits;
}

/**
 * get combined total visits of an experiment (both original and variation/s).
 *
 * @param	integer	$experiment_id
 * @return	integer
 */
function wpms_abtest_dbase_get_combined_total_visits( $experiment_id ) {
	global $wpdb;
	$table_name_a = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$table_name_b = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql_a = "SELECT original_visits FROM {$table_name_a} WHERE id = {$experiment_id}";
	$sql_b = "SELECT SUM(visits) AS total FROM {$table_name_b} WHERE experiment_id = {$experiment_id}";
	$results_a = $wpdb->get_results( $sql_a, OBJECT );
	$results_b = $wpdb->get_results( $sql_b, OBJECT );
	foreach($results_a as $total_a)
	{
		$total_visits_a = $total_a->original_visits;
	}
	foreach($results_b as $total_b)
	{
		$total_visits_b = $total_b->total;
	}
	$total_visits = $total_visits_a + $total_visits_b;
	return $total_visits;
}


/**
 * get combined total conversions of an experiment (both original and variation/s).
 *
 * @param	integer	$experiment_id
 * @return	integer
 */
function wpms_abtest_dbase_get_combined_total_conversions( $experiment_id ) {
	global $wpdb;
	$table_name_a = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$table_name_b = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql_a = "SELECT original_convertions FROM {$table_name_a} WHERE id = {$experiment_id}";
	$sql_b = "SELECT SUM(convertions) AS total FROM {$table_name_b} WHERE experiment_id = {$experiment_id}";
	$results_a = $wpdb->get_results( $sql_a, OBJECT );
	$results_b = $wpdb->get_results( $sql_b, OBJECT );
	foreach($results_a as $total_a)
	{
		$total_convertions_a = $total_a->original_convertions;
	}
	foreach($results_b as $total_b)
	{
		$total_convertions_b = $total_b->total;
	}
	$total_convertions = $total_convertions_a + $total_convertions_b;
	return $total_convertions;
}

/**
 * get total visits by experiment id from experiments table.
 *
 * @param	integer	experiment_id
 * @return	integer
 */
 function wpms_abtest_dbase_get_specific_total_visits_experiment( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$sql = "SELECT * FROM {$table_name} WHERE id = {$experiment_id}";
	$results = $wpdb->get_results( $sql, OBJECT );
	foreach($results as $totals)
	{
		$total_visits = $totals->original_visits;
	}	
	return $total_visits;
 }
 
/**
 * update experiment details.
 *
 * @param	string	experiment_id - experiment id.
 */
function wpms_abtest_dbase_update_experiment( $arr_post ){
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	
	$today = date("Y-m-d");
	
	if($today > $arr_post['endDate2']) {
		$status = 'complete';
	}elseif($today < $arr_post['startDate2']) {
		$status = 'paused';
	}elseif($today >= $arr_post['startDate2'] && $today <= $arr_post['endDate2']) {
		$status = 'running';
	}
	
	$sql = "UPDATE {$table_name} SET 
					name = '{$arr_post['name']}',
					description = '{$arr_post['description']}',
					start_date='{$arr_post['startDate']}',
					end_date='{$arr_post['endDate']}',
					goal='{$arr_post['goal']}',
					goal_type='{$arr_post['goalTrigger']}',
					url='{$arr_post['url']}',
					status='{$status}'
			WHERE id = {$arr_post['expid']}";
	$wpdb->query( $sql );
}
 
/**
 * update variation details.
 *
 * @param	string	variation_id - variation id.
 */
function wpms_abtest_dbase_update_variation( $arr_post ){
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "UPDATE {$table_name} SET name = '{$arr_post['variation_name']}', value='{$arr_post['variation_value']}' WHERE id = {$arr_post['varid']}";
	$wpdb->query( $sql );
}

/**
* delete a specific experiment and its variation/s across the created plugin tables.
*
* @param	integer	experiment_id
*/
function wpms_abtest_delete_experiment( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$table_name2 = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$table_name3 = $wpdb->prefix . WPMS_AB_VISITS_TABLE;
	$table_name4 = $wpdb->prefix . WPMS_AB_CONVERSIONS_TABLE;
	$sql = "DELETE FROM {$table_name} WHERE id = '{$experiment_id}'";
	$sql2 = "DELETE FROM {$table_name2} WHERE experiment_id = '{$experiment_id}'";
	$sql3 = "DELETE FROM {$table_name3} WHERE experiment_id = '{$experiment_id}'";
	$sql4 = "DELETE FROM {$table_name4} WHERE experiment_id = '{$experiment_id}'";
	$wpdb->query($sql);
	$wpdb->query($sql2);
	$wpdb->query($sql3);
	$wpdb->query($sql4);
}
 
/**
* delete a specific variation.
*
* @param	integer	variation_id
*/
function wpms_abtest_delete_variation( $variation_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "DELETE FROM {$table_name} WHERE id = '{$variation_id}'";
	$wpdb->query($sql);
}

/**
 * IMPRESSIONS - increment the original_visits/impressions for experiment.
 *
 * @param	string	id - experiment_id based on shortcode.
 */
function wpms_abtest_dbase_update_original_impression($id, $type){
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$sql = "UPDATE {$table_name} SET original_visits = original_visits + 1 WHERE id = {$id}";
	$wpdb->query( $sql );
	
	// -------------------------------------------------
	// insert to wpms_ab_visits table new visits.
	$table_name_b = $wpdb->prefix . WPMS_AB_VISITS_TABLE;
	$wpdb->insert( 
					$table_name_b, 
					array( 
						'experiment_id' => $id,
						'variation' => "0",							
						'date_created' => date('Y-m-d H:i:s')
					)
				);
	// -------------------------------------------------
}

/**
 * get variations by experiment id.
 *
 * @param	integer	experiment_id
 * @return	array
 */
function wpms_abtest_dbase_get_variations( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "SELECT * FROM {$table_name} WHERE experiment_id = {$experiment_id}";
	$results = $wpdb->get_results( $sql, OBJECT );

	return $results;
}

/**
 * get variations by experiment id for COOKIES implementation.
 *
 * @param	integer	experiment_id
 * @return	integer	variation_id
 */
function wpms_abtest_dbase_get_running_variation( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "SELECT * FROM {$table_name} WHERE experiment_id = {$experiment_id} ORDER BY RAND() LIMIT 1";
	$results = $wpdb->get_results( $sql, OBJECT );

	if($results){
		foreach($results as $result)
		{
			$variation_id = $result->id;
		}	
		return $variation_id;
	}
	else{
		return false;
	}
}

/**
 * IMPRESSIONS->VARIATIONS - get variation from specified experiment to display via shortcode.
 *
 * @param	string	experiment id - experiment_id based on shortcode.
 */
function wpms_abtest_dbase_get_variation( $experiment_id, $variation_id, $update ){
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "SELECT id, value FROM {$table_name} WHERE experiment_id = {$experiment_id} AND id = {$variation_id}";
	$results = $wpdb->get_results( $sql, OBJECT );
	
	if($results){
		foreach($results as $resval)
		{
			$value_content = $resval->value;
			if($update)
			{
				// update the visitor count for this variation
				$sql = "UPDATE {$table_name} SET visits = visits + 1 WHERE id = {$resval->id}";
				$wpdb->query( $sql );
			}
		}
		
		if($update)
		{
			// -------------------------------------------------
			// insert to wpms_ab_visits table new visits.
			$table_name_b = $wpdb->prefix . WPMS_AB_VISITS_TABLE;
			$wpdb->insert( 
							$table_name_b, 
							array( 
								'experiment_id' => $experiment_id,
								'variation' => $variation_id,							
								'date_created' => date('Y-m-d H:i:s')
							)
						);
			// -------------------------------------------------
		}
		return $value_content;
	}
	else
	{
		return false;
	}
}

/**
 * get total visits of a variation via variation id.
 *
 * @param	integer	variation_id
 * @return	integer
 */
function wpms_abtest_dbase_get_specific_total_visits_variation( $variation_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "SELECT * FROM {$table_name} WHERE id = {$variation_id}";
	$results = $wpdb->get_results( $sql, OBJECT );
	foreach($results as $totals)
	{
		$total_visits = $totals->visits;
	}	
	return $total_visits;
}

// ======================================================================
/**
 * get total visits of an experiment for the past 30 days.
 *
 * @param	integer	experiment_id
 * @return	integer
 */
function wpms_abtest_dbase_get_monthly_total_visits( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VISITS_TABLE;
	$sql = "SELECT experiment_id, date_created, COUNT(*) AS total, DATE_FORMAT(date_created, '%m/%d/%Y') 
			FROM {$table_name} 
			WHERE experiment_id = {$experiment_id}
			AND date_created BETWEEN NOW() - INTERVAL 30 DAY 
			AND NOW() 
			GROUP BY DATE_FORMAT(date_created, '%m/%d/%Y')";
	$results = $wpdb->get_results( $sql, OBJECT );

	return $results;
}
// ======================================================================

// ======================================================================
/**
 * get visitors of an experiment by time.
 *
 * @param	integer	experiment_id
 * @return	integer
 */
function wpms_abtest_dbase_get_hourly_visits( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VISITS_TABLE;
	$sql = "SELECT date_created
			FROM {$table_name} 
			WHERE experiment_id = {$experiment_id}";
	$results = $wpdb->get_results( $sql, OBJECT );

	return $results;
}
// ======================================================================

// ======================================================================
/**
 * get conversions of an experiment by time.
 *
 * @param	integer	experiment_id
 * @return	integer
 */
function wpms_abtest_dbase_get_hourly_conversions( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_CONVERSIONS_TABLE;
	$sql = "SELECT date_created
			FROM {$table_name} 
			WHERE experiment_id = {$experiment_id}";
	$results = $wpdb->get_results( $sql, OBJECT );

	return $results;
}
// =====================================================================

// ======================================================================
/**
 * record conversion transaction for chart use.
 *
 * @param	integer	experiment_id, variation_id
 */
function wpms_abtest_dbase_record_conversion_chart( $exp_id, $var_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_CONVERSIONS_TABLE;
	$wpdb->insert( 
					$table_name, 
					array( 
						'experiment_id' => $exp_id,
						'variation' => $var_id,							
						'date_created' => date('Y-m-d H:i:s')
					)
				);
}
// ======================================================================

// ======================================================================
/**
 * get total conversions of an experiment for the past 30 days.
 *
 * @param	integer	experiment_id
 * @return	integer
 */
function wpms_abtest_dbase_get_monthly_total_conversions( $experiment_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_CONVERSIONS_TABLE;
	$sql = "SELECT experiment_id, date_created, COUNT(*) AS total, DATE_FORMAT(date_created, '%m/%d/%Y') 
			FROM {$table_name} 
			WHERE experiment_id = {$experiment_id}
			AND date_created BETWEEN NOW() - INTERVAL 30 DAY 
			AND NOW() 
			GROUP BY DATE_FORMAT(date_created, '%m/%d/%Y')";
	$results = $wpdb->get_results( $sql, OBJECT );

	return $results;
}
// ======================================================================

/**
 * update the experiment status (via transient)
 *
 */
function wpms_abtest_dbase_update_experiment_status( $experiment_id, $status ){
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$sql = "UPDATE {$table_name} SET status = '{$status}' WHERE id = '{$experiment_id}'";
	$wpdb->query( $sql );
}
//-----------------------------------------------------

// check experiment status ( set by transient [cache] )
function wpms_abtest_check_experiment_status() {
	//if(!get_transient('wpms_experiment_status'))
	//{
		$experiments = wpms_abtest_dbase_get_experiments($offset = null, $limit = null);
		foreach ($experiments as $experiment) {
			$startDate = $experiment->start_date;
			$endDate = $experiment->end_date;
			$today = date("Y-m-d");

			if($today > $endDate) {
				wpms_abtest_dbase_update_experiment_status( $experiment->id, 'complete' );
			}elseif($today < $startDate) {
				wpms_abtest_dbase_update_experiment_status( $experiment->id, 'paused' );
			}elseif($today >= $startDate && $today <= $endDate) {
				wpms_abtest_dbase_update_experiment_status( $experiment->id, 'running' );
			}
		}
		// available constants ( MINUTE_IN_SECONDS, HOUR_IN_SECONDS, DAY_IN_SECONDS, WEEK_IN_SECONDS, YEAR_IN_SECONDS )
		//set_transient( 'wpms_experiment_status', "updated", 60 );
	//}
}

function wpms_abtest_dbase_get_goal_url( $url ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	//$sql = "SELECT id FROM {$table_name} WHERE url LIKE '{$url}%'";
	//$sql = "SELECT id FROM {$table_name} WHERE url LIKE CONCAT('%', {$url}, '%')";
	$sql = "SELECT id FROM {$table_name} WHERE url = '".$url."'";
	$results = $wpdb->get_results( $sql, OBJECT );
	if($results)
	{
		foreach($results as $result)
		{
			$id = $result->id;
		}	
		return $id;
	}else{
		return false;
	}
}

function wpms_abtest_dbase_update_conversion( $var_id ){
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_VARIATONS_TABLE;
	$sql = "UPDATE {$table_name} SET convertions = convertions + 1 WHERE id = {$var_id}";
	$wpdb->query( $sql );
}

function wpms_abtest_dbase_update_original_conversion( $exp_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . WPMS_AB_EXPERIMENTS_TABLE;
	$sql = "UPDATE {$table_name} SET original_convertions = original_convertions + 1 WHERE id = {$exp_id}";
	$wpdb->query( $sql );
}

//-----------------------------------------------------
/**
 * Create a flash message
 */
function wpms_abtest_createTempMessage($message)
{
	// $message = [success/false]|[actual message]|[extras]
	$_SESSION['message'] = $message;
}

/**
 * Delete a flash message
 */
function wpms_abtest_deleteTempMessage()
{
	$_SESSION['message'] = null;
}
//-----------------------------------------------------

/**
 * Determine if search engine bot/crawler.
 */
function wpms_abtest_is_search_engine_bots() {
	$bots_arr = array(					
				'googlebot',
				'msnbot',
				'slurp',
				'ask jeeves',
				'crawl',
				'ia_archiver',
				'lycos'		
				);
				
	$bots = implode("|", $bots_arr);

	if(stripos($_SERVER['HTTP_USER_AGENT'], $bots) !== false){
		return true;
	}else{
		return false;
	}
}

//-----------------------------------------------------

/**
 * implement wordpress pointer upon plugin activation.
 */
function wpms_abtest_meta_pointer() {
	//Check option to hide pointer after initial display
	if( get_option( WPMS_AB_OPTION_POINTER ) == "true" ) 
	{
		$pointer_content = '<h3>Start WP Marketing Suite</h3>';
		$pointer_content .= '<p>Start optimizing your website today with WP Marketing Suite!</p>';
		$url = admin_url( 'admin.php?page='.WPMS_MAIN_URL );
		?>

		<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			if(jQuery.fn.pointer)
			{
				jQuery("#menu-plugins").pointer({
				content: '<?php echo $pointer_content; ?>',
				buttons: function( event, t ) {
					button = $('<a id="pointer-close" class="button-secondary">Close</a>');
					button.bind("click.pointer", function() {
						t.element.pointer("close");
					});
					return button;
				},
				position: "left",
				close: function() { }
		
				}).pointer("open");
		  
				jQuery("#pointer-close").after('<a id="pointer-primary" class="button-primary" style="margin-right: 5px;" href="<?php echo $url; ?>">Start Now</a>');
			}
		   
		});
		//]]>
		</script>
		<?php
		// update option to prevent pointer from showing.
		update_option( WPMS_AB_OPTION_POINTER, 'false' );
	}
}

/**
 * On Goal Page/URL - this will detect if a conversion is made. determined by wp permalink.
 */
function wpms_abtest_detect_conversion() {
	if(false == wpms_abtest_is_search_engine_bots())
	{
		//$referer = wp_get_referer();
		$current_url = wpms_abtest_full_url();
		//$current_url = "http://localhost/wordpress/2016/04/02/hello-world/";
		//$current_url = get_permalink();
		
		if($exp_id = wpms_abtest_dbase_get_goal_url( $current_url ))
		{
			//return $exp_id;
			if(!empty($_COOKIE['wpms_experiment_'.$exp_id]))
			{
				if(empty($_COOKIE['wpms_experiment_conversion_'.$exp_id]))
				{
					$var_id = $_COOKIE['wpms_experiment_'.$exp_id];
					set_cookies( $exp_id, $var_id, 1, "conversion" );
					if($var_id != "null")
					{
						wpms_abtest_dbase_update_conversion( $var_id );
					}else{
						wpms_abtest_dbase_update_original_conversion( $exp_id );
					}
					// record the conversion for chart use.
					wpms_abtest_dbase_record_conversion_chart( $exp_id, $var_id );
				}
			}
		}
	}
	//echo $current_url;
}

/**
 * gets the full current url (including protocol [http/s:])
 */
function wpms_abtest_full_url() {
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

function wpms_get_conversion_rate( $total_visits, $total_conversions ) {
	if($total_visits == 0){
		return "0";	
	}else{
		$conversion_rate =  round(($total_conversions / $total_visits) * 100, 2);
		return $conversion_rate;
	}
}