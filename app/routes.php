<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

/**
 * 模块化
 */
include base_path('modules/functions.php');
// 开发辅助
module('5-say');
// 权限
module('Authority');
// 管理员后台
module('Admin');
// 用户后台
module('Account');
// 博客
module('Blog');