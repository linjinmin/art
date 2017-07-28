<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaintingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paintings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('关联用户id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('image_id')->index()->comment('图片id');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->unsignedInteger('painting_type_id')->comment('图片类型');
            $table->foreign('painting_type_id')->references('id')->on('painting_type')->onDelete('cascade');
            $table->string('title', 50)->comment('标题');
            $table->text('introduction')->comment('简介');
//            $table->string('url', 255)->comment('原图片路径');
//            $table->string('url_crop', 255)->comment('压缩图片路径');
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
        Schema::dropIfExists('paintings');
    }
}
