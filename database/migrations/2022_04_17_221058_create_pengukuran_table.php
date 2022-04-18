<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengukuranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengukuran', function (Blueprint $table) {
            $table->integer('id_p', true);
            $table->string('tahun_p', 5);
            $table->integer('id_s_risiko');
            $table->integer('id_pengukur');
            $table->string('nama_responden');
            $table->dateTime('tgl_penilaian')->useCurrent();
            $table->integer('nilai_L');
            $table->integer('nilai_C');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengukuran');
    }
}
