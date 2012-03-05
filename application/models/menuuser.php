<?php defined('SYSPATH') or die('No direct script access.');

class Menuuser_Model extends Model
{
	function __construct($table, $inputter, $idField, $parentField, $sortField)
    {
		$this->db = Database::instance();
		$this->table = $table;
		$this->inputter = $inputter;
		$this->fields = array('id'     => $idField, 'parent' => $parentField,'sort'   => $sortField);
	}

	function _getFields()
    {
		return array($this->fields['id'], $this->fields['parent'], $this->fields['sort'],'id','nleft', 'nright', 'nlevel',
					'node_or_leaf','module','label_input','label_enquiry','url_input','url_enquiry','controls_input','controls_enquiry',
					'inputter','input_date','authorizer','auth_date','record_status','current_no');
  	}

	function getNode($id)
	{
		$query = sprintf('select %s from %s where %s = %d and inputter = "%s"', join(',', $this->_getFields()),$this->table,$this->fields['id'],$id,$this->inputter);
		$result = $this->db->query($query);
		if ($row = $result[0])
			return $row;
         return null;
  	}
  
	function getDescendants($id = 0, $includeSelf = false, $childrenOnly = false)
    {
		$idField = $this->fields['id'];
        $node = $this->getNode($id);
		if (is_null($node)) 
		{
			$nleft = 0;
			$nright = 0;
			$parent_id = 0;
		}
		else 
		{
			$nleft = $node->nleft;
			$nright = $node->nright;
			$parent_id = $node->$idField;
		}
 
		if ($childrenOnly) 
		{
			if ($includeSelf) 
			{
				$query = sprintf('select %s from %s where (%s = %d or %s = %d) and inputter = "%s" order by nleft',
									join(',', $this->_getFields()),
									$this->table,
									$this->fields['id'],
									$parent_id,
									$this->fields['parent'],
                                    $parent_id,
									$this->inputter);
			}
			else 
			{
				$query = sprintf('select %s from %s where %s = %d and inputter = "%s" order by nleft',
									join(',', $this->_getFields()),
									$this->table,
									$this->fields['parent'],
									$parent_id,
									$this->inputter);
			}	
		}
		else 
		{
			if ($nleft > 0 && $includeSelf) 
			{
				$query = sprintf('select %s from %s where nleft >= %d and nright <= %d and inputter = "%s" order by nleft',
                                    join(',', $this->_getFields()),
                                    $this->table,
                                    $nleft,
                                    $nright,
									$this->inputter);
			}
			else if ($nleft > 0) 
			{
				$query = sprintf('select %s from %s where nleft > %d and nright < %d and inputter = "%s" order by nleft',
                                    join(',', $this->_getFields()),
                                    $this->table,
                                    $nleft,
                                    $nright,
									$this->inputter);
			}
			else 
			{
				$query = sprintf('select %s from %s and inputter = "%s" order by nleft',
                                    join(',', $this->_getFields()),
                                    $this->table,
									$this->inputter);
			}
		}
 
		$result = $this->db->query($query);
		$arr = array();
		foreach ($result as $row)
		{
			$arr[$row->$idField] = $row;
		}
		return $arr;
	}

    public function getChildren($id = 0, $includeSelf = false)
	{
		return $this->getDescendants($id, $includeSelf, false);
	}
	
	public function getTopLevelMenus()
	{
		$query = sprintf('select menu_id,module,url_input from %s where %s = 0 and inputter = "%s" order by sortpos',$this->table,$this->fields['parent'],$this->inputter);
     	$result = $this->db->query($query);
		foreach ($result as $row)
		{
			$arr[$row->menu_id] = $row;
		}
		return $arr;
	}
}
?>
