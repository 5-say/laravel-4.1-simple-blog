<?php
/**
 * 博客
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // 文章分类
        Schema::create('article_categories', function ($table) {

            $table->increments('id');
            $table->string('name'       )->comment('分类名称');
            $table->integer('sort_order')->unsigned()->default(0)->comment('排序');

            $table->timestamps();
            $table->softDeletes();

            $table->comment = '文章分类';
            $table->engine  = 'MyISAM';
            $table->unique('name');
        });
        $this->seedArticleCategory();

        // 文章
        Schema::create('articles', function ($table) {

            $table->increments('id');
            $table->integer('user_id'        )->unsigned()->comment('作者ID');
            $table->integer('category_id'    )->unsigned()->comment('文章分类ID');
            $table->integer('comments_count' )->unsigned()->default(0)->comment('评论数');

            $table->string('title'           )->comment('标题');
            $table->string('slug'            )->comment('文章缩略名');
            $table->text('content'           )->comment('内容');
            $table->string('content_format'  )->default('markdown')->comment('内容格式，为后期加入非 markdown 编辑器做准备');

            $table->string('meta_title'      )->nullable()->comment('SEO 页面标题');
            $table->string('meta_description')->nullable()->comment('SEO 页面描述');
            $table->string('meta_keywords'   )->nullable()->comment('SEO 页面关键词');

            $table->timestamps();
            $table->softDeletes();

            $table->comment = '文章';
            $table->engine  = 'MyISAM';
            $table->index('user_id');
            $table->index('category_id');
            $table->unique('title');
            $table->unique('slug');
        });

        // 文章的评论
        Schema::create('article_comments', function ($table) {

            $table->increments('id');
            $table->integer('user_id'   )->unsigned()->comment('作者ID');
            $table->integer('article_id')->unsigned()->comment('归属文章ID');
            $table->text('content'      )->comment('内容');

            $table->timestamps();
            $table->softDeletes();

            $table->comment = '文章的评论';
            $table->engine  = 'MyISAM';
            $table->index('user_id');
            $table->index('article_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('article_categories');
        Schema::drop('articles');
        Schema::drop('article_comments');
	}

	/**
	 * 填充 article_categories 表基础数据
	 * @return void
	 */
	private function seedArticleCategory()
	{
		Category::create(array(
            'name' => '默认分类',
        ));
	}

}
