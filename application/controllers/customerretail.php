<?php defined('SYSPATH') or die('No direct script access.');

class Customerretail_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('customerretail');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS($controller="")
	{
		return html::script(array('media/js/customer'));
	}
	
	function input_validation()
	{
		$_POST['first_name']	= $this->strtotitlecase($_POST['first_name']);
		$_POST['last_name']		= $this->strtotitlecase($_POST['last_name']);
		$_POST['address1']		= $this->strtotitlecase($_POST['address1']);
		$_POST['address2']		=	$this->strtotitlecase($_POST['address2']);
		$_POST['city']			= $this->strtotitlecase($_POST['city']);
		$_POST['email_address']	= strtolower($_POST['email_address']);
		$_POST['business_type']	= strtoupper($_POST['business_type']);
		$_POST['business_type'] = str_replace(" ",".",$_POST['business_type']);
		
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','standard_text');
		$validation->add_rules('customer_id','required', 'length[8]', 'standard_text');
		$validation->add_rules('customer_type','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('business_type','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('first_name','required', 'length[2,255]', 'standard_text');
		$validation->add_rules('last_name','required', 'length[2,255]', 'standard_text');	
		$validation->add_rules('address1','required', 'length[1,255]','standard_text');
		$validation->add_rules('city','required', 'length[1,255]','standard_text');
		$validation->add_rules('region_id','required','numeric');
		$validation->add_rules('country_id','required', 'length[2]','standard_text');
		$validation->add_rules('gender','required', 'length[1]', 'alpha');
		$validation->add_rules('phone_home', 'phone');
		$validation->add_rules('phone_work', 'phone');
		$validation->add_rules('phone_mobile1','required', 'phone');
		$validation->add_rules('phone_mobile2', 'phone');
		$validation->add_rules('email_address', 'valid::email');
		$validation->add_rules('branch_id','required', 'length[2,50]', 'standard_text');

		$validation->add_callbacks('customer_id', array($this, '_duplicate_altid'));

		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['customer_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}