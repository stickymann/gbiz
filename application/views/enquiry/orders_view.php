<?php
printToScreen($enquiryrecords,$pagination,$labels,$config);

function getSection1($item,$labels)
{
	$label_01 = $labels['id'];				$item_01 = $item->id;
	$label_02 = $labels['order_id'];		$item_02 = $item->order_id;
	$label_03 = $labels['branch_id'];		$item_03 = $item->branch_id;
	$label_04 = $labels['inputter'];		$item_04 = $item->inputter;
	$label_05 = $labels['order_date'];		$item_05 = $item->order_date;
	$label_06 = $labels['input_date'];		$item_06 = $item->input_date;
	$label_07 = $labels['customer_id'];		$item_07 = $item->customer_id;
	$label_08 = $labels['phone_mobile1'];	$item_08 = $item->phone_mobile1;
	$label_09 = $labels['phone_home'];		$item_09 = $item->phone_home;
	$label_10 = $labels['phone_work'];		$item_10 = $item->phone_work;
	$label_13 = $labels['comments'];		$item_13 = $item->comments;

	if($item->customer_type == 'COMPANY'){$fullname = $item->last_name;}else{$fullname = $item->first_name.' '.$item->last_name;}
	$address = $item->address1.', '.$item->address2.'<br>'.$item->city;
	$HTML=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>Customer Name : </td><td>$fullname [$item_07]</td></tr>
						<tr valign=top><td>Address : </td><td>$address</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>
						<tr valign=top><td>$label_09 : </td><td>$item_09</td></tr>
						<tr valign=top><td>$label_10 : </td><td>$item_10</td></tr>	
						<tr valign=top><td></td><td></td></tr>
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_01 : </td><td>$item_01</td></tr>
						<tr valign=top><td>$label_02 : </td><td>$item_02</td></tr>	
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
						<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
						<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>	
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
	$label_01 = $labels['quotation_date'];	$item_01 = $item->quotation_date;
	$label_02 = $labels['invoice_date'];	$item_02 = $item->invoice_date;
	$label_03 = $labels['order_status'];	$item_03 = $item->order_status;
	$label_04 = $labels['inventory_checkout_status'];	$item_04 = $item->inventory_checkout_status;
	$label_05 = $labels['inventory_update_type'];	$item_05 = $item->inventory_update_type;
	$label_06 = $labels['order_total'];		$item_06 = "$ ".number_format($item->order_total, 2, '.', ',');
	$label_07 = $labels['payment_total'];	$item_07 = "$ ".number_format($item->payment_total, 2, '.', ',');
	$label_08 = $labels['balance'];	$item_08 = "$ ".number_format($item->balance, 2, '.', ',');

	$HTML=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_01 : </td><td>$item_01</td></tr>
						<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
						<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
						<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>$label_02 : </td><td>$item_02</td></tr>
						<tr valign=top><td>$label_06 : </td><td>$item_06</td></tr>	
						<tr valign=top><td>$label_07 : </td><td>$item_07</td></tr>
						<tr valign=top><td>$label_08 : </td><td>$item_08</td></tr>
					</table>
				</td>
			</tr>
		</table>
_HTML_;
	return $HTML;
}

function OrderDetailsSubForm($item)
{
	$order = new Order_Controller();
	$subcontroller = $order->subform['order_details']['subformcontroller'];
	$idfield = $order->param['indexfield'];
	$idval =  $item->order_id;
	$current_no = $item->current_no;
	$results = $order->param['primarymodel']->getSubFormViewRecords($subcontroller,$idfield,$idval,$current_no,false,$labels);
	$HTML  = subFormHTML($results,$labels);
	$HTML .= '<table class="viewtext" width="72%">';
	$HTML .= sprintf('<tr><td style="text-align:left; padding 0px 5px 0px 0px; color:black;"><b>Sub Total :</b> %s </td>',"$ ".number_format($item->extended_total, 2, '.', ','));
	$HTML .= sprintf('<td style="text-align:left; padding 0px 5px 0px 0px; color:black;"><b>Discount Total :</b> %s </td>',"$ ".number_format($item->discount_total, 2, '.', ','));
	$HTML .= sprintf('<td style="text-align:left; padding 0px 5px 0px 0px; color:black;"><b>Tax Total :</b> %s </td>',"$ ".number_format($item->tax_total, 2, '.', ''));
	$HTML .= sprintf('<td  style="text-align:left; padding 0px 5px 0px 0px; color:black;"><b>GRAND TOTAL :</b> %s </b></td></tr>',"$ ".number_format($item->order_total, 2, '.', ','));
	$HTML .= '</table>';
	return $HTML;
}
	
