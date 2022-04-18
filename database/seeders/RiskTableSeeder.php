<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiskTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('risk')->delete();
        
        \DB::table('risk')->insert(array (
            0 => 
            array (
                'id_risk' => 'RAP',
                'risk' => 'Risk Anti Penyuapan',
            ),
            1 => 
            array (
                'id_risk' => 'RBS',
                'risk' => 'Risk Bisnis dan Strategis',
            ),
            2 => 
            array (
                'id_risk' => 'RD',
                'risk' => 'Risiko Desain',
            ),
            3 => 
            array (
                'id_risk' => 'RE',
                'risk' => 'Risk Lingkungan',
            ),
            4 => 
            array (
                'id_risk' => 'RF',
                'risk' => 'Risk Fasilitas',
            ),
            5 => 
            array (
                'id_risk' => 'RHU',
                'risk' => 'Risk Hukum dan Umum',
            ),
            6 => 
            array (
                'id_risk' => 'RK',
                'risk' => 'Risk Keuangan',
            ),
            7 => 
            array (
                'id_risk' => 'RKK',
                'risk' => 'Risk K3 dan Keamanan',
            ),
            8 => 
            array (
                'id_risk' => 'RL',
                'risk' => 'Risk Logistik',
            ),
            9 => 
            array (
                'id_risk' => 'RP',
                'risk' => 'Risk Produksi',
            ),
            10 => 
            array (
                'id_risk' => 'RPP',
                'risk' => 'Risk Pemasaran dan Penjualan',
            ),
            11 => 
            array (
                'id_risk' => 'RSD',
                'risk' => 'Risk SDM',
            ),
            12 => 
            array (
                'id_risk' => 'RTI',
                'risk' => 'Risk Teknologi Informasi',
            ),
        ));
        
        
    }
}