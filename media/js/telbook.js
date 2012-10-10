var searchValue = $('#telno').val();

$(document).ready(function()
{
	$('#vehicle_id').change(function() {telbook.SetTelBook1();});
	$('#vehicle_id').focus(function() {telbook.SetTelBook1();});
	$('#security_code').change(function() {telbook.plateUpdate();});
	$('#security_code').keyup(function() {telbook.plateUpdate();});
});

var telbook = new function() 
{
	this.SetTelBook1 = function ()
	{
		var plate = $('#vehicle_id').val();
		var tmpstr = "";			
		telbook.plateUpdate();
		telbook_params = 'option=sideinfo&fields=telno,username,mobile&table=vw_telbooks_available&idfield=vehicle_id&idval='+ plate + '&format=*;*;*';
		siteutils.runQuery(telbook_params,"telno","val");
		setTimeout(telbook.checkSearchChanged,500);
	}
		
	this.SetTelBook2 = function()
	{
		var arr = $('#telno').val().split(",");
		$('#telno').val(arr[0]);
		$('#username').val(arr[1]);
		$('#mobile').val(arr[2]);
	}

	this.checkSearchChanged = function() 
	{
		var currentValue = $('#telno').val();
		if ((currentValue) && currentValue != searchValue && currentValue != '') 
		{
			searchValue = currentValue;
			telbook.SetTelBook2();
		} 
		else
		{
			setTimeout(telbook.checkSearchChanged,500);
		}
	}

	this.plateUpdate = function() 
	{
		var str = $('#security_code').val().toUpperCase();
		$('#security_code').val(str);
		$('#plate').val(  $('#vehicle_id').val()+$('#security_code').val() );
	}
}
