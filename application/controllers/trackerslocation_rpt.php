<?php defined('SYSPATH') or die('No direct script access.');

class Trackerslocation_rpt_Controller extends Sitereport_Controller
{

	public function __construct()
    {
		parent::__construct('trackerslocation_rpt');
	}	
		
	public function index()
    {
      $this->processRequest();
    }

	public function report_run()
	{
		$stockbatch_id = $_POST['stockbatch_id'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$products = $_POST['products'];
		$where = ""; $filter = "";
		
		if($stockbatch_id != "" ) { $filter .= sprintf('stockbatch_id = "%s" AND ',$stockbatch_id); $where = "where"; }
		if($start_date != "" ) { $filter .= sprintf('$start_date >= "%s" AND ',$start_date); $where = "where"; }
		if($end_date != "" ) { $filter .= sprintf('$start_date <= "%s" AND ',$end_date); $where = "where"; }
		if($products != "" )
		{
			if( preg_match('/;/',$products) )
			{
			
			}
			else
			{
				$filter .= sprintf('product_id = "%s" AND ',$products); 
				$where = "where"; 
			}
		}
		$filter = substr_replace($filter, '', -5);

		$table = 'vw_trackers_info';
		$querystr = sprintf('select item_status,count(item_status) AS quantity from %s %s %s GROUP BY item_status',$table,$where,$filter);
$this->content->pagebody .= $querystr;		
		$result = $this->sitemodel->executeSelectQuery($querystr);
		
		$RESULT = '<div id="e" style="padding:5px 5px 5px 5px;">';
		$rundate = date("Y-m-d H:i:s");

		if($result) 
		{
			$RESULT .= sprintf('<div>By Item Status</div>');
			$RESULT .= '<table id="rpttbl">'."\n";
			$firstpass = true;
			foreach($result as $row => $linerec)
			{	
				$linerec = (array)$linerec;
				$header = ''; $data = '';
				foreach ($linerec as $key => $value)
				{
					if($firstpass)
					{
						$headtxt = Site_Controller::strtotitlecase(str_replace("_"," ",$key));
						$header .= '<th>'.$headtxt.'</th>'; 
					}
					$data .= '<td width="30%">'.html::specialchars($value).'</td>'; 
				}
			
				if($firstpass)
				{
					$header = "\n".'<thead>'."\n".'<tr>'.$header.'</tr>'."\n".'</thead>'."\n".'<tbody>'."\n";
					$RESULT .=$header;
				}
			
				$data = '<tr>'.$data.'</tr>'."\n"; 
				$RESULT .= $data;
				$firstpass = false;
			}
			$RESULT .='</tbody>'."\n".'</table>'."\n";
		}
		else
		{
			$RESULT .= 'No Result.<br>';		
		}
		
		$querystr = sprintf('select product_id,item_status,count(item_status) AS quantity from %s %s %s GROUP BY product_id,item_status',$table,$where,$filter);
		$result = $this->sitemodel->executeSelectQuery($querystr);
		
		if($result) 
		{
			$RESULT .= sprintf('<br><div>By Product</div>');
			$RESULT .= '<table id="rpttbl">'."\n";
			$firstpass = true;
			foreach($result as $row => $linerec)
			{	
				$linerec = (array)$linerec;
				$header = ''; $data = '';
				foreach ($linerec as $key => $value)
				{
					if($firstpass)
					{
						$headtxt = Site_Controller::strtotitlecase(str_replace("_"," ",$key));
						$header .= '<th>'.$headtxt.'</th>'; 
					}
					$data .= '<td width="30%">'.html::specialchars($value).'</td>'; 
				}
			
				if($firstpass)
				{
					$header = "\n".'<thead>'."\n".'<tr>'.$header.'</tr>'."\n".'</thead>'."\n".'<tbody>'."\n";
					$RESULT .=$header;
				}
			
				$data = '<tr>'.$data.'</tr>'."\n"; 
				$RESULT .= $data;
				$firstpass = false;
			}
			$RESULT .='</tbody>'."\n".'</table>'."\n";
		}
		else
		{
			$RESULT .= 'No Result.<br>';		
		}
		$this->content->pagebody .= $RESULT;
		$this->content->pagebody .= sprintf('<br><div>Run Date : %s<div>',$rundate);
		$this->content->pagebody .= sprintf('<div>Run By : %s</div>',Auth::instance()->get_user()->idname);
		$this->content->pagebody .= "</div>";
	}
}
?>