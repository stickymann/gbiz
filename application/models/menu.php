<?php defined('SYSPATH') or die('No direct script access.');

/*
	The menu model is based on the implemetation of a nested tree.
	Documentation about implementing a nested tree can be found at
	http://www.phpriot.com/articles/nested-trees-1
	http://www.phpriot.com/articles/nested-trees-2
	It is suggest that these articles be read to gain a better understand of how the menu model work.
	It output how the nest tree lookups from the basis for any tree or horzonital javascript menus 
	that formed via an unordered list, <ul></ul> tags.
*/

class Menu_Model extends Model
{
    	/**
         * Constructor. Set the database table name and necessary field names
         *
         * @param   string  $table          Name of the tree database table
         * @param   string  $idField        Name of the primary key ID field
         * @param   string  $parentField    Name of the parent ID field
         * @param   string  $sortField      Name of the field to sort data.
         */
        		
		function __construct($table, $idField, $parentField, $sortField)
        {
            $this->db = Database::instance();
			$this->table = $table;
            $this->fields = array('id'     => $idField,
                                  'parent' => $parentField,
                                  'sort'   => $sortField);
		}

		/**
         * A utility function to return an array of the fields
         * that need to be selected in SQL select queries
         *
         * @return  array   An indexed array of fields to select
         */
        function _getFields()
        {
            return array($this->fields['id'], $this->fields['parent'], $this->fields['sort'],'id','nleft', 'nright', 'nlevel',
						'node_or_leaf','module','label_input','label_enquiry','url_input','url_enquiry','controls_input','controls_enquiry');
        }
 
        /**
         * Fetch the node data for the node identified by $id
         *
         * @param   int     $id     The ID of the node to fetch
         * @return  object          An object containing the node's
         *                          data, or null if node not found
         */

		/**
         * Fetch the node data for the node identified by $id
         *
         * @param   int     $id     The ID of the node to fetch
         * @return  object          An object containing the node's
         *                          data, or null if node not found
         */
        
		function getNode($id)
        {
            $query = sprintf('select %s from %s where %s = %d', join(',', $this->_getFields()),
                                                                $this->table,
                                                                $this->fields['id'],
                                                                $id);
			$result = $this->db->query($query);
			if ($row = $result[0])
                return $row;
            return null;
        }

		 /**
         * Fetch the descendants of a node, or if no node is specified, fetch the
         * entire tree. Optionally, only return child data instead of all descendant
         * data.
         *
         * @param   int     $id             The ID of the node to fetch descendant data for.
         *                                  Specify an invalid ID (e.g. 0) to retrieve all data.
         * @param   bool    $includeSelf    Whether or not to include the passed node in the
         *                                  the results. This has no meaning if fetching entire tree.
         * @param   bool    $childrenOnly   True if only returning children data. False if
         *                                  returning all descendant data
         * @return  array                   The descendants of the passed now
         */
        function getDescendants($id = 0, $includeSelf = false, $childrenOnly = false)
        {
            $idField = $this->fields['id'];
 
            $node = $this->getNode($id);
            if (is_null($node)) {
                $nleft = 0;
                $nright = 0;
                $parent_id = 0;
            }
            else {
                $nleft = $node->nleft;
                $nright = $node->nright;
                $parent_id = $node->$idField;
            }
 
            if ($childrenOnly) {
                if ($includeSelf) {
                    $query = sprintf('select %s from %s where %s = %d or %s = %d order by nleft',
                                     join(',', $this->_getFields()),
                                     $this->table,
                                     $this->fields['id'],
                                     $parent_id,
                                     $this->fields['parent'],
                                     $parent_id);
                }
                else {
                    $query = sprintf('select %s from %s where %s = %d order by nleft',
                                     join(',', $this->_getFields()),
                                     $this->table,
                                     $this->fields['parent'],
                                     $parent_id);
                }
            }
            else {
                if ($nleft > 0 && $includeSelf) {
                    $query = sprintf('select %s from %s where nleft >= %d and nright <= %d order by nleft',
                                     join(',', $this->_getFields()),
                                     $this->table,
                                     $nleft,
                                     $nright);
                }
                else if ($nleft > 0) {
                    $query = sprintf('select %s from %s where nleft > %d and nright < %d order by nleft',
                                     join(',', $this->_getFields()),
                                     $this->table,
                                     $nleft,
                                     $nright);
                }
                else {
                    $query = sprintf('select %s from %s order by nleft',
                                     join(',', $this->_getFields()),
                                     $this->table);
                }
            }
 
            //$result = mysql_query($query);
 
            $result = $this->db->query($query);
			$arr = array();
			foreach ($result as $row)
			{
				$arr[$row->$idField] = $row;
			}
			return $arr;
	     }

