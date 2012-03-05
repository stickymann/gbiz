<?php defined('SYSPATH') or die('No direct script access.');

class Useradmin_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('useradmin');
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
		$validation->add_rules('id','required','standard_text');
		$validation->add_rules('idname','required', 'length[3,50]', 'standard_text');
		$validation->add_rules('username','required', 'length[3,32]', 'standard_text');	
		$validation->add_rules('fullname','required', 'length[3,255]','standard_text');
		$validation->add_rules('email', 'required', 'valid::email');
		$validation->add_rules('enabled','required', 'length[1]', 'alpha');
		$validation->add_rules('expiry_date','required','date');
		$validation->add_rules('branch_id','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('department_id','required', 'length[2,50]', 'standard_text');
		//$validation->add_rules('password','required', 'length[3,20]', 'alpha');
		
		$validation->add_callbacks('idname', array($this, '_duplicate_idname'));
		$validation->add_callbacks('username',array($this, '_duplicate_username'));
		
		$validation->post_filter('strtoupper', 'idname');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
		$_POST['idname']=strtoupper($_POST['idname']);
	}
	
	/*can't pass parameter of callbacks, have to write two functions, parameter passing can be done as of Kohana ver 3.0.7*/
	public function _duplicate_username(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['username'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function _duplicate_idname(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['idname'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	function authorize_post_insert_new_record()
	{
		$user = ORM::factory('user',$_POST['id']);
		//$user->username = $_POST['idname'];
		$user->add(ORM::factory('role', 'login')); 
		$user->save();
	}
}