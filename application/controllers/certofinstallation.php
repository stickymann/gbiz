<?php defined('SYSPATH') or die('No direct script access.');

class Certofinstallation_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('certofinstallation');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script( array('media/js/certofinstallation.js'.$this->randomstring ));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('certificate_id','required', 'length[13,17]', 'standard_text');
		$validation->add_rules('certificate_status','required', 'length[1,7]', 'standard_text');
		$validation->add_rules('vehicle_id','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('chassis_number','required', 'length[1,100]', 'standard_text');
		$validation->add_rules('vehicle_type','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('vehicle_make','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('vehicle_model','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('vehicle_colour','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('first_name','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('last_name','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('address1','required', 'length[2,50]');
		$validation->add_rules('city','required', 'length[2,50]');
		$validation->add_rules('installation_type','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('device_model','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('device_serial_no','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('expiry_date','required','alpha_dash', 'length[10]');
		$validation->add_rules('issue_date','required','alpha_dash', 'length[10]');
		$validation->add_rules('commisioning_fld01','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld02','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld03','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld04','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld05','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld06','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld07','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld08','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld09','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld10','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld11','required', 'length[2,3]');
		$validation->add_rules('commisioning_fld12','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld01','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld02','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld03','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld04','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld05','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld06','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld07','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld08','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld09','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld10','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld11','required', 'length[2,3]');
		$validation->add_rules('usrinstr_fld12','required', 'length[2,3]');
		$validation->add_rules('variations','required', 'length[2,100]', 'standard_text');
		$validation->add_rules('validation_period','required', 'length[2,50]');
		$validation->add_rules('signature_name','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('signature_position','required', 'length[2,50]', 'standard_text');

		$validation->add_callbacks('certificate_id', array($this, '_duplicate_altid'));
		$validation->add_callbacks('certificate_status',array($this,'_active_certificate_exist'));

		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['certificate_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function _active_certificate_exist(Validation $validation,$field)
	{
		$vehicle_id	 = $_POST['vehicle_id'];
		$certificate_status = $_POST['certificate_status'];
		if (array_key_exists('active_cert', $validation->errors() ))
				return;
		if($certificate_status == "ACTIVE")
		{
			$querystr = sprintf('select count(id) as count from %s where vehicle_id = "%s" and %s = "ACTIVE" ',$this->param['tb_live'],$vehicle_id,$field);
			$result = $this->param['primarymodel']->executeSelectQuery($querystr);
			if($result)
			{
				$obj = $result[0];
				if($obj->count > 0)
				{
					$validation->add_error($field, 'active_cert');
				}
			}
		}
	}

	public function authorize_post_insert_new_record()
	{
		$seq_no = substr($_POST['certificate_id'], -4);
		$current_no = $_POST['current_no'];
		$current_date = date('Y-m-d');
		$table = $this->param['tb_live'];
		
		if($current_no == 1 && $seq_no == "0001")
		{
			$querystr = sprintf('update %s set certificate_status = "EXPIRED" where expiry_date < (select date_add("%s", interval -1 day)) and certificate_status != "EXPIRED"',$table,$current_date);
			$this->param['primarymodel']->executeNonSelectQuery($querystr);
		}
	}
}
