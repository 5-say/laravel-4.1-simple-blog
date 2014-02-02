<?php namespace Blog;

class Comment extends \BaseModel {

    protected $table = 'article_comments';

    /**
     * 模型对象关系：归属文章
     * @return object Blog\Post
     */
    public function post()
    {
        return $this->belongsTo('Post');
    }

    /**
     * 模型对象关系：评论的作者
     * @return object Authority\User
     */
    public function user()
    {
        return $this->belongsTo('Authority\User');
    }


}