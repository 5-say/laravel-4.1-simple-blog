<?php

class AccountController extends BaseController
{

    /**
     * 用户中心首页
     * @return Response
     */
    public function getIndex()
    {
        return View::make('Account::index');
    }

}