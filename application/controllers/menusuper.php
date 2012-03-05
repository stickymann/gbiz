<?php defined('SYSPATH') or die('No direct script access.');

class Menusuper_Controller extends Menufunc_Controller
{

    public function __construct()
	{
		parent::__construct();
		$this->content = new View('menutree/menutree.view');
		$this->tree = new Menu_Model('menudefs', 'menu_id', 'parent_id', 'sortpos');
		$this->tree->rebuild();
		$this->topmenu = $this->tree->getTopLevelMenus();
		$this->topmenu_nologin = $this->tree->getAllTopLevelMenusNoLogin();
	}
	
	public function index($print=false)
    {
    	$this->content->usermenu ="<ul class='treeview' id='tree'>\n";
		foreach($this->topmenu as $key=>$rec) 
		{
			$this->content->usermenu .= $this->makeListItemsFromNodes($this->tree->getChildren($rec->menu_id,true));
		}
		$this->content->usermenu .= "</ul>\n";
		if($print){$this->content->render(TRUE);}
	}

	public function printsupers($print=false)
	{
		$this->content->usermenu = '';
		//$security_profile ='';
		foreach($this->topmenu as $key=>$rec) 
		{
			$header = "[<b>".$rec->module."</b>]<br />";
			$nodes = $this->tree->getChildren($rec->menu_id,true);
//print_r($nodes); print "<br>[END NODES]<hr>";		
			$security_profile = $this->makeSecurityProfile($nodes);
			$security_profile = str_replace("<","&lt;", $security_profile);
			$security_profile = str_replace(">","&gt;",  $security_profile);
			$security_profile = str_replace("\n","\n<br />",  $security_profile);
			//$security_profile = htmlspecialchars($security_profile);
			$this->content->usermenu .= $header.$security_profile;
			$this->content->usermenu .= '<hr />';
		}
		if($print){$this->content->render(TRUE);}
	}

	public function updatesupers($print=false)
	{
		$this->content->usermenu = '';
		//$security_profile ='';
		foreach($this->topmenu as $key=>$rec) 
		{
			if($rec->module == 'login'){$rolename=$rec->module;}else {$rolename = $rec->module."_super";}
			$header = "[<b>".$rolename."</b>]<br />";
			$security_profile = $this->makeSecurityProfile($this->tree->getChildren($rec->menu_id,true));
			$role = ORM::factory('role',$rolename);
			if($role->name == '') //role not found
			{
				$role = ORM::factory('role');
				$role->name = $rolename;
				print $role->name."<hr>";
			}
			$role->securityprofile = $security_profile;
			$role->save();

			$security_profile = str_replace("<","&lt;", $security_profile);
			$security_profile = str_replace(">","&gt;",  $security_profile);
			$security_profile = str_replace("\n","\n<br />",  $security_profile);
			$this->content->usermenu .= $header.$security_profile;
			$this->content->usermenu .= '<hr />';
		}
		if($print){$this->content->render(TRUE);}
	}

	public function roleselect($print=false,$spid='',$current_no)
    {  	
		$initperms = array('if'=>'','vw'=>'','pr'=>'','nw'=>'','cp'=>'','iw'=>'','in'=>'','ao'=>'','as'=>'','rj'=>'','de'=>'','hd'=>'','va'=>'','df'=>'','ls'=>'','is'=>'','hs'=>'','ex'=>'');
		$sparr[0] = $initperms;
		if($spid !='' && $current_no !=0)
		{
			$db = new Site_Model();
			$sparr = array();
			$fields = array('securityprofile');
			$result = $db->getRecordByLookUp('roles','roles_is','name',$spid,$fields,'');
			$securityprofile = $result->securityprofile;
			$formfields = new SimpleXMLElement($securityprofile);
			foreach ($formfields->menu as $menu)
			{
				$menu_id = sprintf('%s',$menu->menu_id);
				$iperms = sprintf('%s',$menu->controls_input);
				$eperms = sprintf('%s',$menu->controls_enquiry);
				$perms = $iperms.','.$eperms;
				$lookup = preg_split('/,/',$perms);
				$chkperms = $initperms;
				foreach($lookup as $key)
				{
					$chkperms[$key]="checked";
				}
				$sparr[$menu_id]=$chkperms;
			}
		}
	
		$this->content->usermenu ="<ul class='treeview' id='tree'>\n";
		foreach($this->topmenu_nologin as $key=>$rec) 
		{
			$this->content->usermenu .= $this->makeMenuSelectionList($this->tree->getChildren($rec->menu_id,true),$sparr);
		}
		$this->content->usermenu .= "</ul>\n";
		if($print){$this->content->render(TRUE);} else { return $this->content->usermenu;}
	}
}
?>