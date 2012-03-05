<?php defined('SYSPATH') or die('No direct script access.');

class Inventchkout_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('inventchkout');
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
		$validation->add_rules('order_id','required', 'length[16]', 'standard_text');
		
		$validation->add_callbacks('order_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['order_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function InsertIntoCheckoutTable($data)
	{
		//if order_id does not exist
		$querystr = sprintf('select count(id) as count from %s where order_id = "%s"',$this->param['tb_live'],$data['order_id']);
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$recs = $result[0];
		if( $recs->count == 0 )
		{
			//set up new checkout record and insert into checkout table 
			$arr = $this->param['primarymodel']->createBlankRecord($this->param['tb_live'],$this->param['tb_inau']);
			$arr = (array) $arr;
			$querystr = sprintf('delete from %s where id = "%s"',$this->param['tb_inau'],$arr['id']);
			if($result = $this->param['primarymodel']->executeNonSelectQuery($querystr))
			{
				$arr['order_id']		 = $data['order_id'];
				$arr['checkout_details'] = $data['checkout_details'];
				$arr['run']				 = "Y";
				$arr['comments']		 = "";
				$arr['inputter']		 = $data['idname'];
				$arr['input_date']		 = date('Y-m-d H:i:s'); 
				$arr['authorizer']		 = $data['idname'];
				$arr['auth_date']		 = date('Y-m-d H:i:s'); 
				$arr['record_status']	 = "LIVE";
				$arr['current_no']		 = "1";
				$this->param['primarymodel']->insertRecord($this->param['tb_live'],$arr);
			}
		}
	}
}