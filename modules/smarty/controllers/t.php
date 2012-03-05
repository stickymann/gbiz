<?php defined('SYSPATH') OR die('No direct access allowed.');

class T_Controller extends Controller {

	public $template;
	
	function __construct()
	{
		parent::__construct();
	}

	function __destruct()
	{
		$this->template->render(TRUE);
	}
}
