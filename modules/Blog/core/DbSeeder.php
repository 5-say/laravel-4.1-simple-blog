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

        // 文章分类
        Category::truncate(); // 清空表
        foreach (array('新分类一', '新分类二', '新分类三', '新分类四', '新分类五') as $key => $value) {
            Category::create(array(
                'name'       => $value,
                'sort_order' => $key+1,
            ));
        }
        
        // 博客文章
        Article::truncate(); // 清空表
        for ($i = 1; $i < 60; $i++) {
            Article::create(array(
                'category_id' => 1+$i%5,
                'user_id'     => $i,
                'title'       => '标题'.$i,
                'slug'        => 'slug-biao-ti-'.$i,
                'content'     => $this->articleContent($i),
            ));
        }

        // 文章评论
        Comment::truncate(); // 清空表
        for ($i = 1; $i < 30; $i++) {
            Comment::create(array(
                'user_id'    => 1+$i%3,
                'article_id' => 1+$i%5,
                'content'    => '评论内容'.$i,
            ));
        }

        
    }

    protected function articleContent($i)
    {
        $content = '什么是依赖
每个项目都有依赖（外界提供的输入）, 项目越复杂，越需要更多的依赖。在现今的网络应用程序中，最常见的依赖是数据库，其风险在于，一旦数据库暂停运行，那么整个程序也因此而停止运行。这是因为代码依赖数据库服务器……这已足够。因为数据库服务器有时会崩溃，而弃用它是荒谬的。尽管依赖有其自身的瑕疵，却仍然存在代码中，因为它使程序开发人员的工作更加轻松。什么是依赖
每个项目都有依赖（外界提供的输入）, 项目越复杂，越需要更多的依赖。在现今的网络应用程序中，最常见的依赖是数据库，其风险在于，一旦数据库暂停运行，那么整个程序也因此而停止运行。这是因为代码依赖数据库服务器……这已足够。因为数据库服务器有时会崩溃，而弃用它是荒谬的。尽管依赖有其自身的瑕疵，却仍然存在代码中，因为它使程序开发人员的工作更加轻松。什么是依赖
每个项目都有依赖（外界提供的输入）, 项目越复杂，越需要更多的依赖。在现今的网络应用程序中，最常见的依赖是数据库，其风险在于，一旦数据库暂停运行，那么整个程序也因此而停止运行。这是因为代码依赖数据库服务器……这已足够。因为数据库服务器有时会崩溃，而弃用它是荒谬的。尽管依赖有其自身的瑕疵，却仍然存在代码中，因为它使程序开发人员的工作更加轻松。';
        return $content;
    }

}