<?php defined('SYSPATH') or die('No direct script access.');

class Enqdb_Model extends Model 
{
	/*
	public function _count_records($table,$idfield)
    { // new method
        $query = $this->db->select($idfield)->get($table);
        return $query->count();
    }
	
	public function _browse_all($table,$formfields,$orderarr,$limit,$offset)
    { // edited method
        return $this->db->select($formfields)->from($table)->orderby($orderarr)->limit($limit, $offset)->get();
    }
	*/
	
	public function count_records($querystr)
    { // new method
        $query = $this->db->query($querystr);
		return $query->count();
    }

    public function browse($querystr)
	{
		return $this->db->query($querystr);
	}

	public function getEnqFormFields($controller,&$arr1,&$arr2,&$arr3)
	{
		$query = sprintf('select %s from %s where %s = "%s"','formfields','enquirydefs','controller',$controller);
		$result = $this->db->query($query);
		$row = $result[0];
		$formfields = new SimpleXMLElement($row->formfields);
		foreach ($formfields->field as $field)
		{
			$val1 = sprintf('%s',$field->name);
			$val2 = sprintf('%s',$field->label);
			$val3 = sprintf('%s',$field->filterfield);
			$arr1[$val1] = $val1;
			$arr2[$val1] = $val2;
			$arr3[$val1] = $val3;
		}
	}
	
	public function getFixedSelectionParams($controller,&$arr1,&$arr2,&$arr3,&$arr4)
	{
		$query = sprintf('select %s from %s where %s = "%s"','formfields','fixedselections','fixedselection_id',$controller);
		$result = $this->db->query($query);
		/*controller could exist in params but not in fixedselections, need to return empty arrays*/
		$arr1 = array();
		$arr2 = array();
		$arr3 = array();
		$arr4 = array();
		
		if($row = $result[0])
		{
			if($row->formfields)
			{
				$formfields = new SimpleXMLElement($row->formfields);
				foreach ($formfields->field as $field)
				{
					$val1 = sprintf('%s',$field->name);
					$val2 = sprintf('%s',$field->operand);
					$val3 = sprintf('%s',$field->value);
					$val4 = sprintf('%s',$field->onload);
					$arr1[$val1] = $val1;
					$arr2[$val1] = $val2;
					$arr3[$val1] = $val3;
					$arr4[$val1] = $val4;
				}
			}
			return true;
		}
		return false;
	}

	public function getEnquiryParams($controller)
	{
		$table = 'enquirydefs';
		$fields = array('id','controller','tablename','model','view','idfield','enqheader','showfilter','printuser','printdatetime');
		$query = sprintf('select %s from %s where controller = "%s"', join(',',$fields),$table,$controller);
		$result = $this->db->query($query);
		$arr = array();
		$idField = $fields[1];
		foreach ($result as $row)
		{
			$arr[$row->$idField] = $row;
		}
		return $arr;
	}
}

