<?php defined('SYSPATH') or die('No direct script access.');

class Batchinvoice_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('batchinvoice');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function insertHeadJS()
	{
		$js = html::script( array('media/js/batchinvoice.js'.$this->randomstring ));
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
		$validation->add_rules('batch_id','required', 'length[16]', 'standard_text');
		$validation->add_rules('batch_description','required', 'length[1,255]', 'standard_text');
		$validation->add_rules('batch_date', 'length[10]','alpha_dash');
		$validation->add_rules('batch_details','required');
		$validation->add_callbacks('batch_id', array($this, '_duplicate_altid'));
		$validation->add_callbacks('batch_details',array($this,'_batch_details_exist'));
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
		
		
		//$validation->add_callbacks('?????_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['batch_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function _batch_details_exist(Validation $validation,$field)
	{
		$count = 0;
		$rows = new SimpleXMLElement($_POST['batch_details']);
		if($rows->row) 
		{ 
			foreach ($rows->row as $row) 
			{ 
				$count++; 
			} 
		}
		if (array_key_exists('zero_batchdetails', $validation->errors())) {return;}
		if( !($count > 0) ) { $validation->add_error($field, 'zero_batchdetails');}
	}
}
