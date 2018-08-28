<div>
    <h2>Add New Custom Shortcode</h2>
        <form onSubmit="return dimension.validate(this);" method="POST" action="?page=conditional-custom-shortcode">
            <table class="" id="dimensions" width="48%">
                <tbody>
                    <tr>
                        <th width="5%"><label>Conjuction</label></th><th width="60%"><label>Dimension</label></th><th width="15%"><label>Operator</label></th><th width="5%"><label>Value</label></th><th width="5%">&nbsp;</th>
                    </tr>
                    <tr>
                        <td>&nbsp;
                            
                        </td>
                        <td>
                            <select style="width:100%" name="dimension[]" onChange="dimension.createUI(this);">
                                <option value="country_name">Country</option>
                                <option value="city" >City</option>
                                <option value="user_agent" >User Agent</option> 
                                <option value="referer" >Referer</option>
                                <option value="url_parameter" >URL Parameter</option>	                                    
                            </select>
                        </td>
                        <td>
                            <select name="operator[]">
                                    <option value="==">=</option>
                                    <option value="!=">!=</option>
                                    <option value="regexp">REGEXP</option>
                                    <option value="contains">Contains</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="value[]" maxlength="45" value="" size="10" />
                        </td>
                        <td>
                            <a href="javascript:void(0)" onClick="dimension.append();" >[+]</a>
                        </td>
                    </tr>
                </tbody>
          </table>
         <p class="submit">
            <input class="button button-primary" type="submit" value="Save" name="submit">
         </p>
         <input type="hidden" name="action" value="add"/>
    </form>
</div>

<div>
	<p>Expand to view shortcode help <a href="javascript:void(0)" onClick="dimension.openHelp(this);" >[+]</a></p>
    <div style="display:none;">
        <h4>We have the following dimensions</h4>
    	<ul style="list-style-type: square; list-style-position: inside">
        	<li>Country: This can be a simple text.</li>
            <li>City: This can be a simple text.</li>
            <li>User Agent: Like Mac, Windows, Firefox. Use of 'Contains' and 'REGEXP' operators are recomended.</li>
            <li>Referer: This is the domain. Eg. http://www.google.co.nz/url?sa=t&url=http://mywordpressblog.com. In this 'google.co.nz' is referer.</li>
            <li>URL Parameter: URL Parameter is a query string.</li>
        </ul>
    </div>
</div>