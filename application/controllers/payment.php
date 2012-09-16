<?php defined('SYSPATH') or die('No direct script access.');

class Payment_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('payment');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS()
	{
		return html::script( array('media/js/payment.js'.$this->randomstring ));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('payment_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('branch_id','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('till_id','required', 'length[2,59]', 'standard_text');
		$validation->add_rules('order_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('amount','required','numeric');
		$validation->add_rules('payment_type','required', 'length[4,11]', 'standard_text');
		$validation->add_rules('payment_date', 'length[10]','alpha_dash');
		$validation->add_rules('payment_status','required', 'length[5,10]', 'standard_text');

		$validation->add_callbacks('payment_id', array($this, '_duplicate_altid'));
		$validation->add_callbacks('till_id', array($this, '_is_till_ok'));
		$validation->add_callbacks('order_id', array($this, '_is_orderstatus_ok'));

		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['payment_id'];
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

	public function _is_orderstatus_ok(Validation $validation,$field)
	{
		$order_id = $_POST['order_id'];
		$order = new Order_Controller();

		$querystr = sprintf('select count(id) as count from %s where order_id = "%s" and order_status = "QUOTATION"' ,"vw_orderbalances",$order_id);
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$recs = $result[0];
		if( $recs->count > 0 )
		{
			$validation->add_error($field, 'msg_orderstatus');	
		}
	}
	
	public function isUserTill($till_id,$idname)
	{
		$till = new Tilluser_Controller();
		//if till item exist
		$datestr = date('Y-m-d');
		$timestr = date('H:i:s');
		$querystr = sprintf('select count(id) as count from %s where till_id = "%s" && till_user = "%s" && expiry_date >= "%s" && expiry_time > "%s" && status="OPEN"',$till->param['tb_live'],$till_id,$idname,$datestr,$timestr);
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$recs = $result[0];
		if( $recs->count > 0 )
		{
			return true;
		}
		return false;
	}

	public function orderUpdate()
	{
		$order_id = $_POST['order_id'];
		$order = new Order_Controller();

		$querystr = sprintf('select count(id) as count from %s where order_id = "%s"',"vw_orderbalances",$order_id);
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$recs = $result[0];
		if( $recs->count > 0 )
		{
			$querystr = sprintf('select id,order_id,invoice_date,balance from %s where order_id = "%s"',"vw_orderbalances",$order_id);
			$result = $this->param['primarymodel']->executeSelectQuery($querystr);
			$orderrec = $result[0];
			
			if( $orderrec->balance > 0 ){ $order_status = "INVOICE.PART.PAID"; } else { $order_status = "INVOICE.FULL.PAID"; }
			$order->UpdateOrderStatus($order->param['tb_live'],$order_id,$order_status,date('Y-m-d')); 


			if( $orderrec->invoice_date == "" ||  $orderrec->invoice_date == "0000-00-00" )
			{
				$order->UpdateOrderInvoiceDate($order->param['tb_live'],$order_id,date('Y-m-d'));
			}
		}
	}
	
	public function authorize_post_insert_new_record()
	{
		$this->orderUpdate();
	}
}