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
        // 文章
        Schema::create('posts', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
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
        Schema::create('comments', function(Blueprint $table)
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
        Schema::dropIfExists('posts');
        Schema::dropIfExists('comments');
    }

}
