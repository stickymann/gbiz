var init_expiry_date;
var init_issue_date;

$(document).ready(function()
{
	//$('#vehicle_id').change(function() { certofinstallation.UpdateFields(); });
	$('#vehicle_id').focus(function() { certofinstallation.UpdateFields(); });

	if( $('#current_no').val() == '0' )
	{
		if( $('#certificate_id').val() == '' )
		{
			certofinstallation.CreateCertID();
		}
	}
	certofinstallation.RemoveCertficateChangeStatus();
});
		
var certofinstallation = new function()
{
	this.CreateTillID = function ()
	{
		var current_date = siteutils.currentDate('Y-m-d');
		current_date = current_date.split("-").join("");
		var till_id = $('#js_idname').val() + "-" + current_date;
		$('#till_id').val(till_id);
	}

	this.CreateCertID = function ()
	{
		ctrlid = $('#id').val();
		order_params = "option=orderid&controller=certofinstallation&prefix=VT&ctrlid=" + ctrlid;
		siteutils.runQuery(order_params,'certificate_id','val');
	}

	this.ToggleCertificateStatus = function() 
	{
		if($('#certificate_status').val() == "RETIRED") { $('#certificate_status').val("ACTIVE"); } else { $('#certificate_status').val("RETIRED"); }
	}

	this.ToggleInstallationType = function() 
	{
		if($('#installation_type').val() == "Inspection") { $('#installation_type').val("New"); } else { $('#installation_type').val("Inspection"); }
		this.SetInstallationTypeDate();
	}

	this.ToggleYesNoType = function(idfield) 
	{
		if($('#' + idfield).val() == "yes") { $('#' + idfield).val("no"); } 
		else if ($('#' + idfield).val() == "no") { $('#' + idfield).val("n/a"); } 
		else { $('#' + idfield).val("yes"); }		
	}

	this.SetInstallationTypeDate = function()
	{
		if($('#installation_type').val() == "Inspection") 
		{ 
			$('#expiry_date').val( "" );
			$('#issue_date').val( "" );
		} 
		else 
		{ 
			$('#expiry_date').val( init_expiry_date );
			$('#issue_date').val( init_issue_date );
		}
	}

	this.RemoveCertficateChangeStatus = function()
	{
		if($('#certificate_status').val() == "EXPIRED")
		{
			$('#certificate_status_sidelink').html("");
		}
	}

	this.UpdateFields = function()
	{
		var vehicle_id = $('#vehicle_id').val(); 
		var url = siteutils.getAjaxURL() + "option=jdata&dbtable=vw_vehicle_accounts&fields=chassis_number,vehicletype,make,vehicle_model,color,first_name,last_name,address1,address2,city,device_model,device_tag_id,warranty_expiry_date,installation_date,installer_fullname&prefix=&wfields=vehicle_id&wvals=" + vehicle_id;
		$.getJSON(url, function(data){
			$('#chassis_number').val( data[0].chassis_number );
			$('#vehicle_type').val( data[0].vehicletype );
			$('#vehicle_make').val( data[0].make );
			$('#vehicle_model').val( data[0].vehicle_model );
			$('#vehicle_colour').val( data[0].color );
			$('#first_name').val( data[0].first_name );
			$('#last_name').val( data[0].last_name );
			$('#address1').val( data[0].address1 );
			$('#address2').val( data[0].address2 );
			$('#city').val( data[0].city );
			$('#device_model').val( data[0].device_model );
			$('#device_serial_no').val( data[0].device_tag_id );
			$('#signature_name').val( data[0].installer_fullname );
			init_expiry_date = data[0].warranty_expiry_date;
			init_issue_date = data[0].installation_date;
			certofinstallation.SetInstallationTypeDate();
		
			if( $('#device_model').val() == "GIT101" )
			{
				$('#commisioning_fld10').val("yes");
				$('#usrinstr_fld07').val("yes");
				$('#usrinstr_fld08').val("yes");
				$('#usrinstr_fld09').val("yes");
			}
			else if( $('#device_model').val() == "G10" )
			{
				$('#commisioning_fld10').val("n/a");
				$('#usrinstr_fld07').val("n/a");
				$('#usrinstr_fld08').val("n/a");
				$('#usrinstr_fld09').val("n/a");
			}
		});
	}
}
