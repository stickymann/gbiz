<?php defined('SYSPATH') or die('No direct script access.');

class Frame_Controller extends Controller
{
    public function index()
    {
        $test = new View('frame_view');
        $test->render(TRUE);
    }

}
