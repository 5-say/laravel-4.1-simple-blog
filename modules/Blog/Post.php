<?php namespace Blog;

class Post extends \BaseModel {

    /**
     * 模型对象关系：文章的作者
     * @return object Authority\User
     */
    public function user()
    {
        return $this->belongsTo('Authority\User');
    }

    /**
     * 模型对象关系：文章的评论
     * @return object Blog\Comment
     */
    public function comments()
    {
        return $this->hasMany('Blog\Comment');
    }


}