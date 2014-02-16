<?php
/**
 * 文章
 */
class Article extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'articles';

    /**
     * 模型对象关系：文章的分类
     * @return object Category
     */
    public function category()
    {
        return $this->belongsTo('Category', 'category_id');
    }

    /**
     * 模型对象关系：文章的作者
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * 模型对象关系：文章的评论
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('Comment', 'article_id');
    }


}