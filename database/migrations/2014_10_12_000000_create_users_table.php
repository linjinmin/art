<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('image_id')->index()->comment('图片id/头像');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->enum('sex', [
                '男',
                '女',
                '保密'
            ])->default('保密')->comment('性别');
//            $table->string('avatar', 255)->default('/images/default.jpeg')->comment('头像路径');
            $table->string('nickname', 20)->default('-')->comment('微信昵称');
            $table->string('signature', 50)->nullable()->comment('个性签名');
            $table->enum('status', [
                '1',
                '0'
            ])->default('1')->comment('用户状态, 0->禁用, 1->有效');
            $table->string('last_login_ip', 100)->nullable()->default('0.0.0.0')->comment('最近登录ip');
            $table->enum('role', [
                'manager',
                'painer',
                'member'
            ])->default('member')->comment('用户角色, manager->超级管理员, painer->画家, member->会员');
            $table->string('remember_token', 100)->nullable()->comment('记住我');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
