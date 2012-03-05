<?php defined('SYSPATH') or die('No direct script access.');

class Menudef_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('menudef');
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
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}
		
	function authorize_post_insert_new_record()
	{
		$menu = new Menusuper_Controller();
		$menu->updatesupers();
		//$menu->updateadmins();
	}
}