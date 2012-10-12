<?php defined('SYSPATH') or die('No direct script access.');

class Deliverynote_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('deliverynote');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script( array('media/js/deliverynote.js'.$this->randomstring ));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rule
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('deliverynote_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('order_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('deliverynote_date', 'length[10]','alpha_dash');
		//$validation->add_rules('details','required', 'standard_text');
		$validation->add_rules('status','required', 'length[3,50]', 'standard_text');
		$validation->add_rules('delivered_by','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('delivery_date', 'length[10]','alpha_dash');
		
		$validation->add_callbacks('deliverynote_id', array($this, '_duplicate_altid'));
		$validation->add_callbacks('status',array($this,'_deliverystatus'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['deliverynote_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function _deliverystatus(Validation $validation,$field)
	{
		if (array_key_exists('msg_new', $validation->errors())) return;
		if($_POST['status'] == "NEW") { $validation->add_error($field, 'msg_new');}
	}
	
	public function InsertIntoDeliveryNoteTable($data)
	{
		//set up new checkout record and insert into checkout table 
		$arr = $this->param['primarymodel']->createBlankRecord($this->param['tb_live'],$this->param['tb_inau']);
		$arr = (array) $arr;
		
		$baseurl = url::base(TRUE,'http');
		$url = sprintf('%sajaxtodb?option=orderid&controller=deliverynote&prefix=DNT&ctrlid=%s',$baseurl,$arr['id']);
		$deliverynote_id = Sitehtml_Controller::getHTMLFromUrl($url);
		
		$querystr = sprintf('delete from %s where id = "%s"',$this->param['tb_inau'],$arr['id']);
		if($result = $this->param['primarymodel']->executeNonSelectQuery($querystr))
		{
			$arr['deliverynote_id']	 = $deliverynote_id;
			$arr['order_id']		 = $data['order_id'];
			$arr['deliverynote_date']= date('Y-m-d H:i:s'); 
			$arr['details']			 = $data['details'];
			$arr['status']			 = "NEW";
			$arr['inputter']		 = $data['idname'];
			$arr['input_date']		 = date('Y-m-d H:i:s'); 
			$arr['authorizer']		 = 'SYSAUTH';
			$arr['auth_date']		 = date('Y-m-d H:i:s'); 
			$arr['record_status']	 = "LIVE";
			$arr['current_no']		 = "1";
			$this->param['primarymodel']->insertRecord($this->param['tb_live'],$arr);
		}
	}
}