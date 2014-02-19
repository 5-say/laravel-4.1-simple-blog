<?php

use Illuminate\Database\Schema\Blueprint;

class Assists_database_Blog
{

    public $info = '博客';

    public function refresh()
    {
        $this->down();
        $this->up();
        $this->seed();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_categories');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_comments');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 文章分类
        Schema::create('article_categories', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name', 20)   ->unique()  ->comment('分类名称');
            $table->integer('sort_order')->unsigned()->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
        // 文章
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('category_id')        ->unsigned()         ->comment('文章分类ID');
            $table->integer('user_id')            ->unsigned()         ->comment('作者ID');
            $table->string('title', 100)          ->unique()           ->comment('标题');
            $table->string('slug', 100)           ->unique()           ->comment('文章缩略名');
            $table->text('content')                                    ->comment('内容');
            $table->enum('content_format', array('markdown', 'html'))
                                                  ->default('markdown')->comment('内容格式，为后期加入非 markdown 编辑器做准备');
            $table->smallInteger('comments_count')->default(0)         ->comment('评论数');
            $table->string('meta_title', 100)     ->nullable()         ->comment('SEO 页面标题');
            $table->string('meta_description')    ->nullable()         ->comment('SEO 页面描述');
            $table->string('meta_keywords')       ->nullable()         ->comment('SEO 页面关键词');
            $table->timestamps();
            $table->softDeletes();
        });
        // 文章的评论
        Schema::create('article_comments', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('user_id')   ->unsigned()->comment('作者ID');
            $table->integer('article_id')->unsigned()->comment('归属文章ID');
            $table->text('content')                  ->comment('内容');
            // $table->timestamp('apply_delete_at')->nullable()->comment('用户申请删除评论的时间');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * 基础数据填充
     * @return void
     */
    public function seed()
    {
        // 强制解除 Eloquent::create() 批量赋值限制
        Eloquent::unguard();
        // 文章分类
        Category::truncate(); // 清空表
        Category::create(array(
            'name'       => '默认分类',
            'sort_order' => 0,
        ));
    }

    /**
     * 测试数据填充
     * @return void
     */
    public function seedDemo()
    {
        // 文章分类
        Category::truncate(); // 清空表
        foreach (array('PHP-PSR 代码标准', '新分类二', '新分类三', '新分类四', '新分类五') as $key => $value) {
            Category::create(array(
                'name'       => $value,
                'sort_order' => $key+1,
            ));
        }
        // 博客文章
        Article::truncate(); // 清空表
        for ($i = 1; $i < 60; $i++) {
            Article::create(array(
                'category_id' => 2+$i%4,
                'user_id'     => $i,
                'title'       => '标题'.$i,
                'slug'        => 'slug-biao-ti-'.$i,
                'content'     => $this->getArticleContent($i),
            ));
        }
        sleep(1);
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-0 自动加载规范',
            'slug'        => 'psr-0',
            'content'     => File::get(__DIR__.'/PSR/PSR-0.md'),
        ));
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-1 基础编码规范',
            'slug'        => 'psr-1-basic-coding-standard',
            'content'     => File::get(__DIR__.'/PSR/PSR-1-basic-coding-standard.md'),
        ));
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-2 编码风格规范',
            'slug'        => 'psr-2-coding-style-guide',
            'content'     => File::get(__DIR__.'/PSR/PSR-2-coding-style-guide.md'),
        ));
        Article::create(array(
            'category_id' => 2,
            'user_id'     => 1,
            'title'       => 'PSR-3 日志接口规范',
            'slug'        => 'psr-3-logger-interface',
            'content'     => File::get(__DIR__.'/PSR/PSR-3-logger-interface.md'),
        ));
        // 文章评论
        Comment::truncate(); // 清空表
        for ($i = 1; $i < 30; $i++) {
            Comment::create(array(
                'user_id'    => 1+$i%30,
                'article_id' => 1+$i%5,
                'content'    => '评论内容'.$i,
            ));
            Article::find(1+$i%5)->increment('comments_count');
        }
    }

    /**
     * 生成文章内容
     * @param  integer $i 递增数
     * @return string
     */
    protected function getArticleContent($i)
    {
        $content = '什么是依赖
每个项目都有依赖（外界提供的输入）, 项目越复杂，越需要更多的依赖。在现今的网络应用程序中，最常见的依赖是数据库，其风险在于，一旦数据库暂停运行，那么整个程序也因此而停止运行。这是因为代码依赖数据库服务器……这已足够。因为数据库服务器有时会崩溃，而弃用它是荒谬的。尽管依赖有其自身的瑕疵，却仍然存在代码中，因为它使程序开发人员的工作更加轻松。什么是依赖
每个项目都有依赖（外界提供的输入）, 项目越复杂，越需要更多的依赖。在现今的网络应用程序中，最常见的依赖是数据库，其风险在于，一旦数据库暂停运行，那么整个程序也因此而停止运行。这是因为代码依赖数据库服务器……这已足够。因为数据库服务器有时会崩溃，而弃用它是荒谬的。尽管依赖有其自身的瑕疵，却仍然存在代码中，因为它使程序开发人员的工作更加轻松。什么是依赖
每个项目都有依赖（外界提供的输入）, 项目越复杂，越需要更多的依赖。在现今的网络应用程序中，最常见的依赖是数据库，其风险在于，一旦数据库暂停运行，那么整个程序也因此而停止运行。这是因为代码依赖数据库服务器……这已足够。因为数据库服务器有时会崩溃，而弃用它是荒谬的。尽管依赖有其自身的瑕疵，却仍然存在代码中，因为它使程序开发人员的工作更加轻松。';
        return $content;
    }


}
