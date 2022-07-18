<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMitigasiAddBiayaPenangananColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mitigasi', function (Blueprint $table) {
            $table->integer('biaya_penanganan')->after('progress');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mitigasi', function (Blueprint $table) {
            $table->dropColumn('biaya_penanganan');
        });
    }
}