		/**
         * Fetch the children of a node, or if no node is specified, fetch the
         * top level items.
         *
         * @param   int     $id             The ID of the node to fetch child data for.
         * @param   bool    $includeSelf    Whether or not to include the passed node in the
         *                                  the results.
         * @return  array                   The children of the passed node
         */
        function getChildren($id = 0, $includeSelf = false)
        {
            return $this->getDescendants($id, $includeSelf, false);
        }

		/**
         * Fetch the path to a node. If an invalid node is passed, an empty array is returned.
         * If a top level node is passed, an array containing on that node is included (if
         * 'includeSelf' is set to true, otherwise an empty array)
         *
         * @param   int     $id             The ID of the node to fetch child data for.
         * @param   bool    $includeSelf    Whether or not to include the passed node in the
         *                                  the results.
         * @return  array                   An array of each node to passed node
         */
        function getPath($id = 0, $includeSelf = false)
        {
            $node = $this->getNode($id);
            if (is_null($node))
                return array();
 
            if ($includeSelf) {
                $query = sprintf('select %s from %s where nleft <= %d and nright >= %d order by nlevel',
                                 join(',', $this->_getFields()),
                                 $this->table,
                                 $node->nleft,
                                 $node->nright);
            }
            else {
                $query = sprintf('select %s from %s where nleft < %d and nright > %d order by nlevel',
                                 join(',', $this->_getFields()),
                                 $this->table,
                                 $node->nleft,
                                 $node->nright);
            }
 			
            $idField = $this->fields['id'];
			$result = $this->db->query($query);
			$arr = array();
			foreach ($result as $row)
			{
				$arr[$row->$idField] = $row;
			}
			return $arr;
        }
		
