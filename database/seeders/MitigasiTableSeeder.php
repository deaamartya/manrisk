<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MitigasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mitigasi')->delete();
        
        \DB::table('mitigasi')->insert(array (
            0 => 
            array (
                'id_mitigasi' => 1,
                'id_riskd' => '1',
                'kat' => 'RIF',
                'risiko' => 'Masih menggunakan email server lama dengan kemampuan yang terbatas',
                'mitigasi' => 'Mengganti dengan email server baru menggunakan MS Exchange',
                'jadwal_pelaksanaan' => 'Akhir Juni 2018',
                'relisasi' => 'Penggantian email server dengan menggunakan MS Exchange sampai dengan progres 80%',
                'progress' => 72,
                'keterangan' => '',
                'ref' => '',
            ),
            1 => 
            array (
                'id_mitigasi' => 2,
                'id_riskd' => '2',
                'kat' => 'RIF',
                'risiko' => 'Sofware aplikasi di PAL banyak yang mensyaratkan penggunaan software/OS berlisesni, sedangkan pengadaan tidak bisa dilakukan dengan cepat',
                'mitigasi' => 'Sosialisasi dampak penggunaan software/OS ilegal melalui website',
                'jadwal_pelaksanaan' => 'Juli 2018',
                'relisasi' => 'Sosialisasi penggunaan software/ilegal , pengadaan PC yang disertai OS legal serta recruitment mencapai progres 50% dari target',
                'progress' => 72,
                'keterangan' => '',
                'ref' => '',
            ),
            2 => 
            array (
                'id_mitigasi' => 3,
                'id_riskd' => '',
                'kat' => 'RSD',
                'risiko' => 'Tidak tersedianya personil untuk meriset penggunaan software open source',
                'mitigasi' => ' Tiap pengadaan PC baru harus disertai OS legal;Recruitment periset open source',
                'jadwal_pelaksanaan' => 'Juli 2018',
                'relisasi' => 'Sosialisasi penggunaan software/ilegal , pengadaan PC yang disertai OS legal serta recruitment mencapai progres 50% dari target',
                'progress' => 72,
                'keterangan' => '',
                'ref' => '',
            ),
            3 => 
            array (
                'id_mitigasi' => 4,
                'id_riskd' => '',
                'kat' => 'RIF',
                'risiko' => 'Ketiga sistem aplikasi yang harus diintegrasikan adalah produk luar negeri dimana ada kendala terkait komunikasi jarak dan waktu',
                'mitigasi' => 'Problem solving maupun konsultasi secara online',
                'jadwal_pelaksanaan' => 'Sesuai kebutuhan',
                'relisasi' => 'Terlaksana',
                'progress' => 72,
                'keterangan' => '',
                'ref' => '',
            ),
            4 => 
            array (
                'id_mitigasi' => 5,
                'id_riskd' => '',
                'kat' => 'RIF',
                'risiko' => 'Minimnya waktu training yang diberikan oleh principal',
                'mitigasi' => 'Menggunakan mandays training hanya ketika dibutuhkan saja',
                'jadwal_pelaksanaan' => 'Sesuai kebutuhan',
                'relisasi' => 'Terlaksana',
                'progress' => 72,
                'keterangan' => '',
                'ref' => 'Memo',
            ),
            5 => 
            array (
                'id_mitigasi' => 6,
                'id_riskd' => '',
                'kat' => 'RIF',
                'risiko' => 'Tiap personil punya akses terhadap internet dan email address baik korporat maupun pribadi',
                'mitigasi' => 'Membatasi akses email hanya untuk keperluan korporat saja',
                'jadwal_pelaksanaan' => 'Akhir Juli 2018',
                'relisasi' => 'Progress 50% terlaksana',
                'progress' => 72,
                'keterangan' => '',
                'ref' => '',
            ),
            6 => 
            array (
                'id_mitigasi' => 7,
                'id_riskd' => '',
                'kat' => 'RIF',
                'risiko' => 'Personil masih banyak yang menggunakan flasdisk untuk transfer data',
                'mitigasi' => 'Menutup akses USB port untuk flashdisk baik secara hardware maupun policy melalui Active Directory',
                'jadwal_pelaksanaan' => 'Sesuai kebutuhan',
                'relisasi' => 'Progress 50% terlaksana',
                'progress' => 72,
                'keterangan' => '',
                'ref' => '',
            ),
            7 => 
            array (
                'id_mitigasi' => 8,
                'id_riskd' => '',
                'kat' => 'RIF',
                'risiko' => 'Munculnya layanan yang kurang memuaskan dari pihak lain yang mempengaruhi kualitas layanan TI',
                'mitigasi' => 'Memantau dan mengevaluasi kinerja layanan pihak luar',
                'jadwal_pelaksanaan' => 'Setiap Bulan ',
                'relisasi' => 'Progres 80%',
                'progress' => 72,
                'keterangan' => '',
                'ref' => '',
            ),
        ));
        
        
    }
}