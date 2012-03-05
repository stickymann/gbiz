<?php defined('SYSPATH') or die('No direct script access.');

class Site_Model extends Model
{
	private $errmsg;

	function __construct()
	{
		//parent::__construct();
		$this->db = Database::instance();
		$this->setDBErrMsg();
		//$this->fields = array('id' => $idField,'parent' => $parentField, 'sort' => $sortField);
	}

	public function setDBErrMsg($string='')
	{
		$this->errmsg = $string;
	}

	public function getDBErrMsg()
	{
		return $this->errmsg;
	}
	
	public function executeNonSelectQuery($query)
	{
		if($result = $this->db->query($query))
		{
			return true;
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function executeSelectQuery($query)
	{
		$result = $this->db->query($query);
		$arr = array();
		$i=0;
		foreach ($result as $row)
		{
			$arr[$i] = $row;
			$i++;
		}
		return $arr;
	}

	public function getParams($controller)
	{
		$this->table = 'params';
		$fields = array
		(
			'id','controller','module','auth_mode_on','indexview','viewview','inputview','authorizeview','deleteview','enquiryview',
			'indexfield','indexfieldvalue','indexlabel','appheader','primarymodel','tb_live','tb_inau','tb_hist',
			'pageheader','htmlhead','htmlbody','isinputvalid','validatedpost','inputerrors','errormsgfile'			
		);
		$query = sprintf('select %s from %s where controller = "%s"', join(',',$fields),$this->table,$controller);
		
		$result = $this->db->query($query);
		$arr = array();
		$idField = $fields[1];
		foreach ($result as $row)
		{
			$arr[$row->$idField] = $row;
		}
		return $arr;
	}

	public function getFormDefs($controller)
	{
		$this->table = 'formdefs';
		/*
		$fields = array
		(
			'id','field','controller','module','inputtype','label','value','options','enable_on_new','enable_on_edit'			
		);
		*/
		$fields = array('id','controller','module','formfields');
	

		$query = sprintf('select %s from %s where controller = "%s"', join(',',$fields),$this->table,$controller);
		
		$result = $this->db->query($query);
		$arr = array();
		$idField = $fields[1];
		foreach ($result as $row)
		{
			$arr[$row->$idField] = $row;
		}
		return $arr;
	}

	public function getAllRecsAllFields($table)
	{
		$query = sprintf('select * from %s',$table);
        $idField = 'id';
		$result = $this->db->query($query);
		$arr = array();
		foreach ($result as $row)
		{
			$arr[$row->$idField] = $row;
		}
		return $arr;
	}

	public function getAllHistoryRecsAllFields($table)
	{
		$query = sprintf('select * from %s',$table);
        $result = $this->db->query($query);
		$arr = array();
		foreach ($result as $row)
		{
			$arr[$row->id.",".$row->current_no] = $row;
		}
		return $arr;
	}

	public function getMenuControls($table,$url)
	{
		$query = sprintf('select * from %s where url ="%s"',$table,$url);
        $idField = 'id';
		$result = $this->db->query($query);
		$row = $result[0];
		return $row;
	}
	
	public function getUserMenuControls($table,$url,$user)
	{
		$query = sprintf('select * from %s where url ="%s" and inputter = "%s" ',$table,$url,$user);
        $idField = 'id';
		$result = $this->db->query($query);
		$row = $result[0];
		return $row;
	}

	public function recordExist($table,$field,$id,$unique_id)
	{
		$idfield = $field;
		$query = sprintf('select id from %s where id = "%s" and %s = "%s"',$table,$id,$idfield,$unique_id);
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			return true;
		}
		else
		{
			$idfield = 'id';
			$query = sprintf('select id from %s where id = "%s" and %s = "%s"',$table,$id,$idfield,$unique_id);
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
				return true;
			}
		}
		$str = '<div class="frmmsg">Record [ '.$id.' ] does not exist.</div>';
		$this->setDBErrMsg($str);
		return false;
	}
		
