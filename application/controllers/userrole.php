<?php defined('SYSPATH') or die('No direct script access.');

class Userrole_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('userrole');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS()
	{
		return html::script(array('media/js/userrole'));
	}

	function insertRolesUsers()
	{
		$userarr = ORM::factory('user')->where(array('idname =' => $_POST['idname']))->select_list('id','idname');
		$rolearr = ORM::factory('role')->where(array('name =' => 'login'))->select_list('id','name');

		foreach($userarr as $userid => $userval) {break;}
		foreach($rolearr as $roleid => $roleval) {break;}
		$user = ORM::factory('user',$userid);
		$role = ORM::factory('role',$roleid);
			
		//delete old user roles
		$query = sprintf('delete from %s where user_id = "%s" and role_id !="%s"','roles_users',$user->id,$role->id);
		if($this->param['primarymodel']->executeNonSelectQuery($query))
		{
			//insert new user roles
			$rolecount = count($rolelist = preg_split('/,/',$_POST['roles']));
			if(!($rolelist[0] == ''))
			{
				foreach($rolelist as $key => $val)
				{
					$user->add(ORM::factory('role',$val));
					$user->save();
				}
			}
		}
		else
			$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
	}
	
	public function authorize_post_insert_new_record(){$this->insertRolesUsers();}
	public function authorize_post_update_existing_record(){$this->insertRolesUsers();}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','standard_text');
		$validation->add_rules('idname','required', 'length[3,50]', 'standard_text');
		$validation->add_callbacks('idname', array($this, '_duplicate_idname'));
		
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_idname(Validation $validation,$field)
    {
		$id = $_POST['id'];
		$unique_id = $_POST['idname'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
}
