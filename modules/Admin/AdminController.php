<?php namespace Admin;

use BaseController;
use View;
use Config;

class AdminController extends BaseController {

    public function getIndex()
    {
        return View::make('Admin::index')
            ->with(array(
                'demo'=>'Admin',
                'content'=> Config::get('Admin::test')
            ));
    }

}