function  subFormHTML($results,$labels)
{
	$HTML = "<table id='order_enq_details' width='100%'>"."\n";
	$TABLEHEADER = ""; $TABLEROWS ="";
	foreach($labels as $key => $val)
	{
		if(!($key == "id" || $key == "order_id"))
		{
			$TABLEHEADER .= sprintf("<th>%s</th>",$val);
		}
	}
	$TABLEHEADER = "<tr valign='top'>".$TABLEHEADER."</tr>"."\n";

	foreach($results as $index => $row)
	{
		$TABLEROWS .= "<tr>";
		$obj = (array) $row;
		foreach($obj as $key => $val)
		{
			if(!($key == "id" || $key == "order_id"))
			{
				$TABLEROWS .= sprintf('<td valign=top" style="color:black;">%s</td>',$val);
			}
		}
		$TABLEROWS .= "</tr>";
	}

	$HTML .= $TABLEHEADER.$TABLEROWS."\n"."</table>"."\n";
	return $HTML;
}

function Payments($item)
{
	$payment = new Payment_Controller();
	$order_id =  $item->order_id;
	$TABLEHEADER = ""; $TABLEROWS ="";
	$querystr = sprintf('select payment_id,branch_id,till_id,amount,payment_type,payment_date,ref_no,order_id,id from %s where order_id = "%s" and payment_status ="VALID"',$payment->param['tb_live'],$order_id);
	$results = $payment->param['primarymodel']->executeSelectQuery($querystr);
	$HTML = "<table id='order_enq_details' width='100%'>"."\n";
	$TABLEHEADER = "<tr valign='top'><th>Payment Id</th><th>Branch Id</th><th>Till Id</th><th>Amount</th><th>Payment Type</th><th>Payment Date</th><th>Ref No</th><th>Order Id</th><th>Id</th></tr>"."\n";
	foreach($results as $index => $row)
	{
		$TABLEROWS .= "<tr>";
		$obj = (array) $row;
		foreach($obj as $key => $val)
		{
			$TABLEROWS .= sprintf('<td valign=top" style="color:black;">%s</td>',$val);
		}
		$TABLEROWS .= "</tr>";
	}

	$HTML .= $TABLEHEADER.$TABLEROWS."\n"."</table>"."\n";
	$HTML .= '<table class="viewtext" width="40%">';
	$HTML .= sprintf('<tr><td style="text-align:left; padding 0px 5px 0px 0px; color:black;"><b>Payment Total :</b> %s </td>',"$ ".number_format($item->payment_total, 2, '.', ','));
	$HTML .= sprintf('<td style="text-align:left; padding 0px 5px 0px 0px; color:black;"><b>Balance :</b> %s </td></tr>',"$ ".number_format($item->balance, 2, '.', ','));
	$HTML .= '</table>';
	return $HTML;
}

function InventoryCheckoutStatus($item)
{
	$invchk = new Inventchkout_Controller();
	$order_id =  $item->order_id;
	$TABLEHEADER = ""; $TABLEROWS =""; $HTML="";
	$querystr = sprintf('select checkout_details from %s where order_id = "%s"',$invchk->param['tb_live'],$order_id);
	$results = $invchk->param['primarymodel']->executeSelectQuery($querystr);
	if($results)
	{
		$HTML = viewXMLTable($results[0]->checkout_details);	
	}
	return $HTML;
}

function DeliveryNote($item)
{
	$dnote = new Deliverynote_Controller();
	$order_id =  $item->order_id;
	$TABLEHEADER = ""; $TABLEROWS =""; $HTML = "";
	$querystr = sprintf('select id,deliverynote_id,deliverynote_date,details,status,delivered_by,delivery_date,returned_signed_by,returned_signed_date,comments from %s where order_id = "%s"',$dnote->param['tb_live'],$order_id);
	$results = $dnote->param['primarymodel']->executeSelectQuery($querystr);
	if($results)
	{
		foreach($results as $key => $row)
		{
		
		$item_01 = $row->id;
		$item_02 = $row->deliverynote_id;
		$item_03 = $row->deliverynote_date;
		$item_04 = $row->details;
		$item_05 = $row->status;
		$item_06 = $row->delivered_by;
		$item_07 = $row->delivery_date;
		$item_08 = $row->returned_signed_by;
		$item_09 = $row->returned_signed_date;
		$item_10 = $row->comments;
	
	$HTML1=<<<_HTML_
	<table border=0 width='100%' cellspacing=0 cellpadding=2>
			<tr valign=top>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td width='46%'>Delivery Note Id: </td><td>$item_02 [$item_01]</td></tr>
						<tr valign=top><td>Delivery Date: </td><td>$item_03</td></tr>
						<tr valign=top><td>Status : </td><td>$item_05</td></tr>
						<tr valign=top><td>Comments : </td><td>$item_10</td></tr>
					</table>
				</td>
				<td width='50%'>
					<table width='100%' border=0 cellspacing=0 cellpadding=1>
						<tr valign=top><td>Delivered By : </td><td>$item_06</td></tr>
						<tr valign=top><td>Delivered Date : </td><td>$item_07</td></tr>	
						<tr valign=top><td>Signed By : </td><td>$item_08</td></tr>
						<tr valign=top><td>Signed Date : </td><td>$item_09</td></tr>
					</table>
				</td>
			</tr>
	</table>
_HTML_;
		$HTML2 = viewXMLTable($row->details);	
		$HTML .= $HTML1.$HTML2."<p></p>";
		}
	}
	return $HTML;
}

