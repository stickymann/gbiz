<?php defined('SYSPATH') or die('No direct script access.');

class Menuuser_Controller extends Menufunc_Controller
{
    public function index()
    {
        parent::__construct();
		$site = new Site_Model;
		
		//rebuild main tree, move to menudef controller
		//$tree = new Menu_Model('menudefs', 'menu_id', 'parent_id', 'sortpos');
		//$tree->rebuild();
		
		//delete stale menu
		$query = sprintf('delete from menudefs_users where inputter = "%s"',Auth::instance()->get_user()->idname);
		if($result = $site->executeNonSelectQuery($query))
		{
			//select currently assigned roles
			$query = sprintf('select * from roles_users where user_id = "%s"',Auth::instance()->get_user()->id);
			if($rolearr = $site->executeSelectQuery($query))
			{
//print_r($rolearr); print "<br>[END ROLEARR]<hr>";

			foreach($rolearr as $key => $rec)
			{
				$role = ORM::factory('role',$rec->role_id);
				//get security profle from role record, data is xml
				$xml = new SimpleXMLElement($role->securityprofile);
				foreach ($xml->menu as $menu)
				{
					$controls_i = ''; $controls_e = '';
					//menudef record for menu id
					$query = sprintf('select * from menudefs where menu_id = "%s"',$menu->menu_id);
//print $query."<br>[END QUERY]<hr>";				
					$menurec = $site->executeSelectQuery($query);
//print_r($menurec); print "<br>[END MENUREC]<hr>";				
					if(!$menurec){continue;}
					$post = (array) $menurec[0];
					//update audit fields, we use inputter field to identify the user
					$post['inputter']=Auth::instance()->get_user()->idname; $post['authorizer']='SYSTEM';
					$post['input_date']=date('Y-m-d H:i:s'); $post['auth_date']=date('Y-m-d H:i:s'); $post['record_status']='LIVE';
				
					//set user input controls
					$master_input_ctrls = preg_split('/,/',$post['controls_input']); 
					$user_input_ctrls = preg_split('/,/',$menu->controls_input);
					foreach($user_input_ctrls as $key => $ctrl)
					{
						if(in_array($ctrl, $master_input_ctrls))
						{
							$controls_i = $controls_i.$ctrl.",";
						}
					}
					$post['controls_input'] = substr($controls_i,0,-1);				
				
					//set user enquiry controls
					$master_enquiry_ctrls = preg_split('/,/',$post['controls_enquiry']); 
					$user_enquiry_ctrls = preg_split('/,/',$menu->controls_enquiry);
					foreach($user_enquiry_ctrls as $key => $ctrl)
					{
						if(in_array($ctrl, $master_enquiry_ctrls))
						{
							$controls_e = $controls_e.$ctrl.",";
						}
					}
					$post['controls_enquiry'] = substr($controls_e,0,-1);				
								
					if($site->recordExistDualKey('menudefs_users','menu_id','inputter',$post['menu_id'],$post['inputter']))
					{
						//update controls
						//this scenario never occurs because xml parser only returns 1st instance of duplicate ids.	
						$site->updateRecordDualKey('menudefs_users',$post,'menu_id','inputter',$post['menu_id'],$post['inputter']);
					}
					else
					{				
						$site->insertRecord('menudefs_users',$post);
					}
				}
			}
			}
		}

		//get root menus for user
		$content = new View('menutree/menutree.view');
		$usertree = new Menuuser_Model('menudefs_users',Auth::instance()->get_user()->idname, 'menu_id', 'parent_id', 'sortpos');
		$topmenu = $usertree->getTopLevelMenus();
		$content->usermenu ="<ul class='treeview' id='tree'>\n";
		foreach($topmenu as $key=>$rec) 
		{
			$content->usermenu .= $this->makeListItemsFromNodes($usertree->getChildren($rec->menu_id,true));
		}
		$content->usermenu .= "</ul>\n";
		$content->render(TRUE);
	}
}
?>