		/**
         * Check if one node descends from another node. If either node is not
         * found, then false is returned.
         *
         * @param   int     $descendant_id  The node that potentially descends
         * @param   int     $ancestor_id    The node that is potentially descended from
         * @return  bool                    True if $descendant_id descends from $ancestor_id, false otherwise
         */
        function isDescendantOf($descendant_id, $ancestor_id)
        {
            $node = $this->getNode($ancestor_id);
            if (is_null($node))
                return false;
 
            $query = sprintf('select count(*) as is_descendant
                                  from %s
                                  where %s = %d
                                  and nleft > %d
                                  and nright < %d',
                             $this->table,
                             $this->fields['id'],
                             $descendant_id,
                             $node->nleft,
                             $node->nright);
			
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
				return $row->is_descendant > 0;
			}
			return false;
        }
		
		/**
         * Check if one node is a child of another node. If either node is not
         * found, then false is returned.
         *
         * @param   int     $child_id       The node that is possibly a child
         * @param   int     $parent_id      The node that is possibly a parent
         * @return  bool                    True if $child_id is a child of $parent_id, false otherwise
         */
        function isChildOf($child_id, $parent_id)
        {
            $query = sprintf('select count(*) as is_child from %s where %s = %d and %s = %d',
                             $this->table,
                             $this->fields['id'],
                             $child_id,
                             $this->fields['parent'],
                             $parent_id);
 
            $result = $this->db->query($query);
			if ($row = $result[0])
			{
				return $row->is_descendant > 0;
			}
			return false;
        }

		/**
         * Find the number of descendants a node has
         *
         * @param   int     $id     The ID of the node to search for. Pass 0 to count all nodes in the tree.
         * @return  int             The number of descendants the node has, or -1 if the node isn't found.
         */
        function numDescendants($id)
        {
            if ($id == 0) 
			{
                $query = sprintf('select count(*) as num_descendants from %s', $this->table);
                $result = $this->db->query($query);
				if ($row = $result[0])
				{
					return (int) $row->num_descendants;
				}
            }
            else 
			{
                $node = $this->getNode($id);
                if (!is_null($node)) 
				{
                    return ($node->nright - $node->nleft - 1) / 2;
                }
            }
            return -1;
        }
		
		/**
         * Find the number of children a node has
         *
         * @param   int     $id     The ID of the node to search for. Pass 0 to count the first level items
         * @return  int             The number of descendants the node has, or -1 if the node isn't found.
         */
        function numChildren($id)
        {
            $query = sprintf('select count(*) as num_children from %s where %s = %d',
                             $this->table,
                             $this->fields['parent'],
                             $id);
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
				return (int) $row->num_descendants;
			}
            return -1;
        }

		/**
         * Fetch the tree data, nesting within each node references to the node's children
         *
         * @return  array       The tree with the node's child data
         */
        function getTreeWithChildren()
        {
            $idField = $this->fields['id'];
            $parentField = $this->fields['parent'];
 
            $query = sprintf('select %s from %s order by %s',
                             join(',', $this->_getFields()),
                             $this->table,
                             $this->fields['sort']);

			$result = $this->db->query($query);
			
            // create a root node to hold child data about first level items
            $root = new stdClass;
            $root->$idField = 0;
            $root->children = array();
 
            $arr = array($root);
 
            // populate the array and create an empty children array
            foreach ($result as $row)
			{
				$arr[$row->$idField] = $row;
				$arr[$row->$idField]->children = array();
			}

			// now process the array and build the child data
            foreach ($arr as $id => $row) {
                if (isset($row->$parentField))
                    $arr[$row->$parentField]->children[$id] = $id;
            }
             return $arr;
        }
		
		 /**
         * Generate the tree data. A single call to this generates the n-values for
         * 1 node in the tree. This function assigns the passed in n value as the
         * node's nleft value. It then processes all the node's children (which
         * in turn recursively processes that node's children and so on), and when
         * it is finally done, it takes the update n-value and assigns it as its
         * nright value. Because it is passed as a reference, the subsequent changes
         * in subrequests are held over to when control is returned so the nright
         * can be assigned.
         *
         * @param   array   &$arr   A reference to the data array, since we need to
         *                          be able to update the data in it
         * @param   int     $id     The ID of the current node to process
         * @param   int     $level  The nlevel to assign to the current node
         * @param   int     &$n     A reference to the running tally for the n-value
         */
        function _generateTreeData(&$arr, $id, $level, &$n)
        {
            $arr[$id]->nlevel = $level;
            $arr[$id]->nleft = $n++;
 
            // loop over the node's children and process their data
            // before assigning the nright value
            foreach ($arr[$id]->children as $child_id) {
                $this->_generateTreeData($arr, $child_id, $level + 1, $n);
            }
            $arr[$id]->nright = $n++;
        }
				
		/**
         * Rebuilds the tree data and saves it to the database
         */
        function rebuild()
        {
            $data = $this->getTreeWithChildren();
 
            $n = 0; // need a variable to hold the running n tally
            $level = 0; // need a variable to hold the running level tally
 
            // invoke the recursive function. Start it processing
            // on the fake "root node" generated in getTreeWithChildren().
            // because this node doesn't really exist in the database, we
            // give it an initial nleft value of 0 and an nlevel of 0.
            $this->_generateTreeData($data, 0, 0, $n);
 
            // at this point the the root node will have nleft of 0, nlevel of 0
            // and nright of (tree size * 2 + 1)
 
            foreach ($data as $id => $row) 
			{
 
                // skip the root node
                if ($id == 0)
                    continue;
 
                $query = sprintf('update %s set nlevel = %d, nleft = %d, nright = %d where %s = %d',
                                 $this->table,
                                 $row->nlevel,
                                 $row->nleft,
                                 $row->nright,
                                 $this->fields['id'],
                                 $id);
				$result = $this->db->query($query);	
            }
        }

		function getNumberParentMenus()
        {
            $query = sprintf('select count(%s) as num from %s where %s = 0',
							$this->fields['id'], 
							$this->table,
                            $this->fields['parent']
                            );
			$result = $this->db->query($query);
			if ($row = $result[0])
			{
				return (int) $row->num;
			}
        }

		function getTopLevelMenus()
        {
            $query = sprintf('select menu_id,module,url_input from %s where %s = 0 order by sortpos',$this->table,$this->fields['parent']);
                         
			$result = $this->db->query($query);
			//return $result;
			foreach ($result as $row)
			{
				$arr[$row->menu_id] = $row;
			}
			return $arr;
        }

		function getAllTopLevelMenusNoLogin()
		{
			$query = sprintf('select menu_id,module,url_input from %s where %s = 0 and module <> "%s" order by sortpos',$this->table,$this->fields['parent'],"login");  		
			$result = $this->db->query($query);
			foreach ($result as $row)
			{
				$arr[$row->menu_id] = $row;
			}
			return $arr;
		}
}
?>
