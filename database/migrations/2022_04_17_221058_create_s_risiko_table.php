<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSRisikoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_risiko', function (Blueprint $table) {
            $table->integer('id_s_risiko', true);
            $table->string('s_risiko', 500);
            $table->unsignedInteger('company_id')->default(1);
            $table->foreign('company_id')->references('company_id')->on('perusahaan');
            $table->string('id_konteks', 10)->nullable();
            $table->integer('id_user')->nullable();
            $table->string('tahun', 5)->nullable();
            $table->text('catatan')->nullable();
            $table->integer('status_s_risiko')->nullable();
            $table->integer('status_risk_indhan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_risiko');
    }
}
