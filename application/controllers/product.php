<?php defined('SYSPATH') or die('No direct script access.');

class Product_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('product');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS()
	{
		return html::script(array('media/js/product'));
	}

	function input_validation()
	{
		$_POST['product_id']	= strtoupper($_POST['product_id']);
		$_POST['category']		= strtoupper($_POST['category']);
		$_POST['sub_category']	= strtoupper($_POST['sub_category']);
		$_POST['product_id']	= str_replace(" ","",$_POST['product_id']);
		
		//$_POST['product_description']	= $this->strtotitlecase($_POST['product_description']);
		
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('product_id','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('type','required', 'length[2,7]', 'standard_text');
		$validation->add_rules('product_description','required', 'length[2,255]', 'standard_text');
		$validation->add_rules('category','required', 'length[2,20]', 'standard_text');
		$validation->add_rules('sub_category','required', 'length[2,20]', 'standard_text');
		$validation->add_rules('unit_price','required','numeric');
		$validation->add_rules('tax_percentage','required','numeric');
		$validation->add_rules('taxable','required', 'length[1]', 'standard_text');
		$validation->add_rules('status','required', 'length[2,20]', 'standard_text');
		
		$validation->add_callbacks('product_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['product_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}