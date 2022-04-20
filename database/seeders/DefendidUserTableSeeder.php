<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefendidUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('defendid_user')->delete();
        
        \DB::table('defendid_user')->insert(array (
            0 => 
            array (
                'id_user' => 1,
                'company_id' => 'PI',
            'instansi' => 'PT PAL INDONESIA (PERSERO)',
                'kat_user' => 1,
                'username' => 'ptpal',
                'password' => bcrypt('ptpal'),
                'status_user' => 0,
            ),
            1 => 
            array (
                'id_user' => 2,
                'company_id' => 'LN',
                'instansi' => 'PT. LEN',
                'kat_user' => 1,
                'username' => 'ptlen',
                'password' => bcrypt('ptlen'),
                'status_user' => 0,
            ),
            2 => 
            array (
                'id_user' => 3,
                'company_id' => 'DI',
                'instansi' => 'PT. DIRGANTARA INDONESIA',
                'kat_user' => 1,
                'username' => 'ptdi',
                'password' => bcrypt('ptdi'),
                'status_user' => 0,
            ),
            3 => 
            array (
                'id_user' => 4,
                'company_id' => 'DH',
                'instansi' => 'PT. DAHANA',
                'kat_user' => 1,
                'username' => 'ptdahana',
                'password' => bcrypt('ptdahana'),
                'status_user' => 0,
            ),
            4 => 
            array (
                'id_user' => 5,
                'company_id' => 'PD',
                'instansi' => 'PT. PINDAD',
                'kat_user' => 1,
                'username' => 'ptpindad',
                'password' => bcrypt('ptpindad'),
                'status_user' => 0,
            ),
            5 => 
            array (
                'id_user' => 6,
                'company_id' => 'INHAN',
                'instansi' => 'INDUSTRI PERTAHANAN',
                'kat_user' => 2,
                'username' => 'inhan',
                'password' => bcrypt('inhan'),
                'status_user' => 0,
            ),
        ));
        
        
    }
}