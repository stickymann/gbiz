<?php defined('SYSPATH') or die('No direct script access.');

class Order_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('order');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script(array('media/js/order'));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('order_id','required', 'length[1,16]', 'standard_text');
		$validation->add_rules('branch_id','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('customer_id','required', 'length[8]', 'standard_text');
		$validation->add_rules('order_date', 'length[10]','alpha_dash');
		$validation->add_rules('status_change_date', 'length[10]','alpha_dash');
		$validation->add_rules('order_details','required');
		$validation->add_rules('inventory_checkout_type','required', 'length[4,6]', 'standard_text');
		$validation->add_rules('inventory_checkout_status','required', 'length[4,8]', 'standard_text');	
		$validation->add_callbacks('order_id', array($this, '_duplicate_altid'));
		$validation->add_callbacks('order_status', array($this, '_order_status_ok'));
		$validation->add_callbacks('order_details',array($this,'_order_details_exist'));
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
	
	public function _order_details_exist(Validation $validation,$field)
	{
		$count = 0; $usertext_required = false;
		$rows = new SimpleXMLElement($_POST['order_details']);
		if($rows->row) 
		{ 
			foreach ($rows->row as $row) 
			{ 
				$user_text = sprintf('%s',$row->user_text);
				if(!($user_text == "?") && (strlen($user_text) < 3)) { $usertext_required = true; }
				$count++; 
			} 
		}
		if (array_key_exists('zero_orderdetails', $validation->errors())) {return;}
		if( !($count > 0) ) { $validation->add_error($field, 'zero_orderdetails');}
		if( $usertext_required ) { $validation->add_error($field, 'usertext_required');}
	}

	public function _order_status_ok(Validation $validation,$field)
	{
		$status_new = false;
		if($_POST['order_status'] == "NEW") { $status_new = true; }
		if (array_key_exists('zero_orderdetails', $validation->errors())) {return;}
		if( $status_new ) { $validation->add_error($field, 'msg_new');}
	}

	function subFormSummaryHTML($results,$labels,$color)
	{
		$subtotal =0; $tax_total = 0; $grandtotal = 0;
		foreach($results as $index => $row)
		{
			$row = (array) $row;
			if($row['discount_type']=="PERCENT")
			{
				$discount_amount =  ($row['qty']*$row['unit_price']) *  ($row['discount_amount'] / 100);
			}
			else
			{
				$discount_amount =  $row['discount_amount'];
			}
			
			$subtotal		+= ($row['qty']*$row['unit_price']) - $discount_amount;
			$tax_total		+= $row['tax_amount'];
			$grandtotal		+= $row['extended'];
		}  
		
		$summaryhtml = '<table class="viewtext" width="30%">';
		$summaryhtml .= sprintf('<tr><td width="50%s" style="color:%s;"><b>Sub Total :</b></td><td width="25%s" style="text-align:right; padding 5px 5px 5px 5px; color:%s;">%s</td></tr>',"%",$color,"%",$color,number_format($subtotal, 2, '.', ''));
		$summaryhtml .= sprintf('<tr><td width="50%s" style="color:%s;"><b>Tax Total :</b></td><td width="25%s" style="text-align:right; padding 5px 5px 5px 5px; color:%s;">%s</td></tr>',"%",$color,"%",$color,number_format($tax_total, 2, '.', ''));
		$summaryhtml .= sprintf('<tr><td width="50%s" style="color:%s;"><b>GRAND TOTAL :</b></td><td width="25%s" style="text-align:right; padding 5px 5px 5px 5px; color:%s;"><b>%s</b></td></tr>',"%",$color,"%",$color,number_format($grandtotal, 2, '.', ''));
		$summaryhtml .= '</table>';
		return $summaryhtml;
	}

	public function subFormFieldExclusionList()
	{
		$list = array("order_details" => array("unit_total","tax_amount","extended"));
		return $list;
	}

	public function inventoryCheckout()
	{
		$chk = new Inventchkout_Controller();
		$idname = Auth::instance()->get_user()->idname;
		$xmlrows = "";

		if(!($_POST['order_status'] == "NEW") && !($_POST['order_status'] == "QUOTATION") && $_POST['current_no'] > 0)
		{
			$param	= $this->param['primarymodel']->getControllerParams("product");
			$table	= $param['tb_live'];
			$unique_id = "product_id";
			$fields = array('product_id','type','package_items','product_description');

			$rows = new SimpleXMLElement($_POST['order_details']);
			if($rows->row) 
			{	
				$rowcount = 0;
				foreach ($rows->row as $row) 
				{ 
					$pid = sprintf('%s',$row->product_id);
					$qty = sprintf('%s',$row->qty);
					$desc = sprintf('%s',$row->description);
					$result = $this->param['primarymodel']->getRecordByIdVal($table,$unique_id ,$pid,$fields);
					if($result->type == "STOCK")
					{
$xmlrows .=sprintf('<row><product_id>%s</product_id><description>%s</description><order_qty>%s</order_qty><filled_qty>%s</filled_qty><checkout_qty>%s</checkout_qty><status>%s</status></row>',$pid,$desc,$qty,"0",$qty,"NONE")."\n";
						$rowcount++;
					}
					else if($result->type == "PACKAGE")
					{
						$packages = preg_split('/,/',$result->package_items);
						foreach($packages as $idx => $packagestr)
						{
							$arr = preg_split('/:/',$packagestr);
							$pck_pid = $arr[0];
							$pck_qty = $arr[1] * $qty;
							$pck_result = $this->param['primarymodel']->getRecordByIdVal($table,$unique_id ,$pck_pid,$fields);
							$pck_desc = $pck_result->product_description;
							if($pck_result->type == "STOCK")
							{
$xmlrows .=sprintf('<row><product_id>%s</product_id><description>%s</description><order_qty>%s</order_qty><filled_qty>%s</filled_qty><checkout_qty>%s</checkout_qty><status>%s</status></row>',$pck_pid,$pck_desc,$pck_qty,"0",$pck_qty,"NONE")."\n";
								$rowcount++;
							}
						}
					}
				}	 
			}
$xmlheader = "<?xml version='1.0' standalone='yes'?>"."\n"."<formfields>"."\n";
$xmlheader .= "<header><column>Product Id</column><column>Description</column><column>Order Qty</column><column>Filled Qty</column><column>Checkout Qty</column><column>Checkout Status</column></header>"."\n";
$xmlheader .= "<rows>"."\n";
$xmlfooter = "</rows>"."\n"."</formfields>"."\n";

			$data['order_id'] = $_POST['order_id']; 
			$data['checkout_details'] = $xmlheader.$xmlrows.$xmlfooter;
			$data['idname'] = $idname;
			
			if($rowcount > 0 )
			{
				//create inventory checkout profile
				$chkout_record = $chk->InsertIntoCheckoutTable($data);
			}
			else if($rowcount == 0 && $_POST['inventory_checkout_status'] == "NONE")
			{
				//update checkout status for nonstock order
				$chk->UpdateOrderCheckOutStatus($this->param['tb_live'],$_POST['order_id'],"COMPLETED");
			}
		}
		
		if( $_POST['inventory_checkout_type'] == "AUTO"  && !($_POST['inventory_checkout_status'] == "COMPLETED") && $rowcount > 0)
		{
			$chk->ProcessCheckout($chkout_record);
		}
	}
	
	public function authorize_post_update_existing_record()
	{
		$this->inventoryCheckout();
	}

	public function authorize_post_insert_new_record()
	{
		$this->inventoryCheckout();
	}
}
