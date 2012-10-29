<?php
printToScreen($enquiryrecords,$pagination,$labels,$config);

function getSection1($item,$labels)
{
	$baseurl = url::base()."/"."index.php";
	$label_01 = $labels['id'];					$item_01 = $item->id;
	$label_02 = $labels['serial_no'];			$item_02 = $item->serial_no;
	$label_03 = $labels['item_status'];			$item_03 = $item->item_status;
	$label_04 = $labels['product_id'];			$item_04 = $item->product_id;
	$label_05 = $labels['stockbatch_id'];		$item_05 = $item->stockbatch_id;
	$label_06 = $labels['stock_description'];	$item_06 = $item->stock_description;
	$label_07 = $labels['stockin_date'];		$item_07 = $item->stockin_date;
	$label_08 = $labels['stockin_quantity'];	$item_08 = $item->stockin_quantity;
	$label_09 = $labels['stockbatch_status'];	$item_09 = $item->stockbatch_status;
	$label_10 = $labels['item_comments'];		$item_10 = $item->item_comments;
	$label_11 = $labels['it_comments'];			$item_11 = $item->it_comments;

	$HTML=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_02 : </td>
						<td><a href='$baseurl/inventory_track_detail/index/$item_02' target='enquiry' title='Inventory Track Detail'>$item_02</a> [$item_01]</td></tr>	
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
						<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
						<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>
						<tr valign=top><td></td><td></td></tr>
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_06 : </td><td>$item_06</td></tr>
						<tr valign=top><td>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>
						<tr valign=top><td>$label_09 : </td><td>$item_09</td></tr>
					</table>
				</td>
			</tr>
			<tr><td>$label_10 : </td><td colspan=2>$item_10</td></tr>
			<tr><td>$label_11 : </td><td colspan=2>$item_11</td></tr>	
	</table>
_HTML_;
	return $HTML;
}

function getSection2($item,$labels)
{
	$label_01 = $labels['device_id'];	$item_01 = $item->device_id;
	$label_02 = $labels['warranty_expiry_date'];	$item_02 = $item->warranty_expiry_date;
	$label_03 = $labels['passcode'];		$item_03 = $item->passcode;
	$label_04 = $labels['sms_enabled'];		$item_04 = $item->sms_enabled;
	$label_05 = $labels['gprs_enabled'];	$item_05 = $item->gprs_enabled;
	$label_07 = $labels['phone_device'];	$item_07 = $item->phone_device;
	$label_08 = $labels['phone_textback1'];	$item_08 = $item->phone_textback1;
	$label_09 = $labels['phone_textback2'];	$item_09 = $item->phone_textback2;
	$label_10 = $labels['sms_server'];	$item_10 = $item->sms_server;
	$label_11 = $labels['gprs_server'];	$item_11 = $item->gprs_server;
	$label_12 = $labels['realtime_useraccount'];	$item_12 = $item->realtime_useraccount;
	$label_13 = $labels['realtime_password'];	$item_13 = $item->realtime_password;
	$label_14 = $labels['order_id'];		$item_14 = $item->order_id;
	$label_15 = $labels['realtime_appname'];$item_15 = $item->realtime_appname;
	$label_16 = $labels['device_comments'];	$item_16 = $item->device_comments;
		

	$HTML=<<<_HTML_
		<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td  width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_01 : </td><td>$item_01</td></tr>
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>	
						<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
						<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>
						<tr valign=top><td>: </td><td></td></tr>
						<tr valign=top><td>$label_11 : </td><td>$item_11</td></tr>
						<tr valign=top><td>$label_12 : </td><td>$item_12</td></tr>
						<tr valign=top><td>$label_13 : </td><td>$item_13</td></tr>	
				</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_02 : </td><td>$item_02</td></tr>
						<tr valign=top><td>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>	
						<tr valign=top><td>$label_09 : </td><td>$item_09</td></tr>	
						<tr valign=top><td>$label_10 : </td><td>$item_10</td></tr>	
						<tr valign=top><td>$label_14 : </td><td>$item_14</td></tr>
						<tr valign=top><td>$label_15 : </td><td>$item_15</td></tr>
					</table>
				</td>
			</tr>
			<tr><td>$label_16 : </td><td colspan=2>$item_16</td></tr>
		</table>
_HTML_;
	return $HTML;
}

