<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiskHeaderAddIdPenyusunAndIdPemeriksa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_header', function (Blueprint $table) {
            $table->integer('id_penyusun')->after('penyusun')->nullable();
            $table->integer('id_pemeriksa')->after('pemeriksa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_header', function (Blueprint $table) {
            $table->dropColumn('id_penyusun');
            $table->dropColumn('id_pemeriksa');
        });
    }
}
