<?php

// 注册视图别名
View::addNamespace('5-say', __DIR__.'/../views');

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function moduleChangeFile($path, $frome, $to)
{
    if( is_array($path) )
    {
        foreach ($path as $value)
            moduleChangeFile($value, $frome, $to);
    }
    else
    {
        $file = File::get($path);
        $file = str_replace($frome, $to, $file);
        File::put($path, $file);
    }
}

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix'=>'5-say'), function()
{
    // 操作界面
    Route::get('/', array('as'=>'5-say', function()
    {
        $beginPath   = __DIR__.'/../../';
        $directories = array();
        foreach (File::directories($beginPath) as $value)
        {
            $dir = basename($value);
            $directories[$dir] = $dir.' 模块';
        }
        unset($directories['5-say'], $directories['views']);
        return View::make('5-say::index')->with(compact('directories'));
    }));

    // 迁移
    Route::put('refresh', array('as'=>'5-say-refresh', function()
    {
        $directory = Input::get('refresh');
        $exists    = File::exists(__DIR__.'/../../'.$directory.'/DatabaseMigration.php');
        if (! $exists)
        {
            return Redirect::back()
                ->withInput()
                ->withErrors(array('err'=>$directory.' 模块，迁移文件不存在。'));
        }
        else
        {
            App::make($directory.'\DatabaseMigration')->refresh();
            return Redirect::back()
                ->withInput()
                ->withErrors(array('succ'=>$directory.' 模块，迁移完成。'));
        }
    }));

    // 填充
    Route::put('seed', array('as'=>'5-say-seed', function()
    {
        $directory = Input::get('seed');
        $exists    = File::exists(__DIR__.'/../../'.$directory.'/DatabaseSeeder.php');
        if (! $exists)
        {
            return Redirect::back()
                ->withInput()
                ->withErrors(array('err'=>$directory.' 模块，填充文件不存在。'));
        }
        else
        {
            App::make($directory.'\DatabaseSeeder')->run();
            return Redirect::back()
                ->withInput()
                ->withErrors(array('succ'=>$directory.' 模块，填充完成。'));
        }
    }));

    // 创建
    Route::post('create',array('as'=>'5-say-create', function()
    {
        $module = ucfirst(camel_case(Input::get('module')));
        $destination = __DIR__.'/../../'.$module.'/'; // 目标位置
        // 检测模块是否存在
        $exists = File::exists( $destination );
        if ($exists)
            return Redirect::back()
                ->withInput()
                ->withErrors(array('err'=>$module.' 模块，已经存在。'));
        // 全目录拷贝
        File::copyDirectory(__DIR__.'/../originalModule/', $destination);
        // 修改原始信息
        moduleChangeFile(array(
            $destination.'core/config.php',
            $destination.'core/routes.php',
            $destination.'DatabaseMigration.php',
            $destination.'DatabaseSeeder.php',
            $destination.'User.php',
            $destination.'originalModuleController.php'
        ), 'originalModule', $module);
        rename($destination.'originalModuleController.php', $destination.$module.'Controller.php');
        // 添加进原始路由文件
        $content = PHP_EOL.'// '.PHP_EOL."module('{$module}');";
        File::append(app_path('routes.php'), $content);
        // 返回测试页面连接
        $url = URL::to($module);
        return Redirect::back()
            ->withErrors(array('succ'=>$module.' 模块，创建成功。<a href="'.$url.'" target="_blank">点击浏览测试页面</a>'));
    }));


});

