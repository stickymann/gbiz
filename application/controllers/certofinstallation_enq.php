<?php defined('SYSPATH') or die('No direct script access.');

class Certofinstallation_enq_Controller extends Sitequiry_Controller
{

	public function __construct()
    {
		parent::__construct('certofinstallation_enq');
	}	
		
	public function index()
    {
      $this->processRequest();
			
		//print_r ($_REQUEST);
		// No page number supplied, so default to page one
        //url::redirect('vehicleaccount_enq/page/1');
    }
}
?>