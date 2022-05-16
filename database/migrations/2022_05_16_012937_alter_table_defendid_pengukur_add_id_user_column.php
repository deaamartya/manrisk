<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDefendidPengukurAddIdUserColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('defendid_pengukur', function (Blueprint $table) {
            $table->integer('id_user')->after('company_id')->nullable();
            $table->foreign('id_user')->references('id_user')->on('defendid_user');
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
            $table->dropForeign('defendid_pengukur_id_user_foreign');
            $table->dropColumn('id_user');
        });
    }
}
