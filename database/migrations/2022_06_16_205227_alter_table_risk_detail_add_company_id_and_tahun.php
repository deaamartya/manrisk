<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiskDetailAddCompanyIdAndTahun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_detail', function (Blueprint $table) {
            $table->UnsignedInteger('company_id')->after('id_s_risiko')->nullable();
            $table->integer('tahun')->after('company_id')->nullable();
            $table->foreign('company_id')->references('company_id')->on('perusahaan');
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
            $table->dropForeign('risk_detail_company_id_foreign');
            $table->dropColumn('company_id')->after('id_s_risiko')->nullable();
            $table->dropColumn('tahun')->after('company_id')->nullable();
        });
    }
}
