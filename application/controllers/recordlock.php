<?php defined('SYSPATH') or die('No direct script access.');

class Recordlock_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('recordlock');
	}	
		
	public function index($opt="")
    {
		$this->param['indexfieldvalue'] = $opt;
		$this->processIndex();
	}
	
	
	public function livedelete()
	{
		$this->param['primarymodel']->removeRecordLockById($this->param['indexfieldvalue']);
		url::redirect($this->param['controller']);
	}
	
}