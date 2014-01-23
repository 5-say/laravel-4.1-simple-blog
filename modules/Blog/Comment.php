<?php namespace Blog;

class Comment extends \Eloquent {

    /**
     * 开启软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 归属文章
     * @return object Blog\Post
     */
    public function post()
    {
        return $this->belongsTo('Post');
    }

}