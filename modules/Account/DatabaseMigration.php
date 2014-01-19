<?php namespace Account;

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
        // 用户表
        // Schema::create('users', function(Blueprint $table)
        // {
        //     $table->engine = 'MyISAM';
        //     $table->increments('id');
        //     $table->string('email', 60)->unique()->comment('邮箱');
        //     $table->string('password', 60)->comment('密码');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('users');
    }

}
