<?php

//register_activation_hook(__FILE__, 'wpms_add_defaults');
//register_uninstall_hook(__FILE__, 'wpms_delete_plugin_options');

add_action('admin_init', 'wpms_init' );
add_action('admin_menu', 'wpms_add_menu_page');

class logfile{
	// used for writing logs for debugging.  touch error.log; chmod 777 error.log
	function write($the_string ) {
		$fp = @fopen(WPMS_AB_PLUGIN_DIR_PATH."/error.log", 'a');
		if( $fp ) {
			fputs( $fp, $the_string, strlen($the_string) );
			fclose( $fp );
			return( true );
		} else {
			return( false );
		}
	}
}
$log = new logfile();
// $log->write("test");

function wpms_country_list($atts, $content="") {
	return wpms_list_all_countries();
}
function wpms_shortcode_env($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'env'));
}
function wpms_shortcode_database_date($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'database_date'));
}
function wpms_shortcode_distance_kilometers($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'distance_kilometers'));
}
function wpms_shortcode_distance_miles($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'distance_miles'));
}
function wpms_shortcode_city($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'city'));
}
function wpms_shortcode_postal_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'postal_code'));
}
function wpms_shortcode_longitude($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'longitude'));
}
function wpms_shortcode_latitude($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'latitude'));
}
function wpms_shortcode_ip($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'ip'));
}
function wpms_shortcode_country_name($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'country_name'));
}
function wpms_shortcode_country_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'country_code'));
}
function wpms_shortcode_state_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'state_code'));
}
function wpms_shortcode_state_name($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'state_name'));
}
function wpms_options_nearby_range($atts, $content="") {
        $options = get_option('wpms_options');
	return $options['txt_nearby_range'];
}
function wpms_is_not_ip($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_ip'));
}
function wpms_is_not_ips($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_ips'));
}
function wpms_is_not_country_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_country_code'));
}
function wpms_is_not_country_codes($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_country_codes'));
}
function wpms_is_not_country_name($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_country_name'));
}
function wpms_is_not_country_names($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_country_names'));
}
function wpms_is_not_state_codes($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_state_codes'));
}
function wpms_is_not_state_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_state_code'));
}
function wpms_is_not_state_name($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_state_name'));
}
function wpms_is_not_postal_codes($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_postal_codes'));
}
function wpms_is_not_postal_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_postal_code'));
}
function wpms_is_not_city($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_city'));
}
function wpms_is_not_cities($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_cities'));
}
function wpms_is_not_city_and_state($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_city_and_state'));
}
function wpms_is_ip($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_ip'));
}
function wpms_is_ips($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_ips'));
}
function wpms_is_country_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_country_code'));
}
function wpms_is_country_codes($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_country_codes'));
}
function wpms_is_country_name($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_country_name'));
}
function wpms_is_country_names($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_country_names'));
}
function wpms_is_state_codes($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_state_codes'));
}
function wpms_is_state_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_state_code'));
}
function wpms_is_state_name($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_state_name'));
}
function wpms_is_postal_codes($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_postal_codes'));
}
function wpms_is_postal_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_postal_code'));
}
function wpms_is_city($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_city'));
}
function wpms_is_cities($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_cities'));
}
function wpms_is_city_and_state_code($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_city_and_state_code'));
}
function wpms_is_nearby($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_nearby'));
}
function wpms_is_not_nearby($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_nearby'));
}
function wpms_is_within($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_within'));
}
function wpms_is_not_within($atts, $content="") {
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_not_within'));
}
////CUSTOM SHORTOCDE FOR USER AGENT
function wpms_is_user_agent($atts, $content="") {

	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_user_agent'));
}
////CUSTOM SHORTOCDE FOR NEW OR REPEAT VISITOR

function wpms_is_repeat_visitor($atts, $content="") {

	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'is_repeat_visitor'));
}


///CUSTOM MULTIPLE CONDITION
function wpms_custom_condition($atts, $content="")
{
	return do_shortcode(wpms_conditional_shortcode($atts, $content, 'custom_condition'));
}


