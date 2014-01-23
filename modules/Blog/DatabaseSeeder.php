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
        // 博客文章
        for ($i=0; $i < 3; $i++)
        { 
            $postData[] = array(
                'user_id'=>$i,
                'title'=>'标题'.$i,
                'slug'=>'test-biao-ti-'.$i,
                'content'=>'文章内容'.$i,
                'created_at'=>$dateTime
            );
        }
        Post::truncate();
        Post::insert($postData);
        // 文章评论
        for ($i=0; $i < 3; $i++)
        { 
            $commentData[] = array(
                'user_id'=>$i+1,
                'post_id'=>$i+1,
                'content'=>'评论内容'.$i,
                'created_at'=>$dateTime
            );
        }
        Comment::truncate();
        Comment::insert($commentData);
    }

}