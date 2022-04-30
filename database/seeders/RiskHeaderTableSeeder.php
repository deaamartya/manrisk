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
                'tahun' => '2022',
                'tanggal' => '2021-11-05 15:20:38',
                'target' => '1. Sasaran Perusahaan KPI 2022 <br> 2. ',
                'penyusun' => 'Edi Riyanto',
                'pemeriksa' => 'Oggy Achmad Kosasi',
                'lampiran' => NULL,
                'status_h' => 0,
            ),
            1 => 
            array (
                'id_riskh' => 3,
                'id_user' => 3,
                'tahun' => '2022',
                'tanggal' => '2021-12-09 14:18:47',
                'target' => '1. Meningkatkan daya saing perusahaan <br> 2. Meningkatkan kepuasan pelanggan',
                'penyusun' => 'Person 1',
                'pemeriksa' => 'Person 2',
                'lampiran' => NULL,
                'status_h' => 0,
            ),
        ));
        
        
    }
}