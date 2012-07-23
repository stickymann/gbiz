<?php defined('SYSPATH') or die('No direct script access.');

class Eominvoices_rpt_Controller extends Sitereport_Controller
{

	public function __construct()
    {
		parent::__construct('eominvoices_rpt');
	}	
		
	public function index()
    {
      $this->processRequest();
    }

	public function report_run()
	{
		$batch_id = $_POST['batch_id'];
		$table = 'eominvoicedetails';
		$fields = array('invoice_id','alt_invoice_id','order_id','order_date','first_name','last_name','payment_type','payment_total');
		$querystr = sprintf('select %s from %s where batch_id = "%s"', join(',',$fields),$table,$batch_id);
		$result = $this->sitemodel->executeSelectQuery($querystr);
		
		$num = rand(0,999999);
		$num = str_pad($num, 6, "0", STR_PAD_LEFT);
		$invoices	  = 'EOMI'.date("YmdHis").$num;
		$payments = 'EOMP'.date("YmdHis").$num;
		$pdfurl = ""; 
		if($this->printable)
		{
			$pdfurl = sprintf('<div id=enqprt>[ <a href=%sindex.php/pdfbuilder/index/%s target=_blank>Payments</a> ] ',url::base(),$payments)."\n";
			$pdfurl .= sprintf(' [ <a href=%sindex.php/pdfbuilder/index/%s target=_blank>Invoices</a> ] </div>',url::base(),$invoices)."\n";
		}
		
		$RESULT = '<div id="e" style="padding:5px 5px 5px 5px;">';
		$RESULT .= sprintf('<div>Batch Id : %s</div> %s',$batch_id, $pdfurl);
		$RESULT .= '<table id="rpttbl" width="90%">'."\n";
		$firstpass = true;
		foreach($result as $row => $linerec)
		{	
			$linerec = (array)$linerec;
			$header = ''; $data = '';
			foreach ($linerec as $key => $value)
			{
				if($firstpass)
				{
					$headtxt = Site_Controller::strtotitlecase(str_replace("_"," ",$key));
					$header .= '<th>'.$headtxt.'</th>'; 
				}
				$data .= '<td>'.html::specialchars($value).'</td>'; 
			}
			
			if($firstpass)
			{
				$header = "\n".'<thead>'."\n".'<tr>'.$header.'</tr>'."\n".'</thead>'."\n".'<tbody>'."\n";
				$RESULT .=$header;
			}
			
			$data = '<tr>'.$data.'</tr>'."\n"; 
			$RESULT .= $data;
			$firstpass = false;
		}
		$RESULT .='</tbody>'."\n".'</table>'."\n";
		$RESULT .= '</div>';
		$this->content->pagebody = $RESULT;
		
		$config['batch_id']	= $batch_id;
		$config['invoices']	= $invoices;
		$config['payments']	= $payments;
		$config['idname']		= Auth::instance()->get_user()->idname;
		$config['controller']	= $this->controller;
		$config['type']		= "report";
		$this->createPDF($config);
	}
	
	public function createPDF($data)
	{
		//add xml data to pdfs_is table
		$pdf_xml	= "<batch>".$data['batch_id']."</batch>";
		$pdf_audit	= "<audit><printuser></printuser><printdate></printdate></audit>";
		if($this->rptparam['printuser'] || $this->rptparam['printdatetime'] )
		{
			$pdf_audit = "<audit>"; 
			if($this->rptparam['printuser']) {$pdf_audit .= sprintf('<printuser>Printed By : %s</printuser>',$data['idname']);} 
			if($this->rptparam['printdatetime']) {$pdf_audit .= sprintf('<printdate>Print Date : %s</printdate>',date('Y-m-d H:i:s'));} 
			$pdf_audit .= "</audit>"."\n"; 
		}
		$pdf_data = "<?xml version='1.0' standalone='yes'?>"."\n"."<formfields>"."\n";
		$pdf_data .= $pdf_xml."\n".$pdf_audit;
		$pdf_data .= "</formfields>"."\n";
		$pdf_data = str_replace('&','and',$pdf_data); 
		
		$pdf = new Pdf_Controller();
		$arr['pdf_id']			= $data['payments'];
		$arr['pdf_template']	= "EOMP_SUMMARY";
		$arr['controller']		= $data['controller'];
		$arr['type']			= $data['type'];
		$arr['data']			= $pdf_data;
		$arr['datatype']		= "xml";
		$arr['idname']			= $data['idname'];
		
		//$pdf->InsertIntoPDFTableNoDelete($arr);
		if( $pdf->DeleteFromPDFTable($arr) )
		{
			//wait for deletions
		}
		
		$pdf->InsertIntoPDFTableNoDelete($arr);
		//$arr['pdf_id']			= $quotation_id;
		//$arr['pdf_template']	= "GBIZ_QUOTATION";
		//$pdf->InsertIntoPDFTableNoDelete($arr);
	}
}
?>