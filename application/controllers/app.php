<?php defined('SYSPATH') or die('No direct script access.');

class App_Controller extends Template_Controller
{
	public $template	 = 'app.iframe.view';

    public function index()
    {
		$title = "GPS Rescue Ltd.";
		$this->template->head = $this->getHead($title);
		$this->template->content = $this->getContent($title);
    }
	
	function getHead($title="")
	{	
		$HTML_HEAD  = sprintf('<title>%s</title>',$title);
		$HTML_HEAD .= sprintf('<link rel="stylesheet" type="text/css" href="%smedia/css/site.css">',url::base());
		$HTML_HEAD .= sprintf('<link rel="stylesheet" type="text/css" href="%smedia/css/easyui/gray/easyui.css">',url::base());
		$HTML_HEAD .= sprintf('<link rel="stylesheet" type="text/css" href="%smedia/css/easyui/icon.css">',url::base());
		$HTML_HEAD .= sprintf('<script type="text/javascript" src="%smedia/js/jquery-1.7.min.js"></script>',url::base());
		$HTML_HEAD .= sprintf('<script type="text/javascript" src="%smedia/js/jquery.easyui.min.js"></script>',url::base());
		return $HTML_HEAD;	
	}
	
	function getContent($title=" ")
	{
		$HTML_CONTENT = <<<_text_
	<body class="easyui-layout">
		<div region="west" split="true" title="$title" style="width:250px;overflow:hidden;">
			<div class="easyui-layout" fit="true">
				<div region="north" border="false" split="false" title="" style="height:56px;overflow:hidden;">
					<iframe src="logo" style="width:100%;height:100%" frameborder="0" scrolling="no"></iframe>
				</div>
				<div region="center" border="false" split="false" title=" " style="overflow:hidden;">
					<iframe src="menuuser" style="width:100%;height:100%" frameborder="0" scrolling="auto"></iframe>
				</div>
				<div region="south" border="true" split="true" title=" " style="height:200px;overflow:hidden;">
					<iframe src="cmdbox" style="width:100%;height:100%" frameborder="0" scrolling="auto"></iframe>
				</div>
			</div>
		</div>
		<div region="center" title="" style="overflow:hidden;">
			<div class="easyui-layout" fit="true">
				<div region="north" split="true" title=" " style="height:230px;overflow:hidden;">
					<iframe src="message/inbox" name="enquiry" style="width:100%;height:100%" frameborder="0" scrolling="auto"></iframe>
				</div>
				<div region="center" split="true" title="" style="overflow:hidden;">
					<iframe src="message" name="input" style="width:100%;height:100%;color:green" frameborder="0" scrolling="auto"></iframe>
				</div>
			</div>
		</div>	
	</body>
_text_;
		return $HTML_CONTENT;
	}
		
}

