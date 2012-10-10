<?php defined('SYSPATH') or die('No direct script access.');

class Sitequiry_Controller extends Template_Controller
{
	public $template = 'site.template.view';
    public $enqparam = array();
	public $model;

	public function __construct($controller)
    {
       	if(!Auth::instance()->logged_in())
		{
			Site_Controller::redirectToLogin();	
		}
		parent::__construct();
		$this->model = new Enqdb_Model();
		$this->sitemodel = new Site_Model();
		$this->controller = $controller;
		$this->viewable =  false;
		$this->printable = false;
		$this->template->head = '';
		$this->template->userbttns = '';
		$this->refresh_url = '';
		$this->refresh_icon = '';
		$baseurl = url::base(false,'http');
		$this->refresh_icon = $baseurl."media/img/site/refresh020.png";

		//$this->template->menutitle = $this->param['enquiry_header']; 
		$this->template->menutitle = '';
		$this->template->content = '';
		
		$sc = new Sitecontrol_Controller($this->controller);
		$perm = $sc->getAvailableInputPermissions();
		if($perm['vw']) {$this->viewable = true;}
		if($perm['pr']) {$this->printable = true;}

		//add stylesheets and global scripts
		$this->htmlhead = new Sitehtml_Controller(html::stylesheet(array('media/css/site',$this->easyui_css),array('screen','screen')));
		$this->stylesheet = $this->htmlhead->getHtml();
		$this->htmlhead->add(html::stylesheet(array('media/css/tablesorterblue'),array('screen')));
		$this->htmlhead->add(html::script(array($this->jquery_js,$this->easyui_js,'media/js/jquery.tablesorter')));
		$this->htmlhead->add(html::script(array('media/js/siteutils','media/js/enquiry')));
		//$this->htmlhead->add(html::script(array('media/js/jquery-1.4.4.min','media/js/jquery-ui-1.8.9.custom.min')));
		
		//get enquiry param from database 
		$this->enqparam = $this->getEnquiryControllerParams($controller);
		$this->enqparam['fieldnames'] = array(); $this->enqparam['labels']  = array();  $this->enqparam['filterfields'] = array(); 
		$this->getEnquiryFormFields($controller);
		$this->enqparam['filterfields'] = $this->siftFilterFields();
	}
	
	function processRequest()
	{
		$this->pagerheader();
		if($this->viewable)
		{	
			$this->filter_form();
		}
	}

	public function spage()
	{
		$this->pagerheader();
		if($this->viewable)
		{	
			$op = $_REQUEST['op'];
			$controller = $_REQUEST['controller'];
			$idfield = $_REQUEST['fields'];
			$value	 = $_REQUEST['lkvals'];
			$baseurl = url::base(TRUE,'http');
			$url   = sprintf('index.php/%s/page/1?op=%s&controller=%s&fields=%s&lkvals=%s',$controller,$op,$controller,$idfield,$value);
			$r_url = sprintf('index.php/%s/page/#NO#?op=%s&controller=%s&fields=%s&lkvals=%s',$controller,$op,$controller,$idfield,$value);
			$this->refresh_url = $baseurl."/".$r_url;
			$pagebody = new Sitehtml_Controller();
			$pagebody->add('<div id="enq_display">');
			$pagebody->add('<iframe src="'.$url.'" frameborder=0 width="98%" height=600px scrolling="auto"></iframe>');

			$pagebody->add('</div>');
			$this->content->pageody = $pagebody->getHtml();
			$this->setPageContent($this->htmlhead->getHtml(),$this->content);
		}
	}

	public function pagerheader()
	{
		$this->content	= new View('enquiry/default_enquiry_shell');
		$this->content->pageheader = 'Enquiry - '.$this->enqparam['enqheader'];
		$this->content->pagebody = "";
		$this->setPageContent($this->htmlhead->getHtml(),$this->content);
	}
	
	public function filter_form()
	{
		$this->htmlhead->add($this->insertHeadScript());
		$labels = ""; $fields = "";
		$pagebody = new Sitehtml_Controller();
		
		if($this->enqparam['showfilter'] == 1)
		{
			$field = $this->enqparam['fieldnames']; $label = $this->enqparam['labels'];
			$html  = "<form><table>\n";
			$count = 1;
			foreach($this->enqparam['filterfields'] as $key => $value)
			{
				$labels .= sprintf('<td>%s</td>',$label[$key]);
				$fields .= sprintf('<td><input type="text" id="%s" size="10"></td>',$field[$key]);
				if(($count % 7) == 0)
				{
					$html .= "<tr>".$labels."</tr>\n<tr>".$fields."</tr>";
					$labels = ""; $fields = "";
				}
				$count++;
			}
			$html .= "<tr>".$labels."</tr>\n<tr>".$fields."</tr></table>\n";
			$html .= sprintf('<input type="hidden" id="controller" value="%s">',$this->controller);
			$pagebody->add($html);
			$pagebody->add('</form>');
		}
		$pagebody->add('<div id="enq_display"></div>');
		$this->content->pagebody = $pagebody->getHtml();
		$this->setPageContent($this->htmlhead->getHtml(),$this->content);
	}

