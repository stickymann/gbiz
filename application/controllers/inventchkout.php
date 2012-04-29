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
				return $arr;
			}
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
//print "<hr>".$val['branch_id']."<hr>";
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
print "[ ProcessRow() ]<br>"; 						
							$val = $this->ProcessRow($val);
							if( $val['status'] == "PARTIAL" ) { $chk_p++;}
							else if( $val['status'] == "NONE" ) { $chk_n++;}
							else if( $val['status'] == "COMPLETED" ) { $chk_c++;}
							else if( $val['status'] == "ERROR" ) { $chk_e++;}
print_r($val);
print "<br>[After Update]<hr>";	
						}
					}
				}
			}
			
			if( $chk_e > 0){ $this->UpdateOrderCheckOutStatus("ERROR"); }
			else if( $chk_p > 0 || ( $chk_c > 0 && $chk_n > 0)) { $this->UpdateOrderCheckOutStatus("PARTIAL"); }
			else if( $chk_n > 0 && $chk_c == 0 && $chk_p == 0) { $this->UpdateOrderCheckOutStatus("NONE"); }
			else if( $chk_c > 0 && $chk_n == 0 && $chk_p == 0) { $this->UpdateOrderCheckOutStatus("COMPLETED"); }
		}
	}
	
	public function ProcessRow($val)
	{
		$inventory = new Inventory_Controller();
		//if inventory item exist
		$querystr = sprintf('select count(id) as count from %s where product_id = "%s" && branch_id = "%s"',$inventory->param['tb_live'],$val['product_id'],$val['branch_id']);
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$recs = $result[0];
		if( $recs->count > 0 )
		{
			$querystr = sprintf('select qty_instock from %s where product_id = "%s" && branch_id = "%s"',$inventory->param['tb_live'],$val['product_id'],$val['branch_id']);
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
			}
		}
		return $val;
	}
	
	public function UpdateOrderCheckOutStatus($status)
	{
	
print "[Order CheckOut Status: ".$status." ]<hr>";
	}
	
	public function authorize_post_update_existing_record()
	{
//print_r($_POST);	
		$this->ProcessCheckout($_POST);
		
	}
}