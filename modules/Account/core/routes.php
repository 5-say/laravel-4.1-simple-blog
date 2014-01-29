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

Route::group(array('prefix'=>'account'), function()
{

    // Account Dashboard
    Route::get('/', array('as'=>'account', 'uses'=>'Controllers\Account\DashboardController@getIndex'));

    // Profile
    Route::get('profile', array('as'=>'profile', 'uses'=>'Controllers\Account\ProfileController@getIndex'));
    Route::post('profile', 'Controllers\Account\ProfileController@postIndex');

    // Change Password
    Route::get('change-password', array('as'=>'change-password', 'uses'=>'Controllers\Account\ChangePasswordController@getIndex'));
    Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

    // Change Email
    Route::get('change-email', array('as'=>'change-email', 'uses'=>'Controllers\Account\ChangeEmailController@getIndex'));
    Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

});*/