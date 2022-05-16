<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRiskHeaderAddStatusHIndhanColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_header', function (Blueprint $table) {
            $table->integer('status_h_indhan')->after('status_h')->default(1);
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
            $table->dropColumn('status_h_indhan');
        });
    }
}
