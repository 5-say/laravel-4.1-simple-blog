<?php namespace originalModule;

use View;
use Config;

class originalModuleController extends \BaseController {

    public function getIndex()
    {
        return View::make('originalModule::index')
            ->with(array(
                'demo'=>'originalModule',
                'content'=> Config::get('originalModule::test')
            ));
    }

}