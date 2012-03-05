<?php defined('SYSPATH') or die('No direct script access.');

class Sitecontrol_Controller extends Controller
{	
	public $param = array();
	public function __construct($controller="",$idname="")
    {
		$this->param['primarymodel'] = new Site_Model();
		$this->param['url_input']	 = $controller;
		$this->param['controls']	 = array();
		$this->param['idname'] = $idname;
		$this->param['globalauthmodeon'] = false;
		$this->param['controllerauthmodeon'] = false;
		$this->param['globalindexfldon'] = false;
	}
	
	public function setGlobalAuthModeOn($val)
	{
		$this->param['globalauthmodeon'] = $val;
	}
	
	public function setControllerAuthModeOn($val)
	{
		$this->param['controllerauthmodeon'] = $val;
	}

	public function setGlobalIndexFldOn($val)
	{
		$this->param['globalindexfldon'] = $val;
	}

	public function setInputControls()
	{
		
		$control = array('if'=>false,'vw'=>false,'pr'=>false,'nw'=>false,'cp'=>false,'iw'=>false,'in'=>false,'ao'=>false,'as'=>false,'rj'=>false,'de'=>false,'hd'=>false,'va'=>false,'df'=>false,'ls'=>false,'hs'=>false,'is'=>false,'ex'=>false);
		//$menu=$this->param['primarymodel']->getMenuControls('menudefs',$this->param['url_input']);
	
		$menu=$this->param['primarymodel']->getUserMenuControls('menudefs_users','url_input',$this->param['url_input'],Auth::instance()->get_user()->idname);
		$lookup = preg_split('/,/',$menu->controls_input);
		
		//print_r($lookup);
		//print '<hr>';
		foreach($lookup as $key)
		{
			$control[$key]=true;
		}

		$lookup = preg_split('/,/',$menu->controls_enquiry);
		foreach($lookup as $key)
		{
			$control[$key]=true;
		}

		if(!$this->param['globalauthmodeon'] || !$this->param['controllerauthmodeon'])
		{
			$control['ao']=false;
			$control['as']=false;
		}

		if(!$this->param['globalindexfldon'])
			$control['if']=false;
		$this->param['controls'] = $control;
	}
		
