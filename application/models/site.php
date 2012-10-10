<?php defined('SYSPATH') or die('No direct script access.');

class Site_Model extends Model
{
	private $errmsg;

	function __construct()
	{
		//parent::__construct();
		$this->db = Database::instance();
		$this->setDBErrMsg();
		set_time_limit(0);
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
			'indexfield','indexfieldvalue','indexlabel','appheader','primarymodel','tb_live','tb_inau','tb_hist','errormsgfile'			
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

	function getControllerParams($controller)
	{
		$arrobj = $this->getParams(trim($controller));
		$arr = (array) $arrobj[trim($controller)];
		return $arr;
	}

	public function getFormDefs($controller)
	{
		$this->table = 'params';
		$fields = array('id','controller','module','formfields');
		$query = sprintf('select %s from %s where controller = "%s"', join(',',$fields),$this->table,$controller);
		$result = $this->db->query($query);
		$row = $result[0];
		return $row;
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

	public function getAllRecsByFields($table,$fields,$prefix="",$where="",$orderby="")
	{
		if(is_array($fields))
		{
			if(isset($prefix))
			{
				foreach($fields as $key => $value)
				{
					$fields[$key] = sprintf('%s as %s%s',$value,$prefix,$value);		
				}
			}
			$query = sprintf('select %s from %s %s %s', join(',',$fields),$table,$where,$orderby);
		}
		else
		{
			if(isset($prefix))
			{
				foreach($fields as $key => $value)
				{
					$fields = sprintf('%s as %s_%s',$value,$prefix,$value);		
				}
			}
			$query = sprintf('select %s from %s %s %s', $fields,$table,$where,$orderby);
		}
		$result = $this->db->query($query);
		$arr = array();
		$i = 0;
		foreach ($result as $row)
		{
			$arr[$i] = $row;
			$i++;
		}
		return $arr;
	}

	public function getRecsBySubform($table,$fields,$idfield,$idval,$current_no,$prefix="")
	{
		if(is_array($fields))
		{
			if(isset($prefix))
			{
				foreach($fields as $key => $value)
				{
					$fieldname = $value; $asname = $value;	
					$vals = preg_split('/:/',$value);
					if(is_array($vals) && count($vals)==2)
					{
						$fieldname = $vals[0]; 
						$asname = $vals[1];
					}
					$fields[$key] = sprintf('%s as %s%s',$fieldname,$prefix,$asname);		
				}
			}
			$query = sprintf('select %s from %s where %s="%s" and current_no="%s"', join(',',$fields),$table,$idfield,$idval,$current_no);
		}
		else
		{
			if(isset($prefix))
			{
				foreach($fields as $key => $value)
				{
					
					$fieldname = $value; $asname = $value;	
					$vals = preg_split('/:/',$value);
					if(is_array($vals) && count($vals)==2)
					{
						$fieldname = $vals[0]; 
						$asname = $vals[1];
					}
					$fields = sprintf('%s as %s_%s',$value,$prefix,$value);		
				}
			}
			$query = sprintf('select %s from %s where %s="%s" and current_no="%s"',$fields,$table,$idfield,$idval,$current_no);
		}

		$result = $this->db->query($query);
		$arr = array();
		$i = 0;
		foreach ($result as $row)
		{
			$arr[$i] = $row;
			$i++;
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

	public function getRecordByIdVal($table,$unique_id,$id,$fields)
	{
		$idfield = $unique_id;
		if(is_array($fields))
		{
			$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
		}
		else
		{
			$query = sprintf('select %s from %s where %s = "%s"',$fields,$table,$idfield,$id);
		}
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			return $row;
		}
	}
	
	public function getMenuControls($table,$field,$url)
	{
		$query = sprintf('select * from %s where %s ="%s"',$table,$field,$url);
        $idField = 'id';
		$result = $this->db->query($query);
		$row = $result[0];
		return $row;
	}
	
	public function getUserMenuControls($table,$field,$url,$user)
	{
		$query = sprintf('select * from %s where %s ="%s" and inputter = "%s" ',$table,$field,$url,$user);
  //print  $query."<hr>";   
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
	
	public function recordExistDualKey($table,$field1,$field2,$value1,$value2)
	{
		$query = sprintf('select id from %s where %s = "%s" and %s = "%s"',$table,$field1,$value1,$field2,$value2);
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			return true;
		}
		$str = '<div class="frmmsg">Record [ '.$field1.' | '.$field2.' ] does not exist.</div>';
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
		
		$str = '<div class="frmmsg">Record [ '.$id.' ] does not exist.</div>';
		$this->setDBErrMsg($str);
		return false;
	}

	public function isDuplicateCompositeId($table,$fields,$id)
	{
		$where = "where ";
		foreach($fields as $key => $val)
		{
			$where .= sprintf('%s = "%s" and ',$key,$val);
		}
		$where  = substr_replace($where, '', -5);
		
		$query = sprintf('select id from %s %s',$table,$where);
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			if(!($row->id == $id)){return true;}
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
		$str = '<div class="frmmsg">Record [ '.$id.' ] does not exist.</div>';
		$this->setDBErrMsg($str);
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
			if($formtype=='i' || $formtype=='w')
			{
				if($formtype=='w' && $row->current_no !=0)
				{
					//if record is not new and in inau/ihld table, it cannot be edit with this permission
					$str = '<div class="frmmsg">Record [ '.$row->id.' ] is not a new record, current no not equal 0.</div>';
					$this->setDBErrMsg($str);
					return null;
				}
				
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
			/*if not unique field try id*/
			$idfield = 'id';
			$query = sprintf('select %s from %s where %s = "%s"', join(',', $fields),$table,$idfield,$id);
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
	
				if($formtype=='i' || $formtype=='w')
				{
					if($formtype=='w' && $row->current_no !=0)
					{
						//if record is not new and in inau/ihld table, it cannot be edit with this permission
						$str = '<div class="frmmsg">Record [ '.$row->id.' ] is not a new record, current no not equal 0.</div>';
						$this->setDBErrMsg($str);
						return null;
					}
				
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
					else if ($formtype=='w')
					{
						//if record is coming from live, it cannot be edit with this permission
						$str = '<div class="frmmsg">Record [ '.$row->id.' ] is not a new record, current no not equal 0.</div>';
						$this->setDBErrMsg($str);
						return null;
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
						else if ($formtype=='w')
						{
							//if record is coming from live, it cannot be edit with this permission
							$str = '<div class="frmmsg">Record [ '.$row->id.' ] is not a new record, current no not equal 0.</div>';
							$this->setDBErrMsg($str);
							return null;
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
	
	public function getHistRecordByLookUp($tb_hist,$id,$fields,$formtype)
	{
		/**look in hist table*/
		list($idfield,$cur_no) = preg_split('/;/',$id);
		$table = $tb_hist;
		$query = sprintf('select %s from %s where id = "%s" and current_no = "%s"', join(',', $fields),$table,$idfield,$cur_no);
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
			return $row;
        }
		$str = '<div class="frmmsg">Record [ '.$id.' ] does not exist.</div>';
		$this->setDBErrMsg($str);
		return null;
	}

	public function getFormFields($controller,&$labelarr=null)
	{
		$labels = false; 
		if(isset($labelarr)){ $labels = true; }
		$query = sprintf('select %s from %s where %s = "%s"','formfields','params','controller',$controller);
		$result = $this->db->query($query);
		$arr = array();
		$row = $result[0];
		
		$formfields = new SimpleXMLElement($row->formfields);
		foreach ($formfields->field as $field)
		{
			$val = sprintf('%s',$field->name);
			$arr[$val] = $val;
			if($labels) 
			{
				$lbl = sprintf('%s',$field->name);
				$labelarr[$lbl] = sprintf('%s',$field->label);
			}
		}
		return $arr;
	}
	
	public function getSubFormFields($controller,&$labelarr=null)
	{
		$labels = false; 
		if(isset($labelarr)){ $labels = true; }
		$query = sprintf('select %s from %s where %s = "%s"','formfields','params','controller',$controller);
		$result = $this->db->query($query);
		$arr = array();
		$row = $result[0];
		
		$formfields = new SimpleXMLElement($row->formfields);
		foreach ($formfields->subformfields->subfield as $field)
		{
			$val = sprintf('%s',$field->subname);
			$arr[$val] = $val;
			if($labels) 
			{
				$lbl = sprintf('%s',$field->subname);
				$labelarr[$lbl] = sprintf('%s',$field->sublabel);
			}
		}
		return $arr;
	}

	public function getSubFormColumnDef($controller,$prefix="")
	{
		$labels = false; 
		if(isset($labelarr)){ $labels = true; }
		$query = sprintf('select %s from %s where %s = "%s"','formfields','params','controller',$controller);
		$result = $this->db->query($query);
		$arr = array();
		$row = $result[0];

		$i=0;
		$formfields = new SimpleXMLElement($row->formfields);
		foreach ($formfields->subformfields->subfield as $rowfield)
		{
			$field = sprintf('%s',$rowfield->subname);
			$vals = preg_split('/:/',$field);
			if(is_array($vals) && count($vals)==2)
			{
				$field = $vals[1];
			}	
			$field = $prefix.$field;
			$title = sprintf('%s',$rowfield->sublabel);
			$align = sprintf('%s',$rowfield->align);
			$width = sprintf('%s',$rowfield->width);
			$editor = sprintf('%s',$rowfield->editor);
			$formatter = sprintf('%s',$rowfield->formatter);
			$arr[$i] = array('field'=>$field,'title'=>$title,'width'=>$width,'align'=>$align,'formatter'=>$formatter,'editor'=>$editor);
			$i++;
		}
		return $arr;
	}

	public function getSubFormOptions($controller)
	{
		$labels = false; 
		$query = sprintf('select %s from %s where %s = "%s"','formfields','params','controller',$controller);
		$result = $this->db->query($query);
		$arr = array();
		$row = $result[0];
		
		$formfields = new SimpleXMLElement($row->formfields);
		foreach ($formfields->subformfields->subfield as $subfield)
		{
			$val = sprintf('%s',$subfield->subname);
			$arr[$val]['subname'] = sprintf('%s',$subfield->subname); 
			$arr[$val]['sublabel'] = sprintf('%s',$subfield->sublabel); 
			if($subfield->formatter) { $arr[$val]['formatter'] = sprintf('%s',$subfield->formatter); }
			if($subfield->width) { $arr[$val]['width'] = sprintf('%s',$subfield->width); }
			if($subfield->align) { $arr[$val]['align'] = sprintf('%s',$subfield->align); }
			if($subfield->editor) { $arr[$val]['editor'] = sprintf('%s',$subfield->editor); }
		}
		return $arr;
	}

	public function getSubFormController($controller)
	{
		$query = sprintf('select %s from %s where %s = "%s"','formfields','params','controller',$controller);
		$result = $this->db->query($query);
		$arr = array();
		$row = $result[0];
		
		$formfields = new SimpleXMLElement($row->formfields);
		foreach ($formfields->field as $field)
		{
			$name = sprintf('%s',$field->name);
			if($field->subform && $field->type=="subform")
			{
				$val = sprintf('%s',$field->subform->subformcontroller);
				$arr[$name] = $val;
			}
		}
		return $arr;
	}

	public function getXMLFieldDataByIdVal($table,$idfield,$idval,$field,$prefix="")
	{
		$query = sprintf('select %s from %s where %s = "%s"',$field,$table,$idfield,$idval);
		$result = $this->db->query($query);
		$arr = array();
		$xml = $result[0]->$field;
		
		$i=0;
		$formfields = new SimpleXMLElement($xml);
		foreach ($formfields->rows->row as $row)
		{
			$rowarr = array();
				
			foreach ($row->children() as $field)
			{
				$id  = sprintf('%s',$field->getName() );
				$val = sprintf('%s',$row->$id );
				$index = $prefix.$id;
				$rowarr[$index] = $val;
			}
			$arr[$i] = $rowarr;
			$i++;
		}
		return $arr;
	}
	
	public function getSubFormViewRecords($controller,$idfield,$idval,$current_no,$table_type,&$lbl)
	{
		$labels = array();
		$param	= $this->getControllerParams($controller);
		$columnfield = $this->getSubFormFields($controller,$labels);

		if($table_type)
		{
			if($table_type == "live"){ $table = $param['tb_live']; }else if($table_type == "inau"){	$table = $param['tb_inau'];}else if($table_type == "hist"){ $table = $param['tb_hist'];}
			$result = $this->getRecsBySubform($table,$columnfield,$idfield,$idval,$current_no);
		}
		else
		{	/*default action*/
			/* for subrecs in inau first*/
			$table = $param['tb_inau'];
			if(!($result = $this->getRecsBySubform($table,$columnfield,$idfield,$idval,$current_no)))
			{
				/*if no inau records found, check live*/
				$table = $param['tb_live'];
				$result = $this->getRecsBySubform($table,$columnfield,$idfield,$idval,$current_no);
			}
		}
		$lbl = $labels;
		return $result;
	}

	public function createBlankRecord($tb_live,$tb_inau)
	{
		$str = '<div class="frmmsg">An Error Occurred, Please Try Again.</div>';
				
		$query = sprintf('select counter from _sys_autoids where tb_inau = "%s"',$tb_inau);
		if($result = $this->db->query($query))
		{
			$row_1 = $result[0];
			if(isset($row_1->counter))
			{
//print "[LOOKUP_INSERT]<hr>";					
				$counter = $row_1->counter;
				if($this->recordExist($tb_live,"id",$counter,$counter) || $this->recordExist($tb_inau,"id",$counter,$counter))
				{
					$query = sprintf('update _sys_autoids set counter = (counter + 1) where tb_inau = "%s"',$tb_inau);
					if($result = $this->db->query($query))
					{
						$query = sprintf('select counter from _sys_autoids where tb_inau = "%s"',$tb_inau);
						if($result = $this->db->query($query))
						{
							$row_2 = $result[0];
							$counter = $row_2->counter;
						}
						else
						{
							$this->setDBErrMsg($str);
							return null;
						}
					}
					else
					{
						$this->setDBErrMsg($str);
						return null;
					}
				}
				$query = sprintf('insert into `%s` (`id`,`current_no`) values("%s","0")',$tb_inau,$counter);	
				if($result = $this->db->query($query))
				{
					//$query = sprintf('select * from `%s` order by id desc limit 1',$tb_inau);
					$query = sprintf('select * from `%s` where id = "%s"',$tb_inau,$counter);
					$result = $this->db->query($query);
					if($row = $result[0])
					{
						return $row;
					}
				}
			}
			else
			{
//print "[INCR_INSERT]<hr>";				
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
			}
		}
		$this->setDBErrMsg($str);
		return null;
	}

	public function createBlankRecordOnDBAutoIncrementTable($tb_inau)
	{
		$query = sprintf('insert into `%s` (`current_no`) values("1")',$tb_inau);	
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

	public function setRecordLockById($lock_id,$idname,$locktable,$rec_id,$pre_status)
	{
		$query = sprintf('insert into `recordlocks` (`id`,`idname`,`lock_table`,`record_id`,`pre_status`) values("%s","%s","%s","%s","%s")',$lock_id,$idname,$locktable,$rec_id,$pre_status);	
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

	public function deleteRecordByFieldValue($table,$field,$fieldval)
	{
		$query = sprintf('delete from `%s` where `%s`="%s"',$table,$field,$fieldval);	
print $query."<hr>";		
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
	
	public function setRecordStatusByFieldValue($table,$field,$fieldval,$status)
	{
 		$query = sprintf('update `%s` set record_status = "%s" where %s="%s"',$table,$status,$field,$fieldval);		
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
		$result = $this->db->query($query);
		if ($row = $result[0])
		{
//print_r($row); 
			return $row;} else {return false;} 
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

	public function updateRecordDualKey($table,$arr,$field1,$field2,$value1,$value2)
	{
		$vals = '';
		foreach($arr as $key => $value)
		{
			if(!($key=='id') || !($key==$field1) || !($key==$$field2)) {$vals .= "`".$key."`".'="'.$value.'",';}
		}
		$vals = substr($vals,0,-1);
		$query = sprintf('update `%s` set %s where `%s` = "%s" and  `%s` = "%s"' ,$table,$vals,$field1,$value1,$field2,$value2);
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
	
	public function getSubFormRecords($table,$field,$fieldval)
	{	
		$query = sprintf('select * from %s where %s="%s"',$table,$field,$fieldval);		
		$arr = $this->executeSelectQuery($query);
		return $arr;
	}

	public function getMessages($table,$type,$idname)
	{
	
		$query = sprintf('select id,vw,recipient,sender,subject,input_date,auth_date,record_status,current_no from %s where %s = "%s" order by id desc',$table,$type,$idname);
        $idField = 'id';
		$result = $this->db->query($query);
		$arr = array();
		foreach ($result as $row)
		{
			$arr[$row->$idField] = $row;
		}
		return $arr;
	}

	public function getUserEnquiryTables($user)
	{
		$query = sprintf('select url_input,module,label_input from menudefs_users where inputter="%s" AND (url_input !="" || url_input !=NULL) AND url_input NOT LIKE "%senquiry%s" ORDER BY  url_input;',$user,"%","%");
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
	
	public function getRecordCount($table,$where="")
	{
		$query = sprintf('select count(id) as count from %s %s;',$table,$where);
		$result = $this->db->query($query);
		$row = $result[0];
		return $row->count;
	}

	public function getRecordCountUnreadMessages($table,$idname)
	{
		$query = sprintf('select count(id) as count from %s where vw="N" and recipient="%s";',$table,$idname);
		$result = $this->db->query($query);
		$row = $result[0];
		return $row->count;
	}

	public function getRecordCountUnsentMessages($table,$idname)
	{
		$query = sprintf('select count(id) as count from %s where sender ="%s" or inputter="%s";',$table,$idname,$idname);
		$result = $this->db->query($query);
		$row = $result[0];
		return $row->count;
	}
}