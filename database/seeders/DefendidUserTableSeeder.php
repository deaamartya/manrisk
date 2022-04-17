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
                'password' => '0eb3c0274ad9fd39d12785c7a85fc2ff',
                'status_user' => 0,
            ),
            1 => 
            array (
                'id_user' => 2,
                'company_id' => 'LN',
                'instansi' => 'PT. LEN',
                'kat_user' => 1,
                'username' => 'ptlen',
                'password' => 'b983a373f8e6e1228e0b1782b9137347',
                'status_user' => 0,
            ),
            2 => 
            array (
                'id_user' => 3,
                'company_id' => 'DI',
                'instansi' => 'PT. DIRGANTARA INDONESIA',
                'kat_user' => 1,
                'username' => 'ptdi',
                'password' => '095d08bc2cd1a7fecde712580e4b5dd5',
                'status_user' => 0,
            ),
            3 => 
            array (
                'id_user' => 4,
                'company_id' => 'DH',
                'instansi' => 'PT. DAHANA',
                'kat_user' => 1,
                'username' => 'ptdahana',
                'password' => '2d9ca5d247537adec975dafdde8ffc66',
                'status_user' => 0,
            ),
            4 => 
            array (
                'id_user' => 5,
                'company_id' => 'PD',
                'instansi' => 'PT. PINDAD',
                'kat_user' => 1,
                'username' => 'ptpindad',
                'password' => '1d77ded52be346de5a2df149a748ed7c',
                'status_user' => 0,
            ),
            5 => 
            array (
                'id_user' => 6,
                'company_id' => 'INHAN',
                'instansi' => 'INDUSTRI PERTAHANAN',
                'kat_user' => 2,
                'username' => 'inhan',
                'password' => '047210cc3826bb4d820789ba58268976',
                'status_user' => 0,
            ),
        ));
        
        
    }
}