<?php

// 注册视图别名
View::addNamespace('originalModule', __DIR__.'/../views');
// 注册配置别名（模块不使用独立配置的可以注释掉）
Config::package('_modules/originalModule', __DIR__, 'originalModule');

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

Route::group(array('prefix'=>'originalModule'), function()
{
    $originalModule = 'originalModule\originalModuleController@';

    // 测试页面
    Route::get('/', array('as'=>'originalModuleDemo', 'uses'=>$originalModule.'getIndex'));
});

