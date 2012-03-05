<?php defined('SYSPATH') or die('No direct script access.');

class Banner_Controller extends Controller
{
    public function index()
    {
        $banner = new View('banner.view');
        $banner->render(TRUE);
    }

}
