<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDefendidUserAddIsAssessmentColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('defendid_user', function (Blueprint $table) {
            $table->boolean('is_assessment')->default(0)->after('is_admin')->comment('true jika dapat melakukan penilaian dan clone data ke defendid_pengukur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defendid_user', function (Blueprint $table) {
            $table->dropColumn('is_assessment');
        });
    }
}
