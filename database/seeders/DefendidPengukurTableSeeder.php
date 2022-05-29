<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'company_id' => '1',
                'id_user' => 1,
                'jabatan' => 'Risk Officer PT PAL INDONESIA',
                'nip' => NULL,
                'nama' => ' Risk Officer PT PAL INDONESIA',
                'status_pengukur' => 0,
                'jenis' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id_pengukur' => 2,
                'company_id' => '1',
                'id_user' => 7,
                'jabatan' => 'Kepala Divisi TI',
                'nip' => '105194549',
                'nama' => 'Kepala Divisi TI',
                'status_pengukur' => 0,
                'jenis' => 1,
                'created_at' => NULL,
                'updated_at' => '2022-05-29 15:12:43',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id_pengukur' => 4,
                'company_id' => '1',
                'id_user' => 9,
                'jabatan' => 'Kepala Departemen A',
                'nip' => '151811513048',
                'nama' => 'RiskOwner1',
                'status_pengukur' => 0,
                'jenis' => 1,
                'created_at' => '2022-05-29 04:07:07',
                'updated_at' => '2022-05-29 04:07:07',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}