function wpms_conditional_shortcode($atts, $content, $condition) {

	global $post;
	
	$options = get_option('wpms_options');
	extract(shortcode_atts(array(
                'longitude' => '',
                'latitude' => '',
                'ip' => '',
                'ips' => '',
                'country_name' => '',
                'country_names' => '',
                'country_code' => '',
                'country_codes' => '',
                'state_name' => '',
                'state_code' => '',
                'state_codes' => '',
                'postal_code' => '',
                'postal_codes' => '',
                'cities' => '',
                'city' => '',
                'miles' => '',
				'kilometers' => '',
				'user_agent' => '',
				'repeat_visitor' => '',
				'referer' => '',
				'conjuction' => '',
				'id' => ''
        ), $atts));
        $user_ip = wpms_get_ip_address();
        $loc_arr = wpms_get_location_info($user_ip);
		$loc_arr['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$loc_arr['repeat_user'] = "";
		$visitor = wpms_get_cookie();
		if(!empty($visitor)){
		$loc_arr['repeat_visitor'] = $visitor;
		}
		
		/*
		$loc_arr['repeat_visitor'] = '';
		$inst = WPMS_AB_PLUGIN_DIR_PATH.'database/GeoLiteCity.dat';
		if(is_file($inst)){
		$loc_arr['repeat_visitor'] = "Yes"
		}
		*/
		
		$loc_arr['referer'] = '';
		
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$url = parse_url($_SERVER['HTTP_REFERER']);
			$loc_arr['referer'] = $url['host'];
		}

        if ($user_ip=='' || $loc_arr == FALSE) {
                $user_latitude = '';
                $user_longitude = '';
                $user_state_code = '';
                $user_state_name = '';
                $user_postal_code = '';
                $user_city = '';
                $user_country_name = '';
                $user_country_code = '';
				$user_user_agent = '';
				$user_repeat_visitor = '';
        } else {
                $user_latitude = $loc_arr['latitude'];
                $user_longitude = $loc_arr['longitude'];
                $user_state_code = $loc_arr['state_code'];
                $user_state_name = $loc_arr['state_name'];
                $user_postal_code = $loc_arr['postal_code'];
                $user_city = $loc_arr['city_name'];
                $user_country_name = $loc_arr['country_name'];
                $user_country_code = $loc_arr['country_code'];
				$user_user_agent = $loc_arr['user_agent'];
				$user_repeat_visitor = $loc_arr['repeat_visitor'];
        }
		
		switch( $condition ) {
		case 'env':
			return implode('<br>',$_ENV);
			break;
		case 'database_date' :
			$database=WPMS_AB_PLUGIN_DIR_PATH.'/database/GeoLiteCity.dat';
			if (is_file($database)) {
				if ($options['chk_enable_plugin']) {
					$dbdate=date($options['sel_date_format'], @filemtime("$database"));
				}
			}
			return $dbdate;
			break;
		case 'city' :
			return wpms_case_convert($user_city,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'latitude' :
			return wpms_case_convert($user_latitude,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'longitude' :
			return wpms_case_convert($user_longitude,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'ip' :
			return wpms_case_convert($user_ip,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'country_name' :
			return wpms_case_convert($user_country_name,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'country_code' :
			return wpms_case_convert($user_country_code,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'state_code' :
			return wpms_case_convert($user_state_code,$options['rdo_case'],$options['txt_filter_cls']);
			break;				
		case 'state_name' :
			return wpms_case_convert($user_state_name,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'postal_code' :
			return wpms_case_convert($user_postal_code,$options['rdo_case'],$options['txt_filter_cls']);
			break;
		case 'distance_miles':
			if ($options['txt_home_latitude'] && $options['txt_home_longitude']) {
				$user_distance_miles=distance($user_latitude,$user_longitude,$options['txt_home_latitude'],$options['txt_home_longitude'],TRUE);
			} else {
				$user_distance_miles=$options['txt_def_distance_miles'];
			}
			return $user_distance_miles;
			break;
		case 'distance_kilometers':
			if ($options['txt_home_latitude'] && $options['txt_home_longitude']) {
				$user_distance_kilometers=distance($user_latitude,$user_longitude,$options['txt_home_latitude'],$options['txt_home_longitude'],FALSE);
			} else {
				$user_distance_kilometers=$options['txt_def_distance_kilometers'];
			}
			return $user_distance_kilometers;
			break;
		case 'is_not_nearby':
			if (!$options['txt_home_latitude'] && !$options['txt_home_longitude'] && !$latitude && !$longitude) {
					return; // don't return content if we haven't specified our home base
			}
			if ($latitude && longitude) {
				$compare_lat=$latitude;
				$compare_lon=$longitude;
			} else {
				if ($options['txt_home_latitude'] && $options['txt_home_longitude']) {
					$compare_lat=$options['txt_home_latitude'];
					$compare_lon=$options['txt_home_longitude'];
				} else {
					return; // invalid
				}
			}
			if ($miles) {
				$distance=distance($user_latitude, $user_longitude, $compare_lat, $compare_lon, TRUE);
				if ($distance >= $miles) {
					return $content;
				}
			} else {
				if ($kilometers) {
					$distance=distance($user_latitude, $user_longitude, $compare_lat, $compare_lon, TRUE);
					if ($distance >= $options['txt_nearby_range']) {
						return $content;
					}
				}
			}
			break;
		case 'is_nearby':
// will assume home lat and lon if no lat and lon are specified in the shortcode atts
			if (!$options['txt_home_latitude'] && !$options['txt_home_longitude'] && !$latitude && !$longitude) {
					return; // don't return content if we haven't specified our home base
			}
			if ($latitude && longitude) {
				$compare_lat=$latitude;
				$compare_lon=$longitude;
			} else {
				if ($options['txt_home_latitude'] && $options['txt_home_longitude']) {
					$compare_lat=$options['txt_home_latitude'];
					$compare_lon=$options['txt_home_longitude'];
				} else {
					return; // invalid
				}
			}
			if ($miles) {
				$distance=distance($user_latitude, $user_longitude, $compare_lat, $compare_lon, TRUE);
				if ($distance <= $miles) {
					return $content;
				}
			} else {
				if ($kilometers) {
					$distance=distance($user_latitude, $user_longitude, $compare_lat, $compare_lon, TRUE);
					if ($distance <= $options['txt_nearby_range']) {
						return $content;
					}
				}
			}
			break;
		case 'is_within':
			if (!$options['txt_home_latitude'] && !$options['txt_home_longitude']) {
				return; // don't return content if we haven't specified our home base
			}
			if (!$miles && !$kilometers) {
				//return $content;
				// don't return content if we they haven't specified a distance.
			} else {
				if ($miles) {
					$distance=distance($user_latitude, $user_longitude, $options['txt_home_latitude'], $options['txt_home_longitude'], TRUE);
					if ($distance <= $miles) {
						return $content;
					}
				} else {
					$distance=distance($user_latitude, $user_longitude, $options['txt_home_latitude'], $options['txt_home_longitude'], FALSE);
					if ($distance <= $kilometers) {
						return $content;
					}
				}	
			}
			break;
		case 'is_not_cities':
			$is_not_city=wpms_csv_find($cities,$loc_arr['city_name']);
			if ($is_not_city==false) {
				return $content;
			}
			break;
		case 'is_not_city':
			$is_not_city=wpms_csv_find($city,$loc_arr['city_name']);
			if ($is_not_city==false) {
				return $content;
			}
			break;
		case 'is_not_state_code':
			if ($state_code!=$loc_arr['state_code']) {
				return $content;
			}
			break;
		case 'is_not_state_name':
			if ($state_code!=$loc_arr['state_name']) {
				return $content;
			}
			break;
		case 'is_not_state_codes':
			$found=wpms_csv_find($states,$loc_arr['state_code']);
			if ($found==false) {
				return $content;
			}
		case 'is_not_postal_code':
			if ($postal_code!=$loc_arr['postal_code']) {
				return $content;
			}
			break;
		case 'is_not_postal_codes':
			$found=wpms_csv_find($postals,$loc_arr['postal_code']);
			if ($found==false) {
				return $content;
			}
			break;
		case 'is_not_country_name':
			if ($country_name!=$loc_arr['country_name']) {
				return $content;
			}
			break;
		case 'is_not_country_names':
			$found=wpms_csv_find($country_names,$loc_arr['country_name']);
			if ($found==false) {
				return $content;
			}
			break;
		case 'is_not_country_code':
			if ($country_code!=$loc_arr['country_code']) {
				return $content;
			}
			break;
		case 'is_not_country_codes':
			$found=wpms_csv_find($country_codes,$loc_arr['country_code']);
			if ($found==false) {
				return $content;
			}
			break;
		case 'is_city_and_state_code':
			if ($city==$loc_arr['city_name'] && $state_code!=$loc_arr['state_code']) {
				return $content;
			}
			break;
		case 'is_city':
			if ($city==$loc_arr['city_name']) {
				return $content;
			}
			break;
		case 'is_cities':
			$found=wpms_csv_find($cities,$loc_arr['city_name']);
			if ($found) {
				return $content;
			}
			break;
		case 'is_state_code':
			if ($state_code==$loc_arr['state_code']) {
				return $content;
			}
			break;
		case 'is_state_codes':
			$found=wpms_csv_find($state_codes,$loc_arr['state_code']);
			if ($state_code==$loc_arr['state_code']) {
				return $content;
			}
		case 'is_postal_code':
			if ($postal_code==$loc_arr['state_code']) {
				return $content;
			}
			break;
		case 'is_postal_codes':
			$found=wpms_csv_find($postal_codes,$loc_arr['postal_code']);
			if ($postal_code==$loc_arr['postal_code']) {
				return $content;
			}
			break;
		case 'is_country_name':
			if ($country_name==$loc_arr['country_name']) {
				return $content;
			}
			break;
		case 'is_country_names':
			$found=wpms_csv_find($country_names,$loc_arr['country_name']);
			if ($found) {
				return $content;
			}
			break;
		case 'is_country_code':
			if ($country_code==$loc_arr['country_code']) {
				return $content;
			}
			break;
		case 'is_country_codes':
			$found=wpms_csv_find($country_codes,$loc_arr['country_code']);
			if ($found) {
				return $content;
			}
			break;
		case 'is_ip':
			if ($ip==$user_ip) {
					return $content;
			}
			break;
		case 'is_ips':
			$found=wpms_csv_find($ips,$user_ip);
			if ($found) {
				return $content;
			}
			break;
		case 'is_not_ip':
			if ($ip!=$user_ip) {
					return $content;
			}
			break;
		case 'is_not_ip':
			$found=wpms_csv_find($ips,$user_ip);
			if ($found==false) {
					return $content;
			}
			break;
		///to check what is the user agent 
		
		case 'is_user_agent':
		
		if(strstr($loc_arr['user_agent'],$user_agent))
		{
			return $content;
		}
		break;
		
		///to check new visitor or repeat visitor 
		case 'is_repeat_visitor':
		
		$found = $loc_arr['repeat_visitor'];
		if(!empty($found))
		{
			return $content;
		}
		break;
		
		
		case 'custom_condition':
			/*echo $user_city;
			echo "<br>";
			echo $user_user_agent;
			echo "<br>";
			echo $city;
			echo "<br>";
			echo $user_agent;
			echo "<br>";
			echo $loc_arr['city_name'];*/
			static $order = array();


			if($id)
			{
				global $wpdb;
				$shortcodes = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."ms_custom_shortcode` WHERE `id` = '$id' ");
				
				if(count($shortcodes))
				{
					//print_r($shortcodes);
					$modified_sc = str_replace('][',']'.$content.'[',$shortcodes[0]->custom_shortcode);

					$order = unserialize($shortcodes[0]->order);
					return do_shortcode($modified_sc);
				}	
			}
			else
			{
				/*convert attributes into an array and exclude operator and conjuction*/
				$filtered_atts = array();
				foreach($atts as $attribute_name => $values)
				{
					$filtered_atts[$attribute_name] = explode(',',$values);
				}
				
				//print_r($atts);
				//print_r($filtered_atts);
				//print_r($order);
				$sorted_array = array();
				foreach($order as $key => $dimension)
				{
					$sorted_array[$dimension][$key] = $filtered_atts[$dimension][0];
					unset($filtered_atts[$dimension][0]);
					$filtered_atts[$dimension] = array_values($filtered_atts[$dimension]);
				}
				//print_r($sorted_array);
				$expression = '';
				$save_index = 0;
				
				$logical_operator_placeholder = "/XXXlogical_operatorXXX/";
				foreach($order as $key => $dimension)
				{
					$value = $sorted_array[$dimension][$key];
					$operator = $filtered_atts['operator'][$key]; 
					switch($dimension)
					{
						case 'city':
							if($operator == 'contains')
							{
								if(strstr($loc_arr['city_name'],$value))
								{
	
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else if($operator == 'regexp')
							{
								if(preg_match("/$value/", $loc_arr['city_name']) )
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else
							{
								$expression .= "'$value' $operator '".$loc_arr['city_name']."' XXXlogical_operatorXXX ";
							}
						break;
						case 'country_name':
							if($operator =='contains')
							{
								if(strstr($loc_arr['country_name'],$value))
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else if($operator =='regexp')
							{
								if(preg_match("/$value/", $loc_arr['country_name']) )
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else
							{
								$expression .= "'$value' $operator '".$loc_arr['country_name']."' XXXlogical_operatorXXX ";
							}
						break;
						case 'user_agent':
							if($operator =='contains')
							{
								if(strstr($loc_arr['user_agent'],$value))
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else if($operator =='regexp')
							{
								if(preg_match("/$value/", $loc_arr['user_agent']) )
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else
							{
								$expression .= "'$value' $operator '".$loc_arr['user_agent']."' XXXlogical_operatorXXX ";
							}
						break;
						case 'referer':
							if($operator =='contains')
							{
								if(strstr($loc_arr['referer'],$value))
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else if($operator =='regexp')
							{
								if(preg_match("/$value/", $loc_arr['referer']) )
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else
							{
								$expression .= "'$value' $operator '".$loc_arr['referer']."' XXXlogical_operatorXXX ";
							}
						break;
						
						case 'url_parameter':
							//echo "vvvv".$value;
							
							//echo "current url ID is ".$post->guid;
							$page_link = explode("?",$post->guid);
							$page_parameters = $page_link[count($page_link)-1];
							//echo $pageid." = ".$value;
							
							list($GET_name,$GET_value) = explode("=",$value);
							
							if($operator =='contains')
							{
								if(in_array($GET_name,array_keys($_GET)) && strstr($_GET[$GET_name],$GET_value))
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else if($operator =='regexp')
							{
								if( in_array($GET_name,array_keys($_GET)) && preg_match("/$GET_value/", $_GET[$GET_name]) )
								{
									$expression .= " true XXXlogical_operatorXXX ";	
								}
								else
								{
									$expression .= " false XXXlogical_operatorXXX ";	
								}
							}
							else
							{
								$expression .= "'$value' $operator '".$page_parameters."' XXXlogical_operatorXXX ";
							}
						break;
					}
				}
				
				//echo "<Br>".$expression;
				
				foreach ($filtered_atts['conjuction'] as $conjuction) {
					$expression = preg_replace($logical_operator_placeholder, $conjuction, $expression, 1);
				}
				$expression = str_replace('XXXlogical_operatorXXX', '', $expression);
				//echo "<Br>befire:[{[".$expression."]}]";
				//echo $loc_arr['user_agent'];
				$result = eval("return ( $expression );");
				if($result)
				{
					return $content;
				}
				
			}

		break;
		default:
	}
}

add_shortcode("wpms_country_list", "wpms_country_list");
add_shortcode("wpms_env", "wpms_shortcode_env");
add_shortcode("wpms_database_date", "wpms_shortcode_database_date");
add_shortcode("wpms_distance_kilometers", "wpms_shortcode_distance_kilometers");
add_shortcode("wpms_distance_miles", "wpms_shortcode_distance_miles");
add_shortcode("wpms_longitude", "wpms_shortcode_longitude");
add_shortcode("wpms_latitude", "wpms_shortcode_latitude");
add_shortcode("wpms_city", "wpms_shortcode_city");
add_shortcode("wpms_postal_code", "wpms_shortcode_postal_code");
add_shortcode("wpms_ip", "wpms_shortcode_ip");
add_shortcode("wpms_country_name", "wpms_shortcode_country_name");
add_shortcode("wpms_country_code", "wpms_shortcode_country_code");
add_shortcode("wpms_state_name", "wpms_shortcode_state_name");
add_shortcode("wpms_state_code", "wpms_shortcode_state_code");
add_shortcode("wpms_options_nearby_range", "wpms_options_nearby_range");
add_shortcode("wpms_is_city_and_state_code", "wpms_is_city_and_state_code");
add_shortcode("wpms_is_ip", "wpms_is_ip");
add_shortcode("wpms_is_ips", "wpms_is_ips");
add_shortcode("wpms_is_not_ip", "wpms_is_not_ip");
add_shortcode("wpms_is_not_ips", "wpms_is_not_ips");
add_shortcode("wpms_is_city", "wpms_is_city");
add_shortcode("wpms_is_cities", "wpms_is_cities");
add_shortcode("wpms_is_not_cities", "wpms_is_not_cities");
add_shortcode("wpms_is_not_city", "wpms_is_not_city");
add_shortcode("wpms_is_nearby", "wpms_is_nearby");
add_shortcode("wpms_is_not_nearby", "wpms_is_not_nearby");
add_shortcode("wpms_is_within", "wpms_is_within");
add_shortcode("wpms_is_country_name", "wpms_is_country_name");
add_shortcode("wpms_is_country_names", "wpms_is_country_names");
add_shortcode("wpms_is_country_code", "wpms_is_country_code");
add_shortcode("wpms_is_country_codes", "wpms_is_country_codes");
add_shortcode("wpms_is_state_code", "wpms_is_state_code");
add_shortcode("wpms_is_state_codes", "wpms_is_state_codes");
add_shortcode("wpms_is_postal_code", "wpms_is_postal_code");
add_shortcode("wpms_is_postal_codes", "wpms_is_postal_codes");
add_shortcode("wpms_is_not_postal_code", "wpms_is_not_postal_code");
add_shortcode("wpms_is_not_postal_codes", "wpms_is_not_postal_codes");
add_shortcode("wpms_is_not_country_name", "wpms_is_not_country_name");
add_shortcode("wpms_is_not_country_names", "wpms_is_not_country_names");
add_shortcode("wpms_is_not_country_code", "wpms_is_not_country_code");
add_shortcode("wpms_is_not_country_codes", "wpms_is_not_country_codes");
add_shortcode("wpms_is_not_state_code", "wpms_is_not_state_code");
add_shortcode("wpms_is_not_state_codes", "wpms_is_not_state_codes");

//shortcode for user agent
add_shortcode("wpms_is_user_agent", "wpms_is_user_agent");

//shortcode for repeat visitor

add_shortcode("wpms_is_repeat_visitor", "wpms_is_repeat_visitor");

//shortcodes for multiple condition
add_shortcode("wpms_custom_condition","wpms_custom_condition");

// delete options table entries ONLY when plugin deactivated AND deleted
function wpms_delete_plugin_options() {
	delete_option('wpms_options');
}

// Define default option settings
function wpms_add_defaults() {
    $tmp = get_option('wpms_options');
    if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
		delete_option('wpms_options'); 
		$arr = array("sel_date_format" => 'D, M d Y H:i:s',"txt_def_distance_miles" => "A Lot of Miles","txt_def_distance_kilometers" => "A Lot of Kilometers","txt_def_home" => 'Your home or address', "txt_def_latitude" => 'Your Latitude', "txt_def_longitude" => 'Your Longitude', "txt_def_ip" => 'Your IP', "txt_def_city" => 'Your City', "txt_def_state_code" => 'Your State Code', "txt_def_country_code" => 'Your Country', "txt_def_country_name" => 'Your Country', "chk_post_content" => "1", "chk_comments" => "1", "txt_filter_cls" => "", "rdo_units" => "miles", "rdo_case" => "off", "chk_default_options_db" => "");
		update_option('wpms_options', $arr);
	}
	/*create a table to stroe the custom short codes*/
	global $wpdb;

	$sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."ms_custom_shortcode` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `custom_shortcode` mediumtext,
			  `order` longtext,
			  `date` datetime NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
}

// Init plugin options to white list our options
function wpms_init(){
	$tmp = get_option('wpms_options');
	register_setting( 'wpms_plugin_options', 'wpms_options', 'wpms_validate_options' );
}

// Add menu page
function wpms_add_menu_page() {
	//add_menu_page('WP Marketing Suite', 'WP Marketing Suite', 'manage_options', __FILE__, 'wpms_geolocation_render_form', WPMS_AB_PLUGIN_URL_PATH . '/assets/whatiswpgeocode-menu-icon.png' );
	//add_submenu_page( __FILE__, 'WP Marketing Suite Settings', 'Settings', 'manage_options', __FILE__, 'wpms_geolocation_render_form' ); 
	//add_submenu_page( __FILE__, 'Conditional Custom Shortcode', 'Custom Shortcode', 'manage_options', 'conditional-custom-shortcode', 'wpms_render_conditional_custom_shortcode' ); 
}
//Draw the page for custom conditional shortcodes
function wpms_render_conditional_custom_shortcode()
{
	global $wpdb;
	//print_r($_POST);
	if(isset($_GET['action']) && $_GET['action'] != '')
	{
		if(isset($_GET['id']) && $_GET['action'] == 'delete')
		{
			$id = $_GET['id']; 
			$delete_query = "DELETE FROM `".$wpdb->prefix."ms_custom_shortcode` WHERE `id` = '$id'";
			$wpdb->query($delete_query);
			echo "<script>window.location = '?page=conditional-custom-shortcode';</script>";
			
		}
	}
	/*BULK ACTION IMPLEMENTATION*/
	if(isset($_POST['apply-bulk-action']))
	{
		if($_POST['bulk-action'] == 'delete')
		{

			$id = implode(',',$_POST['id']);
			$delete_query = "DELETE FROM `".$wpdb->prefix."ms_custom_shortcode` WHERE `id` IN ( $id )";
			if($wpdb->query($delete_query))
			{
				?><div class="updated below-h2" id="message"><p>Shortcode(s) deleted.</p></div><?php
			}
	
		}	
	}
	
	if(isset($_POST['submit']))
	{
		//print_r($_POST);
		$operator = implode(',',$_POST['operator']);
		$conjuction = '';
		if(isset($_POST['conjuction']))
		{
			$conjuction = implode(',',$_POST['conjuction']);	
		}
		
		$value = $_POST['value'];
		$dimensions = $_POST['dimension'];
		
		$filter_dimensions = array();
		foreach($dimensions as $key => $dimension)
		{
			if($dimension == 'url_parameter')
			{
				$filter_dimensions[$dimension][] =  $_POST['url_parameter_name'][$key].'='.$value[$key];
			}
			else
			{
				$filter_dimensions[$dimension][] =  $value[$key];
			}
		}
		//print_r($filter_dimensions);
		$dimension_string = '';
		foreach($filter_dimensions as $dimension_name => $dimension_values)
		{
			$dimension_string .= ' '.$dimension_name."='".implode(",",$dimension_values)."'";
		}
		//echo $dimension_string;
		$date = date("Y-m-d H:i:s");
		$order = serialize($_POST['dimension']);
		$custom_shortcode = '[wpms_custom_condition '.$dimension_string.' operator=\''.$operator.'\' conjuction=\''.$conjuction.'\' ][/wpms_custom_condition]';
		if(isset($_POST['id']) && $_POST['action'] == 'update')
		{
			$update_query = "UPDATE `".$wpdb->prefix."ms_custom_shortcode`  SET `custom_shortcode` = '".addslashes($custom_shortcode)."', `order` = '".addslashes($order)."' , `date` = '".$date."' WHERE `id`  = '".$_POST['id']."'";
			if($wpdb->query($update_query))
			{
				$city_name  = '';
				?>
					<div class="updated below-h2" id="message"><p>Shortcode is Updated.</p></div>
				<?php
			}
		}
		else
		{
			$insert_query = "INSERT INTO  `".$wpdb->prefix."ms_custom_shortcode` (`custom_shortcode`,`order`,`date`) VALUES ('".addslashes($custom_shortcode)."','".addslashes($order)."','".$date."')";
			if($wpdb->query($insert_query))
			{
				$city_name  = '';
				?>
					<div class="updated below-h2" id="message"><p>Shortcode is saved.</p></div>
				<?php
			}
		}
	}
	if(isset($_GET['edit']) && $_GET['edit'] != '')
	{
		include(WPMS_AB_PLUGIN_DIR_PATH . "/views/wpmsGeo-edit-shortcode.php");	
	}
	else
	{
		include(WPMS_AB_PLUGIN_DIR_PATH . "/views/wpmsGeo-add-new-shortcode.php");
		
		$shortcodes = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."ms_custom_shortcode` ORDER BY `date` DESC");
		if(count($shortcodes))
		{
			include(WPMS_AB_PLUGIN_DIR_PATH . "/views/wpmsGeo-display-shortcodes.php");
		}
	}
}
// Draw the menu page itself
function wpms_geolocation_render_form() {
	?>
<div class="wrap">
	<table>
    	<tr>
        	<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/Archery-Target-icon-100x100.png" alt="WP Geocode" /></td>
			<td><h2>WP Marketing Suite - Geolocation Settings</h2></td>
        </tr>
	</table>
	<?php 
	if(isset($_GET['action']) && $_GET['action'] == 'update-geolitecity')
	{
		
		?>
        <p>Please do not close/reload page. Database is being update...</p>
        <?php
		
		$url  = "http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz";

		$path = WPMS_AB_PLUGIN_DIR_PATH.'/database/GeoLiteCity.dat.gz';
		
		$fp = fopen($path, 'w');
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		$data = curl_exec($ch);
		curl_close($ch);
		
		fclose($fp);
		
		$r = exec('gunzip '.$path);
		
		$path1 = WPMS_AB_PLUGIN_DIR_PATH.'/database/';
		$dir    = scandir($path1);

		if(in_array('GeoLiteCity.dat.gz',$dir))
		{
		 $file_name = 'GeoLiteCity.dat.gz';
		 $path1 = $path1.$file_name;
		 
		// Raising this value may increase performance
		$buffer_size = 4096; // read 4kb at a time
		$out_file_name = str_replace('.gz', '', $path1);

		// Open our files (in binary mode)
		$file = gzopen($path1,'rb');
		$out_file = fopen($out_file_name, 'wb');

		// Keep repeating until the end of the input file
		while(!gzeof($file)) {
			// Read buffer-size bytes
			// Both fwrite and gzread and binary-safe
			fwrite($out_file, gzread($file, $buffer_size));
		}

		// Files are done, close files
		fclose($out_file);
		gzclose($file);
		// Delete .gz file
		unlink($path1);
		}
		$modified_time = date("D, M d Y H:i:s", @filemtime(WPMS_AB_PLUGIN_DIR_PATH."/database/GeoLiteCity.dat"));
		file_put_contents(WPMS_AB_PLUGIN_DIR_PATH."/database/geo_update_time.txt", print_r($modified_time, true));
		?>
        <p> Database is updated. </p>
        <?
	}
	else
	{
	?>
	<?php settings_fields('wpms_plugin_options'); ?>
	<?php $options = get_option('wpms_options'); ?>
	<form method="post" action="options.php">
	<?php settings_fields('wpms_plugin_options'); ?>
	<input name="wpn-update_settings" type="hidden" value="<?php echo wp_create_nonce('wpn-update_setting'); ?>" />
	<label>Welcome to WP Marketing Suite. Please select relevant options below to get started.</label>
	<br />
	<h3>Shortcodes</h3>
	Expand to view available shortcodes <a style='text-decoration:none;' href='javascript:void(0);' onclick="toggleVisibility('shortcodes');">[+]</a>
	<p>
	<div id='shortcodes' style='display: none'>
	Use these shortcodes to incorporate reader geolocation data into your blog posts
	<h4>Shortcodes</h4>
	Use these shortcodes to incorporate reader geolocation data into your blog posts
	<ul STYLE="list-style-type: square; list-style-position: inside">
	<li> [wpms_ip] - IP Address of the reader</li>
	<li> [wpms_city] - City of the reader
	<li> [wpms_postal_code] - Postal Code (zip) of the reader
	<li> [wpms_state_code] - Two letter State code of the reader
	<li> [wpms_country_name] - Country name of the reader
	<li> [wpms_country_code] - Two letter Country code of the reader
	<li> [wpms_latitude] - Latitude of the reader
	<li> [wpms_longitude] - Latitude of the reader
	</ul>

	<h4>Conditional Shortcodes - Only available in the body of the post</h4>
	Use these shortcodes to display customized content in your blog posts to readers
	<ul STYLE="list-style-type: square; list-style-position: inside">
	<li> [wpms_is_city_and_state city="Yardley" state_code="PA"]
	<li> [wpms_is_postal_code postal_code="90120"]
	<li> [wpms_is_postal_codes postal_code="90120,19067"]
	<li> [wpms_is_not_postal_code postal_codes="90120"]
	<li> [wpms_is_not_postal_codes postal_codes="90120,19067"]
	<li> [wpms_is_ip ip="xx.xx.xx.xx"]
	<li> [wpms_is_ips ip="xx.xx.xx.xx"]
	<li> [wpms_is_ips ips="xx.xx.xx.xx,aa.bb.cc.dd"]
	<li> [wpms_is_not_ip ip="xx.xx.xx.xx"]
	<li> [wpms_is_city city=""]
	<li> [wpms_is_not_cities" city="cityone,citytwo,citythree"]
	<li> [wpms_is_not_city" city=""]
	<li> [wpms_is_nearby"] - Uses the value you specify in the Nearby Range setting from the administrative panel
	<li> [wpms_is_not_nearby"]
	<li> [wpms_is_within miles="10"]
	<li> [wpms_is_within kilometers="12"]
	<li> [wpms_is_country_name country_name=""]
	<li> [wpms_is_country_code country_code=""]
	<li> [wpms_is_state_code state_code=""]
	<li> [wpms_is_not_country_name country_name=""]
	<li> [wpms_is_not_country_code country_code=""]
	<li> [wpms_is_not_country_codes country_codes=""]
	<li> [wpms_is_not_state_code state_code=""]
	<li> [wpms_is_user_agent user_agent=""]
	<li> [wpms_is_repeat_visitor repeat_visitor=""]
	<li> [wpms_custom_condition country_name="" conjuction="" referer="" ]
	</ul>

	<h4>Examples</h4>
	<ul STYLE="list-style-type: square; list-style-position: inside">
	<li> [wpms_is_nearby] Hi Neighbor! [/wpms_is_nearby] - Will display "Hi Neighbor!" to readers within a configurable distance from your home base.
	<li> [wpms_is_within miles=10] Stop on over, since you're in the area.[/wpms_is_within] - Will display "Come on over!" in the post body if the user is viewing the post from within 10 miles.
	<li> [wpms_is_ip ip=123.123.123.123] I used to own this IP Address [/wpms_is_ip] - Will display the message only if the user has that specific IP Address.
	<li> [wpms_is_city city="Yardley"] Hello Fellow Yardlian [/wpms_is_city] - Will display the message only if the user has that specific IP Address.
	<li> [wpms_is_user_agent user_agent="Windows"]This is for windows[/wpms_is_user_agent]
	<li> [wpms_is_repeat_visitor repeat_visitor="repeat visitor"] Not a new visitor[/wpms_is_repeat_visitor]
	<li> [wpms_custom_condition country_name="India" conjuction="AND" referer="google" ]India and google content.[/wpms_custom_condition]
	</ul>
	</div>
	<br>


	
	<h3>Options</h3>

				<table class="form-table">
					<tr>
						<th scope="row">Plugin Status</th>
						<td>
							  <input name="wpms_options[chk_enable_plugin]" id="chk_enable_plugin" type="checkbox" <?php if( $options['chk_enable_plugin'] ) echo 'checked="checked"'; ?> />
							  <label for="chk_enable_plugin">Enable WP Marketing Suite Plugin</label>

						</td>
					</tr>
					<tr>
						<th scope="row">License Key</th>
						<td>
							  <label><input size="40" name="wpms_options[license_key]" id="license_key" type="text" value="<?php echo $options['license_key']; ?>" />
							  <span style="color:#666666;margin-left:2px;">The License Key will be able you to update the plugin. <span style="color:#F00;"><?php echo edd_check_license();?></span></span></label>

						</td>
					</tr>
					<tr>
						<th scope="row">Your Google Maps API Key</th>
						<td>
							<label><input size=40 name="wpms_options[txt_gmaps_key]" value="<?php echo $options['txt_gmaps_key'];?>">
							<span style="color:#666666;margin-left:2px;">This is used when displaying Google Maps.  See <a href=https://developers.google.com/maps/signup>https://developers.google.com/maps/signup</a> for more information.</span>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Your Latitude</th>
						<td>
							<label><input size=40 name="wpms_options[txt_home_latitude]" value="<?php echo $options['txt_home_latitude'];?>">
							<span style="color:#666666;margin-left:2px;">This is used for calculating distance - used by the conditional shortcodes [wpms_is_within]</span>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Your Longitude</th>
						<td>
							<label><input size=40 name="wpms_options[txt_home_longitude]" value="<?php echo $options['txt_home_longitude'];?>">
							<span style="color:#666666;margin-left:2px;">This is used for calculating distance - used by the conditional shortcodes [wpms_is_within]</span>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Nearby Range</th>
						<td>
							<label><input size=10 name="wpms_options[txt_nearby_range]" value="<?php echo $options['txt_nearby_range'];?>">
							<span style="color:#666666;margin-left:2px;">In Miles or Kilometers (see unit setting) if less than this distance will be considered nearby.  Used by [wpms_is_nearby]</span>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default Distance in Kilometers Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_distance_kilometers]" value="<?php echo $options['txt_def_distance_kilometers'];?>">
							<span style="color:#666666;margin-left:2px;">Use this phrase for distance in kilometers if we can't geolocate the reader (shortcode [wpms_city])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default Distance in Miles Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_distance_miles]" value="<?php echo $options['txt_def_distance_miles'];?>">
							<span style="color:#666666;margin-left:2px;">Use this phrase for distance in miles if we can't geolocate the reader (shortcode [wpms_city])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default City Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_city]" value="<?php echo $options['txt_def_city'];?>">
							<span style="color:#666666;margin-left:2px;">Use this word in the city context if we can't geolocate the reader (shortcode [wpms_city])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default State Code Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_state_code]" value="<?php echo $options['txt_def_state'];?>">
							<span style="color:#666666;margin-left:2px;">Use this phrase for the state code if we can't geolocate the reader (shortcode [wpms_state_code])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default Postal Code Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_postal_code]" value="<?php echo $options['txt_def_postal'];?>">
							<span style="color:#666666;margin-left:2px;">Use this phrase for the postal code if we can't geolocate the reader (shortcode [wpms_postal_code])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default Country Name Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_country_name]" value="<?php echo $options['txt_def_country_name'];?>">
							<span style="color:#666666;margin-left:2px;">Use this word for the country name if we can't geolocate the reader (shortcode [wpms_country])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default Country Code Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_country_code]" value="<?php echo $options['txt_def_country_code'];?>">
							<span style="color:#666666;margin-left:2px;">Use this phrase for the country code if we can't geolocate the reader (shortcode [wpms_country])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default Latitude Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_latitude]" value="<?php echo $options['txt_def_latitude'];?>">
							<span style="color:#666666;margin-left:2px;">Use this word in the latitude context if we can't geolocate the reader (shortcode [wpms_latitude"])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default Longitude Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_longitude]" value="<?php echo $options['txt_def_longitude'];?>">
							<span style="color:#666666;margin-left:2px;">Use this word in the longitude context if we can't geolocate the reader (shortcode [wpms_longitude])</span><br />
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row">Default IP Address Phrase</th>
						<td>
							<label><input name="wpms_options[txt_def_ip]" value="<?php echo $options['txt_def_ip'];?>">
							<span style="color:#666666;margin-left:2px;">Use this word in the ip address context if we can't geolocate the reader (shortcode [wpms_ip address])</span><br />
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Content to be filtered</th>
						<td>
							<label><input name="wpms_options[chk_post_content]" type="checkbox" value="1" <?php checked('1', $options['chk_post_content']); ?> /> Blog Posts</label><br />
							<label><input name="wpms_options[chk_post_title]" type="checkbox" value="1" <?php checked('1', $options['chk_post_title']); ?> /> Post Title <em>(also filters recent posts sidebar widget)</em></label><br />
							<label><input name="wpms_options[chk_comments]" type="checkbox" value="1" <?php checked('1', $options['chk_comments']); ?> /> Comments <em>(filters comment author names too)</em></label><br />
						</td>
					</tr>
					<tr>
						<th scope="row">Filter Class</th>
						<td>
							<input name='wpms_options[txt_filter_cls]' value="<?php echo $options['txt_filter_cls'];?>">
							<span style="color:#666666;margin-left:2px;">Renders filtered content using this style/class id. eg: &lt;span class="yourclass"&gt;Your City&lt;/span&gt;</span>
						</td>
					</tr>
					<tr>
						<th scope="row">Date Format</th>
						<td>
							<select name='wpms_options[sel_date_format]'>
								<option <?php if ($options['sel_date_format']=='F j, Y, g:i a') { print "SELECTED"; };?> value='F j, Y, g:i a'><?php print date('F j, Y, g:i a');?></option>

								<option <?php if ($options['sel_date_format']=='m/d/Y') { print "SELECTED"; };?> value='m/d/Y'><?php print date('m/d/Y');?></option>
								<option <?php if ($options['sel_date_format']=='d/m/Y') { print "SELECTED"; };?> value='d/m/Y'><?php print date('d/m/Y');?></option>
								<option <?php if ($options['sel_date_format']=='D M j H:m:s') { print "SELECTED"; };?> value='D M j H:m:s'><?php print date('D M j H:m:s');?></option>
							</select>
							<span style="color:#666666;margin-left:2px;">Format to render date in - used by [wpms_database_date] Eg:'D, M d Y H:i:s' </span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Default Units</th>
						<td>
							<label><input name="wpms_options[rdo_units]" type="radio" value="miles" <?php checked('miles', $options['rdo_units']); ?> /> Miles </label><span style="color:#666666;">Use miles</span><br>
							<label><input name="wpms_options[rdo_units]" type="radio" value="kilometers" <?php checked('lower', $options['rdo_units']); ?> /> Kilometers </label><span style="color:#666666;">Use Kilometers</span><br>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Case Conversion</th>
						<td>
							<label><input name="wpms_options[rdo_case]" type="radio" value="upper" <?php checked('upper', $options['rdo_case']); ?> /> UPPER CASE </label><span style="color:#666666;">- Converts filtered content to UPPER CASE geolocation tags</span><br />
							<label><input name="wpms_options[rdo_case]" type="radio" value="lower" <?php checked('lower', $options['rdo_case']); ?> /> lower </label><span style="color:#666666;">- Converts filtered content to lower case geolocation tags</span><br />
							<label><input name="wpms_options[rdo_case]" type="radio" value="ucfirst" <?php checked('ucfirst', $options['rdo_case']); ?> /> Upper case first letter</label><span style="color:#666666;">- Converts filtered content to upper case first letter</span><br />
							<label><input name="wpms_options[rdo_case]" type="radio" value="off" <?php checked('off', $options['rdo_case']); ?> /> off </label><span style="color:#666666;">- Will not convert the case of filtered content</span>
						</td>
					</tr>
					<tr><td colspan="2"><div style="margin-top:10px;"></div></td></tr>
					<tr valign="top" style="border-top:#dddddd 1px solid;">
						<th scope="row">Database Options</th>
						<td>
							<label><input name="wpms_options[chk_default_options_db]" type="checkbox" value="1" <?php checked('1', $options['chk_default_options_db']); ?> /> Restore defaults upon plugin deactivation/reactivation</label>
							<br /><span style="color:#666666;margin-left:2px;">Only check this if you want to reset plugin settings upon reactivation</span>
						</td>
					</tr>
				</table>
				<p class="submit">
				<input type="submit" class="button-primary" value="Save Changes" />
				</p>
			</form>
	<h3>Database</h3>
	This product includes GeoLite data created by MaxMind, available from http://www.maxmind.com/.
	<p>
	As IP and geolocation data change over time, you should consider updating this database.  To update this database, download the latest version of the database from <a href=http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz>this link</a> and place it in the WP Marketing Suite Plugin database folder on your server.
	<p>
	Installation Instructions <a style='text-decoration:none;' href='javascript:void(0);' onclick="toggleVisibility('installation');">[+]</a>
	<p>
	<div id='installation' style='display: none'>
		<strong>Step 1</strong> - Download database from <a href=http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz>this link</a>.
	</p><p>	
		<strong>Step 2</strong> - Install database. Once you have uploaded the database, you will want to uncompress it. To uncompress the binary format, you will need to unzip the file. For example, to uncompress the GeoIP City binary database on Linux or Unix, you could run:
		<pre>$ tar xvfz GeoIP-133_20051201.tar.gz</pre>
		</p>
		<p>Then you will need to install the .dat file into a database directory of this plugin. This is found at /plugins/wp-marketing-suite/database
		</p>
        <p>If you have a current license you can also auto-update by clicking on "Update Now"  to the right below these instructions.</p>
		
	</div>
	<table>
	<tr>
	<th width='20%'>Latest Available from MaxMind</th>
	<th width='20%'>Installed Database</th>
	<th width='35%'>Database Path</th>
	<th width='15%'>Actions</th>
	</tr>
	<tr>
	<?php 
	$lmoddate=last_mod("http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz");
	
	$db_file = WPMS_AB_PLUGIN_DIR_PATH.'/database/geo_update_time.txt';
	$last_time =  file_get_contents($db_file);
	$time_str = strtotime($last_time);
	
		if($lmoddate == "" || strtotime($lmoddate) < $time_str){
		echo '<td style="text-align:center;"> No latest update</td>';
		}
		else {
        echo '<td style="text-align:center;">'.$lmoddate.'</td>';
		}
	
	$database=WPMS_AB_PLUGIN_DIR_PATH.'/database/GeoLiteCity.dat';
	@touch( $database,$time_str );
	
	if (is_file($database)) {
		if ($options['chk_enable_plugin']) {
			$dbdate=date("D, M d Y H:i:s", @filemtime("$database"));
			$dbstate='<td style="background-color:#99cc99; padding:4px;"><strong>MaxMind Database is installed and dated '.$dbdate.'</strong></td>';
			$install='Update Now';
			
		} else {
			$dbstate='<td style="background-color:#FFE991; padding:4px;"><strong>MaxMind Database is installed but this plugin is disabled.</strong></td>';
			$install='Update Now';
		}
	} else {
			$dbstate='<td style="background-color:#FFE991; padding:4px;"><strong>MaxMind Database not installed.</strong></td>';
			$install='Install Now';
	}
	echo $dbstate;
	
	?>

	<td style="padding:4px;">
	<?php echo WPMS_AB_PLUGIN_DIR_PATH."/database";?>
	</td>
	<td align="center">
	<?php
	if(strtotime($lmoddate) < $time_str)
	{
		echo "Updated";
	}
	else{
		echo '<a href="admin.php?page='.$_GET['page'].'&action=update-geolitecity">'.$install.'</a>';
	}
	?>
	</td>
	</tr>
	</table>
	<?php
	}// else ends here
	?>
	</div>
	<?php
	}// end render form

	function wpms_validate_options($input) {
		$input['txt_gmap_key'] =  wp_filter_nohtml_kses($input['txt_gmap_key']);
		$input['txt_def_city'] =  wp_filter_nohtml_kses($input['txt_def_city']);
		$input['txt_def_state_code'] = wp_filter_nohtml_kses($input['txt_def_state_code']);
		$input['txt_def_country_name'] = wp_filter_nohtml_kses($input['txt_def_country_name']);
		$input['txt_def_country_code'] = wp_filter_nohtml_kses($input['txt_def_country_code']);
		$input['txt_def_ip'] = wp_filter_nohtml_kses($input['txt_def_ip']);
		$input['txt_def_latitude'] = wp_filter_nohtml_kses($input['txt_def_latitude']);
		$input['txt_def_longitude'] = wp_filter_nohtml_kses($input['txt_def_longitude']);
		return $input;
	}

	// ***************************************
	// *** END - Create Admin Options    ***
	// ***************************************

	// ---------------------------------------------------------------------------------

	// ***************************************
	// *** START - Plugin Core Functions   ***
	// ***************************************

	function wpms_case_convert($word,$opt,$cls) {
			if ($cls=='') {
					$wpms_class_on='';
					$wpms_class_off='';
			} else {
					$wpms_class_on='<span class="'.$cls.'">';
					$wpms_class_off='</span>';
			}
		if($opt=='upper'){
			$word=strtoupper($word);
		} else if ($opt=='lower') {
			$word=strtolower($word);
		} else if ($opt=='ucfirst') {
			$word=ucfirst($word);
		}
		return $wpms_class_on.$word.$wpms_class_off;
	}//end function wpms_case_convert

	function wpms_get_location_info($user_ip) {
	$state_list= array( 'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming',);
		$tmp = get_option('wpms_options');
		$wpms_path = WPMS_AB_PLUGIN_DIR_PATH;
		$database = $wpms_path . '/database/GeoLiteCity.dat';
		$fp = @fopen($database, 'r');
		if ($fp==FALSE) {
		return FALSE;
		}
		require_once($wpms_path.'/includes/geocity.php');
		require_once($wpms_path.'/includes/geoip.php');

		$gi = geoip_open($wpms_path.'/database/GeoLiteCity.dat', GEOIP_STANDARD);

		$record = geoip_record_by_addr($gi, "$user_ip");
		
		geoip_close($gi);

		$location_info = array(); 

		$location_info['city_name']    = (isset($record->city)) ? $record->city : '~';
		$location_info['state_code']   = (isset($record->region)) ? strtoupper($record->region) : '~';
		$location_info['state_name']   = (isset($record->region)) ? $state_list[$record->region] : '~' ;
		$location_info['postal_code']   = (isset($record->postal_code)) ? strtoupper($record->postal_code) : '~';
		$location_info['country_name'] = (isset($record->country_name)) ? $record->country_name : '~';
		$location_info['country_code'] = (isset($record->country_code)) ? strtoupper($record->country_code) : '~';
		$location_info['latitude']     = (isset($record->latitude)) ? $record->latitude : '~';
		$location_info['longitude']    = (isset($record->longitude)) ? $record->longitude : '~';

		return $location_info;

	}// end function get_location_info

	function wpms_get_ip_address() {
	if (getenv("HTTP_CLIENT_IP")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if(getenv("HTTP_X_FORWARDED_FOR")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if(getenv("REMOTE_ADDR")) 
		$ip = getenv("REMOTE_ADDR"); 
	else 
		$ip = "UNKNOWN";
	   return $ip;
	}// end function get_ip_address

	function wpms_get_cookie() {
	
	if(!isset($_COOKIE['wpms_cookie'])){
		
		$val = "";
		$value = "visitor";
		//setcookie("wpms_cookie", $value, time() + (86400*365));
	?>
		<script type="text/javascript">
		// Cookies
		function createCookieGeo(name, value, days) {
			if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
				var expires = "; expires=" + date.toGMTString();
			}
			else var expires = "";

			document.cookie = name + "=" + value + expires + "; path=/";
		}
		createCookieGeo("wpms_cookie", "<?php echo $value; ?>", <?php echo "1"; ?>);
		</script>
	<?php
		return $val;
	} else {
	
		$val = "repeat visitor";
		return $val;
	}
	
	}

	function read_header($ch, $header) 
	{ 
		global $modified; 
		$length = strlen($header); 
		if(strstr($header, "Last-Modified:")) 
		{ 
			$modified = substr($header, 15); 
		} 
		return $length; 
	}//end function read_header 

	function last_mod($remote_file) 
	{ 
		global $modified; 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $remote_file); 
		curl_setopt($ch, CURLOPT_HEADER, 1); 
		curl_setopt($ch, CURLOPT_NOBODY, 1); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'read_header'); 

		$headers = curl_exec ($ch); 
		curl_close ($ch); 
		return $modified; 
	}//end function last_mod

	function distance($lat1, $lng1, $lat2, $lng2, $miles = true)
	{
		$pi80 = M_PI / 180;
		$lat1 *= $pi80;
		$lng1 *= $pi80;
		$lat2 *= $pi80;
		$lng2 *= $pi80;
	 
		$r = 6372.797; // mean radius of Earth in km
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$km = $r * $c;
	 
		return ($miles ? ($km * 0.621371192) : $km);
	}//end function distance

	function wpms_csv_find($string1,$string2) {
	// string1 is a csv list eg: one,two,three
	// string2 is a static value

		$strarr = explode(',',$string1);
		foreach($strarr as $ii) {
			if(trim(strtolower($ii)) == trim(strtolower($string2))) {
				return true;
			}
		}
		return false;
	} // end function wpms_find_string_in_array
	function wpms_list_all_countries() {

		$country_list = array(
			"Afghanistan",
			"Albania",
			"Algeria",
			"Andorra",
			"Angola",
			"Antigua and Barbuda",
			"Argentina",
			"Armenia",
			"Australia",
			"Austria",
			"Azerbaijan",
			"Bahamas",
			"Bahrain",
			"Bangladesh",
			"Barbados",
			"Belarus",
			"Belgium",
			"Belize",
			"Benin",
			"Bhutan",
			"Bolivia",
			"Bosnia and Herzegovina",
			"Botswana",
			"Brazil",
			"Brunei",
			"Bulgaria",
			"Burkina Faso",
			"Burundi",
			"Cambodia",
			"Cameroon",
			"Canada",
			"Cape Verde",
			"Central African Republic",
			"Chad",
			"Chile",
			"China",
			"Colombi",
			"Comoros",
			"Congo (Brazzaville)",
			"Congo",
			"Costa Rica",
			"Cote d'Ivoire",
			"Croatia",
			"Cuba",
			"Cyprus",
			"Czech Republic",
			"Denmark",
			"Djibouti",
			"Dominica",
			"Dominican Republic",
			"East Timor (Timor Timur)",
			"Ecuador",
			"Egypt",
			"El Salvador",
			"Equatorial Guinea",
			"Eritrea",
			"Estonia",
			"Ethiopia",
			"Fiji",
			"Finland",
			"France",
			"Gabon",
			"Gambia, The",
			"Georgia",
			"Germany",
			"Ghana",
			"Greece",
			"Grenada",
			"Guatemala",
			"Guinea",
			"Guinea-Bissau",
			"Guyana",
			"Haiti",
			"Honduras",
			"Hungary",
			"Iceland",
			"India",
			"Indonesia",
			"Iran",
			"Iraq",
			"Ireland",
			"Israel",
			"Italy",
			"Jamaica",
			"Japan",
			"Jordan",
			"Kazakhstan",
			"Kenya",
			"Kiribati",
			"Korea, North",
			"Korea, South",
			"Kuwait",
			"Kyrgyzstan",
			"Laos",
			"Latvia",
			"Lebanon",
			"Lesotho",
			"Liberia",
			"Libya",
			"Liechtenstein",
			"Lithuania",
			"Luxembourg",
			"Macedonia",
			"Madagascar",
			"Malawi",
			"Malaysia",
			"Maldives",
			"Mali",
			"Malta",
			"Marshall Islands",
			"Mauritania",
			"Mauritius",
			"Mexico",
			"Micronesia",
			"Moldova",
			"Monaco",
			"Mongolia",
			"Morocco",
			"Mozambique",
			"Myanmar",
			"Namibia",
			"Nauru",
			"Nepa",
			"Netherlands",
			"New Zealand",
			"Nicaragua",
			"Niger",
			"Nigeria",
			"Norway",
			"Oman",
			"Pakistan",
			"Palau",
			"Panama",
			"Papua New Guinea",
			"Paraguay",
			"Peru",
			"Philippines",
			"Poland",
			"Portugal",
			"Qatar",
			"Romania",
			"Russia",
			"Rwanda",
			"Saint Kitts and Nevis",
			"Saint Lucia",
			"Saint Vincent",
			"Samoa",
			"San Marino",
			"Sao Tome and Principe",
			"Saudi Arabia",
			"Senegal",
			"Serbia and Montenegro",
			"Seychelles",
			"Sierra Leone",
			"Singapore",
			"Slovakia",
			"Slovenia",
			"Solomon Islands",
			"Somalia",
			"South Africa",
			"Spain",
			"Sri Lanka",
			"Sudan",
			"Suriname",
			"Swaziland",
			"Sweden",
			"Switzerland",
			"Syria",
			"Taiwan",
			"Tajikistan",
			"Tanzania",
			"Thailand",
			"Togo",
			"Tonga",
			"Trinidad and Tobago",
			"Tunisia",
			"Turkey",
			"Turkmenistan",
			"Tuvalu",
			"Uganda",
			"Ukraine",
			"United Arab Emirates",
			"United Kingdom",
			"United States",
			"Uruguay",
			"Uzbekistan",
			"Vanuatu",
			"Vatican City",
			"Venezuela",
			"Vietnam",
			"Yemen",
			"Zambia",
			"Zimbabwe"
		);
		return implode("<BR>",$country_list);
	}

	add_action('admin_init','my_plugin_admin_init');
	function my_plugin_admin_init() {
	   /* Register our stylesheet. */
	   wp_register_style( 'wpgeocodeStylesheet', plugins_url('/wp-marketing-suite/style.css') );
	   wp_enqueue_style( 'wpgeocodeStylesheet' );
	   /*Register custom functions script*/
	   wp_register_script( 'wpgeocodeScript', plugins_url('/wp-marketing-suite/js/function.js') );
	   wp_enqueue_script( 'wpgeocodeScript' );
	}
	/* Function to get users device os*/
	$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

	function getOS() { 

		global $user_agent;

		$os_platform    =   "Unknown OS Platform";

		$os_array       =   array(
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

		foreach ($os_array as $regex => $value) { 

			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}

		}   

    return $os_platform;

	}
	
	/* Widget Segmentation code starts here */
	add_action( 'widgets_init', 'wpms_load_widgets' );
	/**
	 * Register Wpms widget.
	*/

	function wpms_load_widgets() {
		register_widget( 'Wpms_Widget' );
		}
		
	class Wpms_Widget extends WP_Widget {
		/**
		 * Wpms Widget setup.
		*/
		function Wpms_Widget() 
		{
			$widget_ops = array( 'classname' => 'wpms', 'description' => __('Wp Marketing Suite Widget.', 'wpms') );
			$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'wpms-widget' );
			$this->WP_Widget( 'wpms-widget', __('WPMS', 'Widget'), $widget_ops, $control_ops );
		}
		
		/**
		 * Widget function displays the widget on the screen.
		 */
		function widget( $args, $instance ) 
		{
		
			extract( $args );
			
			$title = apply_filters('widget_title', $instance['title'] );
			$name = $instance['name'];
			$segmentation_enable = isset( $instance['segmentation_enable'] ) ? $instance['segmentation_enable'] : false;
			
			global $wpdb;
			$user_segments = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."ms_custom_shortcode` ORDER BY `date` DESC");

			if($segmentation_enable)
			{	
	
				for($i = 0; $i < (count($user_segments)); $i++) 
				{
					$shortcode = $user_segments[$i];
					$id = $shortcode->id;
					$abc = "segmentation_".$id;
					$val = isset( $instance["$id"] ) ? $instance["$id"] : false;
					
					if ( $name && $val )
					{
						$abcde  =  "[wpms_custom_condition id=".$id."]";
						$abcde .=  $before_widget;
						$abcde .=  $before_title . $title . $after_title;
						$abcde .=  " ".$name." ";
						$abcde .=  "[/wpms_custom_condition]";
						$abcde .=  $after_widget;
						
						echo do_shortcode($abcde);
					}
				}
			}
		}
		/**
		 * Update the widget settings.
		*/
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['name'] =  $new_instance['name'];
			$instance['segmentation_enable'] = $new_instance['segmentation_enable'];
			
			global $wpdb;
			$user_segments = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."ms_custom_shortcode` ORDER BY `date` DESC");
			for($i = 0; $i < (count($user_segments)); $i++) {
			$shortcode = $user_segments[$i];
			$id = $shortcode->id;
			$instance["$id"] = $new_instance["$id"];
			}
			return $instance;
		}
		
		/**
		 * Displays the widget settings controls on the widget panel.
		 */
		
		function form( $instance ) {
		?>
		<div class="wrap">
		<?php
			$defaults = array('segmentation_enable' => on );
			$new_inst = $instance;
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<!-- Widget Title: Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
			</p>
			<!-- Widget Text: -->
			<p>
				<textarea id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" style="width: 100%" cols="20" rows="12"><?php echo $instance['name']; ?></textarea>
			</p>
			<table style="margin-left: 5px;">
			<tr>
				<td><img src="<?php echo WPMS_AB_PLUGIN_URL_PATH; ?>/assets/Archery-Target-icon-35x35.png" alt="WP Geocode" /></td>
				<td><h2 style="font-size: 19px; font-weight: bold">WP Marketing Suite </h2></td>
			</tr>
			</table>
			<p>
				<span style="font-weight:bold">Segmentation:</span>
				<input class="checkbox" type="checkbox" <?php checked( $instance['segmentation_enable'], on ); ?> id="<?php echo $this->get_field_id( 'segmentation_enable' ); ?>" name="<?php echo $this->get_field_name( 'segmentation_enable' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'segmentation_enable' ); ?>"><?php _e('Enable', 'wpms'); ?></label>
			</p>
			<div id= "show_segments" style="background-color: #d9d9d9; padding-left: 15px; width: 100%;">
			<p style="font-weight:bold; font-size: 12px;"> Select which segments this widget will be shown to </p>
			
			<?php 
			global $wpdb;
			$user_segments = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."ms_custom_shortcode` ORDER BY `date` DESC");
			for($i = 0; $i < (count($user_segments)); $i++) {
			$shortcode = $user_segments[$i];
			$id = $shortcode->id;
			?>
			
			<p>
				<label for="<?php echo $id; ?>" style="padding-right: 67px;"><?php _e( "Shortcode ".$id , 'wpms'); ?></label>
				<input class="checkbox" type="checkbox" <?php checked( $new_inst["$id"] , on ); ?> id="<?php echo $this->get_field_id( $id ); ?>" name="<?php echo $this->get_field_name( $id ); ?>" />
			</p>
			<?php 
			}
			?>
			</div>
		</div>
		<?php
		}
	}
	add_filter('widget_text', 'do_shortcode');