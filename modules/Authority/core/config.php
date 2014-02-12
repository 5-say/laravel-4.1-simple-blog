<?php

return array(

    'driver' => 'eloquent',     // 身份验证驱动，系统默认支持："database", "eloquent"
        'model'  => 'User',     // 'eloquent'驱动下用于身份验证的模型名称
        'table'  => 'users',    // 'database'驱动下用于身份验证的数据库表名称

    // 密码提醒设置，用户忘记密码时通常通过邮箱重置
    'reminder' => array(
        'email' => 'Authority::email.forgotPassword', // 密码重置邮件模板
        'table' => 'password_reminders',              // 密码重置令牌存放的数据库表
        'expire' => 60,                               // 令牌有小时间，单位分钟
    ),

    'lougoutTo' => '/',     // 用户退出后跳转到的页面
    'resetedTo' => '/',     // 用户重置密码成功后跳转到的页面

);
