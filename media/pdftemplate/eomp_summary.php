<?php
$formfields = new SimpleXMLElement($data);
$this->pdf->AddPage();

$page_config['formfields'] = $formfields;
$page_config['pdf_margin_left'] = $pdf_margin_left; 
$page_config['pdf_margin_right'] = $pdf_margin_right; 
$page_config['pdf_margin_top'] = $pdf_margin_top; 
$page_config['pdf_margin_bottom'] = $pdf_margin_bottom; 
$page_config['title'] = "INVOICE PAYMENTS SUMMARY";
$page_config['title_height'] = 10;
$page_config['col_width'] = array(15,20,30,30,72,25);
$page_config['col_headers'] = array('Invoice Id','Invoice Date','First Name','Last Name','Payment Type','Payment Total');
page_title($this->pdf, $page_config);
page_body($this->pdf, $page_config);
page_audit($this->pdf, $page_config);

function page_body(&$pdf,$page_config)
{
	//Header
	$pdf->SetFillColor(211,211,211);
	$pdf->SetTextColor(0);
	$pdf->SetLineWidth(0.1);
	$w = $page_config['col_width'];
	$header = $page_config['col_headers'];
	$num_headers = count($header);
	for($i = 0; $i < $num_headers; ++$i) 
	{
		$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
	}
	$pdf->Ln();
	// Color and font restoration
	$pdf->SetFillColor(224, 235, 255);
	$fill = 0;
	
	//Line Data
	$formfields = $page_config['formfields'];
	$batch_id = $formfields->batch;
	
	$table = 'eominvoicedetails';
	$fields = array('alt_invoice_id','order_date','first_name','last_name','payment_type','payment_total');
	$querystr = sprintf('select %s from %s where batch_id = "%s"', join(',',$fields),$table,$batch_id);
	$sitemodel = new Site_Model();
	$result = $sitemodel->executeSelectQuery($querystr);
	if($result)
	{
		foreach($result as $index => $row)
		{
			$pdf->Cell($w[0], 6, $row->alt_invoice_id, 'LR', 0, 'L', $fill);
			$pdf->Cell($w[1], 6, $row->order_date, 'LR', 0, 'C', $fill);
			$pdf->Cell($w[2], 6, $row->first_name, 'LR', 0, 'L', $fill);
			$pdf->Cell($w[3], 6, $row->last_name, 'LR', 0, 'L', $fill);
			$pdf->Cell($w[4], 6, $row->payment_type, 'LR', 0, 'L', $fill);
			$pdf->Cell($w[5], 6, number_format($row->payment_total, 2, '.', ','), 'LR', 0, 'R', $fill);
			$pdf->Ln();
			$fill=!$fill;
		}
		$pdf->Cell(array_sum($w), 0, '', 'T');
	}
}

function page_title(&$pdf,$page_config)
{	
	//title
	$html = sprintf('<span style="font-size: 16pt; font-weight: bold;">%s</span>', $page_config['title'] );
	$pdf->writeHTMLCell(0, $page_config['title_height'], $page_config['pdf_margin_left'], $page_config['pdf_margin_top'], $html, 0, 1, 0, true, 'C', true);
}

function page_audit(&$pdf,$page_config)
{
	$formfields = $page_config['formfields'];
	$batch_id = $formfields->batch;
	$printuser = $formfields->audit->printuser;
	$printdate = $formfields->audit->printdate;
	$html = sprintf('Batch Id : %s <br>%s<br>%s',$batch_id,$printuser,$printdate);
	$pdf->Ln(); $pdf->Ln();
	$pdf->writeHTML($html, true, false, true, false, '');
}
?>