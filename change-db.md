# 将项目数据库依赖变更为其它数据库的方法

> Assist 包中存放着迁移文件，可配合开发辅助工具无缝切换至 MySql 等 laravel 支持的数据库。（工具 URI `/5-say` ）

## 详细步骤（下面以 mysql 为例）

1. 修改数据库配置文件 `/app/config/database.php` 29 行。

    // 'default' => 'sqlite',
    'default' => 'mysql',

> 注意：55 行开始的 mysql 连接配置，请根据自己的需要修改

        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'laravel-4.1-simple-blog',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            // 'collation' => 'utf8_unicode_ci',
            'collation' => 'utf8_general_ci',
            'prefix'    => 'l4_',
        ),

2. 访问 “开发辅助工具”。（工具 URI `/5-say` ）

> 如下图所示，选择 “完全安装，含测试数据”，并点击安装。当看到提示 “安装完成” 后即可正常使用。

![安装](/public/readmeAssets/mx384D1.png "Optional title")