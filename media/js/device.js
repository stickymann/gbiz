var sms_server	= $('#sms_server').val(); 
var gprs_server = $('#gprs_server').val(); 
var realtime_useraccount = $('#realtime_useraccount').val(); 
var realtime_password = $('#realtime_password').val(); 
var realtime_appname = $('#realtime_appname').val(); 

$(document).ready(function()
{
	device.SetSMS();
	device.SetGPRS();
	$('#imei').focus(function() { device.SetModel(); });
	$('#sms_enabled').change(function() {device.SetSMS();});
	$('#gprs_enabled').change(function() {device.SetGPRS();});
	if( $('#phone_textback2').val() == '0' ){ $('#phone_textback2').val(''); }
	if( $('#order_id').val() == '0' ){ $('#order_id').val(''); }
});
		
var device = new function()
{
	this.SetSMS = function()
	{
		if($('#sms_enabled').val()=='N')
		{
			sms_server	= $('#sms_server').val();
			$('#sms_server').val('0000000');
			$('#sms_server').attr('disabled',true);
		}
		else
		{
			$('#sms_server').val(sms_server);
			$('#sms_server').removeAttr('disabled');
		}
	}
		
	this.SetGPRS = function()
	{
		if($('#gprs_enabled').val()=='N')
		{
			gprs_server	= $('#gprs_server').val();
			$('#gprs_server').val('NONE');
			$('#gprs_server').attr('disabled',true);

			realtime_useraccount = $('#realtime_useraccount').val();
			$('#realtime_useraccount').val('');
			$('#realtime_useraccount').attr('readonly',true);

			realtime_password	= $('#realtime_password').val();
			$('#realtime_password').val('');
			$('#realtime_password').attr('readonly',true);

			realtime_appname	= $('#realtime_appname').val();
			$('#realtime_appname').val('');
			$('#realtime_appname').attr('readonly',true);
		}
		else
		{
			$('#gprs_server').val(gprs_server);
			$('#gprs_server').removeAttr('disabled');  

			$('#realtime_useraccount').val(realtime_useraccount);
			$('#realtime_useraccount').removeAttr('readonly');  

			$('#realtime_password').val(realtime_password);
			$('#realtime_password').removeAttr('readonly'); 

			$('#realtime_appname').val(realtime_appname);
			$('#realtime_appname').removeAttr('readonly');
		}
	}
	
	this.SetModel = function()
	{
		var imei = $('#imei').val(); 
		var url = siteutils.getAjaxURL() + "option=jdata&dbtable=vw_device_instock&fields=product_id&prefix=&wfields=serial_no&wvals=" + imei;
		$.getJSON(url, function(data){
			$('#model').val( data[0].product_id );
		});
	}
}
