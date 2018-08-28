<form method="POST" action="?page=conditional-custom-shortcode">
    <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <select name="bulk-action">
                <option selected="selected" value="-1">Bulk Actions</option>
                <option value="delete">Delete</option>
            </select>
            <input type="submit" value="Apply" class="button action" id="doaction" name="apply-bulk-action">
        </div>   
    </div>
    <table class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th class="manage-column column-cb check-column" scope="col"><input type="checkbox" name="ckall" /></th> 
                <th class="manage-column column-columnname" scope="col">Shortcode</th>
                <th class="manage-column column-columnname" scope="col">Conditional</th>
                <th class="manage-column column-columnname" scope="col">Date</th> 
            </tr>
        </thead>
        <tfoot>
        <tr>
                <th class="manage-column column-cb check-column" scope="col"><input type="checkbox" name="ckall" /></th> 
                <th class="manage-column column-columnname" scope="col">Shortcode</th>
                <th class="manage-column column-columnname" scope="col">Conditional</th>
                <th class="manage-column column-columnname" scope="col">Date</th>
        </tr>
        </tfoot>
        <tbody>
            <?php
            foreach($shortcodes as $key => $shortcode)
            {
                ?>
            <tr class="alternate" valign="top"> 
                <th class="check-column" scope="row"><input type="checkbox" name="id[]" value="<?php echo $shortcode->id;?>" /></th>
                <td class="column-columnname">[wpms_custom_condition id="<?php echo $shortcode->id;?>"]Your content.[/wpms_custom_condition]
                    <div class="row-actions submitbox">
                        <span><a href="?page=conditional-custom-shortcode&edit=<?php echo $shortcode->id;?>">Edit</a> |</span>
                        <span class="thrash"><a class="submitdelete" href="<?php echo $_SERVER['REQUEST_URI'];?>&action=delete&id=<?php echo $shortcode->id;?>">Delete</a></span>
                    </div>
                </td>
                <td class="column-columnname"><?php echo $shortcode->custom_shortcode;?>
                </td>
                <td class="column-columnname"><?php echo $shortcode->date;?></td>
            </tr>
            <?php
            }
            ?>
            
        </tbody>
    </table>
</form>
		