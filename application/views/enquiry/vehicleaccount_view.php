<?php
printToScreen($enquiryrecords,$pagination,$labels,$config);

function getSection1($item,$labels)
{
	$baseurl = url::base()."/"."index.php";
	$label_01 = $labels['id'];				$item_01 = $item->id;
	$label_02 = $labels['vehicle_id'];		$item_02 = $item->vehicle_id;
	$label_03 = $labels['owner_id'];		$item_03 = $item->owner_id;
	$label_04 = $labels['device_id'];		$item_04 = $item->device_id;
	$label_05 = $labels['make'];			$item_05 = $item->make;
	$label_06 = $labels['vehicle_model'];	$item_06 = $item->vehicle_model;
	$label_07 = $labels['color'];			$item_07 = $item->color;
	$label_08 = $labels['vehicletype'];		$item_08 = $item->vehicletype;
	$label_09 = $labels['vehicleusage'];	$item_09 = $item->vehicleusage;
	$label_10 = $labels['installer'];		$item_10 = $item->installer;
	$label_11 = $labels['location'];		$item_11 = $item->location;
	$label_12 = $labels['installation_date']; $item_12 = $item->installation_date;
	$label_13 = $labels['comments'];		$item_13 = $item->comments;
	$label_14 = $labels['device_tag_id'];	$item_14 = $item->device_tag_id;
	$label_15 = $labels['chassis_number'];  $item_15 = $item->chassis_number;
	$label_16 = $labels['plate'];			$item_16 = $item->plate;
	$label_17 = $labels['security_code'];	$item_17 = $item->security_code;

	if($item->customer_type == 'COMPANY'){$fullname = $item->last_name;}else{$fullname = $item->first_name.' '.$item->last_name;}
	
	$HTML=<<<_HTML_
		<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_02 : </td>
						<td><a href='$baseurl/vehicle/index/$item_02' target='enquiry' title='Edit Vehicle'>$item_02</a>($item_17) [$item_01]</td>
						</tr>
						<tr valign=top><td>$label_03 : </td>
						<td><a href='$baseurl/customer/index/$item_03' target='enquiry' title='Edit Customer'>$item_03</a></td></tr>
						<tr valign=top><td>Customer Name : </td><td>$fullname</td></tr>	
						<tr valign=top><td>$label_04 : </td>
						<td><a href='$baseurl/device/index/$item_04' target='enquiry' title='Edit Device'>$item_04</a></td></tr>
						<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>	
						<tr valign=top><td>$label_15 : </td><td>$item_15</td></tr>	
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>	
						<tr valign=top><td>$label_09 : </td><td>$item_09</td></tr>
						<tr valign=top><td>$label_10 : </td><td>$item_10</td></tr>
						<tr valign=top><td>$label_11 : </td><td>$item_11</td></tr>
						<tr valign=top><td>$label_12 : </td><td>$item_12</td></tr>	
						<tr valign=top><td>$label_16 : </td>
						<td><a href='$baseurl/telbook/index/$item_16' target='enquiry' title='Edit SMS User Account'>$item_16</td></tr>	
				</table>
				</td>
			</tr>
			<tr><td>$label_13 : </td><td colspan=2>$item_13</td></tr>
		</table>
_HTML_;
	return $HTML;
}

function getSection2($item,$labels)
{
	$label_01 = $labels['customer_type'];	$item_01 = $item->customer_type;
	$label_02 = $labels['business_type'];	$item_02 = $item->business_type;
	$label_03 = $labels['address1'];		$item_03 = $item->address1;
	$label_04 = $labels['address2'];		$item_04 = $item->address2;
	$label_05 = $labels['city'];			$item_05 = $item->city;
	$label_06 = $labels['date_of_birth'];	$item_06 = $item->date_of_birth;
	$label_07 = $labels['gender'];			$item_07 = $item->gender;
	$label_08 = $labels['phone_home'];		$item_08 = $item->phone_home;
	$label_09 = $labels['phone_work'];		$item_09 = $item->phone_work;
	$label_10 = $labels['phone_mobile1'];	$item_10 = $item->phone_mobile1;
	$label_11 = $labels['phone_mobile2'];	$item_11 = $item->phone_mobile2;
	$label_12 = $labels['email_address'];	$item_12 = $item->email_address;
	$label_13 = $labels['driver_permit'];		$item_13 = $item->driver_permit;
	$label_14 = $labels['driver_permit_expiry_date'];	$item_14 = $item->driver_permit_expiry_date;
	$label_15 = $labels['emergency_contact'];	$item_15 = $item->emergency_contact;
	$label_16 = $labels['emergency_contact_phone'];	$item_16 = $item->emergency_contact_phone;
	$label_17 = $labels['branch_id'];		$item_17 = $item->branch_id;
	$label_18 = $labels['referrer_id'];		$item_18 = $item->referrer_id;
	$label_19 = $labels['customer_comments'];$item_19 = $item->customer_comments;
		
	$address = $item->address1.', '.$item->address2.'<br>'.$item->city;
	
	$HTML=<<<_HTML_
		<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td  width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_17 : </td><td>$item_17</td></tr>
						<tr valign=top><td>$label_01 : </td><td>$item_01</td></tr>
						<tr valign=top><td>$label_02 : </td><td>$item_02</td></tr>
						<tr valign=top><td>Address : </td><td>$address</td></tr>	
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>
						<tr valign=top><td>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_13 : </td><td>$item_13</td></tr>
						<tr valign=top><td>$label_12 : </td><td>$item_12</td></tr>
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_18 : </td><td>$item_18</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>	
						<tr valign=top><td>$label_09 : </td><td>$item_09</td></tr>	
						<tr valign=top><td>$label_10 : </td><td>$item_10</td></tr>	
						<tr valign=top><td>$label_11 : </td><td>$item_11</td></tr>
						<tr valign=top><td>$label_15 : </td><td>$item_15</td></tr>
						<tr valign=top><td>$label_16 : </td><td>$item_16</td></tr>
						<tr valign=top><td>$label_14 : </td><td>$item_14</td></tr>
					</table>
				</td>
			</tr>
			<tr><td>$label_19 : </td><td colspan=2>$item_19</td></tr>
		</table>
_HTML_;
	return $HTML;
}

