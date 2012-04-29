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
}