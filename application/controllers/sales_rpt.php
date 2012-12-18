<?php defined('SYSPATH') or die('No direct script access.');

class Sales_rpt_Controller extends Sitereport_Controller
{

	public function __construct()
    {
		parent::__construct('sales_rpt');
	}	
		
	public function index()
    {
      $this->processRequest();
    }

	public function report_run()
	{
		$branch_id = $_POST['branch_id'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$where = ""; $filter = ""; $HTML =""; $RESULT="";
		
		/*query filter*/
		if($branch_id != "" ) { $filter .= sprintf('branch_id >= "%s" AND ',$branch_id); $where=" AND";}
		if($start_date != "" ) { $filter .= sprintf('order_date >= "%s" AND ',$start_date); $where=" AND";}
		if($end_date != "" ) { $filter .= sprintf('order_date <= "%s" AND ',$end_date); $where=" AND";}
		$filter = substr_replace($filter, '', -5);
		
		/*summary totals*/
		$querystr=<<<_SQL_
SELECT 
SUM(order_total) AS total_sales,
SUM(payment_total) AS total_payments,
SUM(balance) AS balance FROM vw_orderbalances 
WHERE NOT ((order_status = "QUOTATION") OR (order_status = "QUOTATION_EXPIRED") OR (order_status = "ORDER.CANCELLED")) 
_SQL_;
		$querystr = sprintf('%s %s %s',$querystr,$where,$filter);
		$result = $this->sitemodel->executeSelectQuery($querystr);
		if($result) 
		{
			$totals = $result[0];
			$RESULT .= '<table>'."\n";
			$RESULT .= sprintf('<tr><td><span class="rpth4">Total Sales : </span></td><td align="right"><span class="rpth4">%s</span></td></tr>',"$ ".number_format($totals->total_sales, 2, '.', ','))."\n";
			$RESULT .= sprintf('<tr><td><span class="rpth4">Total Payments : </span></td><td align="right"><span class="rpth4">%s</span></td></tr>',"$ ".number_format($totals->total_payments, 2, '.', ','))."\n";
			$RESULT .= sprintf('<tr><td><span class="rpth4">Outstanding Balance : </span></td><td align="right"><span class="rpth4">%s</span></td></tr>',"$ ".number_format($totals->balance, 2, '.', ','))."\n";
			$RESULT .= '</table>'."\n";
		}
		else
		{
			$RESULT .= 'No Result.<br>';		
		}
		
		/*line details*/
		$querystr=<<<_SQL_
SELECT 
`orders`.`branch_id` as branch,
`orderdetails`.`product_id` as product_id,
`orderdetails`.`description` as description,
sum(`orderdetails`.`qty`) as quantity,
sum(func_OrderDetailOrderTotal(qty,unit_price,discount_amount,tax_percentage,taxable,discount_type)) AS sale_value 
FROM orderdetails JOIN orders
ON `orderdetails`.`order_id` = `orders`.`order_id`
WHERE NOT ((order_status = "QUOTATION") OR (order_status = "QUOTATION_EXPIRED") OR (order_status = "ORDER.CANCELLED")) 
_SQL_;
		$groupby = 'GROUP BY `orderdetails`.`description` ORDER BY product_id;';
		$querystr = sprintf('%s %s %s %s',$querystr,$where,$filter,$groupby);
		$result = $this->sitemodel->executeSelectQuery($querystr);
		if($branch_id == "") { $branch = "ALL"; } else { $branch = $branch_id; }

		if($result) 
		{
			$RESULT .= sprintf('<br><div></div>');
			$RESULT .= '<table id="rpttbl">'."\n";
			$firstpass = true;
			foreach($result as $row => $linerec)
			{	
				$linerec = (array)$linerec;
				$header = ''; $data = ''; $align = ''; $i = 0;
				foreach ($linerec as $key => $value)
				{
					if($firstpass)
					{
						$headtxt = Site_Controller::strtotitlecase(str_replace("_"," ",$key));
						if($branch == "ALL")
						{
							if($i==3){$align = 'align="center"'; } else if($i==4){$align = 'align="right"'; }
							$header .= sprintf('<th %s><b>%s</b></th>',$align,$headtxt);
						}
						else
						{
							if($i>0)
							{
								if($i==2){$align = 'align="center"'; } else if($i==3){$align = 'align="right"'; }
								$header .= sprintf('<th %s><b>%s</b></th>',$align,$headtxt);
							}
						}
						$i++;
					}
				}
			
				if($firstpass)
				{
					$header = "\n".'<thead>'."\n".'<tr>'.$header.'</tr>'."\n".'</thead>'."\n".'<tbody>'."\n";
					$RESULT .=$header;
				}
				if($branch == "ALL")
				{
					$data .= sprintf('<td width="10%s">%s</td><td width="20%s">%s</td><td width="40%s">%s</td><td align="center">%s</td><td align="right">%s</td>',"%",$linerec['branch'],"%",$linerec['product_id'],"%",$linerec['description'],$linerec['quantity'],"$ ".number_format($linerec['sale_value'], 2, '.', ',')); 
				}
				else
				{
					$data .= sprintf('<td width="20%s">%s</td><td width="50%s">%s</td><td align="center">%s</td><td align="right">%s</td>',"%",$linerec['product_id'],"%",$linerec['description'],$linerec['quantity'],"$ ".number_format($linerec['sale_value'], 2, '.', ',')); 
				}
				
				$data = '<tr valign="top">'.$data.'</tr>'."\n"; 
				$RESULT .= $data;
				$firstpass = false;
			}
			$RESULT .='</tbody>'."\n".'</table>'."\n";
		}
		else
		{
			$RESULT .= 'No Result.<br>';		
		}
		
		/*set defaults*/
		if($start_date == "") { $start_date = "2012-01-01"; }
		if($end_date == "") { $end_date = date("Y-m-d"); }
		$rundate = date("Y-m-d H:i:s");
		
		$sdate = new DateTime($start_date);
		$start_date = $sdate->format('d M Y');
		$edate = new DateTime($end_date);
		$end_date = $edate->format('d M Y');

		$HTML .= '<div id="e" style="padding:5px 5px 5px 5px;">';
		$HTML .= sprintf('<div id="rptbp" class="rpth2"> For Period : %s - %s (Branch : %s)</div>',$start_date,$end_date,$branch);
		
		$REPORT_HTML = $HTML.$RESULT; 
		$this->content->pagebody .= $REPORT_HTML;
		$this->content->pagebody .= sprintf('<br><div>Run Date : %s<div>',$rundate);
		$this->content->pagebody .= sprintf('<div>Run By : %s</div>',Auth::instance()->get_user()->idname);
		$this->content->pagebody .= "</div>";
	}
}
?>