	public function getInputControls()
	{	
		$post =$_POST;
		$controls = "";
		$func='?';
		
		$ctrl = $this->param['controls'];
		if(!$post)
		{
			$controls .= form::submit('submit','Submit','class="bttn"').'&nbsp</td><td>';
			//should i check for if key exist in controls array? with frontend errors should never occur 
			//if (array_key_exists('vw', $this->param['controls']->control['vw']))
			
			if($ctrl['vw']) 
				$controls .= form::radio('func','v',TRUE).form::label('func','view').'&nbsp';
			
			if($ctrl['nw']) 
				$controls .= form::radio('func','n').form::label('func','new').'&nbsp';
			
			if($ctrl['cp']) 
				$controls .= form::radio('func','c').form::label('func','copy').'&nbsp';
						
			if($ctrl['in']) 
				{$controls .= form::radio('func','i').form::label('func','edit').'&nbsp';}
			else if($ctrl['iw']) 
				{$controls .= form::radio('func','w').form::label('func','edit new').'&nbsp';}

			if($ctrl['ao'] || $ctrl['as']) 
			{
				$controls .= form::radio('func','a').form::label('func','authorize').'&nbsp';
				$controls .=form::hidden('auth','y');
			}
			else
			{
				$controls .=form::hidden('auth','');
			}
			
			if($ctrl['rj'])
			{
				if(!($ctrl['ao'] && $ctrl['as']))
				{
					$controls .= form::radio('func','a').form::label('func','reject').'&nbsp';
				}
				$controls .=form::hidden('rjct','y');
			}
			else
			{
				$controls .=form::hidden('rjct','');
			}

			if($ctrl['de']) 
				$controls .= form::radio('func','d').form::label('func','delete').'&nbsp';
			
			
			if($ctrl['is'] || $this->param['url_input'] == "message")
			{
				$result = $this->param['primarymodel']->getParams($this->param['url_input']);
				$table_inau = $result[$this->param['url_input']]->tb_inau;	
				$table_live = $result[$this->param['url_input']]->tb_live;
				$notify_str = ""; $notify_str_ur = ""; $notify_str_us = ""; $prnt=false;

				if($ctrl['is'] && !($this->param['url_input'] == "message")) 
				{
					$count = $this->param['primarymodel']->getRecordCount($table_inau);
					if($count > 0) {$notify_str = sprintf(' Unauthorized(%s) ',$count); $prnt=true; }
				}
			
				if($this->param['url_input'] == "message")
				{
					$a=false; $b=false; 
					$count_ur = $this->param['primarymodel']->getRecordCountUnreadMessages($table_live,$this->param['idname']);
					$count_us = $this->param['primarymodel']->getRecordCountUnsentMessages($table_inau,$this->param['idname']);
					if($count_ur > 0) {$notify_str_ur = sprintf(' Unread Messages(%s) ',$count_ur); $a=true;} 
					if($count_us > 0) {$notify_str_us = sprintf(' Unsent Messages(%s) ',$count_us); $b=true;}
					if($a || $b) {$prnt=true;}
				}
				
				if($prnt)
				{
					$notify_str = $notify_str.$notify_str_ur.$notify_str_us;
					$controls .= sprintf('</td><td class="notify" style="color:#fff; background-color:red; text-align:right;"><b>%s</b></td>',$notify_str);
				}
				else { $controls .= '</td><td></td>';}
			}
		}
		else if($post['func']=='n' || $post['func']=='i' || $post['func']=='c' || $post['func']=='w' || $post['func']=='l')
		{
			//setButtonClicked() function need to manage recordlocks when navigating away from page
			if($ctrl['hd'])
			{
				$controls .= form::submit('submit','Hold','class="bttn" onclick=window.siteutils.setButtonClicked("Hold");').'';
			}
			if($ctrl['va'])
			{
				$controls .= form::submit('submit','Validate','class="bttn" onclick=window.siteutils.setButtonClicked("Validate");').'';
			}
			$controls .= form::submit('submit','Commit','class="bttn" onclick=window.siteutils.setButtonClicked("Commit");').'';
			$controls .= form::submit('submit','Cancel','class="bttn" onclick=window.siteutils.setButtonClicked("Cancel");').'';
		}
		else if($post['func']=='a')
		{
			//$controls .= form::submit('submit','Hold','class="bttn" disabled').'';
			//$controls .= form::submit('submit','Validate','class="bttn" disabled').'';
			if($post['auth']=='y')
			{
				$controls .= form::submit('submit','Authorize','class="bttn" onclick=window.siteutils.setButtonClicked("Authorize");').'';
			}

			if($post['rjct']=='y')
			{
					$controls .= form::submit('submit','Reject','class="bttn" onclick=window.siteutils.setButtonClicked("Reject");').'';
			}
			$controls .= form::submit('submit','Cancel','class="bttn" onclick=window.siteutils.setButtonClicked("Cancel");').'';
		}
		else if($post['func']=='v')
		{
			$controls .= form::submit('submit','Cancel','class="bttn" onclick=window.siteutils.setButtonClicked("Cancel");').'';
			//$controls .= form::submit('submit','Hold','class="bttn" disabled').'';
			//$controls .= form::submit('submit','Validate','class="bttn" disabled').'';
			//$controls .= form::submit('submit','View','class="bttn" disabled').'';
		}
		else if($post['func']=='d')
		{
			//$controls .= form::submit('submit','Hold','class="bttn" disabled').'&nbsp';
			//$controls .= form::submit('submit','Validate','class="bttn" disabled').'&nbsp';
			$controls .= form::submit('submit','Delete','class="bttn" onclick=window.siteutils.setButtonClicked("Delete");').'&nbsp';
			$controls .= form::submit('submit','Cancel','class="bttn" onclick=window.siteutils.setButtonClicked("Cancel");').'';
		}
		return $controls;
	}

	public function getEnqFormControls()
	{
		//verify against security profile
		$this->setEnquiryControls();
		return $this->getEnquiryControls();
	}

