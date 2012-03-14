<?php defined('SYSPATH') or die('No direct script access.');

class Site_Controller extends Template_Controller
{
	public $template	= 'site.template.view'; //defaults to template but you can set your own view file
	public $auto_render = TRUE; //defaults to true, renders the template after the controller method is done
	public $param		= array();
	public $formdata	= array();
	public $form		= array();
	public $label		= array();  
	public $formopts	= array();  
	public $sideinfo	= array();
	public $popout		= array();
	public $sidefunc	= array();
	public $sidelink	= array();
	public $subform		= array();
	public $model		= '';  
	public $colon		= " :";
	public $frmaudtfields = array();		
	
	public function __construct($controller)
    {
       	parent::__construct();
		$this->db = Database::instance();
		$this->model = new Site_Model();
		$this->param = $this->getControllerParams('site');

		$this->template->head = '';
		$this->template->userbttns = '';
		$this->template->menutitle = '';
		$this->template->content = '';
		$this->template->auditfields = '';
	
		if(Auth::instance()->logged_in())
		{
			$this->template->username = Auth::instance()->get_user()->username;
		}
		else
			$this->template->username = 'expired';
		
		// By adding this we are making the database object available to all controllers that extend Site_Controller
        $user = ORM::factory('user',$this->template->username);
		$this->template->idname = $user->idname; 
		$this->mergeFormWithAuditFields($this->form,$this->label);
    
		/*initialize controller params*/
		$this->param = $this->getControllerParams($controller);
		$this->param['url_enquiry'] = $this->param['url_input'] = $this->param['controller'];
		$this->param['primarymodel'] = new $this->param['primarymodel'];
		$this->param['defaultlookupfields'] = $this->param['primarymodel']->getFormFields($controller);
						
		/*setup form field,  fill arrays with default value*/
		$this->setSysconfigGlobalModes();
		$this->formdata = $this->getControllerFormDefs($controller);
		$this->setFormFieldsAndLabels();

		$htmlhead = new Sitehtml_Controller(html::stylesheet(array('media/css/site','media/css/tablesorterblue',$this->easyui_css,$this->easyui_icon,$this->datepick_css),array('screen','screen','screen','screen')));
		$htmlhead->add(html::script(array($this->jquery_js,$this->easyui_js,$this->datepick_js,'media/js/jquery.tablesorter','media/js/jquery.datevalidate','media/js/siteutils')));
		$htmlhead->add(html::script(array('media/js/sideinfo','media/js/enquiry','media/js/popoutselector')));
		$this->param['htmlhead'] = $htmlhead->getHtml();
	}
			
	public function mergeFormWithAuditFields(&$form,&$label)
	{
		$this->frmaudtfields = array
		(
			'inputter'=>		'inputter',
			'input_date'=>		'input_date',
			'authorizer'=>		'authorizer',
			'auth_date'=>		'auth_date',
			'record_status'=>	'record_status',
			'current_no'=>		'current_no'
		);
		$tmp1 = array_reverse($form);
		$tmp2 = array_reverse($this->frmaudtfields);
		$form  = array_reverse(array_merge($tmp2,$tmp1));
		
		$lblaudtabels = array
		(
			'inputter'=>		'Inputter',
			'input_date'=>		'Input Date',
			'authorizer'=>		'Authorizer',
			'auth_date'=>		'Auth Date',
			'record_status'=>	'Record Status',
			'current_no'=>		'Current No'
		);
		$tmp1 = array_reverse($label);
		$tmp2 = array_reverse($lblaudtabels);
		$label  = array_reverse(array_merge($tmp2,$tmp1));
	}

	function getControllerParams($_controller)
	{
		$arrobj = $this->model->getParams(trim($_controller));
		$arr = (array) $arrobj[trim($_controller)];
		return $arr;
	}

	function getControllerFormDefs($_controller)
	{
		$arrobj = $this->model->getFormDefs($_controller);
		return $arrobj;
	}
	
	function setFormFieldsAndLabels()
	{
		$formfields = new SimpleXMLElement($this->formdata->formfields);
		foreach ($formfields->field as $field)
		{		
			$key = sprintf('%s',$field->name);
			$this->form[$key] = sprintf('%s',$field->value);
			$this->label[$key] = sprintf('%s',$field->label);
			$this->formopts[$key]['options'] = sprintf('%s',$field->options);
			$this->formopts[$key]['inputtype'] = sprintf('%s',$field->type);
			$this->formopts[$key]['enable_on_new'] = sprintf('%s',$field->onnew);
			$this->formopts[$key]['enable_on_edit'] = sprintf('%s',$field->onedit);			
			if($field->popout)
			{
				$this->popout[$key]['enable'] = sprintf('%s',$field->popout->enable);
				$this->popout[$key]['table'] = sprintf('%s',$field->popout->table);
				$this->popout[$key]['selectfields'] = sprintf('%s',$field->popout->selectfields);
				$this->popout[$key]['idfield'] = sprintf('%s',$field->popout->idfield);
			}
			
			if($field->sideinfo)
			{
				$this->sideinfo[$key]['enable'] = sprintf('%s',$field->sideinfo->enable);
				$this->sideinfo[$key]['table'] = sprintf('%s',$field->sideinfo->table);
				$this->sideinfo[$key]['selectfields'] = sprintf('%s',$field->sideinfo->selectfields);
				$this->sideinfo[$key]['idfield'] = sprintf('%s',$field->sideinfo->idfield);
				$this->sideinfo[$key]['format'] = sprintf('%s',$field->sideinfo->format);
			}

			if($field->sidefunc)
			{
				$this->sidefunc[$key]['enable'] = sprintf('%s',$field->sidefunc->enable);
				$this->sidefunc[$key]['func'] = sprintf('%s',$field->sidefunc->func);
				$this->sidefunc[$key]['idfield'] = sprintf('%s',$field->sidefunc->idfield);
				$this->sidefunc[$key]['format'] = sprintf('%s',$field->sidefunc->format);
			}
		
			if($field->sidelink)
			{
				$i = 0;
				foreach ($field->sidelink->link as $link)
				{
					$this->sidelink[$key][$i] = array('src'=>sprintf('%s',$link->src),'attr'=>sprintf('%s',$link->attr),'text'=>sprintf('%s',$link->text));	
					$i++;
				}
			}
			
			if($field->subform)
			{
				$this->subform[$key]['subformcontroller'] = sprintf('%s',$field->subform->subformcontroller);	
				$this->subform[$key]['subformonnew'] = sprintf('%s',$field->subform->subformonnew);
				$this->subform[$key]['subformonedit']	= sprintf('%s',$field->subform->subformonedit);
			}
		}
	}

	public function getUserName()
	{
		return $this->template->username;
	}

	public function getIdName()
	{
		return $this->template->idname;
	}

	public function isGlobalAuthModeOn()
	{
		return $this->param['global_authmode_on'];
	}
	
	public function isControllerAuthModeOn()
	{
		return $this->param['auth_mode_on'];
		//return $this->global_auth_mode_on;
	}

	public function isGlobalIndexFieldOn()
	{
		return $this->param['global_indexfield_on'];
	}

	public function setSysconfigGlobalModes()
	{
		/*TODO: write select with join using array index and values*/
		$querystr = sprintf('select id,sysconfig_id,global_authmode_on,global_indexfield_on from sysconfigs where sysconfig_id = "%s"',"SYSTEM");
		$result = $this->param['primarymodel']->executeSelectQuery($querystr);
		$row = $result[0];
		$this->param['global_authmode_on']		= $row->global_authmode_on;
		$this->param['global_indexfield_on']	= $row->global_indexfield_on;
	}

	public function setRecordStatusMsg($_post,$_action="added to")
	{
		$this->param['recordstatusmsg']="<p><b>&nbsp Record  [ ".$_post['id']." ] ".$_action." ".$_post['record_status']." successfully, <a href=".$this->param['controller']."/index/".$_post['id'].">Continue.</a></b></p>"; 
	}

	public function setRecordStatusMsgIHLD($_post,$_msg="in IHLD, cannot be Authorized,")
	{
		$this->param['recordstatusmsg']="<p><b>&nbsp Record  [ ".$_post['id']." ] ".$_msg." <a href=".$this->param['controller']."/index/".$_post['id'].">Continue.</a></b></p>"; 
	}
	
	public function getRecordStatusMsg()
	{
		return $this->param['recordstatusmsg']; 
	}

	public function setPageContent($_head='',$_body='')
	{
		$this->template->head = $_head;
		$this->template->content = $_body;
	}

	public static function redirectToLogin()
	{
		url::redirect('autologout');
	}

