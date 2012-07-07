<?php defined('SYSPATH') or die('No direct script access.');

class Pdf_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('pdf');
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function input_validation()
	{
		$_POST['pdf_id']	= strtoupper($_POST['pdf_id']);
		$post = $_POST;	
		
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('pdf_id','required', 'length[3,30]', 'standard_text');
		
		$validation->add_callbacks('pdf_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['pdf_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	//public function InsertIntoPDFTable($pdf_id,$data,$datatype,$controller,$idname,$type)
	public function InsertIntoPDFTable($pdfdata)
	{
		$arr_inau['pdf_id'] = $pdfdata['pdf_id'];
		//$this->param['primarymodel']->insertRecord($this->param['tb_inau'],$arr_inau);
		//$querystr = sprintf('select id from %s where pdf_id = "%s"',$this->param['tb_inau'],$pdf_id);
		//$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		//$this->param['primarymodel']->deleteRecordById($this->param['tb_inau'],$result[0]->id);
		//$querystr = sprintf('delete from %s where inputter = "%s" and authorizer = "%s" and record_status="HLD" and current_no="0"',$this->param['tb_inau'],$pdfdata['idname'],$pdfdata['idname']);
		$querystr = sprintf('delete from %s where inputter = "%s" and authorizer = "%s" and record_status="HLD" and current_no="0"',$this->param['tb_inau'],$pdfdata['idname'],$pdfdata['idname']);
		if($result = $this->param['primarymodel']->executeNonSelectQuery($querystr))
		{
			//$arr['id']			= $result[0]->id;
			$arr['pdf_id']			= $pdfdata['pdf_id'];
			$arr['pdf_template']	= $pdfdata['pdf_template'];
			$arr['controller']		= $pdfdata['controller'];
			$arr['type']			= $pdfdata['type'];
			$arr['data']			= $pdfdata['data'];
			$arr['data_type']		= $pdfdata['datatype'];
			$arr['inputter']		= $pdfdata['idname'];
			$arr['input_date']		= date('Y-m-d H:i:s'); 
			$arr['authorizer']		= $pdfdata['idname'];
			$arr['auth_date']		= date('Y-m-d H:i:s'); 
			$arr['record_status']	= "HLD";
			$arr['current_no']		= "0";
			$this->param['primarymodel']->insertRecord($this->param['tb_inau'],$arr);
		}
	}

	public function DeleteFromPDFTable($pdfdata)
	{
		$arr_inau['pdf_id'] = $pdfdata['pdf_id'];
		//clean up files in tmp directory
		
		$querystr = sprintf('select pdf_id from %s where inputter = "%s" and authorizer = "%s" and record_status="HLD" and current_no="0"',$this->param['tb_inau'],$pdfdata['idname'],$pdfdata['idname']);
		if($delarr = $this->param['primarymodel']->executeSelectQuery($querystr))
		{	
			foreach($delarr as $index => $row)
			{
				//delete file
				$filename ="/tmp/".$row->pdf_id.".pdf";
				if(file_exists($filename)){ unlink($filename); }
			}		

			$querystr = sprintf('delete from %s where inputter = "%s" and authorizer = "%s" and record_status="HLD" and current_no="0"',$this->param['tb_inau'],$pdfdata['idname'],$pdfdata['idname']);
			$result = $this->param['primarymodel']->executeNonSelectQuery($querystr);
			return $result;
		}
		return false;
		
		/*
		$querystr = sprintf('delete from %s where inputter = "%s" and authorizer = "%s" and record_status="HLD" and current_no="0"',$this->param['tb_inau'],$pdfdata['idname'],$pdfdata['idname']);
		$result = $this->param['primarymodel']->executeNonSelectQuery($querystr);
		return $result;
		*/
	}

	public function InsertIntoPDFTableNoDelete($pdfdata)
	{
		$arr['pdf_id']			= $pdfdata['pdf_id'];
		$arr['pdf_template']	= $pdfdata['pdf_template'];
		$arr['controller']		= $pdfdata['controller'];
		$arr['type']			= $pdfdata['type'];
		$arr['data']			= $pdfdata['data'];
		$arr['data_type']		= $pdfdata['datatype'];
		$arr['inputter']		= $pdfdata['idname'];
		$arr['input_date']		= date('Y-m-d H:i:s'); 
		$arr['authorizer']		= $pdfdata['idname'];
		$arr['auth_date']		= date('Y-m-d H:i:s'); 
		$arr['record_status']	= "HLD";
		$arr['current_no']		= "0";
		$this->param['primarymodel']->insertRecord($this->param['tb_inau'],$arr);
	}
}
