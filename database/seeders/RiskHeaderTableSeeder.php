<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiskHeaderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('risk_header')->delete();
        
        \DB::table('risk_header')->insert(array (
            0 => 
            array (
                'id_riskh' => 2,
                'id_user' => 1,
                'company_id' => 1,
                'tahun' => '2022',
                'tanggal' => '2021-11-05',
                'target' => '1. Sasaran Perusahaan KPI 2022 <br> 2. ',
                'id_penyusun' => 1,
                'id_pemeriksa' => 7,
                'lampiran' => NULL,
                'status_h' => 1,
                'status_h_indhan' => 0,
                'created_at' => NULL,
                'updated_at' => '2022-05-29 15:25:56',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id_riskh' => 3,
                'id_user' => 3,
                'company_id' => 1,
                'tahun' => '2022',
                'tanggal' => '2021-12-09',
                'target' => '1. Meningkatkan daya saing perusahaan <br> 2. Meningkatkan kepuasan pelanggan',
                'id_penyusun' => 1,
                'id_pemeriksa' => 7,
                'lampiran' => NULL,
                'status_h' => 0,
                'status_h_indhan' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id_riskh' => 5,
                'id_user' => 1,
                'company_id' => 1,
                'tahun' => '2022',
                'tanggal' => '2022-05-29',
                'target' => '1. Sasaran Perusahaan KPI 2022<br>2.',
                'id_penyusun' => 1,
                'id_pemeriksa' => 7,
                'lampiran' => NULL,
                'status_h' => 1,
                'status_h_indhan' => 0,
                'created_at' => '2022-05-29 14:33:39',
                'updated_at' => '2022-05-29 15:26:03',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}