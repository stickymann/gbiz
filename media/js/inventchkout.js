var lastIndex;
var subtable = "subform_table_checkout_details";
var subform_table_checkout_details_dataurl = "";
var colArr = new Array();		

$(document).ready(function()	
{
	DefaultColumns(subtable);
	subform_InitDataGridReadWrite(subtable);
});

function doAcceptChanges()
{
	var row = $('#'+subtable).datagrid('getSelected');
	if (row)
	{
		var index = $('#'+subtable).datagrid('getRowIndex', row);
		balance = row.subform_checkout_details_order_qty - row.subform_checkout_details_filled_qty;
		if(row.subform_checkout_details_checkout_qty > balance || row.subform_checkout_details_checkout_qty < 0 )
		{
			row.subform_checkout_details_checkout_qty = balance;
		}
		$('#'+subtable).datagrid('refreshRow', index);
	}
}

function subform_InitDataGridReadWrite(tt)
{
	$('#'+tt).datagrid(
	{
		url: subform_table_checkout_details_dataurl,
		columns: colArr,
		toolbar:
		[
			{
				text:'Accept',	iconCls:'icon-save', handler:function()
				{
					$('#'+tt).datagrid('acceptChanges');
					//abstract function, add to controller
					doAcceptChanges();
				}
			}
		],

		onBeforeLoad: function()
		{
			$(this).datagrid('rejectChanges');
		},
				
		onLoadSuccess: function()
		{
			//abstract function, add to controller
			//doOnLoadSuccess();
		},

		onDblClickRow: function(rowIndex)
		{
			$('#'+tt).datagrid('endEdit', lastIndex);
			row = $('#'+tt).datagrid('getSelected');
			if(row.subform_checkout_details_order_qty != row.subform_checkout_details_filled_qty)
			{
				$('#'+tt).datagrid('beginEdit', rowIndex);
				lastIndex = rowIndex;
			}
		}		
	});
}
