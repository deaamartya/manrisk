<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDefendidPengukurSetJenis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('defendid_pengukur', function (Blueprint $table) {
            $table->integer('jenis')->default(0)->comment(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defendid_pengukur', function (Blueprint $table) {
            $table->integer('jenis')->default(1)->comment('saat ini tidak dipakai')->change();
        });
    }
}
