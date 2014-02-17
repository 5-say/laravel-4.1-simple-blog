<?php
/**
 * 文章分类
 */
class Category extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'article_categories';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：分类下的文章
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function articles()
    {
        return $this->hasMany('Article', 'category_id');
    }



}