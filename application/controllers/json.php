<?php defined('SYSPATH') or die('No direct script access.');

class Json_Controller extends Controller
{
	public function __construct()
    {
		$this->db = new Site_Model;
		//$this->ctrl = new Site_Controller;
	}

	public function index()
	{
	
	}

	public function cleanupRecordLocksAndOphanRecords($recordlockid)
	{
		//set record status back to preload state	
		$arr = $this->db->getRecordLockById($recordlockid);
		if($arr)
		{
			if($arr->pre_status == 'NEW' || $arr->pre_status == 'LIVE')
			{	//delete INAU record, no change
				$this->db->deleteRecordById($arr->lock_table,$arr->record_id);
			}
			else if($arr->pre_status == 'INAU')
			{	//set status back to INAU, no change
				$this->db->setRecordStatus($arr->lock_table,$arr->record_id,'INAU');
			}
		}
		$this->db->removeRecordLockById($recordlockid);
	}
	
	public function removeRecordLockById($id)
	{
		$this->db->removeRecordLockById($id);
	}
}