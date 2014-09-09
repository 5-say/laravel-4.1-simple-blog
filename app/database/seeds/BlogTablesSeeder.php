<?php

class BlogTablesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->seedCategory();
		$this->seedArticle();
		$this->seedComment();
	}

	/**
	 * 填充分类数据
	 * @return void
	 */
	private function seedCategory()
	{
        foreach (array('PHP-PSR 代码标准', '新分类二', '新分类三', '新分类四', '新分类五') as $key => $value) {
            Category::create(array(
                'name'       => $value,
                'sort_order' => $key+1,
            ));
        }
		$this->command->info('测试分类数据填充完毕');
	}

    /**
	 * 填充文章数据
	 * @return void
	 */
    private function seedArticle()
    {
        for ($i = 1; $i < 30; $i++) {
            Article::create(array(
                'category_id' => 2+$i%4,
                'user_id'     => $i,
                'title'       => '标题'.$i,
                'slug'        => 'slug-biao-ti-'.$i,
                'content'     => $this->generateArticleContent($i),
            ));
        }
		$this->command->info('随机文章数据填充完毕');
        sleep(1);
        
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-0 自动加载规范',
            'slug'        => 'psr-0',
            'content'     => File::get(__DIR__.'/PSR/PSR-0.md'),
        ));
        sleep(1);
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-1 基础编码规范',
            'slug'        => 'psr-1-basic-coding-standard',
            'content'     => File::get(__DIR__.'/PSR/PSR-1-basic-coding-standard.md'),
        ));
        sleep(1);
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-2 编码风格规范',
            'slug'        => 'psr-2-coding-style-guide',
            'content'     => File::get(__DIR__.'/PSR/PSR-2-coding-style-guide.md'),
        ));
        sleep(1);
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-3 日志接口规范',
            'slug'        => 'psr-3-logger-interface',
            'content'     => File::get(__DIR__.'/PSR/PSR-3-logger-interface.md'),
        ));

		$this->command->info('PSR 系列文章数据填充完毕');
    }

    /**
	 * 填充评论数据
	 * @return void
	 */
    private function seedComment()
    {
        Comment::truncate(); // 清空表

        for ($i = 1; $i < 30; $i++) {
            Comment::create(array(
                'user_id'    => $i,
                'article_id' => 1 + $i%5 + 28,
                'content'    => '评论内容'.$i,
            ));
            Article::find(1 + $i%5 + 28)->increment('comments_count');
        }

		$this->command->info('随机评论数据填充完毕');
    }

    /**
     * 生成文章内容
     * @param  integer $i 递增数
     * @return string
     */
    private function generateArticleContent($i)
    {
        return $i.'、什么是依赖
每个项目都有依赖（外界提供的输入）, 项目越复杂，越需要更多的依赖。在现今的网络应用程序中，最常见的依赖是数据库，其风险在于，一旦数据库暂停运行，那么整个程序也因此而停止运行。这是因为代码依赖数据库服务器……这已足够。因为数据库服务器有时会崩溃，而弃用它是荒谬的。尽管依赖有其自身的瑕疵，却仍然存在代码中，因为它使程序开发人员的工作更加轻松。';
    }

}