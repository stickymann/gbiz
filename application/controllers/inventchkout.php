<?php defined('SYSPATH') or die('No direct script access.');

class Inventchkout_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('inventchkout');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		return html::script(array('media/js/inventchkout'));
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

	public function xmlSubFormColDef($key,$xml)
	{
/*
function DefaultColumns(tt)
{
	colArr = [[
				{field:'subform_checkout_details_product_id',title:'<b>Product Id</b>',width:120,align:'left'},
				{field:'subform_checkout_details_description',title:'<b>Description</b>',width:200,align:'left'},
				{field:'subform_checkout_details_order_qty',title:'<b>Order Qty</b>',width:75,align:'center'},
				{field:'subform_checkout_details_filled_qty',title:'<b>Filled Qty</b>',width:75,align:'center'},
				{field:'subform_checkout_details_checkout_qty',title:'<b>Checkout Qty</b>',width:100,align:'center',editor:{type:'numberbox',options:{required:true}}},
				{field:'subform_checkout_details_status',title:'<b>Checkout Status</b>',width:125,align:'left'},
			]]
}
*/		$i=0;
		$coldefarr = array(
			"product_id"	=> "width:120,align:'left'",
			"description"	=> "width:200,align:'left'",
			"order_qty"		=> "width:75 ,align:'center'",
			"filled_qty"	=> "width:120,align:'center'",
			"checkout_qty"	=> "width:100,align:'left',editor:{type:'numberbox',options:{required:true}}",
			"status"		=> "width:125,align:'left'"
		);
		
		$formfields = new SimpleXMLElement($xml);
		$row = $formfields->rows->row;
		foreach ($row->children() as $field)
		{
			$colarr[$i] = sprintf('%s',$field->getName() );
			$i++;
		}

		$i=0;
		$COLDEFROW = "";  
		foreach($formfields->header->column as $val)
		{
			$val = sprintf('%s',$val);
			$colname = $colarr[$i];
			if(isset($coldefarr[$colname])) { $coldef = $coldefarr[$colname];} else {$coldef ="";}
			$COLDEFROW .= sprintf("{field:'subform_%s_%s',title:'<b>%s</b>',%s},",$key,$colname,$val,$coldef)."\n";
			$i++;
		}

		$TEXT=<<<_text_
		<script type="text/javascript">
		function DefaultColumns(tt)
		{
colArr = [[
$COLDEFROW
		]]
		}
		</script>
_text_;
		return $TEXT;
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
				$arr['authorizer']		 = 'SYSAUTH';
				$arr['auth_date']		 = date('Y-m-d H:i:s'); 
				$arr['record_status']	 = "LIVE";
				$arr['current_no']		 = "1";
				$this->param['primarymodel']->insertRecord($this->param['tb_live'],$arr);
				return $arr;
			}
		}
	}

	public function ProcessCheckout($data)
	{
		$chk_c = 0; $chk_p = 0; $chk_n = 0;  $chk_e = 0; 
		if( $data['run'] == "Y" )
		{
			$order = new Order_Controller();
			$querystr = sprintf('select branch_id from %s where order_id = "%s"',$order->param['tb_live'],$data['order_id']);
			$result = $this->param['primarymodel']->executeSelectQuery($querystr);
			if($result)
			{
				$xmlrows = ""; $dnoterows = "";
				$formfields = new SimpleXMLElement($data['checkout_details']);
				if($formfields->rows) 
				{
					foreach ($formfields->rows->row as $row) 
					{ 
						$val['branch_id'] = $result[0]->branch_id;
						$val['product_id'] = sprintf('%s',$row->product_id);
						$val['description'] = sprintf('%s',$row->description);
						$val['order_qty'] = sprintf('%s',$row->order_qty);
						$val['filled_qty'] = sprintf('%s',$row->filled_qty);
						$val['checkout_qty'] = sprintf('%s',$row->checkout_qty);
						$val['status'] = sprintf('%s',$row->status);						
						if($val['order_qty'] > $val['filled_qty'])
						{
							$val = $this->ProcessRow($val);
							if( $val['status'] == "PARTIAL" ) { $chk_p++;}
							else if( $val['status'] == "NONE" ) { $chk_n++;}
							else if( $val['status'] == "COMPLETED" ) { $chk_c++;}
							else if( $val['status'] == "ERROR" ) { $chk_e++;}
							$xmlrows .= $val['xmlrow'];
							$dnoterows .= $val['dnoterow'];
						}
						else
						{
							$xmlrows .= sprintf('<row><product_id>%s</product_id><description>%s</description><order_qty>%s</order_qty><filled_qty>%s</filled_qty><checkout_qty>%s</checkout_qty><status>%s</status></row>',$val['product_id'],$val['description'],$val['order_qty'],$val['filled_qty'],$val['checkout_qty'],$val['status']);
						}
						
					}
					$xmlrows = "<rows>".$xmlrows."</rows>";
					$replacement_xml = "<?xml version='1.0' standalone='yes'?><formfields>";
					$replacement_xml .= htmlspecialchars_decode( $formfields->header->asXML() );
					$replacement_xml .= $xmlrows."</formfields>";
					$arr['table'] = $this->param['tb_live'];
					$arr['order_id'] = $data['order_id'];
					$arr['checkout_details'] = $replacement_xml;
					$arr['run'] = "N";
					$this->UpdateCheckOutRecord($arr);
					
					//create delivery note
					$dnoterows = "<rows>".$dnoterows."</rows>";
					$dnote_xml = "<?xml version='1.0' standalone='yes'?><formfields>";
					$dnote_xml .= "<header><column>Product Id</column><column>Description</column><column>Qty</column></header>";
					$dnote_xml .= $dnoterows."</formfields>";
					$dnotedata['order_id']	= $data['order_id'];
					$dnotedata['details']	= $dnote_xml;
					$dnotedata['idname']	= Auth::instance()->get_user()->idname;
					$this->CreateDeliveryNote($dnotedata);
				}
			}
			
			if( $chk_e > 0){ $this->UpdateOrderCheckOutStatus($order->param['tb_live'],$data['order_id'],"ERROR"); }
			else if( $chk_p > 0 || ( $chk_c > 0 && $chk_n > 0)) { $this->UpdateOrderCheckOutStatus($order->param['tb_live'],$data['order_id'],"PARTIAL"); }
			else if( $chk_n > 0 && $chk_c == 0 && $chk_p == 0) { $this->UpdateOrderCheckOutStatus($order->param['tb_live'],$data['order_id'],"NONE"); }
			else if( $chk_c > 0 && $chk_n == 0 && $chk_p == 0) { $this->UpdateOrderCheckOutStatus($order->param['tb_live'],$data['order_id'],"COMPLETED"); }
		}
	}
	
	public function ProcessRow($val)
	{
		$rows = "";
		$inventory = new Inventory_Controller();
		//if inventory item exist
		$querystr = sprintf('select count(id) as count from %s where product_id = "%s" && branch_id = "%s"',$inventory->param['tb_live'],$val['product_id'],$val['branch_id']);
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$recs = $result[0];
		if( $recs->count > 0 )
		{
			$querystr = sprintf('select id,qty_instock,current_no from %s where product_id = "%s" && branch_id = "%s"',$inventory->param['tb_live'],$val['product_id'],$val['branch_id']);
			$result = $this->param['primarymodel']->executeSelectQuery($querystr);
			$qty_instock = $result[0]->qty_instock;
			if($qty_instock != 0)
			{
				if($qty_instock >= $val['checkout_qty'])
				{    
					//enough stock to fill order
					$val['adjust_qty'] = $qty_instock - $val['checkout_qty'];
					$val['filled_qty'] = $val['filled_qty'] + $val['checkout_qty'];
					$val['checkout_qty'] = $val['order_qty'] - $val['filled_qty'];
				}
				else
				{
					//not enough stock to fill order
					$val['adjust_qty'] =  0;
					$val['filled_qty'] = $val['filled_qty'] + $qty_instock;
					$val['checkout_qty'] = $val['checkout_qty'] - $qty_instock;
				}
				
				if($val['order_qty'] == $val['filled_qty']) { $val['status'] = "COMPLETED"; }
				else if($val['order_qty'] > $val['filled_qty']) { $val['status'] = "PARTIAL"; }
				else  { $val['status'] = "ERROR"; }
				
				//update inventory
				$iid = $result[0]->id;
				$current_no = $result[0]->current_no;
				if($this->param['primarymodel']->insertFromTableToTable($inventory->param['tb_hist'],$inventory->param['tb_live'],$iid))
				{
					$arr['id'] = $iid;
					$arr['qty_instock']		 = $val['adjust_qty'];
					$arr['last_update_type'] = "SALE";
					$arr['inputter']		 = Auth::instance()->get_user()->idname;
					$arr['input_date']		 = date('Y-m-d H:i:s'); 
					$arr['authorizer']		 = 'SYSAUTH';
					$arr['auth_date']		 = date('Y-m-d H:i:s'); 
					$arr['record_status']	 = "LIVE";
					$arr['current_no']		 = $current_no + 1;
					$this->param['primarymodel']->updateRecord($inventory->param['tb_live'],$arr);
				}
			}
		}
		$xmlrow = sprintf('<row><product_id>%s</product_id><description>%s</description><order_qty>%s</order_qty><filled_qty>%s</filled_qty><checkout_qty>%s</checkout_qty><status>%s</status></row>',$val['product_id'],$val['description'],$val['order_qty'],$val['filled_qty'],$val['checkout_qty'],$val['status']);
		$dnoterow = sprintf('<row><product_id>%s</product_id><description>%s</description><filled_qty>%s</filled_qty></row>',$val['product_id'],$val['description'],$val['filled_qty']);
		$val['xmlrow'] = $xmlrow;
		$val['dnoterow'] = $dnoterow;
		return $val;
	}
	
	public function UpdateOrderCheckOutStatus($table,$order_id,$status)
	{
		$querystr = sprintf('update %s set inventory_checkout_status = "%s" where order_id = "%s"',$table,$status,$order_id);
		$this->param['primarymodel']->executeNonSelectQuery($querystr);
	}

	public function UpdateCheckOutRecord($arr)
	{
		$querystr = sprintf('update %s set checkout_details = "%s", run = "%s" where order_id = "%s"',$arr['table'],$arr['checkout_details'],$arr['run'],$arr['order_id']);
		$this->param['primarymodel']->executeNonSelectQuery($querystr);
	}
	
	public function CreateDeliveryNote($data)
	{
		$dnote = new Deliverynote_Controller();
		$dnote->InsertIntoDeliveryNoteTable($data);
	}

	public function authorize_post_update_existing_record()
	{
		$this->ProcessCheckout($_POST);
	}
}