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
            $table->integer('id_user');
            $table->unsignedInteger('company_id')->default(1);
            $table->foreign('company_id')->references('company_id')->on('perusahaan');
            $table->boolean('tipe_pengajuan')->comment('0 : tidak perlu mitigasi, 1: perlu mitigasi');
            $table->string('alasan')->nullable();
            $table->boolean('status')->comment('0 : menunggu jawaban admin, 1: sudah dijawab')->default(0);
            $table->boolean('is_approved')->comment('0 : ditolak, 1: disetujui')->default(0);
            $table->string('alasan_admin')->nullable();
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
