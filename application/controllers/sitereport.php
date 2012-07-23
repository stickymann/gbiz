<?php defined('SYSPATH') or die('No direct script access.');

class Sitereport_Controller extends Template_Controller
{
	public $template	= 'site.template.view'; //defaults to template but you can set your own view file
	public $auto_render = TRUE; //defaults to true, renders the template after the controller method is done
	public $param		= array();
	public $form		= array();
	public $formdata	= array();
	public $label		= array();  
	public $formopts	= array();  
	public $popout		= array();
	public $colon		= " :";
	
	public function __construct($controller)
    {
       	 if(!Auth::instance()->logged_in())
		{
			Site_Controller::redirectToLogin();	
		}
		
		parent::__construct();
		$this->db = Database::instance();
		$this->model = new Report_Model();
		$this->sitemodel = new Site_Model();
		$this->controller = $controller;
		$this->viewable =  false;
		$this->printable = false;
		$this->template->head = '';
		$this->template->content = '';
		$this->template->menutitle = '';
		$this->template->userbttns = '';
		
		$this->rptparam = $this->getReportControllerParams(trim($controller));
		$sc = new Sitecontrol_Controller($this->controller);
		$perm = $sc->getAvailableInputPermissions();
		if($perm['vw']) {$this->viewable = true;}
		if($perm['pr']) {$this->printable = true;}
	
		if(Auth::instance()->logged_in())
		{
			$this->template->username = Auth::instance()->get_user()->username;
		}
		else
			$this->template->username = 'expired';
			
		// By adding this we are making the database object available to all controllers that extend Report_Controller
        $user = ORM::factory('user',$this->template->username);
		$this->template->idname = $user->idname; 

		$htmlhead = new Sitehtml_Controller(html::stylesheet(array('media/css/site','media/css/tablesorterblue',$this->easyui_css,$this->easyui_icon,$this->datepick_css),array('screen','screen','screen','screen')));
		$htmlhead->add(html::script(array($this->jquery_js,$this->easyui_js,$this->datepick_js,'media/js/jquery.tablesorter','media/js/jquery.datevalidate')));
		$htmlhead->add(html::script(array('media/js/siteutils.js','media/js/enquiry.js'.$this->randomstring,'media/js/popoutselector.js'.$this->randomstring)));
		$this->rptparam['htmlhead'] = $htmlhead->getHtml();
	}

	function processRequest()
	{
		if($this->viewable)
		{	
			$this->pagerheader();
			if($this->rptparam['showfilter'])
			{
				/*setup form field,  fill arrays with default value*/
				$this->formdata = $this->getReportControllerFormDefs($this->controller);
				$this->setFormFieldsAndLabels();
				if($_POST)
				{
					$this->report_run();
				}
				else
				{
					$this->report_filter();
				}
			}
			else
			{
				$this->report_run();
			}
		}
		$this->setPageContent($this->rptparam['htmlhead'],$this->content);
	}
	
	public function pagerheader()
	{
		$this->content	= new View('report/default_report');
		$this->content->pageheader = 'Report - '.$this->rptparam['rptheader'];
		$this->content->pagebody = "";
	}

	public function setPageContent($_head='',$_body='')
	{
		$this->template->head = $_head;
		$this->template->content = $_body;
	}

	public function getReportControllerParams($controller)
	{
		$arrobj = $this->model->getReportParams($controller);
		$arr = (array) $arrobj[$controller];
		return $arr;
	}
	
	function getReportControllerFormDefs($controller)
	{
		$arrobj = $this->model->getReportFormDefs($controller);
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
			if($field->popout)
			{
				$this->popout[$key]['enable'] = sprintf('%s',$field->popout->enable);
				$this->popout[$key]['table'] = sprintf('%s',$field->popout->table);
				$this->popout[$key]['selectfields'] = sprintf('%s',$field->popout->selectfields);
				$this->popout[$key]['idfield'] = sprintf('%s',$field->popout->idfield);
			}
		}
	}

	public function report_filter()
	{
		if(!$this->form)
		{
			$str = '<div class="frmmsg">A Filter Form Error Occurred, Please Try Again.</div>';
			$pagebody = new Sitehtml_Controller($str);
		}
		else
		{
			$pagebody = new Sitehtml_Controller(form::open($this->rptparam['controller'],array('id'=>$this->rptparam['controller'],'name'=>$this->rptparam['controller'])));
			$pagebody->add("<div id='i'>\n");
			$pagebody->add("<table>\n");
			$pagebody->add("<tr valign='center'><td colspan=2><input type='submit' id='submit' name='submit' value='Create Report' class='bttn'/></td></tr>\n");
			foreach($this->form as $key => $value)
			{
				$POPOUT_HTML =""; $DATEICON_HTML=""; $table =""; $fields=""; $idstr=""; $po_type=""; $disabled="" ; $style="";
				if(!(isset($this->formopts[$key]['options']))){unset($this->form[$key]);unset($_POST[$key]); continue;}
				
				$options = $this->formopts[$key]['options'];
				$POPOUT_HTML = $this->createPopOut($key);
				if($this->formopts[$key]['inputtype']=="date")
				{
					$DATEICON_HTML = $this->createDatePopOut($key);
				}
				$pagebody->add('<tr valign="center"><td>'.form::label($key,$this->label[$key]).$this->colon."</td><td>".form::input($key,$this->form[$key],$options." class='input-r'").$DATEICON_HTML.$POPOUT_HTML."</td></tr>\n"); 
			}
			
			$pagebody->add("</table>");
			$pagebody->add("</div>");
			$pagebody->add(form::close());
			$pagebody->add($this->popOutSelectorWin());
			$this->content->pagebody = $pagebody->getHtml();
		}
	}

	public function createPopOut($key)
	{
		$POPOUT_HTML = "";
		if(isset($this->popout[$key]))
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
	
	/*abstracts*/
	public function report_run(){}
}
