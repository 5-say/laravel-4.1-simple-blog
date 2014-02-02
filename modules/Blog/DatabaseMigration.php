<?php namespace Blog;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Schema;

class DatabaseMigration extends Migration {

    public function refresh()
    {
        $this->down();
        $this->up();
        with(new DatabaseSeeder)->run();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 文章分类
        Schema::create('article_categories', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name', 20)->unique()->comment('分类名称');
            $table->integer('sort_order')->unsigned()->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
        // 文章
        Schema::create('articles', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('category_id')->unsigned()->comment('文章分类ID');
            $table->integer('user_id')->unsigned()->comment('作者ID');
            $table->string('title', 100)->unique()->comment('标题');
            $table->string('slug', 100)->unique()->comment('文章缩略名');
            $table->text('content')->comment('内容');
            $table->string('meta_title', 100)->nullable()->comment('SEO');
            $table->string('meta_description')->nullable()->comment('SEO');
            $table->string('meta_keywords')->nullable()->comment('SEO');
            $table->timestamps();
            $table->softDeletes();
        });
        // 文章的评论
        Schema::create('article_comments', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('作者ID');
            $table->integer('post_id')->unsigned()->comment('归属文章ID');
            $table->text('content')->comment('内容');
            $table->timestamps();
            $table->softDeletes();
        });
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

}
