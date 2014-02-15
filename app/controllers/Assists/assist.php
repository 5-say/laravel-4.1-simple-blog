<?php
/*
|--------------------------------------------------------------------------
| 开发辅助
|--------------------------------------------------------------------------
|
*/

/**
 * 无断点调试，结合 barryvdh/laravel-debugbar
 * @return void
 */
function d()
{
    if (class_exists('Barryvdh\Debugbar\Facade')) {
        Barryvdh\Debugbar\Facade::enable();
        array_map(function ($x) { Barryvdh\Debugbar\Facade::info($x); }, func_get_args());
    } else {
        array_map(function ($x) { var_dump($x); }, func_get_args());
    }
}
// 如果必须要在非视图响应中使用
function d_()
{
    if (class_exists('Barryvdh\Debugbar\Facade')) {
        Barryvdh\Debugbar\Facade::enable();
        echo '<span></span>';
        array_map(function ($x) { Barryvdh\Debugbar\Facade::info($x); }, func_get_args());
    } else {
        array_map(function ($x) { var_dump($x); }, func_get_args());
    }
}

/**
 * 保持原格式的参数文件修改（原参数值将会在下一行以注释的形式备份）
 * @param  string $configName 需要修改的参数
 * @param  string $newConfig  新的参数值
 * @param  string $comment    当存在同名参数时用以区分的注释字符串
 * @return 成功时返回写入到文件内数据的字节数，失败时返回FALSE
 */
function change_config($configName, $newConfig, $comment = '')
{
    $oldConfig      = Config::get($configName);
    $pathArr        = explode('.', $configName);
    $configFilePath = app_path('config/'.$pathArr[0].'.php');
    $oldContent     = File::get($configFilePath);
    
    $befor      = "/([^\n]+)'{$pathArr[count($pathArr)-1]}' => '{$oldConfig}'(.*{$comment}|[^\n])/";
    $after      = "\\1'{$pathArr[count($pathArr)-1]}' => '{$newConfig}'\\2#'{$oldConfig}'";
    $newContent = preg_replace($befor, $after, $oldContent, 1);

    return File::put($configFilePath, $newContent);
}


function make_controller($controller, $method)
{
    $content =
"<?php

class {$controller} extends BaseController
{
    /**
     * 初始化
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 页面：默认
     * @return Response
     */
    public function {$method}()
    {
        return __FILE__;
    }
}
";
    $array    = explode('_', $controller);
    $fileName = array_pop($array).'.php';
    $path     = app_path('controllers/'.implode('/', $array).'/');

    // 若目录不存在，则递归创建
    File::isDirectory($path) OR File::makeDirectory($path, 0777, true);
    // 创建文件
    File::put($path.'/'.$fileName, $content);
}




/**
 * 捕获反射解析异常
 */
App::error(function (ReflectionException $exception) {
    if (Route::current()) {
        list($controller, $method) = explode('@', Route::current()->getActionName());
    } else {
        preg_match('/Class (\w+) does not exist/', $exception->getMessage(), $messageArray);
        make_controller($messageArray[1], 'getIndex');
        return Response::make('路由注册阶段，检测到缺少控制器文件 '.$messageArray[1].' 系统已自动生成，请重新刷新页面。');;
    }
    $link = link_to_route('makeController', '点击创建', $controller.'/'.$method);
    return Response::make('缺少控制器 '.$controller.' '.$link);
});
/**
 * 辅助创建控制器
 */
Route::get('/5-say/make/controller/{controller}/{method}', array('as' => 'makeController', function ($controller, $method) {
    // 创建控制器
    make_controller($controller, $method);
    // 返回之前的页面
    return Redirect::back();
}));
/**
 * 捕获无效参数异常
 */
App::error(function (InvalidArgumentException $exception) {
    // 获取异常消息、类型、核心内容
    preg_match('/(\w+) \[(.+)\].+/', $exception->getMessage(), $messageArray);
    list($message, $type, $content) = $messageArray;
    switch ($type) {
        case 'View':  // 没有找到对应的视图文件
            $link = link_to_route('makeView', '创建视图 '.$content, $content);
            return Response::make($link);
            break;
    }
});
/**
 * 辅助创建视图
 */
Route::get('/5-say/make/view/{view}', array('as' => 'makeView', function ($view) {
    $view = strtr($view, '.', '/').'.blade.php';
    $path = app_path('views/'.$view);
    File::isDirectory(dirname($path)) OR File::makeDirectory(dirname($path));
    File::put($path, $view);
    return Redirect::back();
}));



// 注册视图别名
$view = View::addNamespace('5-say', __DIR__.'/views');
include __DIR__.'/core/routes.php';
