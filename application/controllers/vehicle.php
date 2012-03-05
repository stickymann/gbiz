<?php defined('SYSPATH') or die('No direct script access.');

class Vehicle_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('vehicle');
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function input_validation()
	{		
		$_POST['vehicle_id']	= strtoupper($_POST['vehicle_id']);
		$_POST['make']	= $this->strtotitlecase($_POST['make']);
		$_POST['model']	= $this->strtotitlecase($_POST['model']);
		$_POST['color']	= $this->strtotitlecase($_POST['color']);

		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('vehicle_id','required', 'length[3,20]', 'standard_text');
		$validation->add_rules('owner_id','required', 'length[8]', 'standard_text');
		$validation->add_rules('device_id','required', 'length[3,50]', 'standard_text');
		$validation->add_rules('chassis_number','required', 'length[3,50]', 'standard_text');
		$validation->add_rules('make','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('model','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('color','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('installer','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('location','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('installation_date','required','length[10]','alpha_dash');
		$validation->add_callbacks('vehicle_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['vehicle_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}