<?php


/**
 * 捕获无效参数异常
 */
App::error(function (InvalidArgumentException $exception) {
    $debug = Config::get('app.debug', false);
    // 获取异常消息、类型、核心内容
    preg_match('/(\w+) \[(.+)\].+/', $exception->getMessage(), $messageArray);
    list($message, $type, $content) = $messageArray;
    switch ($type) {
        case 'View':  // 没有找到对应的视图文件
            if ($debug) return $message;
            break;
    }
});



// 开发辅助
module('5-say');
// 后台
module('Admin');
// 用户中心
module('Account');
// 权限模块
module('Authority', true);
// 博客
// module('Blog');

