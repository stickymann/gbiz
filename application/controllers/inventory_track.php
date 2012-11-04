<?php defined('SYSPATH') or die('No direct script access.');

class Inventory_track_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('inventory_track');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		$js = html::script( array('media/js/inventorytrack.js'.$this->randomstring ));
		$controller = $this->param['controller'];
		$TEXT=<<<_text_
		<script type="text/javascript">
		var js_controller = "$controller";
		</script>

_text_;
		return $TEXT.$js;
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('stockbatch_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('stock_description','required', 'length[3,255]', 'standard_text');
		$validation->add_rules('product_id','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('stockin_date','required', 'length[10]','alpha_dash');
		$validation->add_rules('stockin_quantity','required','numeric');
		$validation->add_rules('stockbatch_details','required');

		$validation->add_callbacks('stockbatch_id', array($this, '_duplicate_altid'));
		$validation->add_callbacks('stockbatch_status', array($this, '_stockbatch_status_ok'));
		$validation->add_callbacks('stockbatch_details',array($this,'_stockbatch_details_exist'));
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['stockbatch_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}	
	
	public function _stockbatch_details_exist(Validation $validation,$field)
	{
		$count = 0; $usertext_required = false; $duplicate_serial_no = false; $duplicate_list_no = false; 
		$listarr = array();
		$qty = $_POST['stockin_quantity'];
		$stockbatch_id = $_POST['stockbatch_id'];

		$rows = new SimpleXMLElement($_POST['stockbatch_details']);
		if($rows->row) 
		{ 
			foreach ($rows->row as $row) 
			{ 
				$user_text = sprintf('%s',$row->item_comments);
				$serial_no = sprintf('%s',$row->serial_no);
				$count++;
				if(!($user_text == "?") && (strlen($user_text) < 3)) { $usertext_required = true; }
				if( $this->isDuplicateSerialNo($serial_no,$stockbatch_id) ) { $duplicate_serial_no = true; break; }
				if( in_array($serial_no, $listarr) ) { $duplicate_list_no = true; break; } else { array_push($listarr, $serial_no); }
			} 
		}
		if (array_key_exists('zero_details', $validation->errors())) {return;}
		if( !($count > 0) ) { $validation->add_error($field, 'zero_details');}
		if( $usertext_required ) { $validation->add_error($field, 'item_comments_required');}
		if( $qty != $count ) { $validation->add_error($field, 'quantity_mismatch');}
		if( $duplicate_serial_no ) { $validation->add_error($field, 'duplicate_serial_no');}
		if( $duplicate_list_no ) { $validation->add_error($field, 'duplicate_list_no');}
	}
	
	public function _stockbatch_status_ok(Validation $validation,$field)
	{
		$status_new = false;
		if($_POST['stockbatch_status'] == "NEW") { $status_new = true; }
		if (array_key_exists('zero_details', $validation->errors())) {return;}
		if( $status_new ) { $validation->add_error($field, 'msg_new');}
	}

	public function subFormSummaryHTML($results,$labels,$color)
	{
		$item_count = 0;
		foreach($results as $index => $row)
		{
			$item_count++;
		}  
		
		$summaryhtml = '<div id="itemcount">';
		$summaryhtml .= '<table class="viewtext" width="30%">';
		$summaryhtml .= sprintf('<tr><td style="color:%s;"><b>Item Count :</b></td><td style="text-align:right; padding 5px 5px 5px 5px; color:%s;">%s</td></tr>',$color,$color,$item_count);
		$summaryhtml .= '</table>';
		$summaryhtml .= '</div>';
		$summaryhtml .= '<div id="duptext"></div>';
		return $summaryhtml;
	}

	public function isDuplicateSerialNo($serial_no,$stockbatch_id)
	{
		$itd = new Inventory_track_detail_Controller();
		$itd->auto_render = FALSE;
		$table = $itd->param['tb_live'];
		$querystr = sprintf('select count(serial_no) as count from %s where serial_no = "%s" and stockbatch_id != "%s"',$table,$serial_no,$stockbatch_id);
		$result = $itd->param['primarymodel']->executeSelectQuery($querystr);
		$count = $result[0]->count;
		if($count > 0)
		{
			return true;
		}
		return false;	
	}
	
	public function isdupserialno()
	{
		$serial_no	= $_REQUEST['serial_no'];
		$stockbatch_id	= $_REQUEST['stockbatch_id'];
		$itd = new Inventory_track_detail_Controller();
		$itd->auto_render = FALSE;
		if( $this->isDuplicateSerialNo($serial_no,$stockbatch_id) ) 
		{
			
			$table = $itd->param['tb_live'];
			$querystr = sprintf('select serial_no,stockbatch_id from %s where serial_no = "%s" and stockbatch_id != "%s"',$table,$serial_no,$stockbatch_id);
			$result = $itd->param['primarymodel']->executeSelectQuery($querystr);
			$data = $result[0];
			$this->auto_render = FALSE;
			print json_encode($data);
		}
		else
		{
			$arr = array("serial_no"=>"false","stockbatch_id"=>"false");
			$this->auto_render = FALSE;
			print json_encode($arr);
		}
	}
}
