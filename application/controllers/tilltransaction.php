<?php defined('SYSPATH') or die('No direct script access.');

class Tilltransaction_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('tilltransaction');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS()
	{
		return html::script(array('media/js/tilltransaction'));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('transaction_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('till_id','required', 'length[2,59]', 'standard_text');
		$validation->add_rules('amount','required','numeric');
		$validation->add_rules('transaction_type','required', 'length[4,11]', 'standard_text');
		$validation->add_rules('movement','required', 'length[2,3]', 'standard_text');
		$validation->add_rules('reason','required','standard_text');

		$validation->add_callbacks('transaction_id', array($this, '_duplicate_altid'));
		$validation->add_callbacks('till_id', array($this, '_is_till_ok'));

		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['transaction_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function _is_till_ok(Validation $validation,$field)
	{
		$till_id = $_POST['till_id'];
		$idname  = Auth::instance()->get_user()->idname;
		if (array_key_exists('msg_till', $validation->errors())) return;
		if( !($this->isUserTill($till_id,$idname)) )
		{
			$validation->add_error($field, 'msg_till');
		}
	}

	public function isUserTill($till_id,$idname)
	{
		$till = new Tilluser_Controller();
		//if till item exist
		$querystr = sprintf('select count(id) as count from %s where till_id = "%s" && till_user = "%s"',$till->param['tb_live'],$till_id,$idname);
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$recs = $result[0];
		if( $recs->count > 0 )
		{
			return true;
		}
		return false;
	}

	public function InsertIntoTillTransactionTable($data)
	{
		//set up new tilltransaction record and insert into tilltransaction table 
		$arr = $this->param['primarymodel']->createBlankRecord($this->param['tb_live'],$this->param['tb_inau']);
		$arr = (array) $arr;
		
		$baseurl = url::base(TRUE,'http');
		$url = sprintf('%sajaxtodb?option=orderid&controller=tilltransaction&prefix=TLL&ctrlid=%s',$baseurl,$arr['id']);
		$transaction_id = Sitehtml_Controller::getHTMLFromUrl($url);
		
		$querystr = sprintf('delete from %s where id = "%s"',$this->param['tb_inau'],$arr['id']);
		if($result = $this->param['primarymodel']->executeNonSelectQuery($querystr))
		{
			$arr['transaction_id']		= $transaction_id;
			$arr['till_id']				= $data['till_id'];
			$arr['amount']				= $data['initial_balance'];
			$arr['transaction_type']	= "CASH";
			$arr['movement']			= "IN";
			$arr['reason']				= "Initial balance for till ".$data['till_id'];
			$arr['inputter']			= $data['idname'];
			$arr['input_date']			= date('Y-m-d H:i:s'); 
			$arr['authorizer']			= 'SYSAUTH';
			$arr['auth_date']			= date('Y-m-d H:i:s'); 
			$arr['record_status']		= "LIVE";
			$arr['current_no']			= "1";
			$this->param['primarymodel']->insertRecord($this->param['tb_live'],$arr);
		}
	}
}