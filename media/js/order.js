var order_status = "";
var subtable = "subform_table_order_details";
var url_products = siteutils.getAjaxURL() + "option=jdata&controller=product&fields=product_id&prefix=&wfields=status&wvals=ACTIVE";
		
$(document).ready(function()	
{
	order_status = $('#order_status').val();
	if( $('#order_status').val() == "NEW" || $('#order_status').val() == "QUOTATION" || $('#current_no').val() == 0)
	{
		subform_InitDataGridReadWrite(subtable); 
	}
	else
	{
		subform_InitDataGridReadOnly(subtable)
	}

	if($('#current_no').val() == '0' && $('#order_id').val() == '')
	{
		order_UpdateDetails();
		order_CreateID();
		$('#order_date').val(siteutils.currentDate('Y-m-d'));
		$('#status_change_date').val(siteutils.currentDate('Y-m-d'));
		order_GetUserBranch();
	}
});
	
function DefaultNewRow(tt)
{
	$('#'+tt).datagrid('appendRow',{subform_order_details_order_id:$('#order_id').val(),subform_order_details_qty:'1',subform_order_details_discount_amount:'0.00',subform_order_details_discount_type:'DOLLAR',subform_order_details_description_type:'STANDARD',subform_order_details_user_text:'?'});
}	
	
function getCellsValue(val)
{
	if( val == "undefined"){ return "null"; }
	return val;
}

function doRemove()
{
	order_UpdateDetails();
}

function doUndo()
{
	order_UpdateDetails();
}
	
function doOnLoadSuccess()
{
	order_UpdateDetails();
}	
	
function doAcceptChanges()
{
	var row = $('#'+subtable).datagrid('getSelected');
	if (row)
	{
		var index = $('#'+subtable).datagrid('getRowIndex', row);
	
		if(row.subform_order_details_discount_type=="PERCENT")
		{
			discount_amount = parseFloat(row.subform_order_details_qty*row.subform_order_details_unit_price) * parseFloat(row.subform_order_details_discount_amount / 100);
		}
		else
		{
			discount_amount =  row.subform_order_details_discount_amount;
		}
			
		if(row.subform_order_details_taxable == 'Y')
		{
			row.subform_order_details_tax_amount = siteutils.formatCurrency(((row.subform_order_details_qty*row.subform_order_details_unit_price)-discount_amount) * (row.subform_order_details_tax_percentage/100)); 
		}
		else
		{
			row.subform_order_details_tax_amount ="0.00";
		}
		row.subform_order_details_extended = siteutils.formatCurrency(parseFloat((row.subform_order_details_qty*row.subform_order_details_unit_price)) - parseFloat(discount_amount) + parseFloat(row.subform_order_details_tax_amount));
		row.subform_order_details_discount_amount = siteutils.formatCurrency(row.subform_order_details_discount_amount);
		row.subform_order_details_unit_total = siteutils.formatCurrency(parseFloat(row.subform_order_details_qty*row.subform_order_details_unit_price));
	}
	$('#'+subtable).datagrid('refreshRow', index);
	order_UpdateDetails();
}
	
