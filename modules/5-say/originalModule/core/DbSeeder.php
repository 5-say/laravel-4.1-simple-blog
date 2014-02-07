<?php
namespace Blog;

use Seeder;
use Eloquent;

class core_DbSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 强制解除 Eloquent::create() 批量赋值限制
        Eloquent::unguard();

        // 博客文章
        Article::truncate(); // 清空表
        for ($i = 1; $i < 60; $i++) {
            Article::create(array(
                'category_id' => 1+$i%10,
                'user_id'     => $i,
                'title'       => '标题'.$i,
                'slug'        => 'slug-biao-ti-'.$i,
                'content'     => $this->articleContent($i),
            ));
        }

    }


}