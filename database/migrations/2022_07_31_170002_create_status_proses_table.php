<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_proses', function (Blueprint $table) {
            $table->integer('id_status_proses', true);
            $table->integer('tahun'); 
            $table->integer('id_proses');
            $table->timestamps();
            $table->foreign('id_proses')->references('id_proses')->on('proses_manrisks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_proses');
    }
}
