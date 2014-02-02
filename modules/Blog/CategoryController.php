<?php namespace Blog;


class CategoryController extends \ResourceController {

    protected $init = array(
        'resource' => 'categories',
        'model'    => 'Blog\Category',
        
        'index' => array(
            'view'  => 'resource.index',
            'title' => '文章分类管理',
            'table' => array(
                '分类名称' => 'name',
                '排序'     => 'sort_order',
            ),
            'pagesize'   => 15,
            'createName' => '添加新分类',
        ),
        
        'create' => array(
            'view'  => 'resource.create',
            'title' => '文章分类管理',
        ),
        
        'show' => array(
            'view'  => 'resource.show',
            'title' => '文章分类管理',
        ),
        
        'edit' => array(
            'view'  => 'resource.edit',
            'title' => '文章分类管理',
        ),

    );
    

}