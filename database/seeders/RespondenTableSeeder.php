<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RespondenTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('responden')->delete();
        
        \DB::table('responden')->insert(array (
            0 => 
            array (
                'id_responden' => 2,
                'id_divisi' => 1,
                'nama_responden' => 'linda',
                'tanggal' => null,
            ),
            1 => 
            array (
                'id_responden' => 3,
                'id_divisi' => 1,
                'nama_responden' => 'll',
                'tanggal' => null,
            ),
            2 => 
            array (
                'id_responden' => 5,
                'id_divisi' => 1,
                'nama_responden' => 'dua',
                'tanggal' => '2020-04-10 20:23:05',
            ),
            3 => 
            array (
                'id_responden' => 6,
                'id_divisi' => 1,
                'nama_responden' => 'tiga',
                'tanggal' => '2020-04-10 22:05:18',
            ),
            4 => 
            array (
                'id_responden' => 7,
                'id_divisi' => 2,
                'nama_responden' => 'responden1',
                'tanggal' => '2020-04-14 18:09:03',
            ),
            5 => 
            array (
                'id_responden' => 8,
                'id_divisi' => 2,
                'nama_responden' => 'responden2',
                'tanggal' => '2020-04-14 18:10:07',
            ),
            6 => 
            array (
                'id_responden' => 10,
                'id_divisi' => 10,
                'nama_responden' => 'Wiyono Kumojoyo-Kadiv Supply Chain',
                'tanggal' => '2020-10-05 10:14:03',
            ),
            7 => 
            array (
                'id_responden' => 11,
                'id_divisi' => 10,
                'nama_responden' => 'Sutjipto-Kadep Rendal',
                'tanggal' => '2020-10-05 10:14:19',
            ),
            8 => 
            array (
                'id_responden' => 12,
                'id_divisi' => 10,
                'nama_responden' => 'Anang Sudi Ahmadi-Kadep Pengadaan Material',
                'tanggal' => '2020-10-05 10:14:40',
            ),
            9 => 
            array (
                'id_responden' => 13,
                'id_divisi' => 10,
                'nama_responden' => 'M. Khalili-Kadep Pengadaan Jasa',
                'tanggal' => '2020-10-05 10:15:06',
            ),
            10 => 
            array (
                'id_responden' => 14,
                'id_divisi' => 10,
                'nama_responden' => 'Ghesali-Kadep Pergudangan',
                'tanggal' => '2020-10-05 10:15:31',
            ),
            11 => 
            array (
                'id_responden' => 15,
                'id_divisi' => 10,
                'nama_responden' => 'Nani Ari Susanti-Risk Officer',
                'tanggal' => '2020-10-05 10:15:50',
            ),
            12 => 
            array (
                'id_responden' => 20,
                'id_divisi' => 17,
                'nama_responden' => 'Mashudi',
                'tanggal' => '2020-11-18 14:12:50',
            ),
            13 => 
            array (
                'id_responden' => 21,
                'id_divisi' => 13,
                'nama_responden' => 'Joko Suyono',
                'tanggal' => '2020-11-18 14:59:24',
            ),
            14 => 
            array (
                'id_responden' => 23,
                'id_divisi' => 24,
                'nama_responden' => 'Win',
                'tanggal' => '2021-02-16 15:25:55',
            ),
            15 => 
            array (
                'id_responden' => 24,
                'id_divisi' => 2,
                'nama_responden' => 'Adenandra S Hendrawan',
                'tanggal' => '2021-10-14 08:36:40',
            ),
            16 => 
            array (
                'id_responden' => 25,
                'id_divisi' => 27,
                'nama_responden' => 'Devina Dalilati Prabarini',
                'tanggal' => '2021-10-14 15:09:21',
            ),
            17 => 
            array (
                'id_responden' => 26,
                'id_divisi' => 27,
                'nama_responden' => 'Raden Andita Gunadarma',
                'tanggal' => '2021-10-14 15:10:13',
            ),
        ));
        
        
    }
}