<?php

// 注册视图别名
View::addNamespace('Account', __DIR__.'/../views');
// 注册配置别名（模块不使用独立配置的可以注释掉）
// Config::package('_modules/Account', __DIR__, 'Account');

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'account'), function () {

    $Account = 'Account\core_Controller@';
    # 用户中心首页
    Route::get('/', array('as' => 'account', 'uses' => $Account.'getIndex'));
    # 用户中心首页
    Route::get('/', array('as' => 'account.userInfo', 'uses' => $Account.'getIndex'));
    # 用户中心首页
    // Route::get('/', array('as' => 'account.changePassword', 'uses' => $Account.'getIndex'));
    # 用户中心首页
    Route::get('/', array('as' => 'account.changePortrait', 'uses' => $Account.'getIndex'));
    # 我的评论管理
    Route::get('/', array('as' => 'account.myComments', 'uses' => $Account.'getIndex'));

});