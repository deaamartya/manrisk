<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivisiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('divisi')->delete();
        
        \DB::table('divisi')->insert(array (
            0 => 
            array (
                'id_divisi' => 1,
                'divisi' => 'Design',
                'username' => 'desain',
                'password' => 'desain',
                'kode_divisi' => '21000',
            ),
            1 => 
            array (
                'id_divisi' => 2,
                'divisi' => 'Kapal Niaga',
                'username' => 'kania',
                'password' => 'kania',
                'kode_divisi' => '22000',
            ),
            2 => 
            array (
                'id_divisi' => 3,
                'divisi' => 'Kapal Perang',
                'username' => 'kaprang',
                'password' => 'kaprang',
                'kode_divisi' => '23000',
            ),
            3 => 
            array (
                'id_divisi' => 4,
                'divisi' => 'Kapal Selam',
                'username' => 'kasel',
                'password' => 'kasel',
                'kode_divisi' => '24000',
            ),
            4 => 
            array (
                'id_divisi' => 5,
                'divisi' => 'Pemasaran & Penjualan Bangkap',
                'username' => 'sarjubangkap',
                'password' => 'sarjubangkap',
                'kode_divisi' => '25000',
            ),
            5 => 
            array (
                'id_divisi' => 6,
                'divisi' => 'Rekayasa Umum',
                'username' => 'rekum',
                'password' => 'rekum',
                'kode_divisi' => '31000',
            ),
            6 => 
            array (
                'id_divisi' => 7,
                'divisi' => 'Pemeliharaan & Perbaikan',
                'username' => 'harkan',
                'password' => 'harkan',
                'kode_divisi' => '32000',
            ),
            7 => 
            array (
                'id_divisi' => 8,
                'divisi' => 'Penjualan Rekumhar',
                'username' => 'prekum',
                'password' => 'prekum',
                'kode_divisi' => '33000',
            ),
            8 => 
            array (
                'id_divisi' => 9,
                'divisi' => 'Jaminan Kualitas',
                'username' => 'jamku',
                'password' => 'jamku',
                'kode_divisi' => '34000',
            ),
            9 => 
            array (
                'id_divisi' => 10,
                'divisi' => 'Supply Chain',
                'username' => 'supplychain',
                'password' => 'supplychain',
                'kode_divisi' => '35000',
            ),
            10 => 
            array (
                'id_divisi' => 11,
                'divisi' => 'Perbendaharaan',
                'username' => 'bendahara',
                'password' => 'bendahara',
                'kode_divisi' => '41000',
            ),
            11 => 
            array (
                'id_divisi' => 12,
                'divisi' => 'Akuntansi',
                'username' => 'akuntansi',
                'password' => 'akuntansi',
                'kode_divisi' => '42000',
            ),
            12 => 
            array (
                'id_divisi' => 13,
                'divisi' => 'Teknologi Informasi',
                'username' => 'divti',
                'password' => 'divti',
                'kode_divisi' => '43000',
            ),
            13 => 
            array (
                'id_divisi' => 14,
                'divisi' => 'HCM & Command Media',
                'username' => 'hcm',
                'password' => 'hcm',
                'kode_divisi' => '51000',
            ),
            14 => 
            array (
                'id_divisi' => 15,
                'divisi' => 'Kawasan',
                'username' => 'kawasan',
                'password' => 'kawasan',
                'kode_divisi' => '52000',
            ),
            15 => 
            array (
                'id_divisi' => 16,
                'divisi' => 'Kamtib & K3LH',
                'username' => 'k3lh',
                'password' => 'k3lh',
                'kode_divisi' => '14000',
            ),
            16 => 
            array (
                'id_divisi' => 17,
                'divisi' => 'Naval & Teknologi',
                'username' => 'navtek',
                'password' => 'navtek',
                'kode_divisi' => '61000',
            ),
            17 => 
            array (
                'id_divisi' => 18,
                'divisi' => 'Satuan Pengawasan Intern',
                'username' => 'spi',
                'password' => 'spi',
                'kode_divisi' => '12000',
            ),
            18 => 
            array (
                'id_divisi' => 19,
                'divisi' => 'Sekertaris Perusahaan',
                'username' => 'sekper',
                'password' => 'sekper',
                'kode_divisi' => '11000',
            ),
            19 => 
            array (
                'id_divisi' => 20,
                'divisi' => 'Perencanaan Strategis Perusahaan',
                'username' => 'psp',
                'password' => 'manrisk123',
                'kode_divisi' => '44000',
            ),
            20 => 
            array (
                'id_divisi' => 21,
                'divisi' => 'Korporasi',
                'username' => 'korporasi',
                'password' => 'korporasi',
                'kode_divisi' => '',
            ),
            21 => 
            array (
                'id_divisi' => 27,
                'divisi' => 'TJSL',
                'username' => 'tjsl',
                'password' => 'tjsl',
                'kode_divisi' => '5A000',
            ),
        ));
        
        
    }
}