<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProsesManriskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('proses_manrisks')->delete();
        
        \DB::table('proses_manrisks')->insert(array (
            0 => 
            array (
                'id_proses' => 1,
                'nama_proses' => 'Penentuan target/konteks sasaran',
                'created_at' => now(),
            ),
            1 => [ 
                'id_proses' => 2,
                'nama_proses' => 'Identifikasi risiko',
                'created_at' => now(),
            ],
            2 => [ 
                'id_proses' => 3,
                'nama_proses' => 'Penilaian/pengukuran risiko',
                'created_at' => now(),
            ],
            3 => [ 
                'id_proses' => 4,
                'nama_proses' => 'Analisa risiko',
                'created_at' => now(),
            ],
            4 => [ 
                'id_proses' => 5,
                'nama_proses' => 'Tindak lanjut mitigasi',
                'created_at' => now(),
            ],
            5 => [ 
                'id_proses' => 6,
                'nama_proses' => 'Pelaporan risiko',
                'created_at' => now(),
            ],
        ));
    }
}
