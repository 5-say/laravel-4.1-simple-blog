<?php
/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'account', 'before' => 'auth'), function () {

    $Account = 'AccountController@';
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