<?php defined('SYSPATH') or die('No direct script access.');

class Vehicle_Controller extends Site_Controller
{
	public function __construct()
    {
		parent::__construct('vehicle');
	}	
		
	public function index($opt="")
	{
		$this->param['indexfieldvalue'] = strtoupper($opt);
		$this->processIndex();
	}

	function input_validation()
	{		
		$_POST['vehicle_id']	= strtoupper($_POST['vehicle_id']);
		$_POST['make']	= $this->strtotitlecase($_POST['make']);
		$_POST['model']	= $this->strtotitlecase($_POST['model']);
		$_POST['color']	= $this->strtotitlecase($_POST['color']);

		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		
		$validation->add_rules('id','required','numeric');
		$validation->add_rules('vehicle_id','required', 'length[3,20]', 'standard_text');
		$validation->add_rules('owner_id','required', 'length[8]', 'standard_text');
		$validation->add_rules('device_id','required', 'length[3,50]', 'standard_text');
		$validation->add_rules('chassis_number','required', 'length[3,50]', 'standard_text');
		$validation->add_rules('make','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('model','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('color','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('installer','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('location','required', 'length[2,50]', 'standard_text');
		$validation->add_rules('installation_date','required','length[10]','alpha_dash');
		$validation->add_callbacks('vehicle_id', array($this, '_duplicate_altid'));
		
		//$validation->post_filter('strtoupper', '?????_id');
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = $validation->as_array();
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	public function _duplicate_altid(Validation $validation,$field)
    {
		$id	 = $_POST['id'];
		$unique_id = $_POST['vehicle_id'];
		if (array_key_exists('msg_duplicate', $validation->errors()))
				return;
		
        if ($this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_inau'],$field,$id,$unique_id) || $this->param['primarymodel']->isDuplicateUniqueId($this->param['tb_live'],$field,$id,$unique_id))
        {
            $validation->add_error($field, 'msg_duplicate');
        }
	}

	public function updateItemStatus()
	{
		$vehicle_id		= $_POST['vehicle_id'];
		$device_id		= $_POST['device_id'];
		$current_no		= $_POST['current_no'];
		$new_status		= "";
		$item_status	= "";

		$itd = new Inventory_track_detail_Controller();
		$querystr = sprintf('select imei,item_status from %s where device_id = "%s"',"vw_device_info",$device_id);
		$item = $this->param['primarymodel']->executeSelectQuery($querystr);
		
		if($item && $device_id != "NO.DEVICE")
		{
			$item_status = $item[0]->item_status; 
			$serial_no	 = $item[0]->imei;
			
			switch($item_status)
			{
				case "STOCK-NEW": 
					$new_status = "VEHICLE-NEW";
				break;
			
				case "STOCK-USED":
				case "FLOATING": 
					$new_status = "VEHICLE-USED";
				break;
			
				case "STOCK-REFURBISHED": 
				case "REPAIR-INHOUSE":
				case "REPAIR-RMA":
				case "DISPOSED": 
					$new_status = "VEHICLE-REFURBISHED";
				break;
			}
			if($new_status != "" )
			{
				$querystr = sprintf('update %s set item_status = "%s" where serial_no = "%s"',$itd->param['tb_live'],$new_status,$serial_no);
				$itd->param['primarymodel']->executeNonSelectQuery($querystr);
			}
		}
		
		if($current_no > 1)
		{
			$querystr = sprintf('select device_id from %s where vehicle_id ="%s" and current_no = "%s"',$this->param['tb_hist'],$vehicle_id,$current_no-1);
			$vehist = $this->param['primarymodel']->executeSelectQuery($querystr);
			if($vehist)
			{
				$prev_id = $vehist[0]->device_id;
				if($device_id != $prev_id && $prev_id != "NO.DEVICE")
				{
					$querystr = sprintf('select imei,item_status,device_status from %s where device_id = "%s"',"vw_device_info",$prev_id);
					$item2 = $this->param['primarymodel']->executeSelectQuery($querystr);
					if($item2)
					{
						$serial_no	 = $item2[0]->imei; $device_status = $item2[0]->device_status; $item_status = $item2[0]->item_status;
						switch($item_status)
						{
							case "VEHICLE-NEW": 
							case "VEHICLE-USED":
							case "VEHICLE-REFURBISHED":
							if($device_status == "ACTIVE")
							{
								$querystr = sprintf('update %s set item_status = "%s" where serial_no = "%s"',$itd->param['tb_live'],"FLOATING",$serial_no);
								$itd->param['primarymodel']->executeNonSelectQuery($querystr);
							}
							break;
						}
					}
				}
			}			
		}
	}
	
	public function authorize_post_update_existing_record()
	{
		$this->updateItemStatus();
	}

	public function authorize_post_insert_new_record()
	{
		$this->updateItemStatus();
	}
}