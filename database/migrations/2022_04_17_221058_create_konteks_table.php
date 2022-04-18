<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonteksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konteks', function (Blueprint $table) {
            $table->integer('id_konteks', true);
            $table->string('id_risk', 10)->nullable();
            $table->integer('no_k')->nullable();
            $table->text('konteks')->nullable();
            $table->string('tahun_konteks', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konteks');
    }
}
