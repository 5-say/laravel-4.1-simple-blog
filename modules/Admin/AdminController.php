<?php namespace Admin;

use View;
use Config;

class AdminController extends \BaseController {

    public function getIndex()
    {
        return View::make('Admin::index');
    }

}