	public function setEnquiryControls()
	{
		$control = array('df'=>false,'ls'=>false,'hs'=>false,'is'=>false,'ex'=>false);
		$menu = $this->param['primarymodel']->getUserMenuControls('menudefs_users','url_input',$this->param['url_input'],$this->param['idname']);		
		//$menu = $this->param['primarymodel']->getUserMenuControls('menudefs_users','url_input',$this->param['url_input'],Auth::instance()->get_user()->idname);		
//print_r($menu); print "<hr>";		
		$lookup = preg_split('/,/',$menu->controls_enquiry);
//print_r($lookup); print "<hr>";			
		foreach($lookup as $key)
		{
			$control[$key]=true;
		}
//print_r($control); print "<hr>";			
		$this->param['controls'] = $control;
	}
	
	public function getEnquiryControls()
	{	
		$controls = "";
		$ctrl = $this->param['controls'];
						
		if($ctrl['ls']) 
		{
			$controls .= form::radio('enqfunc','ls',TRUE).form::label('enqfunc','live').'&nbsp';
		}
		else if($ctrl['df']) 
		{
			$controls .= form::radio('enqfunc','df',TRUE).form::label('enqfunc','default').'&nbsp';
		}

		if($ctrl['is']) 
			$controls .= form::radio('enqfunc','is').form::label('enqfunc','inau').'&nbsp';
						
		if($ctrl['hs']) 
			$controls .= form::radio('enqfunc','hs').form::label('enqfunc','hist').'&nbsp';
				
		if($ctrl['ex']) 
			$controls .= form::checkbox('enqexport','0').form::label('enqexport','export').'&nbsp';
		
			$controls .= form::checkbox('fieldnames','0').form::label('fieldnames','fieldnames').'&nbsp';
			$controls .= form::input('limit','500','size=8 class="ff"').form::label('limit','limit').'&nbsp';
			$controls .= '<input type="hidden" id="js_exportid" name="js_exportid">';	
		return $controls;
	}

	public function getAvailableInputPermissions()
	{
		$this->setInputControls();
		return $this->param['controls'];
	}

	public function showTabs($controller,$enqtype='default')
	{
		(array) $result = $this->param['primarymodel']->getUserEnquiryTables(Auth::instance()->get_user()->idname);
		$result = (array) $result;
		$SELECT	= '<select id="controllersel" class="ff" onChange=enquiry.makeFilter()>'."\n";
		foreach ($result as $key => $row)
		{
			$row = (array) $row;
			if($row['url_input'] == $controller){$selected = "selected";} else {$selected = "";}
			$HTML = sprintf('<option value="%s,%s" %s>%s</option>',$row['url_input'],$row['module'],$selected,$row['label_input'])."\n";
			$SELECT .= $HTML;
		}
		$SELECT .= '</select>'."\n";
		$BTTN = '<input class="bttn" type="submit" name="ButtonGet" value="   Get   " onclick=enquiry.GetResults()>'."\n";
		$baseurl = url::base(TRUE,'http');
		$_idname = Auth::instance()->get_user()->idname;
		$url = sprintf('%sindex.php/ajaxtodb?option=enqctrl&controller=%s&user=%s',$baseurl,$controller,$_idname);
//print $url."<hr>";		
		$RADIO = Sitehtml_Controller::getHTMLFromUrl($url); 
		$url = sprintf('%sindex.php/ajaxtodb?option=filterform&controller=%s&user=%s&enqtype=%s&loadfixedvals=1&rochk=0',$baseurl,$controller,$_idname,$enqtype);
		$FILTERFORM = Sitehtml_Controller::getHTMLFromUrl($url);
		
		$HTML=<<<_HTML_
		<div id="pagebody">
			<div id="tabs" class="easyui-tabs">
				<div id="filter" title="filter" closable="false" style="padding:10px;">
					<div id="filtersel">$BTTN $SELECT <span id="radios">$RADIO</span></div>
					<div id="filterurl"></div>
					<div id="filterform">$FILTERFORM</div>
				</div>
				
				<div id="live" title="live" closable="false" style="padding:10px;">
					<div id="resultlive"></div>
				</div>
				
				<div id="inau" title="inau" closable="false" style="padding:10px;">
					<div id="resultinau"></div>
				</div>
				
				<div id="hist" title="hist" closable="false" style="padding:10px;">
					<div id="resulthist"></div>
				</div>
			
			</div> <!--tabs pagebody -->
			<input type="hidden" id="js_idname" name="js_idame" value="$_idname">
	</div> <!--end pagebody -->
_HTML_;
	return $HTML;
	}
}
?>