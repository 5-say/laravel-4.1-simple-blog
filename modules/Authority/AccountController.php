<?php namespace Authority;

use View;
use Input;
use Validator;
use Redirect;
use Hash;
use App;
use Auth;

class AccountController extends \BaseController {
    
    /**
     * 修改密码
     * @return Response
     */
    public function getChangePassword()
    {
        return View::make('Authority::account.changePassword');
    }
    public function postChangePassword()
    {
        // 
    }


}