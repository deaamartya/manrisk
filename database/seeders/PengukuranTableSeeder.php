<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PengukuranTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengukuran')->delete();
        
        \DB::table('pengukuran')->insert(array (
            0 => 
            array (
                'id_p' => 23,
                'tahun_p' => '2022',
                'id_s_risiko' => 2,
                'id_pengukur' => 1,
                'nama_responden' => 'Risk Officer PT PAL INDONESIA',
                'tgl_penilaian' => '2021-11-05 15:17:50',
                'nilai_L' => 1,
                'nilai_C' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id_p' => 24,
                'tahun_p' => '2022',
                'id_s_risiko' => 3,
                'id_pengukur' => 1,
                'nama_responden' => 'Risk Officer PT PAL INDONESIA',
                'tgl_penilaian' => '2021-11-05 15:17:50',
                'nilai_L' => 2,
                'nilai_C' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id_p' => 25,
                'tahun_p' => '2022',
                'id_s_risiko' => 4,
                'id_pengukur' => 1,
                'nama_responden' => 'Risk Officer PT PAL INDONESIA',
                'tgl_penilaian' => '2021-11-05 15:17:50',
                'nilai_L' => 4,
                'nilai_C' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id_p' => 26,
                'tahun_p' => '2022',
                'id_s_risiko' => 2,
                'id_pengukur' => 2,
                'nama_responden' => 'Kepala Divisi TI',
                'tgl_penilaian' => '2022-04-08 22:37:43',
                'nilai_L' => 2,
                'nilai_C' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id_p' => 27,
                'tahun_p' => '2022',
                'id_s_risiko' => 3,
                'id_pengukur' => 2,
                'nama_responden' => 'Kepala Divisi TI',
                'tgl_penilaian' => '2022-04-08 22:37:43',
                'nilai_L' => 1,
                'nilai_C' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id_p' => 28,
                'tahun_p' => '2022',
                'id_s_risiko' => 4,
                'id_pengukur' => 2,
                'nama_responden' => 'Kepala Divisi TI',
                'tgl_penilaian' => '2022-04-08 22:37:43',
                'nilai_L' => 3,
                'nilai_C' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}