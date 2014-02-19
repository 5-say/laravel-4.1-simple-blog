<?php

class core_Controller extends BaseController
{

    /**
     * 页面：操作界面
     * @return Response
     */
    public function getIndex()
    {
        $beginPath   = __DIR__.'/../database/';
        $directories = array();
        foreach (File::files($beginPath) as $value) {
            $file = str_replace('.php', '', basename($value));
            $directories[$file] = App::make('Assists_database_'.$file)->info;
        }
        return View::make('5-say::index')->with(compact('directories'));
    }

    /**
     * 动作：迁移并填充测试数据
     * @return Response
     */
    public function putRefresh()
    {
        $file  = Input::get('refresh');
        $class = App::make('Assists_database_'.$file);
        $class->refresh();
        $class->seedDemo();
        return Redirect::back()
            ->withInput()
            ->withErrors(array('succ' => $class->info.'，迁移和填充测试数据，完成。'));
    }

    /**
     * 动作：迁移并填充基础数据
     * @return [type] [description]
     */
    public function putSeed()
    {
        $file  = Input::get('seed');
        $class = App::make('Assists_database_'.$file);
        $class->refresh();
        return Redirect::back()
            ->withInput()
            ->withErrors(array('succ' => $class->info.'，迁移和填充基础数据，完成。'));
    }

    /**
     * 动作：快速安装应用程序
     * @return Response
     */
    public function postCreate()
    {
        $classArray = array();
        foreach (File::files(__DIR__.'/../database') as $key => $value)
            $classArray[] = App::make('Assists_database_'.str_replace('.php', '', basename($value)));
        
        switch (Input::get('type')) {
            case 'base':
                foreach ($classArray as $key => $value)
                    $value->refresh();
                break;
            case 'all':
                foreach ($classArray as $key => $value) {
                    $value->refresh();
                    $value->seedDemo();
                }
                break;
        }
        return Redirect::back()
            ->withErrors(array('succ' => '安装完成。'));
    }
    
    /**
     * 用于辅助模块化开发，批量执行文件内容的替换
     * @param  string|array $path  文件目录字符串|文件目录数组
     * @param  string       $frome 需要查找的字符串
     * @param  string       $to    用于替换的字符串
     * @return void
     */
    // protected function moduleChangeFile($path, $frome, $to)
    // {
    //     if(is_array($path)) {
    //         foreach ($path as $value)
    //             $this->moduleChangeFile($value, $frome, $to);
    //     } else {
    //         $file = File::get($path);
    //         $file = str_replace($frome, $to, $file);
    //         File::put($path, $file);
    //     }
    // }
}