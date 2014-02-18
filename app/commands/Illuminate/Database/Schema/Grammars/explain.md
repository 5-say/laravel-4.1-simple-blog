# 让 Laravel 4.1 的“数据库迁移”支持 MySQL 字段注释

- `MySqlGrammar.php` 文件，为已经添加注释功能的文件。
- `MySqlGrammar.original.php` 文件，用于比对官方是否有做更新。
- 使用前需要先执行 `php artisan dump-autoload` 或 `composer dump-autoload` 命令。

为调节器数组增加 `'Comment'` 单元。

    protected $modifiers = array( ... , 'Comment');

为类文件增加实现方法。

    /**
     * Get the SQL for a "comment" column modifier.
     *
     * @param \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param \Illuminate\Support\Fluent             $column
     * @return string|null
     */
    protected function modifyComment(Blueprint $blueprint, Fluent $column)
    {
        if ( ! is_null($column->comment))
        {
            return " comment '".strval(mysql_real_escape_string($column->comment))."'";
        }
    }
