<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PengajuanMitigasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_mitigasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_riskd');
            $table->foreign('id_riskd')->references('id_riskd')->on('risk_detail');
            $table->boolean('tipe_pengajuan')->comment('0 : tidak perlu mitigasi, 1: perlu mitigasi');
            $table->string('alasan');
            $table->boolean('is_approved')->default(0);
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
        Schema::dropIfExists('pengajuan_mitigasi');
    }
}
