<?php
$id = $_GET['edit'];
$shortcode = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."ms_custom_shortcode` WHERE `id` = '$id'");
if(count($shortcode))
{
	$atts = shortcode_parse_atts($shortcode[0]->custom_shortcode);
	$order = unserialize($shortcode[0]->order);
	$filtered_atts = array();
	
	/*convert into an array*/
	foreach($atts as $attribute_name => $values)
	{
		 if(!is_int($attribute_name))
		 {
			$values_array = explode(',',$values);
			$filtered_atts[$attribute_name] = $values_array;
			
		 }
	}
	//print_r($filtered_atts);
	/*set order*/
	$stage_array = array();
	foreach($order as $key => $dimension)
	{
		
		$stage_array[$dimension][$key] = $filtered_atts[$dimension][0];
		unset($filtered_atts[$dimension][0]);
		$filtered_atts[$dimension] = array_values($filtered_atts[$dimension]);
		
	}
	//print_r($stage_array);
	$save_index = 0;
	$to_be_edit = array();
	foreach($order as $key => $dimension)
	{	
		//echo '{{'.$dimension.']['.$save_index.'}}';	
		array_push($to_be_edit,array('conjuction' => '', 'dimension' => $dimension , 'operator' => $filtered_atts['operator'][$save_index], 'value' => $stage_array[$dimension][$save_index]));
			
		$save_index++;
	}
	/*add conjuction operators*/
	for($i = 1; $i < count($to_be_edit) ; $i++)
	{
		$to_be_edit[$i]['conjuction'] = $filtered_atts['conjuction'][$i - 1];
	}
	//echo "to - be edit";
	//print_r($to_be_edit);
	?>
    <div>
    <h2>Edit Custom Shortcode</h2>
        <form onSubmit="return dimension.validate(this);" method="POST" action="?page=conditional-custom-shortcode">
            <table class="" id="dimensions" width="48%">
                <tbody>
                    <tr>
                        <th width="5%"><label>Conjuction</label></th><th width="60%"><label>Dimension</label></th><th width="15%"><label>Operator</label></th><th width="5%"><label>Value</label></th><th width="5%">&nbsp;</th>
                    </tr>
					<?php
                    foreach($to_be_edit as $key => $value)
                    {
                        makeDRow($key,$value['conjuction'],$value['dimension'],$value['operator'],$value['value']);
                    }
					//print_r($to_be_edit);
                    ?>
		          </tbody>
                  </table>
                 <p class="submit">
                    <input class="button button-primary" type="submit" value="Save" name="submit" />
                 </p>
                 <input type="hidden" name="id" value="<?php echo $id;?>"/>
                 <input type="hidden" name="action" value="update"/>
            </form>
        </div>
    <?php
	//print_r($to_be_edit);
}
else
{
	echo "Error.";
}
			?>

                   
                
<?php
function makeDRow($index,$conjuction='',$dimension='',$operator='',$value='')
{
	?>
     <tr>
        <td>
        	<?php if($conjuction)
			{
				?>
                <select name="conjuction[]">
                    <option value="&&" <?php if($conjuction == '&&') echo "selected='selected'";?>>AND</option>
                    <option value="||" <?php if($conjuction == '||') echo "selected='selected'";?>>OR</option>
                </select>
                <?php
			}
			else
			{
				?>	
				&nbsp;
				<?php
			}
			?>
            
        </td>
        <td>
        	<?php
				$select_width = '100%';
				$input_type_text = '';
				
				if($dimension == 'url_parameter')
				{
					list($n,$v) = explode('=',$value);
					$value = $v;
					$select_width = '66%';
					$input_type_text = '<input style="width:30%" type="text" name="url_parameter_name['.$index.']" maxlength="45" size="10" value="'.$n.'" />';
				}
			?>
            <select style="width:<?php echo $select_width; ?>;"  name="dimension[]" onchange="dimension.createUI(this);">
                <option value="country_name" <?php if($dimension == 'country_name') echo "selected='selected'";?>>Country</option>
                <option value="city" <?php if($dimension == 'city') echo "selected='selected'";?>>City</option>
                <option value="user_agent" <?php if($dimension == 'user_agent') echo "selected='selected'";?>>User Agent</option> 
                <option value="referer" <?php if($dimension == 'referer') echo "selected='selected'";?>>Referer</option>                                    
                <option value="url_parameter" <?php if($dimension == 'url_parameter') echo "selected='selected'";?>>URL Parameter</option>                                    
            </select>
			<?php echo $input_type_text; ?>
        </td>
        <td>
            <select name="operator[]">
                    <option value="==" <?php if($operator == '==') echo "selected='selected'";?>>=</option>
                    <option value="!=" <?php if($operator == '!=') echo "selected='selected'";?>>!=</option>
                    <option value="regexp" <?php if($operator == 'regexp') echo "selected='selected'";?>>REGEXP</option>
                    <option value="contains" <?php if($operator == 'contains') echo "selected='selected'";?>>Contains</option>
            </select>
        </td>
        <td>
            <input type="text" name="value[]" maxlength="45" value="<?php echo $value;?>" size="10" />
        </td>
        <td>
	        <?php if($conjuction == '')
			{
				?>
				<a href="javascript:void(0)" onClick="dimension.append();" >[+]</a>
				<?php
            }
			else
			{
				?>
                <a href="javascript:void(0)" onclick="dimension.remove(jQuery(this).parent().parent());">[x]</a>
                <?php
			}
			?>
        </td>
    </tr>
    <?
}
?>