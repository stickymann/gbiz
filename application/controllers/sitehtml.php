<?php defined('SYSPATH') or die('No direct script access.');

class Sitehtml_Controller extends Controller
{
	private $html = '';
	
	public function __construct($string='')
	{
		//parent::__construct();
		$this->html = $string."\n"; 
	}

	public function add($string)
	{
		$this->html .= $string."\n";
	}

	public function getHtml()
	{
		return $this->html;
	}

	public static function getHTMLFromUrl($url)
	{
		//requires curl extension to be turned on
		/* STEP 1. let’s create a cookie file */
		//$ckfile = tempnam ("/tmp", "CURLCOOKIE"); 
		
		/* STEP 2. visit the homepage to set the cookie properly */
		//$ch = curl_init ("app");
		//curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
		//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		//$output = curl_exec ($ch);
		
		/* STEP 3. visit required url*/
		ob_start();
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 0);
		//curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
		//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$ok = curl_exec($ch);
		curl_close($ch);
		$text = ob_get_contents();
		ob_end_clean();	
		return $text;
		//other options,
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		//curl_setopt($ch, CURLOPT_NOBODY, 1);
		//curl_setopt($ch, CURLOPT_URL,$url);
		//curl_setopt($ch, CURLOPT_POST, 0);
		//curl_setopt($ch, CURLOPT_USERPWD, $cred)
	}
}
?>
