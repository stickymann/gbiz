<?php defined('SYSPATH') or die('No direct script access.');

class Device_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('device');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS()
	{
		return html::script( array('media/js/device.js'.$this->randomstring ));
	}

	function input_validation()
	{
		$_POST['device_id']	= strtoupper($_POST['device_id']);
		
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('device_id','required','length[3,50]', 'standard_text');
		$validation->add_rules('model','required','length[3,50]', 'standard_text');
		$validation->add_rules('warranty_expiry_date','required','length[10]','alpha_dash');
		$validation->add_rules('passcode','numeric');
		$validation->add_rules('sms_enabled','required', 'length[1]', 'alpha');
		$validation->add_rules('gprs_enabled','required', 'length[1]', 'alpha');
		$validation->add_rules('imei','numeric');
		$validation->add_rules('phone_device','required','length[7]','numeric');
		$validation->add_rules('phone_textback1','required','length[7]','numeric');
		$validation->add_rules('phone_textback2','length[7]','numeric');
		$validation->add_rules('gpsgate_user','length[2,50]','standard_text');
		$validation->add_rules('gpsgate_pass','length[2,255]','standard_text');
		$validation->add_rules('order_id','numeric');
		
		$validation->add_callbacks('device_id', array($this, '_duplicate_altid'));
		
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['device_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}