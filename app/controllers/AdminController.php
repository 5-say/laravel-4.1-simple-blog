<?php

class AdminController extends BaseController
{
    /**
     * 后台首页
     * @return Response
     */
    public function getIndex()
    {
        return View::make('admin.index');
    }


}