	function processIndex()
	{
		$this->param['pageheader'] = $this->getPageHeader($this->param['appheader'],"");
		if(!$_POST)
        {
			$this->appIndex();
        }
		else
		{
			if($_POST['submit']=='Submit')
			{
				$this->param['pageheader'] = $this->getPageHeader($this->param['appheader'],$_POST['func']);
				$this->param['indexfieldvalue'] = $_POST[$this->param['indexfield']];
				
				switch($_POST['func'])
				{
					case 'v':
						$this->view();
					break;
					
					case 'n':
					case 'c':
					case 'i':
					case 'w':
						$this->input();
					break;

					case 'x':
						//$this->verify();
					break;
					
					case 'a':
						$this->authorize();
					break;

					case 'd':
						$this->livedelete();
					break;
				}
			}
			else if($_POST['submit']=='Hold')
			{
				$this->hold();
			}
			else if($_POST['submit']=='Validate')
			{
				//record lock get "mysteriously" delete on manual validation so write it back!
				//$lock = $this->param['primarymodel']->getRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id']);
//print_r($lock);				
				$this->validate();
				//$this->param['primarymodel']->setRecordLockById($lock->id,$lock->idname,$lock->lock_table,$lock->record_id,$lock->pre_status);

			}
			else if($_POST['submit']=='Commit')
			{
				if($this->input())
				{
					if( (!$this->isGlobalAuthModeOn()) || (!$this->isControllerAuthModeOn()) )
					{
						$_POST['submit']='Authorize';
						$_POST['func']='a'; $_POST['auth']='n'; $_POST['rjct']='n';
						$this->authorize();
					}
				}
			}
			else if($_POST['submit']=='Authorize' || $_POST['submit']=='Reject')
			{
				$this->authorize();
			}
			else if($_POST['submit']=='Delete')
			{
				$this->livedelete();
			}
			else if($_POST['submit']=='Cancel')
			{
				$arr = $this->param['primarymodel']->getRecordLockById($_POST['recordlockid']);
				
				$subFormExist = false;
				if($result = $this->param['primarymodel']->getSubFormController($this->param['controller']))
				{	
					$subFormExist = true;
					$parent_idfield = $this->param['indexfield'];
					$idval	 = $_POST[$parent_idfield];
					foreach($result as $key => $val)
					{
						$paramdef = $this->param['primarymodel']->getControllerParams($val);
						$subtable_inau[$val]   = $paramdef['tb_inau'];
						$subtable_idxfld[$val] = $paramdef['indexfield'];
					}
				}
					
				if($arr)
				{
					if($this->param['tb_inau'] == $this->param['tb_live'])
					{
						if($arr->pre_status == 'NEW')
						{	//delete INAU record, no change
							$this->param['primarymodel']->deleteRecordById($this->param['tb_inau'],$_POST['id']);
							if($subFormExist)
							{
								foreach($subtable_inau as $key => $table)
								{
									$this->param['primarymodel']->deleteRecordByFieldValue($table,$parent_idfield,$idval);
								}
							}
						}
					}
					else
					{
						if($arr->pre_status == 'NEW' || $arr->pre_status == 'LIVE')
						{	//delete INAU record, no change
							$this->param['primarymodel']->deleteRecordById($this->param['tb_inau'],$_POST['id']);
							if($subFormExist)
							{
								foreach($subtable_inau as $key => $table)
								{
									$sub_idfield = $subtable_idxfld[$key];
									$this->param['primarymodel']->deleteRecordByFieldValue($table,$parent_idfield,$idval);
								}
							}
						}
						else if($arr->pre_status == 'INAU')
						{	//set status back to INAU, no change
							$this->param['primarymodel']->setRecordStatus($this->param['tb_inau'],$_POST['id'],'INAU');
							if($subFormExist)
							{
								foreach($subtable_inau as $key => $table)
								{
									$sub_idfield = $subtable_idxfld[$key];
									$this->param['primarymodel']->setRecordStatusByFieldValue($table,$parent_idfield,$idval,'INAU');
								}
							}
						}
					}
					$this->param['primarymodel']->removeRecordLockById($_POST['recordlockid']);
					//(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$_POST['id']);
				}
				url::redirect($this->param['controller'].'/index/'.$_POST['id']);
			}
		}
	}

	public function getUserControls()
	{
		//verify against security profile
		$inputcontrols = new Sitecontrol_Controller($this->param['controller'],$this->template->idname);
		$inputcontrols->setGlobalAuthModeOn( $this->isGlobalAuthModeOn() ); 
		$inputcontrols->setControllerAuthModeOn( $this->isControllerAuthModeOn() ); 
		$inputcontrols->setGlobalIndexFldOn($this->isGlobalIndexFieldOn());
		$this->param['permissions'] = $inputcontrols->getAvailableInputPermissions();
		$inputcontrols->setInputControls();
		return $inputcontrols->getInputControls();
	}
		
	public function appIndex()
	{
		//check if user session expired;
		if(!Auth::instance()->logged_in())
		{
			$this->redirectToLogin();
		}
		else
		{
			//add stylesheets and global scripts
			//$this->param['htmlhead'] = $htmlhead->getHtml();
			//$head = html::stylesheet(array('media/css/site'),array('screen'));
			//$head .= html::stylesheet(array('media/css/smoothness/jquery-ui-1.7.2.custom'),array('screen'));
			$head = $this->param['htmlhead'];
			$content = new View($this->param['indexview']);
			$content->pageheader = $this->param['pageheader'];
		
			//build form
			$content->pagebody = "";
			$content->pagebody .=form::open($this->param['controller']);
			$content->pagebody .="<table>\n";
			$content->pagebody .="<tr valign='center'><td>".$this->getUserControls()."</td></tr>\n";
			$ctrl=$this->param['permissions'];
			if($ctrl['if']) 
			{
				$content->pagebody .="<tr valign='center'><td>".form::label($this->param['indexfield'],$this->param['indexlabel']).$this->colon."</td><td align='left'>".form::input($this->param['indexfield'], $this->param['indexfieldvalue'],'size="50" maxlength="50" class="input-i"')."</td></tr>\n"; 
			}
			else
			{
				$content->pagebody .="<tr valign='center'><td>".form::label($this->param['indexfield'],$this->param['indexlabel']).$this->colon."</td><td align='left'>".form::input($this->param['indexfield'], $this->param['indexfieldvalue'],'size="50" maxlength="50" class="input-i" readonly')."</td><td></td></tr>\n"; 
			}
			$content->pagebody .="</table>\n";
			$content->pagebody .=form::close();
			$this->setPageContent($head,$content);
		}
	}

	public function getPageHeader($_table,$_func)
	{
		switch ($_func)
		{
			case 'v':
				return $_table." - View";
			break;
			
			case 'n':
				return $_table." - New";
			break;
		
			case 'i':
			case 'input':
				return $_table." - Edit";
			break;
			
			case 'a':
			case 's':
				return $_table." - Authorize";
			break;
			
			case 'd':
				return $_table." - Delete";
			break;
			
			case 'e':
				return $_table." - Enquiry";
			break;

			default:
				return $_table;
		}

	}
		
