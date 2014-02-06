<?php
namespace Admin;

use View;

class core_Controller extends \BaseController
{

    /**
     * 后台首页
     * @return Response
     */
    public function getIndex()
    {
        return View::make('Admin::index');
    }

}