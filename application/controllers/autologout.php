<?php defined('SYSPATH') or die('No direct script access.');

class Autologout_Controller extends Controller
{
    public function index()
    {
		$logoutpage = new View('login/autologout.view');
		$logoutpage->render(TRUE);
	}
}