<?php
printToScreen($enquiryrecords,$pagination,$labels,$config);

function getSection1($item,$labels)
{
	$label_01 = $labels['id'];					$item_01 = $item->id;
	$label_02 = $labels['certificate_id'];		$item_02 = $item->certificate_id;
	$label_03 = $labels['vehicle_id'];			$item_03 = $item->vehicle_id;
	$label_04 = $labels['certificate_status'];	$item_04 = $item->certificate_status;
	$label_05 = $labels['chassis_number'];		$item_05 = $item->chassis_number;
	$label_06 = $labels['vehicle_type'];		$item_06 = $item->vehicle_type;
	$label_07 = $labels['vehicle_make'];		$item_07 = $item->vehicle_make;
	$label_08 = $labels['vehicle_model'];		$item_08 = $item->vehicle_model;
	$label_09 = $labels['vehicle_colour'];		$item_09 = $item->vehicle_colour;
	$label_10 = $labels['first_name'];			$item_10 = $item->first_name;
	$label_11 = $labels['last_name'];			$item_11 = $item->last_name;
	$label_12 = $labels['installation_type'];	$item_12 = $item->installation_type;
	$label_13 = $labels['device_model'];		$item_13 = $item->device_model;
	$label_14 = $labels['device_serial_no'];	$item_14 = $item->device_serial_no;

	if($item->first_name == 'Co.'){$clientname = $item->last_name;}else{$clientname = $item->first_name.' '.$item->last_name;}
	$address = $item->address1.', '.$item->address2.'<br>'.$item->city;
	$HTML=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_02 : </td><td>$item_02 [$item_01]</td></tr>	
						<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
						<tr valign=top><td>$label_12 : </td><td>$item_12</td></tr>
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
						<tr valign=top><td>Client Name : </td><td>$clientname </td></tr>
						<tr valign=top><td>Address : </td><td>$address</td></tr>
						<tr valign=top><td></td><td></td></tr>
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>
						<tr valign=top><td>$label_09 : </td><td>$item_09</td></tr>
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>
						<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>
						<tr valign=top><td>$label_13 : </td><td>$item_13</td></tr>
						<tr valign=top><td>$label_14 : </td><td>$item_14</td></tr>	
					</table>
				</td>
			</tr>
		</table>
_HTML_;
	return $HTML;
}

function getSection2($item,$labels)
{
	$label_01 = $labels['issue_date'];	$item_01 = $item->issue_date;
	$label_02 = $labels['expiry_date'];	$item_02 = $item->expiry_date;
	$label_03 = $labels['validation_period'];	$item_03 = $item->validation_period;
	$label_04 = $labels['variations'];	$item_04 = $item->variations;
	$label_05 = $labels['signature_name'];	$item_05 = $item->signature_name;
	$label_06 = $labels['signature_position'];	$item_06 = $item->signature_position;

	$HTML=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_01 : </td><td>$item_01</td></tr>
						<tr valign=top><td>$label_02 : </td><td>$item_02</td></tr>
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_04 : </td><td>$item_04</td></tr>
						<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>	
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>
					</table>
				</td>
			</tr>
		</table>
_HTML_;
	return $HTML;
}

