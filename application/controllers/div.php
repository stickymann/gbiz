<?php defined('SYSPATH') or die('No direct script access.');

class Div_Controller extends Controller
{
	public function index()
	{
		//$this->content = new View('enquiry/div');
		$this->auto_render = TRUE;
$HTML=<<<_HTML_
    <html>
	<head>
		<script type="text/javascript">
		
		function openIFrame(opt)
		{
			var url =  "vehicleaccount_enq/page/" + opt;
			document.getElementById("display").innerHTML = '<iframe src="'+ url +'" frameborder=0 width="100%"> <p>Your browser does not support iframes.</p></iframe>';
		}
		</script>
	</head>
	<body>
		<a href = "javascript:void(0)" onclick=openIFrame("1")>Page 1</a><br>
		<a href = "javascript:void(0)" onclick=openIFrame("2")>Page 2</a><br>
		<div id="display"></div>
	</body>
    </html>    
_HTML_;
		//$this->content->html = $HTML;
		//$this->content->render(TRUE);
	
		print $HTML;
		//$this->render(TRUE);
	}

	public function page($text)
	{
		if($text ==	"1")
			echo "Page 1";
		else if($text == "2")
			echo "Page 2";
	}




}
?>