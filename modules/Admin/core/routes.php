<?php

// 注册视图别名
View::addNamespace('Admin', __DIR__.'/../views');
// 注册配置别名（模块不使用独立配置的可以注释掉）
// Config::package('_modules/Admin', __DIR__, 'Admin');

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
Route::group(array('prefix'=>'admin'), function()
{
    $Admin = 'Admin\AdminController@';

    // Blog Management
    Route::group(array('prefix'=>'blogs'), function()
    {
        Route::get('/', array('as'=>'blogs', 'uses'=>'Controllers\Admin\BlogsController@getIndex'));
        Route::get('create', array('as'=>'create/blog', 'uses'=>'Controllers\Admin\BlogsController@getCreate'));
        Route::post('create', 'Controllers\Admin\BlogsController@postCreate');
        Route::get('{blogId}/edit', array('as'=>'update/blog', 'uses'=>'Controllers\Admin\BlogsController@getEdit'));
        Route::post('{blogId}/edit', 'Controllers\Admin\BlogsController@postEdit');
        Route::get('{blogId}/delete', array('as'=>'delete/blog', 'uses'=>'Controllers\Admin\BlogsController@getDelete'));
        Route::get('{blogId}/restore', array('as'=>'restore/blog', 'uses'=>'Controllers\Admin\BlogsController@getRestore'));
    });

    // User Management
    Route::group(array('prefix'=>'users'), function()
    {
        Route::get('/', array('as'=>'users', 'uses'=>'Controllers\Admin\UsersController@getIndex'));
        Route::get('create', array('as'=>'create/user', 'uses'=>'Controllers\Admin\UsersController@getCreate'));
        Route::post('create', 'Controllers\Admin\UsersController@postCreate');
        Route::get('{userId}/edit', array('as'=>'update/user', 'uses'=>'Controllers\Admin\UsersController@getEdit'));
        Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
        Route::get('{userId}/delete', array('as'=>'delete/user', 'uses'=>'Controllers\Admin\UsersController@getDelete'));
        Route::get('{userId}/restore', array('as'=>'restore/user', 'uses'=>'Controllers\Admin\UsersController@getRestore'));
    });

    // Group Management
    Route::group(array('prefix'=>'groups'), function()
    {
        Route::get('/', array('as'=>'groups', 'uses'=>'Controllers\Admin\GroupsController@getIndex'));
        Route::get('create', array('as'=>'create/group', 'uses'=>'Controllers\Admin\GroupsController@getCreate'));
        Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
        Route::get('{groupId}/edit', array('as'=>'update/group', 'uses'=>'Controllers\Admin\GroupsController@getEdit'));
        Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
        Route::get('{groupId}/delete', array('as'=>'delete/group', 'uses'=>'Controllers\Admin\GroupsController@getDelete'));
        Route::get('{groupId}/restore', array('as'=>'restore/group', 'uses'=>'Controllers\Admin\GroupsController@getRestore'));
    });

    // Dashboard
    Route::get('/', array('as'=>'admin', 'uses'=>'Controllers\Admin\DashboardController@getIndex'));

});