function getSection3($item,$labels)
{
	$label_01 = $labels['commisioning_fld01'];	$item_01 = $item->commisioning_fld01;
	$label_02 = $labels['commisioning_fld02'];	$item_02 = $item->commisioning_fld02;
	$label_03 = $labels['commisioning_fld03'];	$item_03 = $item->commisioning_fld03;
	$label_04 = $labels['commisioning_fld04'];	$item_04 = $item->commisioning_fld04;
	$label_05 = $labels['commisioning_fld05'];	$item_05 = $item->commisioning_fld05;
	$label_06 = $labels['commisioning_fld06'];	$item_06 = $item->commisioning_fld06;
	$label_07 = $labels['commisioning_fld07'];	$item_07 = $item->commisioning_fld07;
	$label_08 = $labels['commisioning_fld08'];	$item_08 = $item->commisioning_fld08;
	$label_09 = $labels['commisioning_fld09'];	$item_09 = $item->commisioning_fld09;
	$label_10 = $labels['commisioning_fld10'];	$item_10 = $item->commisioning_fld10;
	$label_11 = $labels['commisioning_fld11'];	$item_11 = $item->commisioning_fld11;
	$label_12 = $labels['commisioning_fld12'];	$item_12 = $item->commisioning_fld12;

	$HTML=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='33%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='70%'>$label_01 : </td><td>$item_01</td></tr>
						<tr valign=top><td>$label_02 : </td><td>$item_02</td></tr>
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
						<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
					</table>
				</td>
				<td width='33%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='70%'>$label_05 : </td><td>$item_05</td></tr>
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>
						<tr valign=top><td>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>
				</table>
				</td>
				<td width='33%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='70%'>$label_09 : </td><td>$item_09</td></tr>
						<tr valign=top><td>$label_10 : </td><td>$item_10</td></tr>	
						<tr valign=top><td>$label_11 : </td><td>$item_11</td></tr>
						<tr valign=top><td>$label_12 : </td><td>$item_12</td></tr>
					</table>
				</td>
			</tr>
		</table>
_HTML_;
	return $HTML;
}

function getSection4($item,$labels)
{
	$label_01 = $labels['usrinstr_fld01'];	$item_01 = $item->usrinstr_fld01;
	$label_02 = $labels['usrinstr_fld02'];	$item_02 = $item->usrinstr_fld02;
	$label_03 = $labels['usrinstr_fld03'];	$item_03 = $item->usrinstr_fld03;
	$label_04 = $labels['usrinstr_fld04'];	$item_04 = $item->usrinstr_fld04;
	$label_05 = $labels['usrinstr_fld05'];	$item_05 = $item->usrinstr_fld05;
	$label_06 = $labels['usrinstr_fld06'];	$item_06 = $item->usrinstr_fld06;
	$label_07 = $labels['usrinstr_fld07'];	$item_07 = $item->usrinstr_fld07;
	$label_08 = $labels['usrinstr_fld08'];	$item_08 = $item->usrinstr_fld08;
	$label_09 = $labels['usrinstr_fld09'];	$item_09 = $item->usrinstr_fld09;
	$label_10 = $labels['usrinstr_fld10'];	$item_10 = $item->usrinstr_fld10;
	$label_11 = $labels['usrinstr_fld11'];	$item_11 = $item->usrinstr_fld11;
	$label_12 = $labels['usrinstr_fld12'];	$item_12 = $item->usrinstr_fld12;

	$HTML=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='33%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='70%'>$label_01 : </td><td>$item_01</td></tr>
						<tr valign=top><td>$label_02 : </td><td>$item_02</td></tr>
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
						<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
					</table>
				</td>
				<td width='33%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='70%'>$label_05 : </td><td>$item_05</td></tr>
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>
						<tr valign=top><td>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>
				</table>
				</td>
				<td width='33%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='70%'>$label_09 : </td><td>$item_09</td></tr>
						<tr valign=top><td>$label_10 : </td><td>$item_10</td></tr>	
						<tr valign=top><td>$label_11 : </td><td>$item_11</td></tr>
						<tr valign=top><td>$label_12 : </td><td>$item_12</td></tr>
					</table>
				</td>
			</tr>
		</table>
_HTML_;
	return $HTML;
}

