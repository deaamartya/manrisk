<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitigasiLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitigasi_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_riskd');
            $table->integer('id_user')->nullable();
            $table->integer('realisasi')->default(0);
            $table->string('dokumen')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('defendid_user');
            $table->foreign('id_riskd')->references('id_riskd')->on('risk_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitigasi_logs');
    }
}
