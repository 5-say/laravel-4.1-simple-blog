<?php

use Illuminate\Database\Schema\Blueprint;


// 开发辅助
include __DIR__.'/controllers/Assists/assist.php';


Route::get('/', function()
{
	return '/';
});

// 核心权限控制器
Route::controller('auth', 'Authority_IndexController');






