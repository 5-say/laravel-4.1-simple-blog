<?php

class Comment extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'article_comments';

    /**
     * 模型对象关系：归属文章
     * @return object Article
     */
    public function article()
    {
        return $this->belongsTo('Article', 'article_id');
    }

    /**
     * 模型对象关系：评论的作者
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }


}