<?php defined('SYSPATH') or die('No direct script access.');

class Tillmanage_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('tillmanage');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script(array('media/js/tillmanage'));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('till_id','required','length[2,59]','standard_text');
		$validation->add_rules('till_user','required','length[2,50]','standard_text');
		$validation->add_rules('till_date','required','length[10]','alpha_dash');
		$validation->add_rules('initial_balance','required','numeric');
		$validation->add_rules('status','required','length[2,50]','standard_text');
		$validation->add_rules('expiry_date','required','length[10]','alpha_dash');
		$validation->add_rules('expiry_time','required','length[8]','chars[:,1,2,3,4,5,6,7,8,9,0]');
		
		$validation->add_callbacks('till_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['till_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function authorize_post_insert_new_record()
	{
		$data['till_id']			= $_POST['till_id'];
		$data['initial_balance']	= $_POST['initial_balance'];
		$data['idname']				= Auth::instance()->get_user()->idname; 
		$tilltransaction = new Tilltransaction_Controller();
		$tilltransaction->InsertIntoTillTransactionTable($data);
	}
}
