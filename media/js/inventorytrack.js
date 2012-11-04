var lastIndex = 0;
var order_status = "";
var edittype = "DEFAULT";
var subtable = "subform_table_stockbatch_details";
var listarr = [];

var stock_status =  
[
	{item_status:'STOCK-NEW',name:'STOCK-NEW'},
	{item_status:'STOCK-NEW',name:'STOCK-USED'},
	{item_status:'STOCK-REFURBISHED',name:'STOCK-REFURBISHED'},
	{item_status:'VEHICLE-NEW',name:'VEHICLE-NEW'},
	{item_status:'VEHICLE-NEW',name:'VEHICLE-USED'},
	{item_status:'VEHICLE-REFURBISHED',name:'VEHICLE-REFURBISHED'},
	{item_status:'REPAIR-INHOUSE',name:'REPAIR-INHOUSE'},
	{item_status:'REPAIR-RMA',name:'REPAIR-RMA'},
	{item_status:'FLOATING',name:'FLOATING'},
	{item_status:'DISPOSED',name:'DISPOSED'}
]; 

$(document).ready(function()	
{
	var summarylayout = '<div id="itemcount"></div><div id="duptext">';
	$('#subform_summary_stockbatch_details').html(summarylayout);
	
	if($('#stockbatch_status').val() == "CLOSED")
	{
		$('#stockbatch_status_sidelink').html("");
		$('#stock_description').prop("readonly",true);
		$('#stockin_quantity').prop("readonly",true);
		subform_InitDataGridReadOnly(subtable);
	}
	else
	{
		subform_InitDataGridReadWrite(subtable); 
	}

	if($('#current_no').val() == '0' && $('#stockbatch_id').val() == '')
	{
		inventorytrack_UpdateDetails();
		inventorytrack_CreateID();
		$('#stockin_date').val(siteutils.currentDate('Y-m-d'));
	}
});

function DefaultColumns(tt)
{
	var colArr =new Array();
	colArr = [[
				{field:'subform_stockbatch_details_serial_no',title:'<b>Serial No.</b>',width:200,align:'left',editor:{type:'validatebox',options:{required:true}}},
				{field:'subform_stockbatch_details_item_status',title:'<b>Item Status</b>',width:200,align:'left',editor:{type:'combobox',options:{valueField:'item_status',textField:'item_status',data:stock_status,required:true}}},
				{field:'subform_stockbatch_details_item_comments',title:'<b>Item Comments</b>',width:350,align:'left',editor:{type:'textarea'}},
				{field:'subform_stockbatch_details_stockbatch_id',title:'<b>Stock Batch Id</b>',width:140,align:'left'},
				{field:'subform_stockbatch_details_id',title:'<b>Id</b>',width:50,align:'left'}
			]]
			$('#'+tt).datagrid({columns: colArr });
}

function DefaultNewRow(tt)
{
	$('#'+tt).datagrid('appendRow',
	{
		subform_stockbatch_details_stockbatch_id:$('#stockbatch_id').val(),
		subform_stockbatch_details_item_status:'STOCK-NEW',
		subform_stockbatch_details_item_comments:'?'
	});
}	

function getCellsValue(val)
{
	if( val == "undefined"){ return "null"; }
	return val;
}

function doRemove()
{
	inventorytrack_UpdateDetails();
}

function doUndo()
{
	inventorytrack_UpdateDetails();
}
	
function doOnLoadSuccess()
{
	inventorytrack_UpdateDetails();
}	
	
function doAcceptChanges()
{
	var row = $('#'+subtable).datagrid('getSelected');
	if (row)
	{
		var index = $('#'+subtable).datagrid('getRowIndex', row);
	}
	$('#'+subtable).datagrid('refreshRow', index);
	inventorytrack_UpdateDetails();
}
	
