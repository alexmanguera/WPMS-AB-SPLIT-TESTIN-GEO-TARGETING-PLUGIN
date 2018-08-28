jQuery(document).ready(function() {
	
	//Event Dates - DatePicker
	jQuery( "#wpms_startDate" ).datepicker({
	  numberOfMonths: 2,
	  dateFormat: 'yy-mm-dd',
	  minDate: '0',
	  onClose: function( selectedDate ) {
		jQuery( "#wpms_endDate" ).datepicker( "option", "minDate", selectedDate );
	  }
	});
	jQuery( "#wpms_endDate" ).datepicker({
	  numberOfMonths: 2,
	  dateFormat: 'yy-mm-dd',
	  onClose: function( selectedDate ) {
		jQuery( "#wpms_startDate" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});
	
	// ------------------------------------------------
	//Event Dates - DatePicker
	jQuery( "#wpms_startDate2" ).datepicker({
	  numberOfMonths: 2,
	  dateFormat: 'yy-mm-dd',
	  minDate: '0',
	  onClose: function( selectedDate ) {
		jQuery( "#wpms_endDate2" ).datepicker( "option", "minDate", selectedDate );
	  }
	});
	jQuery( "#wpms_endDate2" ).datepicker({
	  numberOfMonths: 2,
	  dateFormat: 'yy-mm-dd',
	  onClose: function( selectedDate ) {
		jQuery( "#wpms_startDate2" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});
	
	jQuery('#wpms_ab_tabs')
    .tabs()
    .addClass('ui-tabs-vertical ui-helper-clearfix');
		
});
/**********************************/
function addRow() {
	var myRow = '<tr>';
	
		myRow += '<td>';
		myRow += '<label class="variation-label-name" for="variationName[]">Name </label>';
		myRow += '<input type="text" name="variationName[]" class="variationField" required>';
		myRow += '</td>';
		
		myRow += '<td>';
		myRow += '<label class="variation-label" for="variation[]">Content </label>';
		myRow += '<input type="text" name="variation[]" class="variationField" required>';
		myRow += '</td>';
		
		myRow += '<td>';	
		myRow += '<label class="class-label" for="class[]">Element Class </label>';
		myRow += '<input type="text" name="variationClass[]" class="variationField">';
		myRow += '</td>';
		
		myRow += '<td>';
		myRow += '<a href="javascript:;" onClick="jQuery(this).closest('+"'tr'"+').remove();" class="remove_field_button" style="text-decoration:none;">[-]</a>';
		myRow += '</td>';
		
		myRow += '</tr>';

	if(jQuery("#variants tr").length < 5)
	{
		jQuery("#variants tr:last").after(myRow);
	}
	else
	{
		alert('Maximum of 5 variants only.');
	}
}
/**********************************/


/* ----------------------- */
/* Geolocate */
function Dimension()

{

	this.row_index = 0;

	this.validate = function(form)

	{

		var _return_ = true;

		jQuery(form).find("input[type='text']").each(function(index, element) {

           if( jQuery(this).val() == '')

			{

				alert('Please fill value.');	

				jQuery(this).focus();

				_return_ = false;

				return false;

			}

        });

		return _return_;

	}

	this.append = function()

	{

		var new_table_row = '<tr>';

			   

			   new_table_row += '<td><select name="conjuction[]"><option value="&&">AND</option><option value="||" >OR</option></select></td>';

			   new_table_row += '<td><select name="dimension[]" style="width:100%;" onchange="dimension.createUI(this);"><option value="country_name">Country</option><option value="city" >City</option><option value="user_agent" >User Agent</option><option value="referer" >Referer</option><option value="url_parameter" >URL Parameter</option></select></td>';

			   new_table_row += '<td><select name="operator[]"><option value="==">=</option><option value="!=">!=</option><option value="regexp">REGEXP</option><option value="contains">Contains</option></select></td>';

			   new_table_row += '<td><input type="text" name="value[]" maxlength="45" value="" size="10" /></td>';

			   new_table_row += '<td><a onclick="dimension.remove(jQuery(this).parent().parent());" href="javascript:void(0)">[x]</a></td>'

		   new_table_row += '</tr>';

		if(jQuery("table#dimensions tr").length < 6)

		{					

			jQuery("table#dimensions tr:last").after(new_table_row);

			this.row_index++;

		}

		else

		{

			alert('You can add only 5.');

		}

	}

	this.remove = function(_this)

	{

		jQuery(_this).remove();

		this.row_index--;

	}

	this.openHelp =  function (_this)

	{

		if(jQuery(_this).parent().next().css('display') == 'none')

		{

			jQuery(_this).text('[-]');

			jQuery(_this).parent().next().show();

		}

		else

		{

			jQuery(_this).text('[+]');

			jQuery(_this).parent().next().hide();

		}

	}

	this.createUI = function(_this)

	{



		var dimension = jQuery(_this).val();

		switch(dimension)

		{

			case 'url_parameter':

				var this_row_index =  jQuery(_this).parent().parent().index() - 1;

				jQuery(_this).css('width','66%');

				jQuery(_this).after("<input style='width:30%' type='text' name='url_parameter_name[" + this_row_index + "]' maxlength='45' size='10' value='name' />");

			break;

			default:

				jQuery(_this).next().remove();

				jQuery(_this).css('width','100%');

			break;	

		

		}

	}

	this.pingURL = function(_this)

	{

		/*

		Check ping to remote site

		91C1880DBBCF35393EB3D585D52C09CB

		91c1880dbbcf35393eb3d585d52c09cb

		*/

	}

}

var dimension = new Dimension();



function toggleVisibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
}
/* ----------------------- */