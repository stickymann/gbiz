<?php defined('SYSPATH') or die('No direct script access.');

class Cmdbox_Controller extends Controller
{
    public function index()
    {
        $test = new View('cmdbox.view');
        $test->render(TRUE);
    }

}
