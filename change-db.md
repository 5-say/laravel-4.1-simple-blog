# 将项目数据库依赖变更为其它数据库的方法

> 2014-09-09 为避免对新人产生错误引导，移除开发辅助工具（不规范），采用常规化的迁移与填充流程。

## 详细步骤（下面以 mysql 为例）

1、修改数据库配置文件 `/app/config/database.php` 29 行。

```php
    // 'default' => 'sqlite',
    'default' => 'mysql',
```

> 注意：55 行开始的 mysql 连接配置，请根据自己的需要修改

```php
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
```

2、执行 `php artisan migrate` 命令完成数据库的迁移（含基础数据）

> 以下为反馈信息

```
Migration table created successfully.
Migrated: 2014_09_09_135540_create_authority_tables
Migrated: 2014_09_09_141726_create_blog_tables
[Finished in 5.2s]
```

3、执行 `php artisan db:seed` 命令完成测试数据填充

> 以下为反馈信息

```
测试用户数据填充完毕
Seeded: AuthorityTablesSeeder
测试分类数据填充完毕
随机文章数据填充完毕
PSR 系列文章数据填充完毕
随机评论数据填充完毕
Seeded: BlogTablesSeeder
[Finished in 38.9s]
```

> 注意：由于迁移文件是 UTF-8 格式，因此在 Win 下执行的话，以上信息的中文部分会显示为乱码，但并不影响正常使用。