function getSection3($item,$labels)
{
	$label_01 = $labels['device_model'];	$item_01 = $item->device_model;
	$label_02 = $labels['warranty_expiry_date'];	$item_02 = $item->warranty_expiry_date;
	$label_03 = $labels['passcode'];		$item_03 = $item->passcode;
	$label_04 = $labels['sms_enabled'];		$item_04 = $item->sms_enabled;
	$label_05 = $labels['gprs_enabled'];	$item_05 = $item->gprs_enabled;
	$label_06 = $labels['imei'];			$item_06 = $item->imei;
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
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>
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

function printToScreen($enquiryrecords,$pagination,$labels,$config)
{
	foreach ($enquiryrecords as $item )
	{
		$section1 = getSection1($item,$labels);
		$section2 = getSection2($item,$labels);
		$section3 = getSection3($item,$labels);
		$num = rand(0,999999);
		$num = str_pad($num, 6, "0", STR_PAD_LEFT);
		$pdf_id	  = 'PDF'.date("YmdHis").$num;
		$enqurl  = sprintf('<div id=enqtot><a href="%s" title="Refresh Page"><img src="%s" align="middle";></a>',$config['refresh_url'],$config['refresh_icon']);
		$enqurl .= sprintf(' Total : %s </div>',$config['total_items']);
		$enqurl .= sprintf('<div id=enqpag>%s</div>',$pagination);
		$pdfurl = ""; 
		if($config['printable'])
		{
			$pdfurl = sprintf('<div id=enqprt><a href=%sindex.php/pdfdoc/index/%s target=_blank>Printable Version</a></div>',url::base(),$pdf_id)."\n";
		}
$HTML=<<<_HTML_
	<style>
	.enqhdr {width:100%; color: #000000; background-color: #ffffff; font-family: verdana, arial, helvetica, sans-serif; font-size: 13pt; font-weight:  bold; margin: 0px 0px 0px 0px;  padding: 5px 0px 5px 0px; text-align: center; clear: both;}
	.enqshd {width: 100%; color: #000000; font-size: 1.3em; font-weight: bold; background-color: silver;  margin: 0px 5px 0px 0px;  padding: 5px 2px 5px 2px; text-align: left; clear: both;}
	</style>
	<div class='enqshd'>Vehicle Information</div>
	<div>$section1</div>
	<div class='enqshd'>Customer Information</div>
	<div>$section2</div>
	<div class='enqshd'>Device Information</div>
	<div>$section3</div>
_HTML_;
		print $enqurl.$pdfurl.$HTML;
		$pdf_header = sprintf("<div class='enqhdr'>%s</div>",$config['enqheader']);
		$pdf_audit="";
		if($config['printuser'] || $config['printdatetime'] )
		{
			$pdf_audit .= "<hr><p></p>"; 
			if($config['printuser']) {$pdf_audit .= sprintf('Printed By : %s<br>',$config['idname']);} 
			if($config['printdatetime']) {$pdf_audit .= sprintf('Print Date : %s<br>',date('Y-m-d H:i:s'));} 
		}
		
		$pdf_html = $pdf_header.$HTML.$pdf_audit;
		//necessary to do str_replace to ensure database inserts work
		$pdf_html = str_replace('class=enqshd','class=\"enqshd\"',$pdf_html);
		$pdf_html = str_replace('class=enqhdr','class=\"enqhdr\"',$pdf_html);
		
		$pdf = new Pdf_Controller();
		$arr['pdf_id']			= $pdf_id;
		$arr['pdf_template']	= "GBIZ_VEHICLE_SUMMARY";
		$arr['controller']		= $config['controller'];
		$arr['type']			= $config['type'];
		$arr['data']			= $pdf_html;
		$arr['datatype']		= "html";
		$arr['idname']			= $config['idname'];
		$pdf->InsertIntoPDFTable($arr);
	}
}
?>

