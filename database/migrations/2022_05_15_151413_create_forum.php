<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->integer('id_user');
            $table->string('subject');
            $table->text('body');
            $table->boolean('display')->default(0)->comment('0 = private, 1 = public');
            $table->timestamps();
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
        Schema::dropIfExists('forum');
    }
}
