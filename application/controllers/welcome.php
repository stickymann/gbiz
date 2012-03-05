<?php defined('SYSPATH') or die('No direct script access.');

class Welcome_Controller extends Controller
{
    public function index()
    {
		url::redirect('login');
	}
}