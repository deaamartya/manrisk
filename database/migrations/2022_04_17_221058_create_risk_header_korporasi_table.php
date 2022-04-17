<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskHeaderKorporasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_header_korporasi', function (Blueprint $table) {
            $table->integer('id_riskh', true);
            $table->integer('id_divisi');
            $table->string('tahun', 5);
            $table->dateTime('tanggal')->useCurrent();
            $table->text('target')->nullable();
            $table->string('penyusun', 100)->nullable();
            $table->string('pemeriksa', 100)->nullable();
            $table->string('lampiran', 200)->nullable();
            $table->integer('status_h')->nullable();
            $table->integer('deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_header_korporasi');
    }
}
