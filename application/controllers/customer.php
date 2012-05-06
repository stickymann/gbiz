<?php defined('SYSPATH') or die('No direct script access.');

class Customer_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('customer');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script( array('media/js/customer.js'.$this->randomstring ));
	}
	
	function input_validation()
	{
		$_POST['first_name']	= $this->strtotitlecase($_POST['first_name']);
		$_POST['last_name']		= $this->strtotitlecase($_POST['last_name']);
		$_POST['address1']		= $this->strtotitlecase($_POST['address1']);
		$_POST['address2']		=	$this->strtotitlecase($_POST['address2']);
		$_POST['city']			= $this->strtotitlecase($_POST['city']);
		$_POST['emergency_contact']	= $this->strtotitlecase($_POST['emergency_contact']);
		$_POST['driver_permit']	= strtoupper($_POST['driver_permit']);
		$_POST['passport']		= strtoupper($_POST['passport']);
		$_POST['email_address']	= strtolower($_POST['email_address']);
		$_POST['business_type']	= strtoupper($_POST['business_type']);
		$_POST['business_type'] = str_replace(" ",".",$_POST['business_type']);
		
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('customer_id','required', 'length[8]', 'standard_text');
		$validation->add_rules('customer_type','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('business_type','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('first_name','required', 'length[2,255]', 'standard_text');
		$validation->add_rules('last_name','required', 'length[2,255]', 'standard_text');	
		$validation->add_rules('address1','required', 'length[1,255]','standard_text');
		$validation->add_rules('city','required', 'length[1,255]','standard_text');
		$validation->add_rules('region_id','required','numeric');
		$validation->add_rules('country_id','required', 'length[2]','standard_text');
		$validation->add_rules('date_of_birth', 'length[10]','alpha_dash');
		$validation->add_rules('gender','required', 'length[1]', 'alpha');
		$validation->add_rules('phone_home', 'length[7]','numeric');
		$validation->add_rules('phone_work', 'length[7]','numeric');
		$validation->add_rules('phone_mobile1','required', 'length[7]','numeric');
		$validation->add_rules('phone_mobile2', 'length[7]','numeric');
		$validation->add_rules('email_address', 'valid::email');
		$validation->add_rules('driver_permit','required', 'standard_text');
		$validation->add_rules('branch_id','required', 'length[2,50]', 'standard_text');

		$validation->add_callbacks('customer_id', array($this, '_duplicate_altid'));
		//$validation->add_callbacks('first_name', array($this, 'ucfirst_sentence'));
		
		//$validation->post_filter('ucfirst_sentence', 'first_name');
		//$validation->post_filter('ucfirst_sentence', 'last_name');
		//$validation->post_filter('strtoupper', 'country_id');

		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	
		
		//$_POST['country_id']  =strtoupper($_POST['country_id']);
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

	function authorize_post_insert_new_record()
	{
		/*
		$db = new Site_Model();
		
		$arr[0] = "customeraccounts_is";
		$arr[1] = "`customer_account_id`,`customer_id`,`account_type`,`customer_status`,`status_change_date`,`status_confirmed`,`primary_account`,`inputter`,`input_date`,`record_status`,`current_no`";
		$arr[2] = $_POST['customer_id']."-01";
		$arr[3] = $_POST['customer_id'];
		$arr[4] = "FIRST.TIME";		
		$arr[5] = "UNSAVED";
		$arr[6] = date('Y-m-d H:i:s'); 
		$arr[7] = "N";
		$arr[8] = "Y";
		$arr[9] = Auth::instance()->get_user()->idname;
		$arr[10] = date('Y-m-d H:i:s'); 
		$arr[11] = "IHLD";
		$arr[12] = "0";
	
		$query = vsprintf('insert into `%s`(%s) values("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")',$arr);
		$db->executeNonSelectQuery($query);
		*/
	}
}