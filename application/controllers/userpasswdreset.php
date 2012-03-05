<?php defined('SYSPATH') or die('No direct script access.');

class Userpasswdreset_Controller extends Site_Controller
{
	
	public function __construct()
    {
		parent::__construct('userpasswdreset');
		$this->param['htmlhead'] .= $this->insertHeadJS($this->param['controller']);
	}	
		
	public function index($opt="")
    {
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS($controller)
	{
		$TEXT=<<<_text_
		<script type="text/javascript">
		$(document).ready(function()
		{
			$('#password').val("");
		});
		</script>
_text_;
		return $TEXT;
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		$validation->add_rules('password','required', 'length[3,20]', 'standard_text');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = (array) $validation;
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}
	
	public function input_post_update_existing_record()
	{
		$user = ORM::factory('users_i',$_POST['id']);
		$user->password = Auth::instance()->hash_password($_POST['password']);
		$user->save();
	}
}
