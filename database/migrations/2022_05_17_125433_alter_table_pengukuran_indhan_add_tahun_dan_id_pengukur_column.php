<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePengukuranIndhanAddTahunDanIdPengukurColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengukuran_indhan', function (Blueprint $table) {
            $table->integer('tahun_p')->after('id_p');
            $table->integer('id_pengukur')->after('id_s_risiko');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengukuran_indhan', function (Blueprint $table) {
            $table->dropColumn('tahun_p');
            $table->dropColumn('id_pengukur');
        });
    }
}
