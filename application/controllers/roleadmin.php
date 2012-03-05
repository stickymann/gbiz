<?php defined('SYSPATH') or die('No direct script access.');

class Roleadmin_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('roleadmin');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		$head_js_files =  html::stylesheet(array('media/css/jquery.treeview','media/css/screen'),array('screen','screen'));
		$head_js_files .= html::script(array('media/js/jquery.cookie','media/js/jquery.treeview','media/js/roleadmin'));
		return $head_js_files;
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('name','required', 'length[3,50]', 'standard_text');
		$validation->add_rules('description','required', 'length[3,50]', 'standard_text');
		
		$validation->add_callbacks('name', array($this, '_duplicate_altid'));
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}
	
	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['name'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}