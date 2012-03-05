<?php defined('SYSPATH') or die('No direct script access.');

class Telbook_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('telbook');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script(array('media/js/telbook'));
	}
		
	function input_validation()
	{
		$_POST['username']	= strtoupper($_POST['username']);
		$_POST['plate']	= strtoupper($_POST['plate']);

		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('telno','required', 'length[7]','numeric');
		$validation->add_rules('plate','required', 'length[3,20]', 'standard_text');
		$validation->add_rules('username','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('mobile','required', 'length[9,23]', 'standard_text');
		$validation->add_rules('totalmoney','required','numeric');
		$validation->add_rules('centerpassword','required', 'length[6]','numeric');
		$validation->add_rules('hasalarm','required', 'length[1]','numeric');
		$validation->add_rules('groupid','required','numeric');
		$validation->add_rules('modemkind','required', 'length[1]','numeric');

		$validation->add_callbacks('plate', array($this, '_duplicate_altid'));
		$validation->add_callbacks('telno', array($this, '_duplicate_altid2'));


		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['plate'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function _duplicate_altid2(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['telno'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}