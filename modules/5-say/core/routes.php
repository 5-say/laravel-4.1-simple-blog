<?php
include __DIR__.'/Controller.php';

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => '5-say'), function () {

    $controller = 'core_Controller@';

    // 操作界面
    Route::get('/', array('as' => '5-say', 'uses' => $controller.'getIndex'));
    // 迁移
    Route::put('refresh', array('as' => '5-say-refresh', 'uses' => $controller.'putRefresh'));
    // 填充
    Route::put('seed', array('as' => '5-say-seed', 'uses' => $controller.'putSeed'));
    // 创建
    Route::post('create',array('as' => '5-say-create', 'uses' => $controller.'postCreate'));


});

