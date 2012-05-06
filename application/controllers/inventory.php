<?php defined('SYSPATH') or die('No direct script access.');

class Inventory_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('inventory');
		$this->param['htmlhead'] .= $this->insertHeadJS();
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}
	
	function insertHeadJS()
	{
		return html::script( array('media/js/inventory.js'.$this->randomstring ));
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('product_id','required','length[3,50]', 'standard_text');
		$validation->add_rules('branch_id','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('qty_instock','required','numeric');
		$validation->add_rules('reorder_level','required','numeric');
		$validation->add_rules('last_update_type','required', 'length[3,11]', 'standard_text');

		$validation->add_callbacks('product_id', array($this, '_duplicate_composite_id'));
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_composite_id(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$fields = array('product_id'=>$_POST['product_id'],'branch_id'=>$_POST['branch_id']);
		if (array_key_exists('msg_duplicate', $validation->errors())) { return; }
		if($this->param['primarymodel']->isDuplicateCompositeId($this->param['tb_inau'],$fields,$id) || $this->param['primarymodel']->isDuplicateCompositeId($this->param['tb_live'],$fields,$id))
		{
			$validation->add_error($field, 'msg_duplicate');
		}
	}
}