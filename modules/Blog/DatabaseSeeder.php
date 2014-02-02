<?php namespace Blog;

use Seeder;
use Eloquent;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $dateTime = new Carbon;

        // 文章分类
        $data   = array();
        $data[] = array(
            'name'       => '默认分类',
            'sort_order' => 1,
            'created_at' => $dateTime,
        );
        Category::truncate();
        Category::insert($data);
        
        // 博客文章
        $data = array();
        for ($i=0; $i < 3; $i++)
        { 
            $data[] = array(
                'category_id' => 1,
                'user_id'     => $i,
                'title'       => '标题'.$i,
                'slug'        => 'test-biao-ti-'.$i,
                'content'     => '文章内容'.$i,
                'created_at'  => $dateTime,
            );
        }
        Post::truncate();
        Post::insert($data);

        // 文章评论
        $data = array();
        for ($i=0; $i < 3; $i++)
        { 
            $data[] = array(
                'user_id'    => $i+1,
                'post_id'    => $i+1,
                'content'    => '评论内容'.$i,
                'created_at' => $dateTime
            );
        }
        Comment::truncate();
        Comment::insert($data);
    }

}