	public function insertHeadScript()
	{
		$changefuncs = "\n"; $lkvals = ""; 
		foreach($this->enqparam['filterfields'] as $key => $value)
		{
			$changefuncs .= sprintf("\t\t\t$('#%s').keyup(function() {openIFrame();});",$value)."\n";
			$lkvals .=  sprintf("$('#%s').val()+','+",$value);
		}
		$lkvals = substr_replace($lkvals, '', -5); $lkvals .=";";
		$filterfields = join(',',$this->enqparam['filterfields']);
$HTML=<<<_HTML_
		<script type="text/javascript">
		
		$(document).ready(function()
		{
			$changefuncs
			openIFrame();
		});
		
		function openIFrame()
		{
			var ctrlr = $('#controller').val();
			var view = $('#customview').val();
			var fields = "$filterfields";
			var lkvals = $lkvals 
			var url =  ctrlr + "/page/1?op=like&controller=" + ctrlr + "&fields=" + fields + "&lkvals=" + lkvals;
			//alert(url);
			var iframe = '<iframe src="'+ url +'" frameborder=0 width="98%" height=600px scrolling="auto"></iframe>';
			$('#enq_display').html(iframe);
		}
		</script>
_HTML_;
		return $HTML;
	}

	public function page($pagenum)
    {
		if($this->viewable)
		{	
			$request = $_REQUEST;
			$config['refresh_url'] = str_replace("#NO#",$pagenum,$this->refresh_url);
			$config['refresh_icon'] = $this->refresh_icon;
			/*from enquirydefs*/
			$table = $this->enqparam['tablename'];
			$idfield = $this->enqparam['idfield'];
			$orderarr = array($idfield => 'ASC');
			$view = $this->enqparam['view']; 
			$this->template->content = new View($view);
		
			if($request['lkvals'] == ",")
			{
				$querystr = sprintf('select %s from %s',$idfield,$table);
				$paging = new Pagination(array
				(
					'total_items' => $this->model->count_records($querystr),
					'items_per_page' => 1
				));
				$querystr = sprintf('select %s from %s limit %s offset %s',join(',',$this->enqparam['fieldnames']),$table,$paging->items_per_page,$paging->sql_offset);
				$this->template->content->enquiryrecords =  $this->model->browse($querystr);
			}
			else
			{
				$fields = $request['fields'];
				$lkvals = $request['lkvals'];
				$op = $request['op'];
				$filter = "";
				$lkarr = array_combine(preg_split('/,/',$fields),preg_split('/,/',$lkvals));
				foreach($lkarr as $key => $value)
				{
					if($op == 'eq'){$filter .= sprintf('%s = "%s%s" AND ',$key,$value,"%");}
					else if($op == 'like'){$filter .= sprintf('%s LIKE "%s%s" AND ',$key,$value,"%");}
				}
				$filter = substr_replace($filter, '', -5);
						
				$querystr = sprintf('select %s from %s where %s',join(',',$this->enqparam['fieldnames']),$table,$filter);
				$paging = new Pagination(array
				(
					'total_items' => $this->model->count_records($querystr),
					'items_per_page' => 1
				));
				$querystr = sprintf('select %s from %s where %s limit %s offset %s',join(',',$this->enqparam['fieldnames']),$table,$filter,$paging->items_per_page,$paging->sql_offset);
				$this->template->content->enquiryrecords =  $this->model->browse($querystr);
			}
   
			// Render the page links
			$this->template->head = $this->stylesheet;
			$config['enqheader']	= $this->enqparam['enqheader'];
			$config['controller']	= $this->controller;
			$config['total_items']	= $paging->total_items;
			$config['idname']		= Auth::instance()->get_user()->idname;
			$config['viewable']		= $this->printable;
			$config['printable']	= $this->printable;
			$config['printuser']	= $this->enqparam['printuser'];
			$config['printdatetime']= $this->enqparam['printdatetime'];
			$config['type']			= 'enquiry';
			$this->template->content->config = $config;
			$this->template->content->labels = $this->enqparam['labels'];
			$this->template->content->pagination = $paging->render();
		}
	}

	public function setPageContent($_head='',$_body='')
	{
		$this->template->head = $_head;
		$this->template->content = $_body;
	}

	public function getEnquiryControllerParams($_controller)
	{
		$arrobj = $this->model->getEnquiryParams($_controller);
		$arr = (array) $arrobj[$_controller];
		return $arr;
	}

	public function getEnquiryFormFields($controller)
	{
		$this->model->getEnqFormFields($controller,$this->enqparam['fieldnames'],$this->enqparam['labels'],$this->enqparam['filterfields']);
	}
	
	public function siftFilterFields()
	{
		foreach ($this->enqparam['filterfields'] as $key => $value)
		{		
			if (preg_match('/yes/i', $value) ||  $value==1) 
			{
				$arr[$key] = $key;
			}
		}
		return $arr;
	}

	public function enquiry_custom()
	{
		$sc = new Sitecontrol_Controller();
		$pagehead = new Sitehtml_Controller($this->htmlhead->getHtml());
		$pagebody = new Sitehtml_Controller($sc->showTabs($this->controller,'custom'));
		$this->setPageContent($pagehead->getHtml(),$pagebody->getHtml());
	}
}
?>