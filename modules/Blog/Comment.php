<?php
namespace Blog;

class Comment extends \BaseModel
{

    protected $table = 'article_comments';

    /**
     * 模型对象关系：归属文章
     * @return object Blog\Article
     */
    public function article()
    {
        return $this->belongsTo('Blog\Article', 'article_id');
    }

    /**
     * 模型对象关系：评论的作者
     * @return object Authority\User
     */
    public function user()
    {
        return $this->belongsTo('Authority\User', 'user_id');
    }


}