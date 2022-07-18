<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiskDetailAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_detail', function (Blueprint $table) {
            $table->string('sasaran_kinerja')->after('tahun')->nullable();
            $table->integer('dampak_kuantitatif')->after('sebab')->nullable();
            $table->string('penilaian')->after('pengendalian')->nullable();
            $table->integer('dampak_kuantitatif_residu')->after('r_akhir')->nullable();
            $table->string('dampak_residu')->after('dampak_kuantitatif_residu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_detail', function (Blueprint $table) {
            $table->dropColumn('sasaran_kinerja')->after('tahun')->nullable();
            $table->dropColumn('dampak_kuantitatif')->after('sebab')->nullable();
            $table->dropColumn('penilaian')->after('pengendalian')->nullable();
            $table->dropColumn('dampak_kuantitatif_residu')->after('r_akhir')->nullable();
            $table->dropColumn('dampak_residu')->after('dampak_kuantitatif_residu')->nullable();
        });
    }
}
