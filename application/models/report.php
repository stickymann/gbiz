<?php defined('SYSPATH') or die('No direct script access.');

class Report_Model extends Model 
{
	public function getReportFormDefs($controller)
	{
		$this->table = 'reportdefs';
		$fields = array('id','controller','formfields');
		$query = sprintf('select %s from %s where controller = "%s"', join(',',$fields),$this->table,$controller);
		$result = $this->db->query($query);
		$row = $result[0];
		return $row;
	}
	
	public function getReportParams($controller)
	{
		$table = 'reportdefs';
		$fields = array('id','controller','model','view','rptheader','showfilter','printuser','printdatetime');
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
