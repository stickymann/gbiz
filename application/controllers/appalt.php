<?php defined('SYSPATH') or die('No direct script access.');

class Appalt_Controller extends Controller
{
    public function index()
    {
        $test = new View('app.frameset.view');
        $test->render(TRUE);
    }

}
