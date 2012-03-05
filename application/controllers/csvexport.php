<?php defined('SYSPATH') or die('No direct script access.');

class Csvexport_Controller extends Controller
{
	public function __construct()
    {
       	if(!Auth::instance()->logged_in())
		{
			Site_Controller::redirectToLogin();	
		}
		$this->db = new Site_Model();
	}
	
	function index($csv_id)
	{
		$this->exportToXL($csv_id);
	}

	function exportToXL($csv_id)
	{
		$csv_id = trim($csv_id);
		$querystr = sprintf('select csv from csvs_is where csv_id = "%s"',$csv_id);
		$arr = $this->db->executeSelectQuery($querystr);
		$CSV = $arr[0]->csv;
		/*
		//many ways to print file contents, choose one
		1) file_get_contents()
		2) {
			$contents = file($file);
			$string = implode($contents);
			echo $string; 
		}
		*/
		$filename = $csv_id.".csv";
		Header ( "Content-Type: application/octet-stream"); 
		Header ( "Content-Type: application/text"); 
		Header( "Content-Disposition: attachment; filename=$filename");
		//print $CSV;
		include($CSV);
	}
}
?>
