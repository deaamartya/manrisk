<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMitigasiLogsModifyIsApprovedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mitigasi_logs', function (Blueprint $table) {
            $table->integer('is_approved')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mitigasi_logs', function (Blueprint $table) {
            $table->boolean('is_approved')->default(0)->change();
        });
    }
}