function makeXFDFXML($item,$label)
{
	$certificate_id = $item->certificate_id; 			$vehicle_id = $item->vehicle_id;
	$certificate_status = $item->certificate_status; 	$chassis_number = $item->chassis_number;
	$vehicle_type = $item->vehicle_type;				$vehicle_make = $item->vehicle_make;
	$vehicle_model = $item->vehicle_model;				$vehicle_colour = $item->vehicle_colour;
	$first_name = $item->first_name;					$last_name = $item->last_name;
	$installation_type = $item->installation_type;		$device_model = $item->device_model;
	$device_serial_no = $item->device_serial_no;		$issue_date = $item->issue_date;
	$expiry_date = $item->expiry_date;					$validation_period = $item->validation_period;
	$variations = $item->variations;					$signature_name = $item->signature_name;
	$signature_position = $item->signature_position;	$city = $item->city;

	$commisioning_fld01= $item->commisioning_fld01;		$commisioning_fld02 = $item->commisioning_fld02;
	$commisioning_fld03 = $item->commisioning_fld03;	$commisioning_fld04 = $item->commisioning_fld04;
	$commisioning_fld05 = $item->commisioning_fld05;	$commisioning_fld06 = $item->commisioning_fld06;
	$commisioning_fld07 = $item->commisioning_fld07;	$commisioning_fld08 = $item->commisioning_fld08;
	$commisioning_fld09 = $item->commisioning_fld09;	$commisioning_fld10 = $item->commisioning_fld10;
	$commisioning_fld11 = $item->commisioning_fld11;	$commisioning_fld12 = $item->commisioning_fld12;

	$usrinstr_fld01 = $item->usrinstr_fld01;			$usrinstr_fld02 = $item->usrinstr_fld02;
	$usrinstr_fld03 = $item->usrinstr_fld03;			$usrinstr_fld04 = $item->usrinstr_fld04;
	$usrinstr_fld05 = $item->usrinstr_fld05;			$usrinstr_fld06 = $item->usrinstr_fld06;
	$usrinstr_fld07 = $item->usrinstr_fld07;			$usrinstr_fld08 = $item->usrinstr_fld08;
	$usrinstr_fld09 = $item->usrinstr_fld09;			$usrinstr_fld10 = $item->usrinstr_fld10;
	$usrinstr_fld11 = $item->usrinstr_fld11;			$usrinstr_fld12 = $item->usrinstr_fld12;

	if($item->first_name == 'Co.'){$clientname = $item->last_name;}else{$clientname = $item->first_name.' '.$item->last_name;}
	$address = $item->address1;
	if($item->address2 != "") { $address .= ', '.$item->address2;}
	
	$XML=<<<_XML_
<xfdf xmlns='http://ns.adobe.com/xfdf/' xml:space='preserve'>
<f href='vtcert_template.pdf'/>
<fields>
<field name='certificate_id'><value>$certificate_id</value></field>
<field name='vehicle_id'><value>$vehicle_id</value></field>
<field name='chassis_number'><value>$chassis_number</value></field>
<field name='vehicle_type'><value>$vehicle_type</value></field>
<field name='vehicle_make'><value>$vehicle_make</value></field>
<field name='vehicle_model'><value>$vehicle_model</value></field>
<field name='vehicle_colour'><value>$vehicle_colour</value></field>
<field name='client_name'><value>$clientname</value></field>
<field name='client_address'><value>$address</value></field>
<field name='client_city'><value>$city</value></field>
<field name='installation_type'><value>$installation_type</value></field>
<field name='device_model'><value>$device_model</value></field>
<field name='device_serial_no'><value>$device_serial_no</value></field>
<field name='commision_fld01'><value>$commisioning_fld01</value></field>
<field name='commision_fld02'><value>$commisioning_fld02</value></field>
<field name='commision_fld03'><value>$commisioning_fld03</value></field>
<field name='commision_fld04'><value>$commisioning_fld04</value></field>
<field name='commision_fld05'><value>$commisioning_fld05</value></field>
<field name='commision_fld06'><value>$commisioning_fld06</value></field>
<field name='commision_fld07'><value>$commisioning_fld07</value></field>
<field name='commision_fld08'><value>$commisioning_fld08</value></field>
<field name='commision_fld09'><value>$commisioning_fld09</value></field>
<field name='commision_fld10'><value>$commisioning_fld10</value></field>
<field name='commision_fld11'><value>$commisioning_fld12</value></field>
<field name='commision_fld12'><value>$commisioning_fld12</value></field>
<field name='usrinstr_fld01'><value>$usrinstr_fld01</value></field>
<field name='usrinstr_fld02'><value>$usrinstr_fld02</value></field>
<field name='usrinstr_fld03'><value>$usrinstr_fld03</value></field>
<field name='usrinstr_fld04'><value>$usrinstr_fld04</value></field>
<field name='usrinstr_fld05'><value>$usrinstr_fld05</value></field>
<field name='usrinstr_fld06'><value>$usrinstr_fld06</value></field>
<field name='usrinstr_fld07'><value>$usrinstr_fld07</value></field>
<field name='usrinstr_fld08'><value>$usrinstr_fld08</value></field>
<field name='usrinstr_fld09'><value>$usrinstr_fld09</value></field>
<field name='usrinstr_fld10'><value>$usrinstr_fld10</value></field>
<field name='usrinstr_fld11'><value>$usrinstr_fld11</value></field>
<field name='usrinstr_fld12'><value>$usrinstr_fld12</value></field>
<field name='variations'><value>$variations</value></field>
<field name='validation_period'><value>$validation_period</value></field>
<field name='expiry_date'><value>$expiry_date</value></field>
<field name='issue_date'><value>$issue_date</value></field>
<field name='signature_name'><value>$signature_name</value></field>
<field name='signature_position'><value>$signature_position</value></field>
</fields>
</xfdf>
_XML_;
	return $XML;
}

