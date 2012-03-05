var searchValue = $('#telno').val();

$(document).ready(function()
{
	if($('#current_no').val() == '1') //new telbook recor, special case
	{
		$('#plate').change(function() {telbook.SetTelBook1();});
		$('#plate').focus(function() {telbook.SetTelBook1();});
	}
});

var telbook = new function() 
{
	this.SetTelBook1 = function ()
	{
		var plate = $('#plate').val();
		var tmpstr = "";			
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
}
