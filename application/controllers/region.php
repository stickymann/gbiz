<?php defined('SYSPATH') or die('No direct script access.');

class Region_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('region');
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('area','required', 'length[2,255]', 'standard_text');
		$validation->add_rules('sub_region','required', 'length[1,255]', 'standard_text');
		$validation->add_rules('region','required', 'length[1,255]', 'standard_text');
		$validation->add_rules('country_id','required', 'length[2]', 'standard_text');
		
		$validation->add_callbacks('id', array($this, '_duplicate_altid'));
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}