function viewXMLTable($xml)
{
	$HTML = "<table id='order_enq_details' width='100%'>"."\n";
	$TABLEHEADER = ""; $TABLEROWS ="";
	$formfields = new SimpleXMLElement($xml);
		
	foreach($formfields->header->column as $val)
	{
		$val = sprintf('%s',$val);
		$TABLEHEADER .= sprintf("<th>%s</th>",$val);
	}
	$TABLEHEADER = "<tr valign='top'>".$TABLEHEADER."</tr>"."\n";

	foreach($formfields->rows->row as $row)
	{
		$TABLEROWS .= "<tr>";
		foreach ($row->children() as $field)
		{
			$subkey = sprintf('%s',$field->getName() );
			$val	= sprintf('%s',$row->$subkey);
			$TABLEROWS .= sprintf("<td valign='top' style='color:%s;'>%s</td>","black",$val);
		}
		$TABLEROWS .= "</tr>";
	}

	$HTML .= $TABLEHEADER.$TABLEROWS."\n"."</table>"."\n";
	return $HTML;
}

function makePDFXML($item,$label)
{
	$id = $item->id;						$order_id = $item->order_id;
	$branch_id = $item->branch_id;			$inputter = $item->inputter;
	$first_name = $item->first_name;		$last_name = $item->last_name;
	$customer_type = $item->customer_type;	$city = $item->city;
	$address1 = $item->address1;			$address2 = $item->address2;
	$phone_mobile1 = $item->phone_mobile1;	$phone_home = $item->phone_home;		
	$phone_work = $item->phone_work;		$current_no = $item->current_no;
	$invoice_date = $item->invoice_date;	$quotation_date = $item->quotation_date;
	$order_total = $item->order_total;		$payment_total = $item->payment_total; 
	$balance = $item->balance;				$sub_total = $item->extended_total;
	$tax_total = $item->tax_total;			$discount_total = $item->discount_total;

	$label_id = $label['id'];							$label_order_id = $label['order_id'];
	$label_branch_id = $label['branch_id'];				$label_inputter = $label['inputter'];
	$label_first_name = $label['first_name'];			$label_last_name = $label['last_name'];
	$label_customer_type = $label['customer_type'];		$label_city = $label['city'];
	$label_address1 = $label['address1'];				$label_address2 = $label['address2'];
	$label_phone_mobile1 = $label['phone_mobile1'];		$label_phone_home = $label['phone_home'];		
	$label_phone_work = $label['phone_work'];			$label_current_no = $label['current_no'];
	$label_invoice_date = $label['invoice_date'];		$label_quotation_date = $label['quotation_date'];
	$label_order_total = $label['order_total'];			$label_payment_total = $label['payment_total']; 
	$label_balance = $label['balance'];					$label_sub_total = $label['extended_total'];
	$label_tax_total = $label['tax_total'];				$label_discount_total = $label['discount_total'];
	
	$XML=<<<_XML_
<fields>
	<id><label>$label_id</label><value>$id</value></id>	
	<order_id><label>$label_order_id</label><value>$order_id</value></order_id>
	<branch_id><label>$label_branch_id</label><value>$branch_id</value></branch_id>
	<inputter><label>$label_inputter</label><value>$inputter</value></inputter>
	<first_name><label>$label_first_name</label><value>$first_name</value></first_name>
	<last_name><label>$label_last_name</label><value>$last_name</value></last_name>
	<customer_type><label>$label_customer_type</label><value>$customer_type</value></customer_type>
	<address1><label>$label_address1</label><value>$address1</value></address1>
	<address2><label>$label_address2</label><value>$address2</value></address2>
	<city><label>$label_city</label><value>$city</value></city>
	<phone_mobile1><label>$label_phone_mobile1</label><value>$phone_mobile1</value></phone_mobile1>
	<phone_home><label>$label_phone_home</label><value>$phone_home</value></phone_home>
	<phone_work><label>$label_phone_work</label><value>$phone_work</value></phone_work>
	<quotation_date><label>$label_quotation_date</label><value>$quotation_date</value></quotation_date>
	<invoice_date><label>$label_invoice_date</label><value>$invoice_date</value></invoice_date>
	<current_no><label>$label_current_no</label><value>$current_no</value></current_no>
	<sub_total><label>$label_sub_total</label><value>$sub_total</value></sub_total>
	<discount_total><label>$label_discount_total</label><value>$discount_total</value></discount_total>
	<tax_total><label>$label_tax_total</label><value>$tax_total</value></tax_total>
	<order_total><label>$label_order_total</label><value>$order_total</value></order_total>
	<payment_total><label>$label_payment_total</label><value>$payment_total</value></payment_total>
	<balance><label>$label_balance</label><value>$balance</value></balance>
</fields>
_XML_;
	return $XML;
}

