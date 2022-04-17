<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_detail', function (Blueprint $table) {
            $table->integer('id_riskd', true);
            $table->integer('id_riskh');
            $table->integer('id_s_risiko');
            $table->text('ppkh')->nullable();
            $table->text('indikator')->nullable();
            $table->text('sebab')->nullable();
            $table->text('dampak')->nullable();
            $table->string('uc', 10)->nullable();
            $table->text('pengendalian')->nullable();
            $table->double('l_awal')->nullable();
            $table->double('c_awal')->nullable();
            $table->double('r_awal')->nullable();
            $table->text('peluang')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->text('jadwal')->nullable();
            $table->string('pic', 200)->nullable();
            $table->text('dokumen')->nullable();
            $table->text('mitigasi')->nullable();
            $table->date('jadwal_mitigasi')->nullable();
            $table->integer('realisasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->double('l_akhir')->nullable();
            $table->double('c_akhir')->nullable();
            $table->double('r_akhir')->nullable();
            $table->integer('status')->nullable();
            $table->string('u_file', 500)->nullable();
            $table->integer('status_mitigasi')->nullable();
            $table->integer('status_korporasi')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_detail');
    }
}
