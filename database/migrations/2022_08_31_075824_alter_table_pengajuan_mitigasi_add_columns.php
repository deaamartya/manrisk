<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePengajuanMitigasiAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuan_mitigasi', function (Blueprint $table) {
            $table->integer('arah_pengajuan')->after('tipe_pengajuan')->default(1)->comment('1: pengajuan pada admin, 2: pengajuan pada risk officer');
            $table->integer('id_responden')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuan_mitigasi', function (Blueprint $table) {
            $table->dropColumn('arah_pengajuan')->after('tipe_pengajuan');
            $table->dropColumn('id_responden')->after('status');
        });
    }
}