function printToScreen($enquiryrecords,$pagination,$labels,$config)
{
	foreach ($enquiryrecords as $item )
	{
		$section1 = getSection1($item,$labels);
		$section2 = getSection2($item,$labels);
		$section3 = getSection3($item,$labels);
		$section4 = getSection4($item,$labels);

		$num = rand(0,999999);
		$num = str_pad($num, 6, "0", STR_PAD_LEFT);
		$cert_id	  = 'CERT'.date("YmdHis").$num;
		$enqurl = sprintf('<div id=enqtot>Total : %s</div><div id=enqpag>%s</div>',$config['total_items'],$pagination);
		$pdfurl = ""; 
		if($config['printable'] && $item->certificate_status=="ACTIVE")
		{
			$pdfurl .= sprintf('<div id=enqprt> [ <a href=%sindex.php/xfdfexport/index/%s target=_blank>Printable Version</a> ] </div>',url::base(),$cert_id)."\n";
		}
$HTML=<<<_HTML_
	<style>
	.enqhdr {width:100%; color: #000000; background-color: #ffffff; font-family: verdana, arial, helvetica, sans-serif; font-size: 13pt; font-weight:  bold; margin: 0px 0px 0px 0px;  padding: 5px 0px 5px 0px; text-align: center; clear: both;}
	.enqshd {width: 100%; color: #ffffff; font-size: 1.3em; font-weight: bold; background-color:#000066;  margin: 0px 5px 0px 0px;  padding: 5px 2px 5px 2px; text-align: left; clear: both;}
	</style>
	<div class='enqshd'>Client and Vehicle Information</div>
	<div>$section1</div><p></p>
	<div class='enqshd'>Installation and Inspection Information</div>
	<div>$section2</div><p></p>
	<div class='enqshd'>Commissioning</div>
	<div>$section3</div><p></p>
	<div class='enqshd'>User Instructions</div>
	<div>$section4</div><p></p>
_HTML_;
		print $enqurl.$pdfurl.$HTML;

		//add xml data to pdfs_is table
		$pdf_xml	= makeXFDFXML($item,$labels);
		$pdf_data	= "<?xml version='1.0'?>"."\n";
		$pdf_data  	.= $pdf_xml;
		$pdf_data	= str_replace('&','and',$pdf_data); 
		$controller 	= $config['controller'];
		$idname		= $config['idname'];
		$type		= "xfdf";

		$csv = new Csv_Controller();
		$csv->InsertIntoCSVTable($cert_id,$pdf_data,$controller,$idname,$type);
	}
}
?>


