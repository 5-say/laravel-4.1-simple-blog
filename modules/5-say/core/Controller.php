<?php

class core_Controller extends BaseController
{

    /**
     * 页面：操作界面
     * @return Response
     */
    public function getIndex()
    {
        $beginPath   = __DIR__.'/../../';
        $directories = array();
        foreach (File::directories($beginPath) as $value) {
            $dir = basename($value);
            $directories[$dir] = $dir.' 模块';
        }
        unset($directories['5-say'], $directories['views']);
        return View::make('5-say::index')->with(compact('directories'));
    }

    /**
     * 动作：迁移
     * @return Response
     */
    public function putRefresh()
    {
        $directory = Input::get('refresh');
        $exists    = File::exists(__DIR__.'/../../'.$directory.'/core/DbMigration.php');
        if (! $exists) {
            return Redirect::back()
                ->withInput()
                ->withErrors(array('err' => $directory.' 模块，迁移文件不存在。'));
        } else {
            App::make($directory.'\core_DbMigration')->refresh();
            return Redirect::back()
                ->withInput()
                ->withErrors(array('succ' => $directory.' 模块，迁移完成。'));
        }
    }

    /**
     * 动作：填充
     * @return [type] [description]
     */
    public function putSeed()
    {
        $directory = Input::get('seed');
        $exists    = File::exists(__DIR__.'/../../'.$directory.'/core/DbSeeder.php');
        if (! $exists) {
            return Redirect::back()
                ->withInput()
                ->withErrors(array('err' => $directory.' 模块，填充文件不存在。'));
        } else {
            App::make($directory.'\core_DbSeeder')->run();
            return Redirect::back()
                ->withInput()
                ->withErrors(array('succ' => $directory.' 模块，填充完成。'));
        }
    }

    /**
     * 动作：创建新模块
     * @return Response
     */
    public function postCreate()
    {
        $module      = ucfirst(camel_case(Input::get('module')));
        $destination = __DIR__.'/../../'.$module.'/'; // 目标位置
        // 检测模块是否存在
        $exists      = File::exists( $destination );
        if ($exists)
            return Redirect::back()
                ->withInput()
                ->withErrors(array('err' => $module.' 模块，已经存在。'));
        // 全目录拷贝
        File::copyDirectory(__DIR__.'/../originalModule/', $destination);
        // 修改原始信息
        $this->moduleChangeFile(array(
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
            ->withErrors(array('succ' => $module.' 模块，创建成功。<a href="'.$url.'" target="_blank">点击浏览测试页面</a>'));
    }
    
    /**
     * 用于辅助模块化开发，批量执行文件内容的替换
     * @param  string|array $path  文件目录字符串|文件目录数组
     * @param  string       $frome 需要查找的字符串
     * @param  string       $to    用于替换的字符串
     * @return void
     */
    protected function moduleChangeFile($path, $frome, $to)
    {
        if(is_array($path)) {
            foreach ($path as $value)
                $this->moduleChangeFile($value, $frome, $to);
        } else {
            $file = File::get($path);
            $file = str_replace($frome, $to, $file);
            File::put($path, $file);
        }
    }
}