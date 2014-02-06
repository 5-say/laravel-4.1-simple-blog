<?php
namespace Blog;

class Article extends \BaseModel
{

    protected $table = 'articles';

    /**
     * 模型对象关系：文章的作者
     * @return object Authority\User
     */
    public function user()
    {
        return $this->belongsTo('Authority\User', 'user_id');
    }

    /**
     * 模型对象关系：文章的评论
     * @return object Blog\Comment
     */
    public function comments()
    {
        return $this->hasMany('Blog\Comment', 'article_id');
    }


}