<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiskDetailIdRiskhNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_detail', function (Blueprint $table) {
            $table->integer('id_riskh')->unsigned()->nullable()->change();
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
            $table->integer('id_riskh')->unsigned()->nullable(false)->change();
        });
    }
}
