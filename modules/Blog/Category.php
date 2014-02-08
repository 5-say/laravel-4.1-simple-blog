<?php
namespace Blog;

class Category extends \BaseModel
{

    protected $table = 'article_categories';

    /**
     * 模型对象关系：分类下的文章
     * @return object Blog\Article
     */
    public function articles()
    {
        return $this->hasMany('Blog\Article', 'category_id');
    }



}