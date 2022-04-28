<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefendidUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defendid_user', function (Blueprint $table) {
            $table->integer('id_user', true);
            $table->unsignedInteger('company_id');
            $table->string('username', 100);
            $table->string('password');
            $table->integer('status_user')->nullable();
            $table->boolean('is_risk_officer')->default(0);
            $table->boolean('is_penilai')->default(0);
            $table->boolean('is_penilai_indhan')->default(0);
            $table->boolean('is_risk_owner')->default(0);
            $table->boolean('is_admin')->default(0);
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
        Schema::dropIfExists('defendid_user');
    }
}
