<?php
namespace Blog;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Schema;

class core_DbMigration extends Migration
{

    public function refresh()
    {
        $this->down();
        $this->up();
        with(new core_DbSeeder)->run();
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
            $table->string('name', 20)->unique()->comment('分类名称');
            $table->integer('sort_order')->unsigned()->comment('排序');
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
    }

}
