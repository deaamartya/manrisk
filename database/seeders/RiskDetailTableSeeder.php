<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiskDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('risk_detail')->delete();
        
        \DB::table('risk_detail')->insert(array (
            0 => 
            array (
                'id_riskd' => 2,
                'id_riskh' => 2,
                'id_s_risiko' => 4,
                'ppkh' => 'RKAP 2022',
                'indikator' => 'Sales tidak tercapai',
                'sebab' => 'Keterlambatan Delivery',
                'dampak' => 'Reputasi perusahaan menurun terhadap pemegang saham',
                'uc' => 'C',
                'pengendalian' => 'Dilakukan koordinasi dengan divisi produksi dan marketing',
                'l_awal' => 4.0,
                'c_awal' => 4.0,
                'r_awal' => 16.0,
                'peluang' => 'Meningkatkan sadar risiko',
                'tindak_lanjut' => 'Inovasi produk',
                'jadwal' => 'Bulanan',
                'pic' => 'BOD',
                'dokumen' => 'Dokumen SO, PO,',
                'mitigasi' => 'Percepatan Delivery',
                'jadwal_mitigasi' => '2021-11-10',
                'realisasi' => NULL,
                'keterangan' => 'Kendala,1 2,3 ',
                'l_akhir' => 2.0,
                'c_akhir' => 2.0,
                'r_akhir' => 4.0,
                'status' => 1,
                'u_file' => 'mitigasi_2.pdf',
                'status_mitigasi' => NULL,
                'status_korporasi' => 0,
            ),
            1 => 
            array (
                'id_riskd' => 3,
                'id_riskh' => 2,
                'id_s_risiko' => 3,
                'ppkh' => 'Test Risiko Aman',
                'indikator' => 'Test Risiko Aman',
                'sebab' => 'Test Risiko Aman',
                'dampak' => 'Test Risiko Aman',
                'uc' => 'UC',
                'pengendalian' => 'Test Risiko Aman',
                'l_awal' => 2.0,
                'c_awal' => 1.0,
                'r_awal' => 2.0,
                'peluang' => 'Test Risiko Aman',
                'tindak_lanjut' => 'Test Risiko Aman',
                'jadwal' => 'Test Risiko Aman',
                'pic' => 'Test Risiko Aman',
                'dokumen' => 'Test Risiko Aman',
                'mitigasi' => NULL,
                'jadwal_mitigasi' => NULL,
                'realisasi' => NULL,
                'keterangan' => NULL,
                'l_akhir' => 2.0,
                'c_akhir' => 1.0,
                'r_akhir' => 2.0,
                'status' => 0,
                'u_file' => NULL,
                'status_mitigasi' => NULL,
                'status_korporasi' => 0,
            ),
            2 => 
            array (
                'id_riskd' => 4,
                'id_riskh' => 3,
                'id_s_risiko' => 5,
                'ppkh' => 'Risko Test 1 DI',
                'indikator' => 'Risko Test 1 DI',
                'sebab' => 'Risko Test 1 DI',
                'dampak' => 'Risko Test 1 DI',
                'uc' => 'C',
                'pengendalian' => 'Risko Test 1 DI',
                'l_awal' => 2.0,
                'c_awal' => 3.0,
                'r_awal' => 6.0,
                'peluang' => 'Risko Test 1 DI',
                'tindak_lanjut' => 'Risko Test 1 DI',
                'jadwal' => 'Bulan Januari',
                'pic' => 'Person 3',
                'dokumen' => 'Risko Test 1 DI',
                'mitigasi' => NULL,
                'jadwal_mitigasi' => NULL,
                'realisasi' => NULL,
                'keterangan' => NULL,
                'l_akhir' => 2.0,
                'c_akhir' => 3.0,
                'r_akhir' => 6.0,
                'status' => 0,
                'u_file' => NULL,
                'status_mitigasi' => NULL,
                'status_korporasi' => 0,
            ),
            3 => 
            array (
                'id_riskd' => 5,
                'id_riskh' => 3,
                'id_s_risiko' => 6,
                'ppkh' => 'Risko Test 2 DI',
                'indikator' => 'Risko Test 2 DI',
                'sebab' => 'Risko Test 2 DI',
                'dampak' => 'Risko Test 2 DI',
                'uc' => 'C',
                'pengendalian' => 'Risko Test 2 DI',
                'l_awal' => 4.0,
                'c_awal' => 5.0,
                'r_awal' => 20.0,
                'peluang' => 'Risko Test 2 DI',
                'tindak_lanjut' => 'Risko Test 2 DI',
                'jadwal' => 'Risko Test 2 DI',
                'pic' => 'Person 3',
                'dokumen' => 'Risko Test 2 DI',
                'mitigasi' => NULL,
                'jadwal_mitigasi' => NULL,
                'realisasi' => NULL,
                'keterangan' => NULL,
                'l_akhir' => 4.0,
                'c_akhir' => 5.0,
                'r_akhir' => 20.0,
                'status' => 1,
                'u_file' => NULL,
                'status_mitigasi' => NULL,
                'status_korporasi' => 0,
            ),
        ));
        
        
    }
}