function TrackerInstallationHistory($item)
{
	$baseurl = url::base()."/"."index.php";
	$vehicle = new Vehicle_Controller();
	$device_id = $item->device_id;
	$tb_live = $vehicle->param['tb_live'];
	$tb_hist = $vehicle->param['tb_hist'];

$querystr=<<<_SQL_
SELECT DISTINCT vehicle_id,owner_id,make,model,color,installer,installation_date,record_status FROM $tb_live WHERE device_id = "$device_id"
UNION
SELECT DISTINCT vehicle_id,owner_id,make,model,color,installer,installation_date,record_status FROM $tb_hist WHERE device_id = "$device_id";
_SQL_;
	$results = $vehicle->param['primarymodel']->executeSelectQuery($querystr);

	$HTML = "<table id='order_enq_details' width='100%'>"."\n";
	$TABLEHEADER = sprintf('<tr valign="top"><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><tr>',"Vehicle Id","Owner Id","Make","Model","Color","Installer","Install Date","Status"); 
	$TABLEROWS ="";

	if($results)
	{
		foreach($results as $index => $row)
		{
			$TABLEROWS .= "<tr>";
			foreach ($row as $field => $value)
			{
				if($field == "vehicle_id")
				{
					$data = sprintf('<a href="%s/vehicle/index/%s" target="enquiry" title="Vehicle">%s</a>',$baseurl,$value,$value); 
					$TABLEROWS .= sprintf('<td valign="top" style="color:%s;">%s</td>',"black",$data);
				}
				else if($field == "owner_id")
				{
					$data = sprintf('<a href="%s/customer/index/%s" target="enquiry" title="Customer">%s</a>',$baseurl,$value,$value); 
					$TABLEROWS .= sprintf('<td valign="top" style="color:%s;">%s</td>',"black",$data);
				}
				else
				{
					$TABLEROWS .= sprintf('<td valign="top" style="color:%s;">%s</td>',"black",$value);
				}
			}
			$TABLEROWS .= "</tr>"."\n";
		}
	}
	$HTML .= $TABLEHEADER.$TABLEROWS."\n"."</table>"."\n";
	return $HTML;
}

function printToScreen($enquiryrecords,$pagination,$labels,$config)
{
	foreach ($enquiryrecords as $item )
	{
		$section1 = getSection1($item,$labels);
		$section2 = getSection2($item,$labels);
		$section3 = TrackerInstallationHistory($item);
		//$temp = sprintf('<div> %s </div>',$config['query']);
		$enqurl  = sprintf('<div id=enqtot><a href="%s" title="Refresh Page"><img src="%s" align="middle";></a>',$config['refresh_url'],$config['refresh_icon']);
		$enqurl .= sprintf(' Total : %s </div>',$config['total_items']);
		$enqurl .= sprintf('<div id=enqpag>%s</div>',$pagination);

$HTML=<<<_HTML_
	<style>
	.enqhdr {width:100%; color: #000000; background-color: #ffffff; font-family: verdana, arial, helvetica, sans-serif; font-size: 13pt; font-weight:  bold; margin: 0px 0px 0px 0px;  padding: 5px 0px 5px 0px; text-align: center; clear: both;}
	.enqshd {width: 100%; color: #ffffff; font-size: 1.3em; font-weight: bold; background-color:#000066;  margin: 0px 5px 0px 0px;  padding: 5px 2px 5px 2px; text-align: left; clear: both;}
	</style>
	<div class='enqshd'>Tracker/Inventory Information</div>
	<div>$section1</div><p></p>
	<div class='enqshd'>Device Information</div>
	<div>$section2</div><p></p>
	<div class='enqshd'>Tracker Installation History</div>
	<div>$section3</div><p></p>
_HTML_;
		print $enqurl.$HTML;
	}
}
?>


