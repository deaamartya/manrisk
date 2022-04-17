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
            $table->string('company_id', 5);
            $table->string('instansi', 200);
            $table->integer('kat_user');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->integer('status_user')->nullable();
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
