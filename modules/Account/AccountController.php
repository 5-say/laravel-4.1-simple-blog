<?php namespace Account;

use View;
use Config;

class AccountController extends \BaseController {

    public function getIndex()
    {
        return View::make('Account::index')
            ->with(array(
                'demo'=>'Account',
                'content'=> Config::get('Account::test')
            ));
    }

}