	public function isDuplicateUniqueId($table,$field,$id,$unique_id)
	{
		$idfield = $field;
		$query = sprintf('select id from %s where %s = "%s"',$table,$idfield,$unique_id);
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			if(!($row->id == $id)){return true;}
		}
		else
		{
			$idfield = 'id';
			$query = sprintf('select id from %s where %s = "%s"',$table,$idfield,$unique_id);
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
				if(!($row->id == $id)){return true;}
			}
		}
		$str = '<div class="frmmsg">Record [ '.$id.' ] does not exist.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function getRecordById($table,$unique_id,$id,$fields)
	{
		$idfield = $unique_id;
		$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			if($lockedrec=$this->isRecordLocked($table,$row->id))
			{
				$str = '<div class="frmmsg">Record [ '.$lockedrec->record_id.' ] is locked by user '.$lockedrec->idname.'.</div>';
				$this->setDBErrMsg($str);
				//print "Chk1"."<hr>";
				return null;
			}
			else
			{	//print "Chk2"."<hr>";
				return $row;
			}
		}
		else
		{
			$idfield = 'id';
			$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
				if($lockedrec=$this->isRecordLocked($table,$row->id))
				{
					$str = '<div class="frmmsg">Record [ '.$lockedrec->record_id.' ] is locked by user '.$lockedrec->idname.'.</div>';
					$this->setDBErrMsg($str);
					//print "Chk3"."<hr>";
					return null;
				}
				else
				{	//print "Chk4"."<hr>";
					return $row;
				}
			}
		}
		//print "Chk5"."<hr>";
		//$str = '<div class="frmmsg">Record [ '.$id.' ] does not exist.</div>';
		//$this->setDBErrMsg($str);
		return null;
	}

	public function getRecordByLookUp($tb_live,$tb_inau,$unique_id,$id,$fields,$formtype)
	{
		/**look in inau table first*/
		$idfield = $unique_id;
		$table = $tb_inau;
		$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			if($formtype=='i')
			{
				if($lockedrec=$this->isRecordLocked($table,$row->id))
				{
					$str = '<div class="frmmsg">Record [ '.$lockedrec->record_id.' ] is locked by user '.$lockedrec->idname.'.</div>';
					$this->setDBErrMsg($str);
					return null;
				}
			}
			return $row;
        }
		else
		{
			/*if not unquie field try id*/
			$idfield = 'id';
			$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
				if($formtype=='i')
				{
					if($lockedrec=$this->isRecordLocked($table,$row->id))
					{
						$str = '<div class="frmmsg">Record [ '.$lockedrec->record_id.' ] is locked by user '.$lockedrec->idname.'.</div>';
						$this->setDBErrMsg($str);
						return null;
					}
				}
				return $row;
			}
			else
			{
				/**look in live table now, most hits should be here*/
				$idfield = $unique_id;
				$table = $tb_live;
				$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
				$result = $this->db->query($query);
				if ($row = $result[0])
				{
					if($formtype=='i')
					{
						//if record is coming from live, set status 'IHLD' and pre-status 'LIVE'
						$this->insertFromTableToTable($tb_inau,$tb_live,$row->id);
					}
					return $row;
				}
				else
				{
					/*if not unquie field try id*/
					$idfield = 'id';
					$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
					$result = $this->db->query($query);
					if ($row = $result[0])
					{
						if($formtype=='i')
						{
							//if record is coming from live, set status 'IHLD' and pre-status 'LIVE'
							$this->insertFromTableToTable($tb_inau,$tb_live,$row->id);
						}
						return $row;
					}
				}
			}
		}	
		$str = '<div class="frmmsg">Record [ '.$id.' ] does not exist.</div>';
		$this->setDBErrMsg($str);
		return null;
	}

	public function getFormFields($controller)
	{
		$query = sprintf('select %s from %s where %s = "%s"','field','formdefs','controller',$controller);
		$result = $this->db->query($query);
		$arr = array();
		foreach ($result as $row)
		{
			$arr[$row->field] = $row->field;
		}
		return $arr;
	}

	public function createBlankRecord($tb_inau)
	{
		$query = sprintf('insert into `%s` (`current_no`) values("0")',$tb_inau);	
		if($result = $this->db->query($query))
		{
			$query = sprintf('select * from `%s` order by id desc limit 1',$tb_inau);
			$result = $this->db->query($query);
			if($row = $result[0])
			{
				return $row;
			}
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return null;
	}
			
	public function setRecordLock($idname,$locktable,$rec_id,$pre_status)
	{
		$query = sprintf('insert into `recordlocks` (`idname`,`lock_table`,`record_id`,`pre_status`) values("%s","%s","%s","%s")',$idname,$locktable,$rec_id,$pre_status);	
		$result = $this->db->query($query);
	}
	
	public function getRecordLock($idname,$locktable,$rec_id)
	{
		$query = sprintf('select * from `recordlocks` where `idname`="%s" and `lock_table`="%s" and `record_id`="%s"',$idname,$locktable,$rec_id);	
		$result = $this->db->query($query);
		if ($row = $result[0]){return $row;} else {return false;} 
	}
	
	public function getRecordLockById($id)
	{
		$query = sprintf('select * from `recordlocks` where `id`="%s"',$id);	
		$result = $this->db->query($query);
		if ($row = $result[0]){return $row;} else {return false;} 
	}

	public function removeRecordLock($idname,$locktable,$rec_id)
	{
		$query = sprintf('delete from `recordlocks` where `idname`="%s" and `lock_table`="%s" and `record_id`="%s"',$idname,$locktable,$rec_id);	
		$result = $this->db->query($query);
	}
	
	public function removeRecordLockById($id)
	{
		$query = sprintf('delete from `recordlocks` where `id`="%s"',$id);	
		$result = $this->db->query($query);
	}

	public function deleteRecordById($table,$id)
	{
		$query = sprintf('delete from `%s` where `id`="%s"',$table,$id);	
		if ($result = $this->db->query($query))
		{
			return true;
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function insertFromTableToTable($table_into,$table_from,$id)
	{
		$query = sprintf('insert into %s select * from %s where id="%s"',$table_into,$table_from,$id);	
		if($result = $this->db->query($query))
		{
			return true;
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function setRecordStatus($table,$id,$status)
	{
 		$query = sprintf('update `%s` set record_status = "%s" where id="%s"',$table,$status,$id);
		if($result = $this->db->query($query))
		{
			return true;
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	function setRecordStatusHIST($table,$id,$current_no,$status='HIST')
	{
		$query = sprintf('update `%s` set record_status = "%s" where id="%s" and current_no="%s"',$table,$status,$id,$current_no);
		if($result = $this->db->query($query))
		{
			return true;
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function incrementCurrentNo($table,$id)
	{
 		$query = sprintf('update `%s` set current_no+1 where id="%s"',$table,$id);
		$result = $this->db->query($query);
	}

	public function isRecordLocked($locktable,$rec_id)
	{
		$query = sprintf('select idname,lock_table,record_id,pre_status from recordlocks where lock_table="%s" and record_id="%s"',$locktable,$rec_id);	
		print $query."<hr>"; 
		$result = $this->db->query($query);
		if ($row = $result[0]){print_r($row); return $row;} else {return false;} 
	}
	
	public function isRecordLockedById($id)
	{
		$query = sprintf('select idname,lock_table,record_id,pre_status from recordlocks where id="%s"',$id);	
		$result = $this->db->query($query);
		if ($row = $result[0]){return $row;} else {return false;} 
	}

	public function updateRecord($table,$arr)
	{
		$vals = '';
		foreach($arr as $key => $value)
		{
			if(!($key=='id')) {$vals .= "`".$key."`".'="'.$value.'",';}
		}
		$vals = substr($vals,0,-1);
		$query = sprintf('update `%s` set %s where `id` = %s',$table,$vals,$arr['id']);
		if($result = $this->db->query($query))//or die( "An error has ocured: " .mysql_error (). ":" .mysql_errno (););
		{
			return true;
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function insertRecord($table,$arr)
	{
		$vals = '';
		$fields = '';
		foreach($arr as $key => $value)
		{
			$fields .= "`".$key."`,";
			$vals .= '"'.$value.'",';
		}
		$vals = substr($vals,0,-1);
		$fields = substr($fields,0,-1);
				
		$query = sprintf('insert into `%s` (%s) values(%s)',$table,$fields,$vals);	
		if($result = $this->db->query($query))//or die( "An error has ocured: " .mysql_error (). ":" .mysql_errno (););
		{
			return true;
		}
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function getMessages($table,$type,$idname)
	{
	
		$query = sprintf('select id,recipient,sender,subject,input_date,auth_date,record_status,current_no from %s where %s = "%s" order by id desc',$table,$type,$idname);
        $idField = 'id';
		$result = $this->db->query($query);
		$arr = array();
		foreach ($result as $row)
		{
			$arr[$row->$idField] = $row;
		}
		return $arr;
	}
}