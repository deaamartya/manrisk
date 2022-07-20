<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiskDetailAddBiayaPenangananColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_detail', function (Blueprint $table) {
            $table->integer('biaya_penanganan')->after('dampak_residu')->nullable();
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
            $table->dropColumn('biaya_penanganan')->after('dampak_residu')->nullable();
        });
    }
}
