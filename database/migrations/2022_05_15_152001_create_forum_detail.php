<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_detail', function (Blueprint $table) {
            $table->string('id_forum', 32);
            $table->integer('id_user');
            $table->text('body');
            $table->timestamps();
            $table->foreign('id_forum')->references('id')->on('forum');
            $table->foreign('id_user')->references('id_user')->on('defendid_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_detail');
    }
}
