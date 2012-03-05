<?php defined('SYSPATH') or die('No direct script access.');

class Logo_Controller extends Controller
{
    public function index()
    {
        $test = new View('logo.view');
        $test->render(TRUE);
    }

}
