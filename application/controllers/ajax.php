<?php defined('SYSPATH') or die('No direct script access.');

class Coreajax_Controller extends Controller
{
	public function __construct()
    {
		$this->db = new Site_Model;
	}

	public function index()
	{
		print 'Hello<br>';
		print Router::$query_string."<br>";
		print_r ($_REQUEST);
		//$this.show();
		//$this->render(TRUE);
	}
}