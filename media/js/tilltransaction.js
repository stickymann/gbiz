
$(document).ready(function()
{
	if( $('#current_no').val() == '0' && $('#till_id').val() == '' )
	{
		tilltransaction.CreateTransactionID();
		tilltransaction.CreateTillID();
	}
});
		
var tilltransaction = new function()
{
	this.CreateTillID = function ()
	{
		var current_date = siteutils.currentDate('Y-m-d');
		current_date = current_date.split("-").join("");
		var till_id = $('#js_idname').val() + "-" + current_date;
		$('#till_id').val(till_id);
	}

	this.CreateTransactionID = function ()
	{
		ctrlid = $('#id').val();
		order_params = "option=orderid&controller=tilltransaction&prefix=TLL&ctrlid=" + ctrlid;
		siteutils.runQuery(order_params,'transaction_id','val');
	}
}
