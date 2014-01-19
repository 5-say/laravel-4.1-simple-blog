# 让 Laravel 4.1 的“数据库迁移”支持 MySQL 字段注释

**更新时间：** 2014-01-19

为调节器数组增加 `'Comment'` 单元。

    protected $modifiers = array( ... , 'Comment');

为类文件增加实现方法。

    /**
     * Get the SQL for a "comment" column modifier.
     *
     * @param \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param \Illuminate\Support\Fluent  $column
     * @return string|null
     */
    protected function modifyComment(Blueprint $blueprint, Fluent $column)
    {
        if ( ! is_null($column->comment))
        {
            return " comment '".strval(mysql_real_escape_string($column->comment))."'";
        }
    }
