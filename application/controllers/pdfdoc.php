<?php defined('SYSPATH') or die('No direct script access.');

class Pdfdoc_Controller extends Controller
{
	public function __construct()
    {
		if(!Auth::instance()->logged_in())
		{
			Site_Controller::redirectToLogin();	
		}
		
		require_once('media/tcpdf/config/lang/eng.php');
		require_once('media/tcpdf/tcpdf.php');
		$this->db = new Site_Model();
		$this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor('');
		$this->pdf->SetSubject('');
		$this->pdf->SetKeywords('');
	
		// set default header data
		$HEADER_STRING = PDF_HEADER_STRING;
		$this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,$HEADER_STRING );

		// set header and footer fonts
		$this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		//set auto page breaks
		$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		//$this->pdf->setLanguageArray($l);

		// set default font subsetting mode
		$this->pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		//$this->pdf->SetFont('dejavusans', '', 14, '', true);
		
		$this->pdf->SetFont('helvetica', '', 10.5, '', true);
		// Add a page
		// This method has several options, check the source code documentation for more information.
		$this->pdf->AddPage();
	}

	public function index($pdf_id)
    {
		$querystr = sprintf('select html from pdfs_is where pdf_id = "%s"',$pdf_id);
		$arr = $this->db->executeSelectQuery($querystr);
		$HTML = $arr[0]->html;
		$HTML = str_replace("'",'"', $HTML);
		// Set some content to print
		// Print text using writeHTMLCell()
		//$this->pdf->writeHTMLCell()$w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
		$this->pdf->SetTitle($pdf_id);
		$this->pdf->writeHTML($HTML, true, false, true, false, '');

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$this->pdf->Output($pdf_id.'.pdf', 'I');
	}
}
