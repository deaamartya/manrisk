<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PerusahaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('perusahaan')->delete();
        
        \DB::table('perusahaan')->insert(array (
            0 => 
            array (
                'company_id' => 1,
                'company_code' => 'PI',
                'instansi' => 'PT PAL INDONESIA (PERSERO)',
                'created_at' => now(),
                'updated_at' => now()
            ),
            1 => [ 
                'company_id' => 2,
                'company_code' => 'LN',
                'instansi' => 'PT. LEN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            2 => [ 
                'company_id' => 3,
                'company_code' => 'DI',
                'instansi' => 'PT. DIRGANTARA INDONESIA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            3 => [ 
                'company_id' => 4,
                'company_code' => 'DH',
                'instansi' => 'PT. DAHANA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            4 => [ 
                'company_id' => 5,
                'company_code' => 'PD',
                'instansi' => 'PT. PINDAD',
                'created_at' => now(),
                'updated_at' => now()
            ],
            5 => [ 
                'company_id' => 6,
                'company_code' => 'INHAN',
                'instansi' => 'INDUSTRI PERTAHANAN',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ));
    }
}