function inventorytrack_UpdateDetails()
{
	var xmlhr = "<?xml version='1.0' standalone='yes'?>"+"<rows>";
	var xmlft = "</rows>";
	var xmltxt = "", summaryhtml = ""; 
	$('#duptext').html("");
	var rows = $('#'+subtable).datagrid('getRows');
	listarr = [];

	rowlength = rows.length;
	for(var i=0; i<rowlength; i++)
	{  
		id				= "<id>" + getCellsValue(rows[i].subform_stockbatch_details_id) + "</id>";
		serial_no		= "<serial_no>" + getCellsValue(rows[i].subform_stockbatch_details_serial_no) + "</serial_no>";
		stockbatch_id	= "<stockbatch_id>" + getCellsValue(rows[i].subform_stockbatch_details_stockbatch_id) + "</stockbatch_id>";
		item_status		= "<item_status>" + getCellsValue(rows[i].subform_stockbatch_details_item_status) + "</item_status>";
		item_comments	= "<item_comments>" + getCellsValue(rows[i].subform_stockbatch_details_item_comments) + "</item_comments>";
		xmltxt			+= "<row>"+ id + serial_no + stockbatch_id + item_status + item_comments + "</row>";
		isDuplicateSerialNo( getCellsValue(rows[i].subform_stockbatch_details_serial_no) , $('#stockbatch_id').val() );
		isDuplicateListNo( getCellsValue(rows[i].subform_stockbatch_details_serial_no) );
	} 
	
	xmltxt = xmlhr + xmltxt + xmlft;
	summaryhtml += '<table>';
	summaryhtml += '<tr><td><b>Item Count :</b></td><td style="text-align:right; padding 5px 5px 5px 5px;">' + rowlength + '</td></tr>';
	summaryhtml += '</table>';
	$('#itemcount').html(summaryhtml);
	$('#stockbatch_details').val(xmltxt);
}

function inventorytrack_CreateID()
{
	ctrlid = $('#id').val();
	order_params = "option=orderid&controller=inventory_track&prefix=ISB&ctrlid=" + ctrlid;
	siteutils.runQuery(order_params,'stockbatch_id','val');
}

function inventorytrack_ToggleStatusType()
{
	if( $('#stockbatch_status').val() == "NEW" || $('#stockbatch_status').val() == "CLOSED" ) 
	{ 
		$('#stockbatch_status').val("EDIT"); 
	} 
	else 
	{ 
		$('#stockbatch_status').val("CLOSED"); 
	}
}

function isDuplicateSerialNo(serial_no,stockbatch_id)
{
	var status = "";
	get_url = siteutils.getBaseURL() + "index.php/inventory_track/isdupserialno?";
	url = get_url + "serial_no=" + serial_no + "&stockbatch_id=" + stockbatch_id;
	$.getJSON(url, function(data){
		if(data.stockbatch_id != "false")
		{
			status = data.serial_no + " : " + data.stockbatch_id + " (duplicate -> exist in database)<br>";
		}
		$("#duptext").append(status);
	});
}

function isDuplicateListNo(serial_no)
{
	if( $.inArray(serial_no, listarr) > -1 )
	{
		status = serial_no + " : (duplicate -> exist in current list)<br>";
		$("#duptext").append(status);
	}
	else
	{
		listarr.push(serial_no);
	}
}

function subform_InitDataGridReadOnly(tt)
{
	$('#'+tt).datagrid(
	{
		onLoadSuccess: function()
		{
			//abstract function, add to controller
			doOnLoadSuccess();
		}	
	});
}

function subform_InitDataGridReadWrite(tt)
{
	$('#'+tt).datagrid(
	{
				toolbar:[{text:'Add',iconCls:'icon-add',handler:function()
					{
						DefaultColumns(tt)
						$('#'+tt).datagrid('endEdit', lastIndex);
						//abstract function, add to controller
						DefaultNewRow(tt);
						var index = $('#'+tt).datagrid('getRows').length-1;
						$('#'+tt).datagrid('selectRow', index);
						$('#'+tt).datagrid('beginEdit', index);
					}
				},'-',
						{text:'Remove',iconCls:'icon-remove',handler:function()
					{
						var row = $('#'+tt).datagrid('getSelected');
						if(row)
						{
							var index = $('#'+tt).datagrid('getRowIndex', row);
							$('#'+tt).datagrid('deleteRow', index);
						}
						//abstract function, add to controller
						doRemove();
					}
				},'-',
						{text:'Undo',iconCls:'icon-undo',handler:function()
					{
						$('#'+tt).datagrid('rejectChanges');
						//abstract function, add to controller
						doUndo();
					}
				},'-',
						{text:'Accept',	iconCls:'icon-save', handler:function()
					{
						$('#'+tt).datagrid('acceptChanges');
						//abstract function, add to controller
						doAcceptChanges();
					}
				}],

				onBeforeLoad: function()
				{
					$(this).datagrid('rejectChanges');
				},
				
				onLoadSuccess: function()
				{
					//abstract function, add to controller
					doOnLoadSuccess();
				},

				onDblClickRow: function(rowIndex)
				{
					$('#'+tt).datagrid('endEdit', lastIndex);
					row = $('#'+tt).datagrid('getSelected');
					DefaultColumns(tt);
					$('#'+tt).datagrid('beginEdit', rowIndex);
					lastIndex = rowIndex;
				}		
	});
}
