<?php defined('SYSPATH') or die('No direct script access.');

class Siterandstr_Controller extends Controller
{
	private $randstr = '';
	
	public function __construct($length=10)
	{
		//parent::__construct();
		$this->randstr_gen($length);
	}

	public function getRandomString()
	{
		return $this->randstr;
	}

	public function getNewRandomString($length=10)
	{
		$this->randstr_gen($length);
		return $this->randstr;
	}
	
	function randstr_gen($length)
	{
		$random= "";
		srand((double)microtime()*1000000);
		$char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char_list .= "abcdefghijklmnopqrstuvwxyz";
		$char_list .= "1234567890";
		// Add the special characters to $char_list if needed

		 for($i = 0; $i < $length; $i++)  
		{    
			$random .= substr($char_list,(rand()%(strlen($char_list))), 1);  
		}  
		$this->randstr = $random;
	}
}
?>
