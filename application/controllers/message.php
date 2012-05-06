<?php defined('SYSPATH') or die('No direct script access.');

class Message_Controller extends Site_Controller
{
	public function __construct()
    {
		$this->delayLoad();
		parent::__construct("message");
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
    {
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS()
	{
		return html::script( array('media/js/message.js'.$this->randomstring ));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		$validation->add_rules('id','required','standard_text');
		//$validation->add_rules('vw','required', 'length[1]', 'standard_text');
		$validation->add_rules('recipient','required', 'length[1,50]', 'standard_text');
		$validation->add_rules('sender','required', 'length[1,50]', 'standard_text');	
		$validation->add_rules('subject','required', 'length[1,255]','standard_text');
		$validation->add_rules('body','required', 'length[1,8192]','standard_text');

		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}
		
	function delayLoad()
	{
		if(substr(getenv("HTTP_REFERER"),-3) == "app") { usleep(3000000); }
	}
	
	function inbox()
	{
		$this->param['url'] = $this->param['controller'].'/inbox';
		$this->param['pageheader'] = '<div id="msgcon" >Inbox</div>';
		$arr = $this->param['primarymodel']->getMessages($this->param['tb_live'],'recipient',Auth::instance()->get_user()->idname);
		$this->processEnquiry($arr);
	}
	
	function sent()
	{
		$this->param['url'] = $this->param['controller'].'/sent';
		$this->param['pageheader'] = '<div id="msgcon">Sent</div>';
		$arr = $this->param['primarymodel']->getMessages($this->param['tb_live'],'sender',Auth::instance()->get_user()->idname);
		$this->processEnquiry($arr);
	}

	function drafts()
	{	
		$this->param['url'] = $this->param['controller'].'/drafts';
		$this->param['pageheader'] = '<div id="msgcon">Drafts</div>';
		$arr = $this->param['primarymodel']->getMessages($this->param['tb_inau'],'sender',Auth::instance()->get_user()->idname);
		$this->processEnquiry($arr);
	}

	function view_pre_open_existing_record()
	{
		$arr=$this->param['primarymodel']->getRecordById($this->param['tb_live'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields']);
		if (isset ($arr->recipient))
		{
			if($arr->recipient == Auth::instance()->get_user()->idname )
			{
				$querystr = sprintf('update %s set vw="Y" where %s = "%s"',$this->param['tb_live'],$this->param['indexfield'],$this->param['indexfieldvalue']);
				if($result = $this->param['primarymodel']->executeNonSelectQuery($querystr))
				{
					//wait for update to complete, do nothing for now			
				}
			}
		}
	}
}
