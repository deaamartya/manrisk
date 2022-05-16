<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSRisikoAddStatusSKorporasiColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('s_risiko', function (Blueprint $table) {
            $table->integer('status_korporasi')->after('status_s_risiko')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('s_risiko', function (Blueprint $table) {
            $table->dropColumn('status_korporasi');
        });
    }
}