function order_UpdateDetails()
{
	//var xmlhr = "<?xml version='1.0' standalone='yes'?>"+"\\n"+"<rows>"+"\\n";
	var xmlhr = "<?xml version='1.0' standalone='yes'?>"+"<rows>";
	var xmlft = "</rows>";
	//var xmlrowcount = "<rowcount>0</rowcount>";
	var xmltxt = "", summaryhtml = "";
	var grandtotal = 0, subtotal = 0, tax_total = 0, discount_amount = 0; 

	var rows = $('#'+subtable).datagrid('getRows');
	rowlength = rows.length;
	for(var i=0; i<rowlength; i++)
	{  
		id				= "<id>" + getCellsValue(rows[i].subform_order_details_id) + "</id>";
		order_id		= "<order_id>" + getCellsValue(rows[i].subform_order_details_order_id) + "</order_id>";
		product_id		= "<product_id>" + getCellsValue(rows[i].subform_order_details_product_id) + "</product_id>";
		qty				= "<qty>" + getCellsValue(rows[i].subform_order_details_qty) + "</qty>";
		unit_price		= "<unit_price>" + getCellsValue(rows[i].subform_order_details_unit_price) + "</unit_price>";
		unit_total		= "<unit_total>" + getCellsValue(rows[i].subform_order_details_unit_total) + "</unit_total>";
		taxable			= "<taxable>" + getCellsValue(rows[i].subform_order_details_taxable) + "</taxable>";
		tax_percentage  = "<tax_percentage>" + getCellsValue(rows[i].subform_order_details_tax_percentage) + "</tax_percentage>";
		tax_amount		= "<tax_amount>" + getCellsValue(rows[i].subform_order_details_tax_amount) + "</tax_amount>";
		extended		= "<extended>" + getCellsValue(rows[i].subform_order_details_extended) + "</extended>";
		discount_type   = "<discount_type>" + getCellsValue(rows[i].subform_order_details_discount_type) + "</discount_type>";
		discount_amount = "<discount_amount>" + getCellsValue(rows[i].subform_order_details_discount_amount) + "</discount_amount>";
		description		= "<description>" + getCellsValue(rows[i].subform_order_details_description) + "</description>";
		user_text		= "<user_text>" + getCellsValue(rows[i].subform_order_details_user_text) + "</user_text>";
		xmltxt			+= "<row>" + id + order_id + product_id + qty + unit_price + unit_total +taxable + tax_percentage + tax_amount + extended + discount_type + discount_amount + description + user_text + "</row>";
			
		if(rows[i].subform_order_details_discount_type=="PERCENT")
		{
			discount_amount = parseFloat(rows[i].subform_order_details_qty*rows[i].subform_order_details_unit_price) * parseFloat(rows[i].subform_order_details_discount_amount / 100);
		}
		else
		{
			discount_amount =  rows[i].subform_order_details_discount_amount;
		}
			
		subtotal		+= parseFloat((rows[i].subform_order_details_qty*rows[i].subform_order_details_unit_price)) - parseFloat(discount_amount);
		tax_total		+= parseFloat(rows[i].subform_order_details_tax_amount);
		grandtotal		+= parseFloat(rows[i].subform_order_details_extended);
	}  
	
	//xmlrowcount = "<rowcount>" + rowlength + "</rowcount>" + "\\n";
	xmltxt = xmlhr + xmltxt + xmlft;
	//alert(xmltxt);
	summaryhtml += '<table width="30%">';
	summaryhtml += '<tr><td width="50%"><b>Sub Total :</b></td><td width="20%" style="text-align:right; padding 5px 5px 5px 5px;">' + siteutils.formatCurrency(subtotal) + '</td></tr>';
	summaryhtml += '<tr><td width="50%"><b>Tax Total :</b></td><td width="20%" style="text-align:right; padding 5px 5px 5px 5px;">' + siteutils.formatCurrency(tax_total) + '</td></tr>';
	summaryhtml += '<tr><td width="50%"><b>GRAND TOTAL :</b></td><td width="20%" style="text-align:right; padding 5px 5px 5px 5px;"><b>' + siteutils.formatCurrency(grandtotal) + '</b></td></tr>';
	summaryhtml += '</table>';
	$('#subform_summary_order_details').html(summaryhtml);
	$('#order_details').val(xmltxt);
}

function order_GetProductData()
{
	var lookupval = "";
	var row = $('#'+subtable).datagrid('getSelected');

	if (row)
	{
		var index = $('#'+subtable).datagrid('getRowIndex', row);
		$('#'+subtable).datagrid('updateRow',index);
			
		$('input').each(function() 
		{
			$.each(this.attributes, function(i, attrib)
			{
				var name = attrib.name;
				var value = attrib.value;
				//alert('name :'+attrib.name+' ,value :'+attrib.value);
				if(name == "value")
				{
					lookupval = lookupval + attrib.value + ",";
				}
			});
		});
		lookupval = lookupval.substr(0,lookupval.length-1);

		url = siteutils.getAjaxURL() + "option=jdatabyid&controller=product&fields=product_id,product_description,unit_price,taxable,tax_percentage&idfield=product_id&idval=" + lookupval;
		$.getJSON(url, function(data){
		row.subform_order_details_description = data.product_description;
		row.subform_order_details_unit_price = data.unit_price;
				
				row.subform_order_details_taxable = data.taxable;
				row.subform_order_details_tax_percentage = data.tax_percentage;
		});
	}
}

function order_StatusPopOut()
{	var po_params = "";
	siteutils.dialogWindow("chklight",300,190,"Order Status Selector");
	po_params = "option=orderstatus&idfield=order_status_id&func=order_StatusUpdate&" + "fldval=" + order_status;
	siteutils.runQuery(po_params,'chkresult','html');
}
	
function order_StatusUpdate(fldval)
{
	$('#order_status').val(fldval);
	$( '#chklight' ).dialog( "close" );
}

function order_CreateID()
{
	ctrlid = $('#id').val();
	order_params = "option=orderid&controller=order&prefix=ORD&ctrlid=" + ctrlid;
	siteutils.runQuery(order_params,'order_id','val');
}
		
function order_GetUserBranch() 
{
	idname = $("#js_idname").val();
	order_params = "option=userbranch&idname=" + idname;
	siteutils.runQuery(order_params,'branch_id','val');
}

function order_ToggleCheckoutType()
{
	if($('#inventory_checkout_type').val() == "AUTO") { $('#inventory_checkout_type').val("MANUAL"); } else { $('#inventory_checkout_type').val("AUTO"); }
}
