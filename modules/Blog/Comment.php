<?php namespace Blog;

class Comment extends \Eloquent {

    /**
     * 开启软删除
     * @var boolean
     */
    protected $softDelete = true;

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

    /**
     * 访问器：友好的创建时间
     * @return string
     */
    public function getFriendlyCreatedAtAttribute()
    {
        return friendly_date($this->created_at);
    }

    /**
     * 访问器：友好的更新时间
     * @return string
     */
    public function getFriendlyUpdatedAtAttribute()
    {
        return friendly_date($this->updated_at);
    }

    /**
     * 访问器：友好的删除时间
     * @return string
     */
    public function getFriendlyDeletedAtAttribute()
    {
        return friendly_date($this->deleted_at);
    }

}