<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DefendidPengukurTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('defendid_pengukur')->delete();
        
        \DB::table('defendid_pengukur')->insert(array (
            0 => 
            array (
                'id_pengukur' => 1,
                'company_id' => 'PI',
                'jenis' => 1,
                'jabatan' => 'Risk Officer PT PAL INDONESIA',
                'nip' => NULL,
                'nama' => ' Risk Officer PT PAL INDONESIA',
                'status_pengukur' => 0,
            ),
            1 => 
            array (
                'id_pengukur' => 2,
                'company_id' => 'PI',
                'jenis' => 1,
                'jabatan' => 'Kepala Divisi TI',
                'nip' => '105194549',
                'nama' => 'Joko Suyono',
                'status_pengukur' => 0,
            ),
        ));
        
        
    }
}