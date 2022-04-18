<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitigasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitigasi', function (Blueprint $table) {
            $table->integer('id_mitigasi', true);
            $table->string('id_riskd', 100);
            $table->string('kat', 100)->nullable();
            $table->text('risiko')->nullable();
            $table->text('mitigasi')->nullable();
            $table->string('jadwal_pelaksanaan', 500)->nullable();
            $table->text('relisasi')->nullable();
            $table->integer('progress')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('ref')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitigasi');
    }
}
