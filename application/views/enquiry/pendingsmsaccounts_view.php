<?php
printToScreen($enquiryrecords,$pagination,$labels,$config);

function getSection1($item,$labels)
{
	$label_01 = $labels['vehicle_id'];		$item_01 = $item->vehicle_id;
	$label_02 = $labels['telno'];			$item_02 = $item->telno;
	$label_03 = $labels['username'];		$item_03 = $item->username;
	$label_04 = $labels['mobile'];			$item_04 = $item->mobile;
	$label_05 = $labels['duplicate_telno'];	$item_05 = $item->duplicate_telno;

	
	$HTML=<<<_HTML_
		<table border=0 cellspacing=0 cellpadding=2>
			<tr valign=top><td>$label_01 : </td><td>$item_01</td></tr>
			<tr valign=top><td>$label_02 : </td><td>$item_02</td></tr>
			<tr valign=top><td>$label_03 : </td><td>$item_03</td></tr>
			<tr valign=top><td>$label_04 : </td><td>$item_04</td></tr>
			<tr valign=top><td>$label_05 : </td><td>$item_05</td></tr>	
		</table>
_HTML_;
	return $HTML;
}


function printToScreen($enquiryrecords,$pagination,$labels,$config)
{
	foreach ($enquiryrecords as $item )
	{
		$section1 = getSection1($item,$labels);
		$num = rand(0,999999);
		$num = str_pad($num, 6, "0", STR_PAD_LEFT);
		$pdf_id	  = 'PDF'.date("YmdHis").$num;
		$enqurl = sprintf('<div id=enqtot>Total : %s</div><div id=enqpag>%s</div>',$config['total_items'],$pagination);
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
	<div class='enqshd'>SMS Account</div>
	<div>$section1</div>
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
		//$pdf->InsertIntoPDFTable($pdf_id,$pdf_html,$config['controller'],$config['idname'],$config['type']);
		//print $pdf_html;
	}
}
?>

