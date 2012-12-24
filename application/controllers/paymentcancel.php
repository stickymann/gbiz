<?php defined('SYSPATH') or die('No direct script access.');

class Paymentcancel_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('paymentcancel');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script( array('media/js/paymentcancel.js'.$this->randomstring ));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('paymentcancel_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('payment_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('amount','required','numeric');
		$validation->add_rules('reason','required', 'length[10,255]', 'standard_text');
		$validation->add_callbacks('paymentcancel_id', array($this, '_duplicate_altid'));
		
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['paymentcancel_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
	
	public function authorize_post_insert_new_record()
	{
		$pmnt = new Payment_Controller; 
		$pmnt->getFormlessRecord($_POST['payment_id']);
		$pmnt->form['payment_status'] = "CANCELLED";
		$pmnt->updateFormlessRecord($pmnt->form);
		$pmnt->authorize();
	}
}