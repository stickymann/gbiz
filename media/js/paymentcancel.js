
$(document).ready(function()
{
	if( $('#current_no').val() > -1 )
	{
		paymentcancel.SetPaymentStatus();
	}
});
		
var paymentcancel = new function()
{
	this.SetPaymentStatus = function ()
	{
		$("#payment_status").val('CANCELLED');
	}
}