function printToScreen($enquiryrecords,$pagination,$labels,$config)
{
	foreach ($enquiryrecords as $item )
	{
		$section1 = getSection1($item,$labels);
		$section2 = getSection2($item,$labels);
		$section3 = OrderDetailsSubForm($item);
		$section4 = Payments($item);
		$section5 = InventoryCheckoutStatus($item);
		$section6 = DeliveryNote($item);
		$num = rand(0,999999);
		$num = str_pad($num, 6, "0", STR_PAD_LEFT);
		$invoice_id	  = 'INV'.date("YmdHis").$num;
		$quotation_id = 'QTE'.date("YmdHis").$num;
		$enqurl = sprintf('<div id=enqtot>Total : %s</div><div id=enqpag>%s</div>',$config['total_items'],$pagination);
		$pdfurl = ""; 
		if($config['printable'])
		{
			$pdfurl = sprintf('<div id=enqprt>[ <a href=%sindex.php/pdfbuilder/index/%s target=_blank>Quotation</a> ] ',url::base(),$quotation_id)."\n";
			$pdfurl .= sprintf(' [ <a href=%sindex.php/pdfbuilder/index/%s target=_blank>Invoice</a> ] </div>',url::base(),$invoice_id)."\n";
		}
$HTML=<<<_HTML_
	<style>
	.enqhdr {width:100%; color: #000000; background-color: #ffffff; font-family: verdana, arial, helvetica, sans-serif; font-size: 13pt; font-weight:  bold; margin: 0px 0px 0px 0px;  padding: 5px 0px 5px 0px; text-align: center; clear: both;}
	.enqshd {width: 100%; color: #ffffff; font-size: 1.3em; font-weight: bold; background-color:#000066;  margin: 0px 5px 0px 0px;  padding: 5px 2px 5px 2px; text-align: left; clear: both;}
	</style>
	<div class='enqshd'>Order Information</div>
	<div>$section1</div><p></p>
	<div class='enqshd'>Order Status & Details</div>
	<div>$section2</div><p></p>
	<div>$section3</div><p><br></p>
	<div>$section4</div><p><br></p>
	<div class='enqshd'>Inventory Checkout Details</div><p></p>
	<div>$section5</div><p><br></p>
	<div class='enqshd'>Delivery Notes</div>
	<div>$section6</div><p></p>
_HTML_;
		print $enqurl.$pdfurl.$HTML;

		//add xml data to pdfs_is table
		$pdf_xml	= makePDFXML($item,$labels);
		$pdf_audit	= "<audit><printuser></printuser><printdate></printdate></audit>";
		if($config['printuser'] || $config['printdatetime'] )
		{
			$pdf_audit = "<audit>"; 
			if($config['printuser']) {$pdf_audit .= sprintf('<printuser>Printed By : %s</printuser>',$config['idname']);} 
			if($config['printdatetime']) {$pdf_audit .= sprintf('<printdate>Print Date : %s</printdate>',date('Y-m-d H:i:s'));} 
			$pdf_audit .= "</audit>"."\n"; 
		}
		$pdf_data = "<?xml version='1.0' standalone='yes'?>"."\n"."<formfields>"."\n";
		$pdf_data .= $pdf_xml."\n".$pdf_audit;
		$pdf_data .= "</formfields>"."\n";

		$pdf = new Pdf_Controller();
		$arr['pdf_id']			= $invoice_id;
		$arr['pdf_template']	= "GBIZ_INVOICE";
		$arr['controller']		= $config['controller'];
		$arr['type']			= $config['type'];
		$arr['data']			= $pdf_data;
		$arr['datatype']		= "xml";
		$arr['idname']			= $config['idname'];
		
		if( $pdf->DeleteFromPDFTable($arr) )
		{
			$pdf->InsertIntoPDFTableNoDelete($arr);
			$arr['pdf_id']			= $quotation_id;
			$arr['pdf_template']	= "GBIZ_QUOTATION";
			$pdf->InsertIntoPDFTableNoDelete($arr);
		}
	}
}
?>

