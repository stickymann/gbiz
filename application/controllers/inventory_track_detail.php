<?php defined('SYSPATH') or die('No direct script access.');

class Inventory_track_detail_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('inventory_track_detail');
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
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('serial_no','required', 'standard_text');
		
		//$validation->add_callbacks('?????_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['serial_no'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}
	
	public function updateStockBatchCurrentNo()
	{
		$stockbatch_id	= $_POST['stockbatch_id'];
		$current_no		= $_POST['current_no'];
		
		$it = new Inventory_track_Controller();	
		$querystr = sprintf('update %s set current_no = "%s" where stockbatch_id = "%s"',$it->param['tb_live'],$current_no,$stockbatch_id);
		$result = $it->param['primarymodel']->executeNonSelectQuery($querystr);
		if($result > 0)
		{
			$querystr = sprintf('update %s set current_no = "%s" where stockbatch_id = "%s"',$this->param['tb_live'],$current_no,$stockbatch_id);
			$result = $this->param['primarymodel']->executeNonSelectQuery($querystr);
		}
	}

	public function authorize_post_update_existing_record()
	{
		$this->updateStockBatchCurrentNo();
	}
	public function authorize_post_insert_new_record()
	{
		$this->updateStockBatchCurrentNo();
	}
}