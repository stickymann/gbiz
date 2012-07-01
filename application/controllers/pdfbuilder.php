<?php defined('SYSPATH') or die('No direct script access.');
require_once('media/tcpdf/config/lang/eng.php');
require_once('media/tcpdf/tcpdf.php');
require_once('media/pdftemplate/pdf_headfootdef.php');

class Pdfbuilder_Controller extends Controller
{
	public function __construct()
    {
		if(!Auth::instance()->logged_in())
		{
			Site_Controller::redirectToLogin();	
		}
		
		//ob_end_clean();
		
		$this->db  = new Site_Model();
		$this->pdft = new Pdftemplate_Controller();
	}

	public function index($pdf_id="sample")
    {
		$querystr = sprintf('select pdf_template,data from pdfs_is where pdf_id = "%s"',$pdf_id);
		$result = $this->db->executeSelectQuery($querystr);
		$template_id = $result[0]->pdf_template;
		$data		 = $result[0]->data;
		
		$querystr  = sprintf('select * from %s where template_id = "%s"',$this->pdft->param['tb_live'],$template_id);
		$result	= $this->db->executeSelectQuery($querystr);
		if($result)
		{
			$CLASS					= $result[0]->pdf_header_class;
			$pdf_page_orientation	= $result[0]->pdf_page_orientation;
			$pdf_unit				= $result[0]->pdf_unit;
			$pdf_page_format		= $result[0]->pdf_page_format;
			$pdf_font_monospaced	= $result[0]->pdf_font_monospaced;
			$pdf_font				= $result[0]->pdf_font;
			$pdf_fontstyle			= $result[0]->pdf_fontstyle;
			$pdf_fontsize			= $result[0]->pdf_fontsize;
			$pdf_margin_top			= $result[0]->pdf_margin_top;
			$pdf_margin_right		= $result[0]->pdf_margin_right;
			$pdf_margin_left		= $result[0]->pdf_margin_left;
			$pdf_margin_bottom		= $result[0]->pdf_margin_bottom;
			$pdf_output				= $result[0]->pdf_output;

			$this->pdf = new $CLASS($pdf_page_orientation, $pdf_unit, $pdf_page_format, true, 'UTF-8', false);

			// set document information
			$this->pdf->SetCreator(PDF_CREATOR);
			$this->pdf->SetAuthor('');
			$this->pdf->SetTitle('');
			$this->pdf->SetSubject('');
			$this->pdf->SetKeywords('');

			// set default fonts
			$this->pdf->SetDefaultMonospacedFont($pdf_font_monospaced);
			$this->pdf->SetFont($pdf_font, $pdf_fontstyle, $pdf_fontsize);
			
			//set margins
			$this->pdf->SetMargins($pdf_margin_left, $pdf_margin_top, $pdf_margin_right);

			//set auto page breaks
			$this->pdf->SetAutoPageBreak(TRUE, $pdf_margin_bottom);

			//set image scale factor
			$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			$pdf_template_file = "media/pdftemplate/".$result[0]->pdf_template_file;
			require_once($pdf_template_file);
			$this->pdf->Output("/tmp/".$pdf_id.'.pdf', $pdf_output);
		}
	}

}