	public function view()
	{
		$this->param['defaultlookupfields']=array_merge($this->param['defaultlookupfields'],$this->frmaudtfields);
		if(strstr($this->param['indexfieldvalue'],';') !== false)
		{
			$this->view_pre_open_existing_record();		
			$formarr=$this->param['primarymodel']->getHistRecordByLookUp($this->param['tb_hist'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields'],'v');
			$this->form = (array)$formarr;
		}
		else
		{
			$this->view_pre_open_existing_record();
			$formarr=$this->param['primarymodel']->getRecordByLookUp($this->param['tb_live'],$this->param['tb_inau'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields'],'v');
			$this->form = (array)$formarr;
		}
		$this->view_form();
		$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
		$this->view_post_open_existing_record();
	}
	
	public function view_form()
	{
		$content	= new View($this->param['viewview']);
		
		//add page/form header
		$content->pageheader = $this->param['pageheader'];
		if(!$this->form)
		{
			$pagebody = new SiteHtml_Controller($this->param['primarymodel']->getDBErrMsg());
		}	
		else
		{	
			// add form
			$pagebody = new Sitehtml_Controller(form::open($this->param['controller']));
			$pagebody->add("<table>\n");
			$pagebody->add("<tr valign='center'><td colspan=2>".$this->getUserControls()."</td></tr>\n");
			//form fields
			foreach($this->form as $key => $value)
			{
				$this->form[$key] = trim($this->form[$key]);
				switch($key)
				{
					case 'inputter':
					case 'input_date':
					case 'authorizer':
					case 'auth_date':
					case 'record_status':
					case 'current_no':
						$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td><span>".html::specialchars($this->form[$key])."</span></td></tr>\n");
					break;	
										
					default:
						$pagebody->add("<tr valign='top'>");
						if($this->formopts[$key]['inputtype']=='subform')
						{
							if($this->form['record_status'] == "IHLD" || $this->form['record_status'] == "INAU") { $subtable_type = "inau"; }
							else if ($this->form['record_status'] == "HIST") { $subtable_type = "hist"; }
							else { $subtable_type = "live"; }
							
							$SUBFORM_HTML = $this->viewSubForm($key,$this->form['current_no'],"brown",$subtable_type);
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".$SUBFORM_HTML."</span>");
						}
						else if($this->formopts[$key]['inputtype']=='xmltable')
						{
							$XMLTABLE_HTML = $this->viewXMLTable($key,$this->form[$key],"brown");
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".$XMLTABLE_HTML."</span>");
						}
						else
						{
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".nl2br(html::specialchars($this->form[$key]))."</span>");
						}

						if($this->formopts[$key]['inputtype']=='input')
						{
							$SIDEINFO_HTML = $this->createSideInfo($key,$this->formopts[$key]['options']);
							if($SIDEINFO_HTML != ""){ $SIDEINFO_HTML = "&nbsp &nbsp ( ".$SIDEINFO_HTML.")";}
							$pagebody->add($SIDEINFO_HTML);

							$SIDEFUNC_HTML = $this->createSideFunc($key,$this->formopts[$key]['options']);
							if($SIDEFUNC_HTML != ""){ $SIDEFUNC_HTML = "&nbsp &nbsp ( ".$SIDEFUNC_HTML.")";}
							$pagebody->add($SIDEFUNC_HTML);
							
						}
						$pagebody->add("</td></tr>\n"); 
					break;
				}
			}
			$pagebody->add("</table>");
			$pagebody->add(form::hidden('recordlockid',0));
			$pagebody->add(form::hidden('func','*'));
			$pagebody->add(form::close());
		}
		$content->pagebody = $pagebody->getHtml();
		$this->param['htmlbody'] = $content;
	}

	public function input()
	{
		//set index value invalid if hist syntax passed, cannot edit history record 
		if(strstr($this->param['indexfieldvalue'],';') !== false) {$this->param['indexfieldvalue'] = -1;}
		
		if($_POST['func']=='n')
        {
			//create new record in IHLD, populate form 
			if($this->param['tb_inau'] == $this->param['tb_live'])
			{
				//no inau table in tableset, auto_increment on live table, live table usually  linked to external system 
				//$formarr=$this->param['primarymodel']->createBlankRecordOnDBAutoIncrementTable($this->param['tb_live']);
				$formarr=$this->param['primarymodel']->createBlankRecord($this->param['tb_live'],$this->param['tb_inau']);
				$formarr->current_no = 1;
			}
			else
			{
				//using ids from _sys_autoids because records from inau tables get deleted and contain on records, auto_increment resets to zero 
				$formarr=$this->param['primarymodel']->createBlankRecord($this->param['tb_live'],$this->param['tb_inau']);
			}
			$this->form = (array)$formarr;
			if($this->form)
			{
				$this->param['primarymodel']->setRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id'],'NEW');
				$this->form['record_status'] = 'IHLD';
				$this->param['primarymodel']->setRecordStatus($this->param['tb_inau'],$this->form['id'],$this->form['record_status']);;
			}
			$this->input_form($_POST['func']);
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
			return true;
        }
		else if($_POST['func']=='c')
        {
			//create new record, copy existing record
			$empty = array();
			$this->param['defaultlookupfields']=array_merge($this->param['defaultlookupfields'],$empty);
			$formarr=$this->param['primarymodel']->getRecordByLookUp($this->param['tb_live'],$this->param['tb_inau'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields'],$_POST['func']);
			$newarr=$this->param['primarymodel']->createBlankRecord($this->param['tb_live'],$this->param['tb_inau']);
			$arr = (array)$newarr;
			$this->form = array_merge($arr,(array)$formarr);
			$this->form['id'] = $arr['id'];
			if($this->form)
			{
				$this->param['primarymodel']->setRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id'],'NEW');
				$this->form['record_status'] = 'IHLD';
				$this->param['primarymodel']->setRecordStatus($this->param['tb_inau'],$this->form['id'],$this->form['record_status']);;
			}
			$this->input_form($_POST['func']);
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
			return true;
        }
		else if($_POST['func']=='i' || $_POST['func']=='w')
		{	
			//create edit existing record in IHLD, populate form 
			$this->param['defaultlookupfields']=array_merge($this->param['defaultlookupfields'],$this->frmaudtfields);
			$formarr=$this->param['primarymodel']->getRecordByLookUp($this->param['tb_live'],$this->param['tb_inau'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields'],$_POST['func']);
			
			$this->form = (array)$formarr;
			if($this->form)
			{
				if($this->param['tb_inau'] == $this->param['tb_live'])
				{
					$this->param['primarymodel']->setRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id'],'INAU');
				}
				else
				{
					$this->param['primarymodel']->setRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id'],$this->form['record_status']);
				}
				$this->form['record_status'] = 'IHLD';
				$this->param['primarymodel']->setRecordStatus($this->param['tb_inau'],$this->form['id'],$this->form['record_status']);
				if($this->form['current_no']==0){$this->input_form('n');} else {$this->input_form('i');}
			}
			else
			{
				$this->input_form('i');
			}
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
			return true;
		}
		else
		{
			if($this->validate())
			{
				//add  formdata add to database, INAU table updated query
				$this->param['primarymodel']->removeRecordLockById($_POST['recordlockid']);
				//$this->param['primarymodel']->removeRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$_POST['id']);

				//removing indexes 'submit and 'func' from array, do not need for update, not database fields
				unset($_POST['submit']); unset($_POST['func']); unset($_POST['preval']);unset($_POST['recordlockid']);
				unset($_POST['bttnclicked']); unset($_POST['js_idname']);
				
				//set audit data
				$_POST['inputter']=Auth::instance()->get_user()->idname;$_POST['authorizer']='';
				$_POST['input_date']=date('Y-m-d H:i:s'); $_POST['auth_date']='';  $_POST['record_status']='INAU';

				$this->input_pre_update_existing_record();		
				if( $this->param['primarymodel']->updateRecord($this->param['tb_inau'],$_POST))
				{
					//create  update subform records if any
					$this->createSubFormRecords();
					$this->input_post_update_existing_record();		
					$this->setRecordStatusMsg($_POST);
										
					$this->param['htmlbody']->pagebody =  $this->getRecordStatusMsg();
					$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
					return true;
				}
				return false;
			}
			else
			{
				return false;
			}
		}
	}
	
	public function input_form($_func)
	{
		$content = new View('default_input');
		
		//add page/form header
		$content->pageheader = $this->param['pageheader'];
		
		//input form
		if(!$this->form)
		{
			$pagebody = new Sitehtml_Controller($this->param['primarymodel']->getDBErrMsg());
		}
		else
		{
			//get record lock data
			$lock = $this->param['primarymodel']->getRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id']);
			// add form
			$pagebody = new Sitehtml_Controller(form::open($this->param['controller'],array('id'=>$this->param['controller'],'name'=>$this->param['controller'])));
			$pagebody->add("<table>\n");
			$pagebody->add("<tr valign='center'><td colspan=2>".$this->getUserControls()."</td></tr>\n");
		
			foreach($this->form as $key => $value)
			{
				$POPOUT_HTML =""; $SIDEINFO_HTML=""; $SIDELINK_HTML=""; $DATEICON_HTML=""; $table =""; $fields=""; $idstr=""; $po_type=""; $disabled="" ; $style="";
				switch($key)
				{
					case 'inputter':
					case 'input_date':
					case 'authorizer':
					case 'auth_date':
					case 'record_status':
					case 'current_no':
						//$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span>".$this->form[$key]."</span></td></tr>\n"); 
						$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td><input type='hidden' id='".$key."' name='".$key."' value='".$this->form[$key]."'/><span>".$this->form[$key]."</span></td></tr>\n"); 
					break;	
				
					default:
						if(!(isset($this->formopts[$key]['options']))){unset($this->form[$key]);unset($_POST[$key]); continue;}
						$this->formopts[$key]['options'] = str_replace("%FORM%",$this->param['controller'], $this->formopts[$key]['options']); 
						$this->form[$key] = trim($this->form[$key]);
						if($_func == 'n' || $_func == 'c' || ($_func == 'l' && $_POST['current_no'] == 0))
						{ 
							if($this->formopts[$key]['enable_on_new'] == 'readonly' || $this->formopts[$key]['enable_on_new'] == 'readonly_po')
							{
								$disabled = 'readonly';
								if( $this->formopts[$key]['enable_on_new'] == 'readonly') { $style = 'style="background-color: #EBEBE0;"'; }
							}
							else if ($this->formopts[$key]['enable_on_new'] == 'disabled') {$disabled = 'disabled';}
							else { $disabled = "";} /*enabled*/
							$po_type = $this->formopts[$key]['enable_on_new'];
						}
						else if ($_func == 'i' || ($_func == 'l' && $_POST['current_no'] > 0))
						{
							if($this->formopts[$key]['enable_on_edit'] == 'readonly' || $this->formopts[$key]['enable_on_edit'] == 'readonly_po')
							{
								$disabled = 'readonly';
								if( $this->formopts[$key]['enable_on_edit'] == 'readonly') { $style = 'style="background-color: #EBEBE0;"'; }
							}
							else if ($this->formopts[$key]['enable_on_edit'] == 'disabled') {$disabled = 'disabled';}
							else { $disabled = "";} /*enabled*/
							$po_type = $this->formopts[$key]['enable_on_edit'];
						}
					
						$options = $this->formopts[$key]['options'] = $this->formopts[$key]['options'].' '.$style.' '.$disabled;
						switch($this->formopts[$key]['inputtype'])
						{	
							case 'input':
							case 'date':
							/*popout div*/
								if($po_type == 'enabled_po' || $po_type == 'readonly_po')
								{
									$POPOUT_HTML = $this->createPopOut($key,$this->form['current_no']);
									$SIDELINK_HTML = $this->createSideLink($key,$this->form['current_no']);
									if($this->formopts[$key]['inputtype']=="date")
									{
										$DATEICON_HTML = $this->createDatePopOut($key);
									}
								}
							/*side info span*/	
								$SIDEINFO_HTML = $this->createSideInfo($key,$options);
								$SIDEFUNC_HTML = $this->createSideFunc($key,$options);
																
								if(isset($LABEL))
									$pagebody->add("<tr valign='center'><td>".$LABEL.$this->colon."</td><td>".form::input($key,$this->form[$key],$options." class='input-i'")."</td></tr>\n"); 
								else
									$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::input($key,$this->form[$key],$options." class='input-i'").$DATEICON_HTML.$POPOUT_HTML.$SIDELINK_HTML.$SIDEINFO_HTML.$SIDEFUNC_HTML."</td></tr>\n"); 
							break;
					
							case 'hidden':
								//$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key],$options)."<span class='viewtext'>".$this->form[$key]."</span></td></tr>\n"); 
								$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td><input type='hidden' id='".$key."' name='".$key."' value='".$this->form[$key]."'/><span>".$this->form[$key]."</span></td></tr>\n"); 
							break;

							case 'password':
								$SIDELINK_HTML = $this->createSideLink($key,$this->form['current_no']);
								$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::password($key,$this->form[$key],$options." class='input-i'")."</td><td>".$SIDELINK_HTML."</td></tr>\n"); 
							break;

							case 'upload':
						
							break;

							case 'textarea':
								if($po_type == 'enabled_po' || $po_type == 'readonly_po')
								{
									$SIDELINK_HTML = $this->createSideLink($key,$this->form['current_no']);
								}
								$pagebody->add("<tr valign='top'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::textarea($key,$this->form[$key],$options." class='input-i'").$SIDELINK_HTML."</td></tr>\n"); 
							break;
							
							case 'xmltable':
								$XMLTABLE_HTML = $this->editXMLTable($key,$this->form[$key],"black");
								$pagebody->add("<td valign='top'>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::input($key,$this->form[$key])."<span class='viewtext'>".$XMLTABLE_HTML."</span>");
							break;

							case 'dropdown':
								list($arrval,$arrtxt)=explode("::",$options);
								$selection = array_combine(explode(",",$arrval),explode(",",$arrtxt));
								$pagebody->add("<tr valign='center'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::dropdown($key,$selection,$this->form[$key])."</td></tr>\n"); 
							break;

							case 'checkbox':
						
							break;

							case 'radio':
						
							break;

							case 'submit':
						
							break;

							case 'subform':
								if($lock)
								{
									if($_func == 'l')
									{
										$SUBFORM_HTML = $this->createSubFormFromXML($key,$_POST[$key]);
									}
									else
									{
										if($lock->pre_status == "IHLD" || $lock->pre_status == "INAU") {  $subtable_type = "inau"; }
										else { $subtable_type = "live"; }
										$SUBFORM_HTML = $this->createSubForm($key,$this->form['current_no'],$subtable_type);
									}
									$pagebody->add("<tr valign='top'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".$SUBFORM_HTML.sprintf('<input type="text" id="%s" name="%s" value="%s" size="1" style="border:0px;width:0px;height:0px;" readonly>',$key,$key,$this->form[$key])."</td></tr>\n"); 
								}
							break;
						}
					break;
				}
			}
			$pagebody->add("</table>");
			$pagebody->add(form::hidden('func','*'));
			//if($this->param['tb_inau'] == $this->param['tb_live']){ $pagebody->add(form::hidden('preval','i'));	}
			//else { ); }
			
			$pagebody->add(form::hidden('preval',$_func));
			$html = sprintf('<input type="hidden" id="bttnclicked" name="bttnclicked" value="%s"/>','false');
			$pagebody->add($html);

			if($lock)
			{
				$html = sprintf('<input type="hidden" id="recordlockid" name="recordlockid" value="%s"/>',$lock->id);
				$pagebody->add($html);
			}
			$html = sprintf('<input type="hidden" id="js_idname" name="js_idname" value="%s"/>',Auth::instance()->get_user()->idname);
			$pagebody->add($html);
			$pagebody->add(form::close());
			$pagebody->add($this->popOutSelectorWin());
			$pagebody->add($this->customDialogWin());
		}
		$content->pagebody = $pagebody->getHtml();
		$this->param['htmlbody'] = $content;
	}
	
	public function input_repopulate($_func)
	{
		$_POST['func']=$_func;
		$formarr=$_POST;
		unset($formarr['submit']); unset($formarr['func']); unset($formarr['preval']);unset($formarr['recordlockid']);
		//unset($_POST['recordlockid']);
		// repopulate form fields and show errors
		$this->form = arr::overwrite($formarr, $this->param['validatedpost']);
	}
	
	public function authorize()
	{
		//set index value invalid if hist syntax passed, cannot authorize history record 
		if(strstr($this->param['indexfieldvalue'],';') !== false) {$this->param['indexfieldvalue'] = -1;}
		
		//1) LIVE record inserted into HISTORY
		//2) INAU record record inserted into LIVE in not exist, else updated, count incremented if Approved
		//3) INAU record deleted
		
		if($_POST['submit']=='Submit')
        {
			$_POST['func']=='a';
			$this->param['defaultlookupfields']=array_merge($this->param['defaultlookupfields'],$this->frmaudtfields);
			$formarr=$this->param['primarymodel']->getRecordById($this->param['tb_live'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields']);
			$liverec = (array)$formarr;
			$formarr=$this->param['primarymodel']->getRecordById($this->param['tb_inau'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields']);
			$this->form = (array)$formarr;
			if($this->form)
			{
				$this->param['primarymodel']->setRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id'],$this->form['record_status']);
			}
			$this->authorize_form($liverec);
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
		}
		else if($_POST['submit']=='Reject')
		{
			//minimal authform required
			$content = new View('default_authorize');
			$content->pageheader = $this->param['pageheader'];
			$content->pagebody = $this->getUserControls();
			$this->param['htmlbody'] = $content;

			$this->param['primarymodel']->removeRecordLockById($_POST['recordlockid']);
			//$this->param['primarymodel']->removeRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$_POST['id']);
			if($this->param['primarymodel']->deleteRecordById($this->param['tb_inau'],$_POST['id']))
			{
				if($this->subFormExist($parent_idfield,$idval,$subtable_live,$subtable_inau,$subtable_hist,$subtable_idxfld))
				{
					foreach($subtable_inau as $key => $table)
					{
						$arr = $this->param['primarymodel']->getSubFormRecords($table,$parent_idfield,$idval);
						foreach($arr as $index => $row)
						{
							$sub_post = (array)$row;
							if($this->param['primarymodel']->deleteRecordById($table,$sub_post['id']))
							{/*do nothing*/} else {	return false; }
						}
					}
				}
				
				$this->setRecordStatusMsg($_POST,"deleted from");
				$this->param['htmlbody']->pagebody =  $this->getRecordStatusMsg();
			}
			else
			{
				$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
			}
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
		}
		else if($_POST['submit']=='Authorize')
		{	
			//minimal authform required
			$content = new View('default_authorize');
			$content->pageheader = $this->param['pageheader'];
			$content->pagebody = $this->getUserControls();
			$this->param['htmlbody'] = $content;
			
			//remove recordlocks first then do other  processing
			if( $this->isGlobalAuthModeOn() && $this->isControllerAuthModeOn() )
			{
				$this->param['primarymodel']->removeRecordLockById($_POST['recordlockid']);
			}
			
			//$this->param['primarymodel']->removeRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$_POST['id']);
			if($_POST['record_status']=='INAU')
			{
				//authorization permission is set/used only if auth modes on 
				if( $this->isGlobalAuthModeOn() && $this->isControllerAuthModeOn() )
				{
					$authorize = false;
					$ctrl = $this->param['permissions'];
					if($_POST['inputter']==Auth::instance()->get_user()->idname && $ctrl['as'])
					{ 
						$authorize = true; 
					} 
					else
					{ 
						$this->param['htmlbody']->pagebody = "Inputter = Authorizer, Cannot Self Authorize.";
						$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
					}

					if(!($_POST['inputter']==Auth::instance()->get_user()->idname) && $ctrl['ao'])
					{ 
						$authorize = true; 
					} 
					else
					{ 
						$this->param['htmlbody']->pagebody = "Inputter != Authorizer, Can Only Self Authorize.";
						$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
					}
				}
				else
				{
					$authorize = true; 
				}

				if($authorize)
				{
					//remove indexes 'submit and 'func' from array, do not need for update, not database fields
					unset($_POST['submit']); unset($_POST['func']); unset($_POST['preval']); unset($_POST['recordlockid']);
					unset($_POST['auth']); unset($_POST['rjct']);
				
					//set audit data
					$_POST['authorizer']=Auth::instance()->get_user()->idname; $_POST['auth_date']=date('Y-m-d H:i:s');
					$_POST['record_status']='LIVE'; 

					if($_POST['current_no']==0) //new record
					{
						$_POST['current_no']++;
						$this->authorize_pre_insert_new_record();
						if( $this->param['primarymodel']->insertRecord($this->param['tb_live'],$_POST))
						{
							$subFormExist = false;
							if($this->subFormExist($parent_idfield,$idval,$subtable_live,$subtable_inau,$subtable_hist,$subtable_idxfld))
							{
								$subFormExist = true;
								foreach($subtable_live as $key => $table)
								{
									$arr = $this->param['primarymodel']->getSubFormRecords($subtable_inau[$key],$parent_idfield,$idval);
									foreach($arr as $index => $row)
									{
										$sub_post = (array)$row;
										$sub_post['authorizer']		= $_POST['authorizer']; 
										$sub_post['auth_date']		= $_POST['auth_date'];
										$sub_post['record_status']	= $_POST['record_status'];
										$sub_post['current_no']		= $_POST['current_no'];
										if($this->param['primarymodel']->insertRecord($table,$sub_post))
										{/*do nothing*/} else {	return false; }
									}
								}
							}
														
							$this->authorize_post_insert_new_record();
							$this->setRecordStatusMsg($_POST);
										
							if($this->param['primarymodel']->deleteRecordById($this->param['tb_inau'],$_POST['id']))
							{
								if($subFormExist)
								{
									foreach($subtable_inau as $key => $table)
									{
										$arr = $this->param['primarymodel']->getSubFormRecords($table,$parent_idfield,$idval);
										foreach($arr as $index => $row)
										{
											$sub_post = (array)$row;
											if($this->param['primarymodel']->deleteRecordById($table,$sub_post['id']))
											{/*do nothing*/} else {	return false; }
										}
									}
								}
								$this->param['htmlbody']->pagebody =  $this->getRecordStatusMsg();
								$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
							}
							else
							{
								$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
							}
						}
						else
						{
							$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
						}
					}
					else //existing record
					{
						if($this->param['primarymodel']->insertFromTableToTable($this->param['tb_hist'],$this->param['tb_live'],$_POST['id']))
						{
							$this->param['primarymodel']->setRecordStatusHIST($this->param['tb_hist'],$_POST['id'],$_POST['current_no']);
							$_POST['current_no']++;
							
							$subFormExist = false;
							if($this->subFormExist($parent_idfield,$idval,$subtable_live,$subtable_inau,$subtable_hist,$subtable_idxfld))
							{
								$subFormExist = true;
								foreach($subtable_live as $key => $table)
								{
									$arr = $this->param['primarymodel']->getSubFormRecords($subtable_live[$key],$parent_idfield,$idval);
									foreach($arr as $index => $row)
									{
										$sub_post = (array)$row;
										if($this->param['primarymodel']->insertFromTableToTable($subtable_hist[$key],$table,$sub_post['id']))
										{
											$this->param['primarymodel']->setRecordStatusHIST($subtable_hist[$key],$sub_post['id'],$sub_post['current_no']);
										}
										else {	return false; }
									}
								}
							}
							
							$this->authorize_pre_update_existing_record();		
							if($this->param['primarymodel']->updateRecord($this->param['tb_live'],$_POST))
							{
								if($subFormExist)
								{
									foreach($subtable_live as $key => $table)
									{
										/*no of inau records may differ from live after edit*/
										/*delete live records first*/
										$arr = $this->param['primarymodel']->getSubFormRecords($table,$parent_idfield,$idval);
										foreach($arr as $index => $row)
										{
											$sub_post = (array)$row;
											if($this->param['primarymodel']->deleteRecordById($table,$sub_post['id']))
											{/*do nothing*/} else {	return false; }
										}

										/*re-insert inau records into live*/
										$arr = $this->param['primarymodel']->getSubFormRecords($subtable_inau[$key],$parent_idfield,$idval);
										foreach($arr as $index => $row)
										{
											$sub_post = (array)$row;
											$sub_post['authorizer']		= $_POST['authorizer']; 
											$sub_post['auth_date']		= $_POST['auth_date'];
											$sub_post['record_status']	= $_POST['record_status'];
											$sub_post['current_no']		= $_POST['current_no'];
											if($this->param['primarymodel']->insertRecord($table,$sub_post))
											{/*do nothing*/} else {	return false; }
										}
									}
								}

								$this->authorize_post_update_existing_record();		
								$this->setRecordStatusMsg($_POST);
								$isTrue=false;
								if($this->param['tb_inau'] == $this->param['tb_live']){ $isTrue = true; }
								else 
								{ 
									if($isTrue = $this->param['primarymodel']->deleteRecordById($this->param['tb_inau'],$_POST['id']))
									{
										if($subFormExist)
										{
											/*cleanup subform inau*/
											foreach($subtable_inau as $key => $table)
											{
												$arr = $this->param['primarymodel']->getSubFormRecords($table,$parent_idfield,$idval);
												foreach($arr as $index => $row)
												{
													$sub_post = (array)$row;
													if($this->param['primarymodel']->deleteRecordById($table,$sub_post['id']))
													{/*do nothing*/} else {	return false; }
												}
											}
										}
									}									
								}
								
								if($isTrue)
								{
									$this->param['htmlbody']->pagebody =  $this->getRecordStatusMsg();
									$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
								}
								else
								{
									$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
								}
							}
							else
							{
								$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
							}
						}
						else
						{
							$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
						}
					}
				}
			}
			else
			{
				$this->setRecordStatusMsgIHLD($_POST);
				$this->param['htmlbody']->pagebody =  $this->getRecordStatusMsg();
				$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
			}
		}
	}

	public function authorize_form($_liverec='')
	{
		$content = new View('default_authorize');
		//add page/form header
		$content->pageheader = $this->param['pageheader'];
		if(!$this->form)
		{
			$pagebody = new Sitehtml_Controller($this->param['primarymodel']->getDBErrMsg());
		}	
		else
		{	
			// add form
			$pagebody = new Sitehtml_Controller(form::open($this->param['controller']));
			$pagebody->add("<table>\n");
			$pagebody->add("<tr valign='center'><td colspan=2>".$this->getUserControls()."</td></tr>\n");
			//form fields
			if($this->form['current_no']==0){$newrec = true;}else{$newrec = false;}
			foreach($this->form as $key => $value)
			{
				$this->form[$key] = trim($this->form[$key]);
				$livetext =''; $SUBFORM_HTML_LIVE = "";
				if(!$newrec)
				{
					if( $this->isGlobalAuthModeOn() && $this->isControllerAuthModeOn() )
					{
						if(!($_liverec[$key]==$this->form[$key]))
						{
							$SIDEINFO_HTML = $this->createSideInfo($key,$this->formopts[$key]['options'],$_liverec[$key]);
							if($SIDEINFO_HTML != ""){ $SIDEINFO_HTML = "&nbsp &nbsp ( ".$SIDEINFO_HTML.")";}
							$livetext="<br><span class='livetext'>".nl2br(html::specialchars($_liverec[$key])).$SIDEINFO_HTML."</span>";
							
							if(isset($this->formopts[$key]['inputtype']))
							{
								if($this->formopts[$key]['inputtype']=='subform')
								{
									$livetext = $this->viewSubForm($key,$this->form['current_no'],"green","live");
								}
								else if($this->formopts[$key]['inputtype']=='xmltable')
								{
									$livetext = $this->viewXMLTable($key,$this->form[$key],"green");
								}
							}
						}
					}
				}

				switch($key)
				{
					case 'inputter':
					case 'input_date':
					case 'authorizer':
					case 'auth_date':
					case 'record_status':
					case 'current_no':
						$pagebody->add("<tr valign='top'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span>".html::specialchars($this->form[$key])."</span></td></tr>\n"); 
					break;	
					default:
						$pagebody->add("<tr valign='top'>");
						if($this->formopts[$key]['inputtype']=='subform')
						{
							$txtval = $this->viewSubForm($key,$this->form['current_no'],"brown","inau");
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".$txtval."</span>");
						}
						else if($this->formopts[$key]['inputtype']=='xmltable')
						{
							$txtval = $this->viewXMLTable($key,$this->form[$key],"brown");
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".$txtval."<br></span>");
							
						}
						else
						{
							$txtval = $this->form[$key];
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".nl2br(html::specialchars($txtval))."</span>");
						}
												
						if($this->formopts[$key]['inputtype']=='input')
						{
							$SIDEINFO_HTML = $this->createSideInfo($key,$this->formopts[$key]['options']);
							if($SIDEINFO_HTML != ""){ $SIDEINFO_HTML = "&nbsp &nbsp ( ".$SIDEINFO_HTML.")";}
							$pagebody->add($SIDEINFO_HTML);

							$SIDEFUNC_HTML = $this->createSideFunc($key,$this->formopts[$key]['options']);
							if($SIDEFUNC_HTML != ""){ $SIDEFUNC_HTML = "&nbsp &nbsp ( ".$SIDEFUNC_HTML.")";}
							$pagebody->add($SIDEFUNC_HTML);
						}
						
						$pagebody->add($livetext."</td></tr>\n"); 
					break;
				}
			}
			$pagebody->add("</table>");
			$pagebody->add(form::hidden('func','*'));
			$lock = $this->param['primarymodel']->getRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id']);
			if($lock)
			{
				$html = sprintf('<input type="hidden" id="recordlockid" name="recordlockid" value="%s"/>',$lock->id);
				$pagebody->add($html);
			}
			$pagebody->add(form::close());
		}
		$content->pagebody = $pagebody->getHtml();
		$this->param['htmlbody'] = $content;
	}
	
	public function livedelete()
	{
		//set index value invalid if hist syntax passed, cannot delete history record 
		if(strstr($this->param['indexfieldvalue'],';') !== false) {$this->param['indexfieldvalue'] = -1;}
		
		if($_POST['submit']=='Submit')
        {
			if($this->param['primarymodel']->recordExist($this->param['tb_inau'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['indexfieldvalue']))
			{
				$this->livedelete_form();
				$this->param['htmlbody']->pagebody = '<div class="frmmsg">Record [ '.$this->param['indexfieldvalue'].' ] in IHLD or INAU, cannot delete from LIVE.</div>';
			}
			else
			{
				$_POST['func']=='d';
				$this->param['defaultlookupfields']=array_merge($this->param['defaultlookupfields'],$this->frmaudtfields);
				$formarr=$this->param['primarymodel']->getRecordById($this->param['tb_live'],$this->param['indexfield'],$this->param['indexfieldvalue'],$this->param['defaultlookupfields']);
				$this->form = (array)$formarr;
				if($this->form)
				{
					$this->param['primarymodel']->setRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id'],$this->form['record_status']);
				}
				$this->livedelete_form();
			}			
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
		}
		else if($_POST['submit']=='Delete')
		{
			$this->livedelete_form();
			if($this->param['primarymodel']->insertFromTableToTable($this->param['tb_hist'],$this->param['tb_live'],$_POST['id']))
			{
				$this->param['primarymodel']->setRecordStatusHIST($this->param['tb_hist'],$_POST['id'],$_POST['current_no']);
				
				$subFormExist = false;
				if($this->subFormExist($parent_idfield,$idval,$subtable_live,$subtable_inau,$subtable_hist,$subtable_idxfld))
				{
					foreach($subtable_live as $key => $table)
					{
						$arr = $this->param['primarymodel']->getSubFormRecords($subtable_live[$key],$parent_idfield,$idval);
						foreach($arr as $index => $row)
						{
							$sub_post = (array)$row;
							if($this->param['primarymodel']->insertFromTableToTable($subtable_hist[$key],$table,$sub_post['id']))
							{
								$this->param['primarymodel']->setRecordStatusHIST($subtable_hist[$key],$sub_post['id'],$sub_post['current_no']);
							}
							else {	return false; }
						}
					}
					$subFormExist = true;
				}
								
				$this->setRecordStatusMsg($_POST,'deleted from');
				$this->delete_pre_update_existing_record();		
				if($this->param['primarymodel']->deleteRecordById($this->param['tb_live'],$_POST['id']))
				{
					if($subFormExist)
					{
						/*cleanup subform inau*/
						foreach($subtable_live as $key => $table)
						{
							$arr = $this->param['primarymodel']->getSubFormRecords($table,$parent_idfield,$idval);
							foreach($arr as $index => $row)
							{
								$sub_post = (array)$row;
								if($this->param['primarymodel']->deleteRecordById($table,$sub_post['id']))
								{/*do nothing*/} else {	return false; }
							}
						}
					}
					$this->delete_post_update_existing_record();	
					$this->param['htmlbody']->pagebody =  $this->getRecordStatusMsg();
					$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
				}
				else
				{
					$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
				}
			}
			else
			{
				$this->param['htmlbody']->pagebody= $this->param['primarymodel']->getDBErrMsg();
			}
		}
	}
	
	public function livedelete_form()
	{
		$content = new View('default_delete');
		//add page/form header
		$content->pageheader = $this->param['pageheader'];
		$pagebody = new Sitehtml_Controller(form::open($this->param['controller']));
		//add page/form header
		$content->pageheader = $this->param['pageheader'];
		if(!$this->form)
		{
			$pagebody = new Sitehtml_Controller($this->param['primarymodel']->getDBErrMsg());
		}	
		else
		{	
			// add form
			$pagebody = new Sitehtml_Controller(form::open($this->param['controller']));
			$pagebody->add("<table>\n");
			$pagebody->add("<tr valign='center'><td colspan=2>".$this->getUserControls()."</td></tr>\n");
			//form fields
			foreach($this->form as $key => $value)
			{
				$this->form[$key] = trim($this->form[$key]);
				switch($key)
				{
					case 'inputter':
					case 'input_date':
					case 'authorizer':
					case 'auth_date':
					case 'record_status':
					case 'current_no':
						$pagebody->add("<tr valign='top'><td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span>".html::specialchars($this->form[$key])."</span></td></tr>\n"); 
					break;	
					default:
						$pagebody->add("<tr valign='top'>");
						
						if($this->formopts[$key]['inputtype']=='subform')
						{
								
							$SUBFORM_HTML = $this->viewSubForm($key,$this->form['current_no'],"red","live");
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".$SUBFORM_HTML."</span>");
						}
						else if($this->formopts[$key]['inputtype']=='xmltable')
						{
							$XMLTABLE_HTML = $this->viewXMLTable($key,$this->form[$key],"red");
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".$XMLTABLE_HTML."</span>");
						}
						else
						{
							$pagebody->add("<td>".form::label($key,$this->label[$key]).$this->colon."</td><td>".form::hidden($key,$this->form[$key])."<span class='viewtext'>".nl2br(html::specialchars($this->form[$key]))."</span>");
						}
								
						if($this->formopts[$key]['inputtype']=='input')
						{
							$SIDEINFO_HTML = $this->createSideInfo($key,$this->formopts[$key]['options']);
							if($SIDEINFO_HTML != ""){ $SIDEINFO_HTML = "&nbsp &nbsp ( ".$SIDEINFO_HTML.")";}
							$pagebody->add($SIDEINFO_HTML);
						
							$SIDEFUNC_HTML = $this->createSideFunc($key,$this->formopts[$key]['options']);
							if($SIDEFUNC_HTML != ""){ $SIDEFUNC_HTML = "&nbsp &nbsp ( ".$SIDEFUNC_HTML.")";}
							$pagebody->add($SIDEFUNC_HTML);
						}
						$pagebody->add("</td></tr>\n");
					
					break;
				}
			}
			$pagebody->add("</table>");
			$pagebody->add(form::hidden('func','*'));
			$lock = $this->param['primarymodel']->getRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$this->form['id']);
			if($lock)
			{
				$html = sprintf('<input type="hidden" id="recordlockid" name="recordlockid" value="%s"/>',$lock->id);
				$pagebody->add($html);
			}
			$pagebody->add(form::close());
		}
		$content->pagebody = $pagebody->getHtml();
		$this->param['htmlbody'] = $content;
	}

	public function hold()
	{
		//add  formdata add to database, INAU table updated
		$this->input_form('i');
		//remove recordlocks before index
		$this->param['primarymodel']->removeRecordLockById($_POST['recordlockid']);
		//removing indexes 'submit and 'func' from array, do not need for update, not database fields
		unset($_POST['submit']); unset($_POST['func']); unset($_POST['preval']); unset($_POST['recordlockid']); unset($_POST['bttnclicked']);
		unset($_POST['js_idname']);
				
		//set audit data
		$_POST['inputter']=Auth::instance()->get_user()->idname;$_POST['authorizer']='';
		$_POST['input_date']=date('Y-m-d H:i:s'); $_POST['auth_date']='';  $_POST['record_status']='IHLD';
		
		//$this->param['primarymodel']->removeRecordLock(Auth::instance()->get_user()->idname,$this->param['tb_inau'],$_POST['id']);
		if( $this->param['primarymodel']->updateRecord($this->param['tb_inau'],$_POST))
		{
			$this->createSubFormRecords();
			$this->setRecordStatusMsg($_POST);
			$this->param['htmlbody']->pagebody =  $this->getRecordStatusMsg();
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
		}
	}
	
	public function validate()
	{
		$errmsg = "";
		$this->input_validation();
		if (!$this->param['isinputvalid'])
		{
			$this->input_repopulate($_POST['preval']);
			$this->input_form('l');
			
			foreach ($this->param['inputerrors'] as $key => $value)
			{
				$errmsg .= $value.'<br/>';	
			}
			$this->param['htmlbody'] .= $this->validationAlertWin($errmsg);
			$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
			return false;
		}
		else
		{
			$this->input_repopulate($_POST['preval']);
			$this->input_form('l');
			$errmsg .= 'All input data ok, no errors.';	
			if($_POST['submit'] == 'Validate')
			{	
				$this->param['htmlbody'] .= $this->validationAlertWin($errmsg);
				$this->setPageContent($this->param['htmlhead'],$this->param['htmlbody']);
			}
			return true;
		}
	}

	function validationAlertWin($errmsg)
	{
		$HTML= <<<_TEXT_
		<div id="validatewin" class="easyui-dialog" title="Validation Alert" modal="true" resizable="true" buttons="#validatewin-buttons">
 			<div id="validate_error">
			$errmsg
			</div>
		</div>
		<div id="validatewin-buttons"><a href="#" class="easyui-linkbutton" onclick="javascript:$('#validatewin').dialog('close')">Close</a></div>  
_TEXT_;
		return $HTML;
	}

	function input_validation()
	{
		$post = $_POST;	
		//validation rules
		$validation = new Validation($post);
		$validation->pre_filter('trim', TRUE);
		$this->param['isinputvalid'] = $validation->validate();
		$this->param['validatedpost'] = (array) $validation;
		$this->param['inputerrors'] = (array) $validation->errors($this->param['errormsgfile']);
	}

	function processEnquiry($arr=array())
	{
		if(!Auth::instance()->logged_in())
		{
			$this->redirectToLogin();	
		}
		else
		{
			$pagehead = new Sitehtml_Controller(html::stylesheet(array('media/css/tablesorterblue','media/css/site'),array('screen','screen')));
			$pagehead->add(html::stylesheet(array($this->easyui_css,$this->easyui_icon),array('screen','screen')));
			$pagehead->add(html::script(array($this->jquery_js,$this->easyui_js,'media/js/jquery.tablesorter')));
			$controller = $this->param['controller'];
	
			$TEXT = <<<_TEXT_
			<script type="text/javascript">
			controller="$controller";
			if(controller=="message")
			{
				//sort on firstcolumn(id) desc
				$(function() { $("#enqrestab").tablesorter({sortList:[[0,1]], widgets: ['zebra']}); });
			}
			else
			{
				$(function() 
					{		
						$("#enqrestab").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
						$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
					}
				);
			}
			</script> 
_TEXT_;
			$pagehead->add($TEXT);
			$pagehead->add('</script>');
			//$htmltable = '<div id="pageheader" class="ui-widget-header">';
			$htmltable = '<div id="pageheader" class="window">';
			$htmltable .= $this->param['pageheader']."\n";
			$htmltable .= '</div>';
			$htmltable .= '<div id="pagebody">';
			$htmltable .= '<div id="e">'."\n";
			$htmltable .= '<table id="enqrestab" class="tablesorter" border="0" cellpadding="0" cellspacing="1" width=500%>'."\n";
			$firstpass = true;
			$lbl=$this->label;
			foreach($arr as $row => $linerec)
			{	
				$header = ''; $data = '';
				foreach ($linerec as $key => $value)
				{
					if($firstpass)
					{
						$header .= '<th>'.$lbl[$key].'</th>'; 
					}
					if($key == 'id')
					{
						$data .= '<td>'.html::anchor($this->param['controller'].'/index/'.$value,$value,array('target'=>'input'));
						//$data .= '<td>'.'<a href="'.$this->param['controller'].'/index/'.$value.'" target=input>'.$value.'</a></td>'; 
					}
					else
					{
						$data .= '<td>'.$value.'</td>'; 
					}
				}
				if($firstpass)
				{
					$header = "\n".'<thead>'."\n".'<tr>'.$header.'</tr>'."\n".'</thead>'."\n".'<tbody>'."\n";
					$htmltable.=$header;
				}
				$data = '<tr>'.$data.'</tr>'."\n"; 
				$htmltable.= $data;
				$firstpass = false;
			}
			$htmltable.='</tbody>'."\n".'</table>'."\n";
			$htmltable .= '</div></div>'."\n";
			$pagebody = new Sitehtml_Controller($htmltable);
			$this->setPageContent($pagehead->getHtml(),$pagebody->getHtml());
		}
	}	
	
	function enquiry_default()
	{
		if(!Auth::instance()->logged_in())
		{
			$this->redirectToLogin();	
		}
		else
		{
			$sc = new Sitecontrol_Controller();
			$pagehead = new Sitehtml_Controller($this->param['htmlhead']);
			$pagebody = new Sitehtml_Controller($sc->showTabs($this->param['controller']));
			$this->setPageContent($pagehead->getHtml(),$pagebody->getHtml());
		}
	}

	public function popOutSelectorWin()
	{
		$HTML = <<<_HTML_
		<div id="light" class="white_content" buttons="#light-buttons">
			<div id="pofilter"></div>
			<div id="poresult"></div>
		</div>
		<div id="light-buttons" style="background-color:#ebf2f9; display:none;"><a href="#" class="easyui-linkbutton" onclick="javascript:popout.SelectorClose()">Close</a></div>
		<div id="fade" class="black_overlay"></div>
_HTML_;
		return $HTML;
	}
	
	public function customDialogWin()
	{
		$HTML = <<<_HTML_
		<div id="chklight" class="white_content"  buttons="#chklight-buttons">
			<div id="chkresult"></div>
		</div>
		<div id="chklight-buttons" style="background-color:#ebf2f9; display:none;"><a href="#" class="easyui-linkbutton" onclick="javascript:siteutils.closeDialog('chklight',false)">Close</a></div>
		<div id="fade" class="black_overlay"></div>
_HTML_;
		return $HTML;
	}

	public function createPopOut($key, $current_no)
	{
		$POPOUT_HTML = "";
		if(($this->formopts[$key]['enable_on_edit'] == "readonly" || $this->formopts[$key]['enable_on_edit'] == "disabled") && $_POST['func']=="i" && $current_no > 0)
		{
			return $POPOUT_HTML;
		}
		else if(isset($this->popout[$key]))
		{
			//preg_match('/\.([^\.]*$)/i'
			if (preg_match('/yes/i', $this->popout[$key]['enable']) || $this->popout[$key]['enable']==1) 
			{
				$fields = sprintf('"%s"',$this->popout[$key]['selectfields']);
				$table	= sprintf('"%s"',$this->popout[$key]['table']);
				$idfield  = sprintf('"%s"',$this->popout[$key]['idfield']);
				$returnfield = sprintf('"%s"',$key);
				$baseurl = sprintf('<img src="%smedia/img/site/%s" align=absbottom>',url::base(),"lubw020.png");
				$POPOUT_HTML = sprintf('<a href = "javascript:void(0)" onclick=window.popout.SelectorOpen(%s,%s,%s,%s) class="aimg">&nbsp %s &nbsp</a>',$fields,$table,$idfield,$returnfield,$baseurl);
			}
		}
		return $POPOUT_HTML;
	}
	
	public function createSideInfo($key,&$options,$val="")
	{
		$SIDEINFO_HTML = "";
		if($val==""){$val=$this->form[$key];}
		if(isset($this->sideinfo[$key]))
		{
			if (preg_match('/yes/i', $this->sideinfo[$key]['enable']) || $this->sideinfo[$key]['enable']==1) 
			{
//print_r($this->sideinfo[$key]); print "<hr>";					
				$fields			= trim(sprintf('"%s"',$this->sideinfo[$key]['selectfields']));
				$table			= trim(sprintf('"%s"',$this->sideinfo[$key]['table']));
				$idfield		= trim(sprintf('"%s"',$this->sideinfo[$key]['idfield']));
				$returnfield	= trim(sprintf('"%s"',$key));
				$format			= trim(sprintf('"%s"',$this->sideinfo[$key]['format']));
												
//print_r($this->formopts[$key]['options']); print "<hr>";					
				$this->formopts[$key]['options'] = str_replace("%FIELDS%",$fields, $this->formopts[$key]['options']); 
				$this->formopts[$key]['options'] = str_replace("%TABLE%",$table, $this->formopts[$key]['options']); 
				$this->formopts[$key]['options'] = str_replace("%IDFIELD%",$idfield, $this->formopts[$key]['options']); 
				//$this->formopts[$key]['options'] = trim(str_replace("%IDVAL%",$this->form[$key], $this->formopts[$key]['options'])); 
				$this->formopts[$key]['options'] = str_replace("%RETFIELD%",$returnfield, $this->formopts[$key]['options']); 
				$this->formopts[$key]['options'] = str_replace("%FORMAT%",$format, $this->formopts[$key]['options']); 
//print_r($this->formopts[$key]['options']); print "<hr>";				
				/*
				if($dynamic)
				{
					$idval	= sprintf('document.getElementById("%s").value',$key);
					$this->formopts[$key]['options'] = str_replace("%IDVAL%",$idval, $this->formopts[$key]['options']); 
				}
				*/
				$idval = sprintf('"%s"',$val);
				$options = $this->formopts[$key]['options'];
								
//$url = "http://localhost/soulmap/ajaxtodb?option=sideinfo&fields=label_input,url_input&table=menudefs&idfield=menu_id&idval=100&format=*;_*";
//$url = sprintf('http://localhost/soulmap/ajaxtodb?option=sideinfo&fields=%s&table=%s&idfield=%s&idval=%s&format=%s',$fields,$table,$idfield,$idval,$format);
				$baseurl = url::base(TRUE,'http');
				$url = sprintf('%sajaxtodb?option=sideinfo&fields=%s&table=%s&idfield=%s&idval=%s&format=%s',$baseurl,$fields,$table,$idfield,$idval,$format);
				$url = str_replace('"','',$url);

//print $url."<br>[END URL]<hr>";				
				$loadval = Sitehtml_Controller::getHTMLFromUrl($url);
				$SIDEINFO_HTML = sprintf('<span id="%s_sideinfo" name="%s_sideinfo"> %s</span>',$key,$key,$loadval)."\n";
			}
		}
		return $SIDEINFO_HTML;
	}
	
	public function createSideFunc($key,&$options,$val="")
	{
		$SIDEFUNC_HTML = "";
		if($val==""){$val=$this->form[$key];}
		if(isset($this->sidefunc[$key]))
		{
			if (preg_match('/yes/i', $this->sidefunc[$key]['enable']) || $this->sidefunc[$key]['enable']==1) 
			{
//print_r($this->sideinfo[$key]); print "<hr>";					
				$func = sprintf('"%s"',$this->sidefunc[$key]['func']);
				$value	= sprintf('"%s"',$this->form[$key]);
				$format = sprintf('"%s"',$this->sidefunc[$key]['format']);
				$idfield = sprintf('"%s"',$this->sidefunc[$key]['idfield']);
				
				$this->formopts[$key]['options'] = str_replace("%FUNC%",$func, $this->formopts[$key]['options']); 
				$this->formopts[$key]['options'] = str_replace("%PARAMFLD%",$idfield, $this->formopts[$key]['options']); 
				$this->formopts[$key]['options'] = str_replace("%SFFORMAT%",$format, $this->formopts[$key]['options']); 
//print_r($this->formopts[$key]['options']); print "<hr>";	
				$options = $this->formopts[$key]['options'];
				$baseurl = url::base(TRUE,'http');
				$url = sprintf('%sajaxtodb?option=sidefunc&func=%s&parameter=%s&format=%s',$baseurl,$func,$value,$format);
				$url = str_replace('"','',$url);
//print $url."<br>[END URL]<hr>";					
				$loadval = Sitehtml_Controller::getHTMLFromUrl($url);
				$SIDEFUNC_HTML = sprintf('<span id="%s_sidefunc" name="%s_sidefunc"> %s</span>',$key,$key,$loadval)."\n";
			}
		}
		return $SIDEFUNC_HTML;
	}

	public function createSideLink($key,$current_no)
	{
		$SIDEFUNC_LINK = ""; $linkhtml="";
		if(($this->formopts[$key]['enable_on_edit'] == "readonly" || $this->formopts[$key]['enable_on_edit'] == "disabled") && $_POST['func']=="i" && $current_no > 0)
		{
			return$SIDEFUNC_LINK;
		}
		else if(isset($this->sidelink[$key]))
		{
			foreach($this->sidelink[$key] as $indx => $linkarr)
			{
				if(strstr($linkarr['text'],'%IMG%') !== false)
				{
					$baseurl = url::base(TRUE,'http');
					$baseurl = str_replace("index.php/","",$baseurl);
					$linkarr['text'] = sprintf('<img src="%s%s" align="absbottom"/>',$baseurl,$linkarr['text']);
					$linkarr['text'] = str_replace("%IMG%","",$linkarr['text']);
				}
				$linkhtml	.= sprintf('<a href="%s" %s>%s</a> ',$linkarr['src'],$linkarr['attr'],$linkarr['text']);
			}
		}
		$SIDEFUNC_LINK = sprintf('<span id="%s_sidelink" name="%s_sidelink"> %s</span>',$key,$key,$linkhtml)."\n";
		return $SIDEFUNC_LINK;
	}
	
	public function createDatePopOut($key)
	{
		$baseurl = url::base();
		$iconurl = $baseurl."media/css/calendar-blue.gif";
		$TEXT=<<<_text_
		<script type="text/javascript">
			$(function() 
			{
				$('#$key').datepick(
				{
					showOnFocus: false, 
					showTrigger: '<span class="dateicon">&nbsp&nbsp<img src="$iconurl" align="absbottom">&nbsp</span>',
					dateFormat: 'yyyy-mm-dd',
					yearRange: '1900:c+100',
					showAnim: '',
					alignment: 'bottomLeft',
					onSelect: function() { $('#$key').focus(); }
				});
			});
	</script>
_text_;
		return $TEXT;
	}

	public function createSubFormJSONLoad($key,$current_no,$subtable_type=false)
	{
		$TABLE = ""; $TABLEHEAD = ""; $TABLEROWS = ""; $columnfield = array(); $columnlabel = array(); 
		$subcontroller = $this->subform[$key]['subformcontroller'];
		$subheader	= $this->label[$key];
	
		$columnfield = $this->param['primarymodel']->getSubFormFields($subcontroller,$columnlabel);
		$subopt = $this->param['primarymodel']->getSubFormOptions($subcontroller);
		$idfield = $this->param['indexfield'];
		$idval = $this->form[$idfield];

		$TABLEHEAD .= "<thead>"."\n"."<tr valign='top'>"."\n";
		foreach($subopt as $subkey => $row)
		{
			if(isset($row['width'])){ $width = $row['width']; } else { $width = ""; }
			if(isset($row['align'])){ $align = $row['align']; } else { $align = ""; }
			if(isset($row['formatter'])){ $formatter = $row['formatter']; } else { $formatter = ""; }
			if(isset($row['editor'])){ $editor = $row['editor']; } else { $editor = ""; }
			$subname = $row['subname'];
			$vals = preg_split('/:/',$row['subname']);
			if(is_array($vals) && count($vals)==2)
			{
				$subname = $vals[1];
			}			
			$TABLEHEAD .= "\t".sprintf('<th field="subform_%s_%s" width="%s" align="%s" formatter="%s" editor="%s"><b>%s</b></th>',$key,$subname,$width,$align,$formatter,$editor,$row['sublabel'])."\n";
		}
		
		$TABLEHEAD .= "</tr>"."\n"."</thead>"."\n\n";
		
		$style = 'style="width:800px; height:250px;"'; 
		$baseurl = url::base(TRUE,'http');
		$ttype ="";
		if($subtable_type)
		{
			$ttype =sprintf('&tabletype=%s',$subtable_type);
		}
		$url = sprintf('%sajaxtodb?option=jsubrecs&subcontroller=%s&parentfield=%s&idfield=%s&idval=%s&curno=%s%s',$baseurl,$subcontroller,$key,$idfield,$idval,$current_no,$ttype);

$TABLETAG = "\n\n".sprintf('<div id="sf" class="sf"><table %s id="subform_table_%s" resizable="true" title="%s" singleSelect="true" idField="subform_%s_id" url="%s">',$style,$key,$subheader,$key,$url)."\n\n";
$TABLE = $TABLETAG."\n".$TABLEHEAD."</table></div>"."\n";
		$TABLE .= sprintf('<div id="subform_summary_%s"></div>',$key); 
		return $TABLE;
	}

	public function createSubForm($key,$current_no,$subtable_type=false)
	{
		$TABLE = ""; $TABLEHEAD = ""; $TABLEROWS = "";
		$subcontroller = $this->subform[$key]['subformcontroller'];
		$subheader	= $this->label[$key];
		$idfield = $this->param['indexfield'];
		$idval   = $this->form[$idfield];
		$subopt  = $this->param['primarymodel']->getSubFormOptions($subcontroller);
		$results = $this->param['primarymodel']->getSubFormViewRecords($subcontroller,$idfield,$idval,$current_no,$subtable_type,$labels);
		
		$TABLEHEAD .= "<thead>"."\n"."<tr valign='top'>"."\n";
		foreach($subopt as $subkey => $row)
		{
			if(isset($row['width'])){ $width = $row['width']; } else { $width = ""; }
			if(isset($row['align'])){ $align = $row['align']; } else { $align = ""; }
			if(isset($row['formatter'])){ $formatter = $row['formatter']; } else { $formatter = ""; }
			if(isset($row['editor'])){ $editor = $row['editor']; } else { $editor = ""; }
			$subname = $row['subname'];
			$vals = preg_split('/:/',$row['subname']);
			if(is_array($vals) && count($vals)==2)
			{
				$subname = $vals[1];
			}			
			$TABLEHEAD .= "\t".sprintf('<th field="subform_%s_%s" width="%s" align="%s" formatter="%s" editor="%s"><b>%s</b></th>',$key,$subname,$width,$align,$formatter,$editor,$row['sublabel'])."\n";
		}
		$TABLEHEAD .= "</tr>"."\n"."</thead>"."\n\n";
		
		$TABLEROWS = "\n"."<tbody>"."\n";
		foreach($results as $index => $row)
		{
			$TABLEROWS .= "<tr valign='top'>";
			$obj = (array) $row;
			foreach($obj as $subkey => $val)
			{
				$TABLEROWS .= sprintf('<td field="subform_%s_%s">%s</td>',$key,$subkey,$val);
			}
			$TABLEROWS .= "</tr>";
		}
		$TABLEROWS .= "\n"."</tbody>"."\n";
		$style = 'style="width:800px; height:250px;"'; 
$TABLETAG = "\n\n".sprintf('<div id="sf" class="sf"><table %s id="subform_table_%s" resizable="true" title="%s" singleSelect="true" idField="subform_%s_id">',$style,$key,$subheader,$key)."\n\n";
		$TABLE = $TABLETAG."\n".$TABLEHEAD.$TABLEROWS."</table></div>"."\n";
		$TABLE .= sprintf('<div id="subform_summary_%s"></div>',$key); 
		return $TABLE;
	}

	public function createSubFormFromXML($key,$xml)
	{
		$TABLE = ""; $TABLEHEAD = ""; $TABLEROWS = "";
		$subcontroller = $this->subform[$key]['subformcontroller'];
		$subheader	= $this->label[$key];
		$idfield = $this->param['indexfield'];
		$idval   = $this->form[$idfield];
		$subopt  = $this->param['primarymodel']->getSubFormOptions($subcontroller);
		
		$rows = new SimpleXMLElement($xml);
		$TABLEHEAD .= "<thead>"."\n"."<tr valign='top'>"."\n";
		foreach($subopt as $subkey => $row)
		{
			if(isset($row['width'])){ $width = $row['width']; } else { $width = ""; }
			if(isset($row['align'])){ $align = $row['align']; } else { $align = ""; }
			if(isset($row['formatter'])){ $formatter = $row['formatter']; } else { $formatter = ""; }
			if(isset($row['editor'])){ $editor = $row['editor']; } else { $editor = ""; }
			$subname = $row['subname'];
			$vals = preg_split('/:/',$row['subname']);
			if(is_array($vals) && count($vals)==2)
			{
				$subname = $vals[1];
			}			
			$TABLEHEAD .= "\t".sprintf('<th field="subform_%s_%s" width="%s" align="%s" formatter="%s" editor="%s"><b>%s</b></th>',$key,$subname,$width,$align,$formatter,$editor,$row['sublabel'])."\n";
		}
		$TABLEHEAD .= "</tr>"."\n"."</thead>"."\n\n";
				
		$TABLEROWS = "\n"."<tbody>"."\n";
		foreach ($rows->row as $row)
		{
			$TABLEROWS .= "<tr valign='top'>";
			foreach($subopt as $subkey => $field)
			{
			//foreach ($row->children() as $field)
			//{
				//$subkey = sprintf('%s',$field->getName() );
				//$val	= sprintf('%s',$row->$subkey);
				$subname = $field['subname'];
				$vals = preg_split('/:/',$field['subname']);
				if(is_array($vals) && count($vals)==2)
				{
					$subname = $vals[1];
				}	
				$val = sprintf('%s',$row->$subname);
				if($val == "undefined" || $val == "null" || $val == "Array") { $val = ""; } 
				$TABLEROWS .= sprintf('<td field="subform_%s_%s">%s</td>',$key,$subname,$val);
			}
			$TABLEROWS .= "</tr>";
		}
		$TABLEROWS .= "\n"."</tbody>"."\n";
		$style = 'style="width:800px; height:250px;"'; 
$TABLETAG = "\n\n".sprintf('<div id="sf" class="sf"><table %s id="subform_table_%s" resizable="true" title="%s" singleSelect="true" idField="subform_%s_id">',$style,$key,$subheader,$key)."\n\n";
		$TABLE = $TABLETAG."\n".$TABLEHEAD.$TABLEROWS."</table></div>"."\n";
		$TABLE .= sprintf('<div id="subform_summary_%s"></div>',$key); 
		return $TABLE;
	}
	
	public function  viewXMLTable($key,$xml,$color)
	{
		$HTML = "<table id='subformview' width='90%'>"."\n";
		$TABLEHEADER = ""; $TABLEROWS ="";
		$formfields = new SimpleXMLElement($xml);
		
		foreach($formfields->header->column as $val)
		{
			$val = sprintf('%s',$val);
			$TABLEHEADER .= sprintf("<th>%s</th>",$val);
		}
		$TABLEHEADER = "<tr valign='top'>".$TABLEHEADER."</tr>"."\n";

		foreach($formfields->rows->row as $row)
		{
			$TABLEROWS .= "<tr>";
			foreach ($row->children() as $field)
			{
				$subkey = sprintf('%s',$field->getName() );
				$val	= sprintf('%s',$row->$subkey);
				$TABLEROWS .= sprintf("<td valign='top' style='color:%s;'>%s</td>",$color,$val);
			}
			$TABLEROWS .= "</tr>";
		}

		$HTML .= $TABLEHEADER.$TABLEROWS."\n"."</table>"."\n";
		return $HTML;
	}

	public function  editXMLTable($key,$xml)
	{
		$TABLEHEADER = ""; $TABLEROWS ="";
		$subtable_id = "subform_table_".$key;
		$baseurl = url::base(TRUE,'http');
		$controller = $this->param['controller'];
		$field = $key;
		$idfield = $this->param['indexfield'];
		$idval = $this->form[$idfield];
		$prefix = sprintf('subform_%s_',$key);
		$tabletype = "inau";
$url = sprintf('%sajaxtodb?option=jxmldatabyid&controller=%s&field=%s&idfield=%s&idval=%s&prefix=%s&tabletype=%s',$baseurl,$controller,$field,$idfield,$idval,$prefix,$tabletype);
$JSURL = sprintf('<script type="text/javascript">%s_dataurl="%s"</script>',$subtable_id,$url);
$HTML = "\n".'<div id="sf" class="sf">'.sprintf('<table id="%s" class="easyui-datagrid" resizable="true" singleSelect="true"  style="width:800px; height:auto;">',$subtable_id)."\n";
	
		$i=0;
		$formfields = new SimpleXMLElement($xml);
		$row = $formfields->rows->row;
		foreach ($row->children() as $field)
		{
			$colname[$i] = sprintf('%s',$field->getName() );
			$i++;
		}

		$i=0;
		$TABLEHEADER = "<thead>"."\n"."<tr valign='top'>"."\n"; 
		foreach($formfields->header->column as $val)
		{
			$val = sprintf('%s',$val);
			$TABLEHEADER .= sprintf("<th field='subform_%s_%s'><b>%s</b></th>",$key,$colname[$i],$val)."\n";
			$i++;
		}
		$TABLEHEADER .="</tr>"."\n"."</thead>"."\n";
		
		/*
		$TABLEROWS ="<tbody>"."\n";
		foreach($formfields->rows->row as $row)
		{
			$TABLEROWS .= "<tr valign='top'>"."\n";
			foreach ($row->children() as $field)
			{
				$subkey = sprintf('%s',$field->getName() );
				$val	= sprintf('%s',$row->$subkey);
				//$TABLEROWS .= sprintf("<td valign='top' style='color:%s;'>%s</td>",$color,$val)."\n";
				$TABLEROWS .= sprintf("<td>%s</td>",$val)."\n";
			}
			$TABLEROWS .= "</tr>"."\n"."</tbody>"."\n";;
		}
		*/
		$COLDEF = $this->xmlSubFormColDef($key,$xml);
		$HTML .= $TABLEHEADER.$TABLEROWS."</table></div>"."\n".$JSURL."\n".$COLDEF."\n";
		return $HTML;
	}

	public function viewSubForm($key,$current_no,$color,$subtable_type=false)
	{
		$subcontroller = $this->subform[$key]['subformcontroller'];
		$idfield = $this->param['indexfield'];
		$idval =  $this->form[$idfield];

		$results = $this->param['primarymodel']->getSubFormViewRecords($subcontroller,$idfield,$idval,$current_no,$subtable_type,$labels);
		$HTML  = $this->subFormHTML($results,$labels,$color);
		$HTML .= $this->subFormSummaryHTML($results,$labels,$color);
		return $HTML;
	}
	
	public function  subFormHTML($results,$labels,$color)
	{
		$HTML = "<table id='subformview' width='90%'>"."\n";
		$TABLEHEADER = ""; $TABLEROWS ="";
//print_r($results);
//print "[DATA]<hr>";
		foreach($labels as $key => $val)
		{
			$TABLEHEADER .= sprintf("<th>%s</th>",$val);
		}
		$TABLEHEADER = "<tr valign='top'>".$TABLEHEADER."</tr>"."\n";

		foreach($results as $index => $row)
		{
			$TABLEROWS .= "<tr>";
			$obj = (array) $row;
			foreach($obj as $key => $val)
			{
				$TABLEROWS .= sprintf("<td valign='top' style='color:%s;'>%s</td>",$color,$val);
			}
			$TABLEROWS .= "</tr>";
		}

		$HTML .= $TABLEHEADER.$TABLEROWS."\n"."</table>"."\n";
		return $HTML;
	}

	public function subFormExist(&$parent_idfield,&$idval,&$subtable_live,&$subtable_inau,&$subtable_hist,&$subtable_idxfld)
	{
		$subFormExist = false;
		if($result = $this->param['primarymodel']->getSubFormController($this->param['controller']))
		{	
			$subFormExist = true;
			$parent_idfield = $this->param['indexfield'];
			$idval = $_POST[$parent_idfield];
			foreach($result as $key => $val)
			{
				$paramdef = $this->param['primarymodel']->getControllerParams($val);
				$subtable_inau[$key]   = $paramdef['tb_inau'];
				$subtable_hist[$key]   = $paramdef['tb_hist'];
				$subtable_live[$key]   = $paramdef['tb_live'];
				$subtable_idxfld[$val] = $paramdef['indexfield'];
			}
		}
		return $subFormExist;
	}

	public function createSubFormRecords()
	{
		if($this->subFormExist($parent_idfield,$idval,$subtable_live,$subtable_inau,$subtable_hist,$subtable_idxfld))
		{
			$rowsExist = false;
			foreach($subtable_inau as $key => $subtable)
			{
				$xml = simplexml_load_string($_POST[$key]);
				$json = json_encode($xml);
				$arr = json_decode($json,TRUE);
	
				if(isset($arr['row'])) 
				{ 
					$tmp = $arr['row'];  
					if(!isset($tmp['id'])) { $arr = $arr['row'];} 
					$rowsExist = true;
				}
	
				$querystr = sprintf('delete from %s where %s = "%s"',$subtable,$parent_idfield,$idval);
				if($result = $this->param['primarymodel']->executeNonSelectQuery($querystr))
				{
					if($rowsExist)
					{
						foreach ($arr as $index => $row)
						{
							$row['inputter']		= $_POST['inputter'];
							$row['authorizer']		= $_POST['authorizer'];
							$row['input_date']		= $_POST['input_date'];
							$row['auth_date']		= $_POST['auth_date'];
							$row['record_status']	= $_POST['record_status'];
							$row['current_no']		= $_POST['current_no'];
					
							$list = $this->subFormFieldExclusionList();
							if(isset($list[$key]))
							{
								foreach($list[$key] as $idx => $fld)
								{
									if(isset($row[$fld])) { unset($row[$fld]); }
								}
							}

							if($row['id'] == "undefined")
							{
								//get id for record, then update fields
								$subformarr = $this->param['primarymodel']->createBlankRecord($subtable_live[$key],$subtable);
								$subform = (array) $subformarr;
								array_merge($row,$subform);
								$row['id']	= $subform['id'];
								if($this->param['primarymodel']->updateRecord($subtable,$row))
								{ } else {	return false; }
							}
							else
							{
								//delete exist record, re-insert with updated fields
								if($this->param['primarymodel']->insertRecord($subtable,$row))
								{ } else {	return false; }
							}
						}
					}
				}
			}
		}
	}
	
	function strtotitlecase($str)
	{
		$str = strtolower($str);
		return preg_replace('/\b(\w)/e', 'strtoupper("$1")', $str);
	} 

	/*abstracts*/
	public function authorize_pre_insert_new_record(){}
	public function authorize_post_insert_new_record(){}
	public function authorize_pre_update_existing_record(){}		
	public function authorize_post_update_existing_record(){}		

	public function input_pre_validation(){}
	public function input_pre_update_existing_record(){}		
	public function input_post_update_existing_record(){}
	
	public function delete_pre_update_existing_record(){}		
	public function delete_post_update_existing_record(){}
	
	public function view_pre_open_existing_record(){}		
	public function view_post_open_existing_record(){}

	public function subFormSummaryHTML($results=null,$labels=null) {}
	public function subFormFieldExclusionList() { return false;}
	public function xmlSubFormColDef() {}

}
?>


		