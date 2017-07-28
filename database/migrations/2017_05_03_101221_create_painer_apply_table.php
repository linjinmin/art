<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePainerApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('painer_apply', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('用户id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('image_id')->index()->comment('图片id');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->text('describe')->nullable()->comment('自己的描述');
//            $table->string('url')->comment('图片路径');
            $table->enum('status', [
                '等待',
                '通过',
                '拒绝'
            ])->default('等待');
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
        Schema::dropIfExists('painer_apply');
    }
}
