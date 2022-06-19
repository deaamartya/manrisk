<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiskHeaderDropPenyusunAndPemeriksa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_header', function (Blueprint $table) {
            $table->dropColumn('penyusun');
            $table->dropColumn('pemeriksa');
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
            $table->string('penyusun')->after('id_penyusun')->nullable();
            $table->string('pemeriksa')->after('id_pemeriksa')->nullable();
        });
    }
}
