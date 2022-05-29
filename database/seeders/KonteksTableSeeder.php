<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KonteksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('konteks')->delete();
        
        \DB::table('konteks')->insert(array (
            0 => 
            array (
                'id_konteks' => 1,
                'id_risk' => 'RD',
                'no_k' => 1,
                'konteks' => 'Fasilitas Teknologi dan Peralatan Utama (Infrastruktur)',
                'tahun_konteks' => '2022',
            ),
            1 => 
            array (
                'id_konteks' => 2,
                'id_risk' => 'RD',
                'no_k' => 2,
                'konteks' => 'Segmen Pasar Utama',
                'tahun_konteks' => '2022',
            ),
            2 => 
            array (
                'id_konteks' => 3,
                'id_risk' => 'RD',
                'no_k' => 3,
                'konteks' => 'Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            3 => 
            array (
                'id_konteks' => 4,
                'id_risk' => 'RD',
                'no_k' => 4,
                'konteks' => 'Persyaratan & Harapan Pelanggan / stake holder',
                'tahun_konteks' => '2022',
            ),
            4 => 
            array (
                'id_konteks' => 5,
                'id_risk' => 'RD',
                'no_k' => 5,
                'konteks' => 'Perbedaan Persyaratan & Harapan Pelanggan',
                'tahun_konteks' => '2022',
            ),
            5 => 
            array (
                'id_konteks' => 6,
                'id_risk' => 'RD',
                'no_k' => 6,
                'konteks' => 'Tipe Pemasok & Partner',
                'tahun_konteks' => '2022',
            ),
            6 => 
            array (
                'id_konteks' => 7,
                'id_risk' => 'RD',
                'no_k' => 7,
                'konteks' => 'Persyaratan & harapan pemangku kepentingan',
                'tahun_konteks' => '2022',
            ),
            7 => 
            array (
                'id_konteks' => 8,
                'id_risk' => 'RD',
                'no_k' => 8,
                'konteks' => 'Persyaratan Key Supply Chain',
                'tahun_konteks' => '2022',
            ),
            8 => 
            array (
                'id_konteks' => 9,
                'id_risk' => 'RD',
                'no_k' => 9,
                'konteks' => 'Posisi Kompotitive dan Market Share',
                'tahun_konteks' => '2022',
            ),
            9 => 
            array (
                'id_konteks' => 10,
                'id_risk' => 'RD',
                'no_k' => 10,
                'konteks' => 'Tantangan Strategis',
                'tahun_konteks' => '2022',
            ),
            10 => 
            array (
                'id_konteks' => 11,
                'id_risk' => 'RD',
                'no_k' => 11,
                'konteks' => 'Keunggulan Strategis',
                'tahun_konteks' => '2022',
            ),
            11 => 
            array (
                'id_konteks' => 12,
                'id_risk' => 'RD',
                'no_k' => 12,
                'konteks' => 'Business Process',
                'tahun_konteks' => '2022',
            ),
            12 => 
            array (
                'id_konteks' => 13,
                'id_risk' => 'RD',
                'no_k' => 13,
                'konteks' => 'Quality Objective & KPI Korporat',
                'tahun_konteks' => '2022',
            ),
            13 => 
            array (
                'id_konteks' => 14,
                'id_risk' => 'RL',
                'no_k' => 1,
            'konteks' => 'Fasilitas Teknologi dan Peralatan Utama (Infrastruktur)',
                'tahun_konteks' => '2022',
            ),
            14 => 
            array (
                'id_konteks' => 15,
                'id_risk' => 'RL',
                'no_k' => 2,
                'konteks' => 'Segmen Pasar Utama',
                'tahun_konteks' => '2022',
            ),
            15 => 
            array (
                'id_konteks' => 16,
                'id_risk' => 'RL',
                'no_k' => 3,
                'konteks' => 'Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            16 => 
            array (
                'id_konteks' => 17,
                'id_risk' => 'RL',
                'no_k' => 4,
                'konteks' => 'Persyaratan & Harapan Pelanggan / stake holder',
                'tahun_konteks' => '2022',
            ),
            17 => 
            array (
                'id_konteks' => 18,
                'id_risk' => 'RL',
                'no_k' => 5,
                'konteks' => 'Perbedaan Persyaratan & Harapan Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            18 => 
            array (
                'id_konteks' => 19,
                'id_risk' => 'RL',
                'no_k' => 6,
                'konteks' => 'Persyaratan Key Supply Chain',
                'tahun_konteks' => '2022',
            ),
            19 => 
            array (
                'id_konteks' => 20,
                'id_risk' => 'RL',
                'no_k' => 7,
                'konteks' => 'Posisi Kompotitive dan Market Share',
                'tahun_konteks' => '2022',
            ),
            20 => 
            array (
                'id_konteks' => 21,
                'id_risk' => 'RL',
                'no_k' => 8,
                'konteks' => 'Tantangan Strategis',
                'tahun_konteks' => '2022',
            ),
            21 => 
            array (
                'id_konteks' => 22,
                'id_risk' => 'RL',
                'no_k' => 9,
                'konteks' => 'Keunggulan Strategis',
                'tahun_konteks' => '2022',
            ),
            22 => 
            array (
                'id_konteks' => 23,
                'id_risk' => 'RL',
                'no_k' => 10,
                'konteks' => 'Business Process',
                'tahun_konteks' => '2022',
            ),
            23 => 
            array (
                'id_konteks' => 24,
                'id_risk' => 'RL',
                'no_k' => 11,
                'konteks' => 'Quality Objective & KPI Korporat',
                'tahun_konteks' => '2022',
            ),
            24 => 
            array (
                'id_konteks' => 25,
                'id_risk' => 'RPP',
                'no_k' => 1,
                'konteks' => 'Segmen Pasar Utama',
                'tahun_konteks' => '2022',
            ),
            25 => 
            array (
                'id_konteks' => 26,
                'id_risk' => 'RPP',
                'no_k' => 2,
                'konteks' => 'Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            26 => 
            array (
                'id_konteks' => 27,
                'id_risk' => 'RPP',
                'no_k' => 3,
                'konteks' => 'Persyaratan & Harapan Pelanggan / stake holder',
                'tahun_konteks' => '2022',
            ),
            27 => 
            array (
                'id_konteks' => 28,
                'id_risk' => 'RPP',
                'no_k' => 4,
                'konteks' => 'Perbedaan Persyaratan & Harapan Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            28 => 
            array (
                'id_konteks' => 29,
                'id_risk' => 'RPP',
                'no_k' => 5,
                'konteks' => 'Persyaratan & harapan pemangku kepentingan',
                'tahun_konteks' => '2022',
            ),
            29 => 
            array (
                'id_konteks' => 30,
                'id_risk' => 'RPP',
                'no_k' => 6,
                'konteks' => 'Posisi Kompotitive dan Market Share',
                'tahun_konteks' => '2022',
            ),
            30 => 
            array (
                'id_konteks' => 31,
                'id_risk' => 'RPP',
                'no_k' => 7,
                'konteks' => 'Tantangan Strategis',
                'tahun_konteks' => '2022',
            ),
            31 => 
            array (
                'id_konteks' => 32,
                'id_risk' => 'RPP',
                'no_k' => 8,
                'konteks' => 'Keunggulan Strategis',
                'tahun_konteks' => '2022',
            ),
            32 => 
            array (
                'id_konteks' => 33,
                'id_risk' => 'RPP',
                'no_k' => 9,
                'konteks' => 'Business Process',
                'tahun_konteks' => '2022',
            ),
            33 => 
            array (
                'id_konteks' => 34,
                'id_risk' => 'RPP',
                'no_k' => 10,
                'konteks' => 'Quality Objective & KPI Korporat',
                'tahun_konteks' => '2022',
            ),
            34 => 
            array (
                'id_konteks' => 35,
                'id_risk' => 'RBS',
                'no_k' => 0,
            'konteks' => 'Tingkat Relatif Penting Produk (Target Penjualan / Sales)',
                'tahun_konteks' => '2022',
            ),
            35 => 
            array (
                'id_konteks' => 36,
                'id_risk' => 'RBS',
                'no_k' => 0,
            'konteks' => 'Core Competensi, Future Core Competensi (Kompetensi Karyawan)',
                'tahun_konteks' => '2022',
            ),
            36 => 
            array (
                'id_konteks' => 37,
                'id_risk' => 'RBS',
                'no_k' => 0,
            'konteks' => 'Profil tenaga kerja (Jumlah Pensiun MPP Pendidikan)',
                'tahun_konteks' => '2022',
            ),
            37 => 
            array (
                'id_konteks' => 38,
                'id_risk' => 'RBS',
                'no_k' => 0,
            'konteks' => 'Faktor Utama yang mempengaruhi Keterikatan Tenaga Kerja (Engagement)',
                'tahun_konteks' => '2022',
            ),
            38 => 
            array (
                'id_konteks' => 39,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Serikat Pekerja',
                'tahun_konteks' => '2022',
            ),
            39 => 
            array (
                'id_konteks' => 40,
                'id_risk' => 'RBS',
                'no_k' => 0,
            'konteks' => 'Persyaratan khusus terkait dengan Kesehatan dan Keselamatan Kerja (HSE)',
                'tahun_konteks' => '2022',
            ),
            40 => 
            array (
                'id_konteks' => 41,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Struktur Organisasi',
                'tahun_konteks' => '2022',
            ),
            41 => 
            array (
                'id_konteks' => 42,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Tata Kelola Perusahaan',
                'tahun_konteks' => '2022',
            ),
            42 => 
            array (
                'id_konteks' => 43,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Segmen Pasar Utama',
                'tahun_konteks' => '2022',
            ),
            43 => 
            array (
                'id_konteks' => 44,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            44 => 
            array (
                'id_konteks' => 45,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Persyaratan & Harapan Pelanggan / stake holder',
                'tahun_konteks' => '2022',
            ),
            45 => 
            array (
                'id_konteks' => 46,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Perbedaan Persyaratan & Harapan Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            46 => 
            array (
                'id_konteks' => 47,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Persyaratan & harapan pemangku kepentingan',
                'tahun_konteks' => '2022',
            ),
            47 => 
            array (
                'id_konteks' => 48,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Posisi Kompotitive dan Market Share',
                'tahun_konteks' => '2022',
            ),
            48 => 
            array (
                'id_konteks' => 49,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Tantangan Strategis',
                'tahun_konteks' => '2022',
            ),
            49 => 
            array (
                'id_konteks' => 50,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Keunggulan Strategis',
                'tahun_konteks' => '2022',
            ),
            50 => 
            array (
                'id_konteks' => 51,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Financial',
                'tahun_konteks' => '2022',
            ),
            51 => 
            array (
                'id_konteks' => 52,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Business Process',
                'tahun_konteks' => '2022',
            ),
            52 => 
            array (
                'id_konteks' => 53,
                'id_risk' => 'RBS',
                'no_k' => 0,
                'konteks' => 'Quality Objective & KPI Korporat',
                'tahun_konteks' => '2022',
            ),
            53 => 
            array (
                'id_konteks' => 54,
                'id_risk' => 'RP',
                'no_k' => 0,
            'konteks' => 'Profil tenaga kerja (Jumlah Pensiun, MPP, Pendidikan)',
                'tahun_konteks' => '2022',
            ),
            54 => 
            array (
                'id_konteks' => 55,
                'id_risk' => 'RP',
                'no_k' => 0,
            'konteks' => 'Fasilitas Teknologi dan Peralatan Utama (Infrastruktur)',
                'tahun_konteks' => '2022',
            ),
            55 => 
            array (
                'id_konteks' => 56,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Segmen Pasar Utama',
                'tahun_konteks' => '2022',
            ),
            56 => 
            array (
                'id_konteks' => 57,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            57 => 
            array (
                'id_konteks' => 58,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Persyaratan & Harapan Pelanggan / stake holder',
                'tahun_konteks' => '2022',
            ),
            58 => 
            array (
                'id_konteks' => 59,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Perbedaan Persyaratan & Harapan Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            59 => 
            array (
                'id_konteks' => 60,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Persyaratan & harapan pemangku kepentingan',
                'tahun_konteks' => '2022',
            ),
            60 => 
            array (
                'id_konteks' => 61,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Tantangan Strategis',
                'tahun_konteks' => '2022',
            ),
            61 => 
            array (
                'id_konteks' => 62,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Keunggulan Strategis',
                'tahun_konteks' => '2022',
            ),
            62 => 
            array (
                'id_konteks' => 63,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Business Process',
                'tahun_konteks' => '2022',
            ),
            63 => 
            array (
                'id_konteks' => 64,
                'id_risk' => 'RP',
                'no_k' => 0,
                'konteks' => 'Quality Objective & KPI Korporat',
                'tahun_konteks' => '2022',
            ),
            64 => 
            array (
                'id_konteks' => 65,
                'id_risk' => 'RSD',
                'no_k' => 0,
            'konteks' => 'Core Competensi, Future Core Competensi (Kompetensi Karyawan)',
                'tahun_konteks' => '2022',
            ),
            65 => 
            array (
                'id_konteks' => 66,
                'id_risk' => 'RSD',
                'no_k' => 0,
            'konteks' => 'Profil tenaga kerja (Jumlah Pensiun MPP Pendidikan)',
                'tahun_konteks' => '2022',
            ),
            66 => 
            array (
                'id_konteks' => 67,
                'id_risk' => 'RSD',
                'no_k' => 0,
            'konteks' => 'Faktor Utama yang mempengaruhi Keterikatan Tenaga Kerja (Engagement)',
                'tahun_konteks' => '2022',
            ),
            67 => 
            array (
                'id_konteks' => 68,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Serikat Pekerja',
                'tahun_konteks' => '2022',
            ),
            68 => 
            array (
                'id_konteks' => 69,
                'id_risk' => 'RSD',
                'no_k' => 0,
            'konteks' => 'Persyaratan khusus terkait dengan Kesehatan dan Keselamatan Kerja (HSE)',
                'tahun_konteks' => '2022',
            ),
            69 => 
            array (
                'id_konteks' => 70,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Segmen Pasar Utama',
                'tahun_konteks' => '2022',
            ),
            70 => 
            array (
                'id_konteks' => 71,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            71 => 
            array (
                'id_konteks' => 72,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Persyaratan & Harapan Pelanggan / stake holder',
                'tahun_konteks' => '2022',
            ),
            72 => 
            array (
                'id_konteks' => 73,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Perbedaan Persyaratan & Harapan Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            73 => 
            array (
                'id_konteks' => 74,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Tipe Pemasok & Partner',
                'tahun_konteks' => '2022',
            ),
            74 => 
            array (
                'id_konteks' => 75,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Persyaratan & harapan pemangku kepentingan',
                'tahun_konteks' => '2022',
            ),
            75 => 
            array (
                'id_konteks' => 76,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Posisi Kompotitive dan Market Share',
                'tahun_konteks' => '2022',
            ),
            76 => 
            array (
                'id_konteks' => 77,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Tantangan Strategis',
                'tahun_konteks' => '2022',
            ),
            77 => 
            array (
                'id_konteks' => 78,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Keunggulan Strategis',
                'tahun_konteks' => '2022',
            ),
            78 => 
            array (
                'id_konteks' => 79,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Business Process',
                'tahun_konteks' => '2022',
            ),
            79 => 
            array (
                'id_konteks' => 80,
                'id_risk' => 'RSD',
                'no_k' => 0,
                'konteks' => 'Quality Objective & KPI Korporat',
                'tahun_konteks' => '2022',
            ),
            80 => 
            array (
                'id_konteks' => 81,
                'id_risk' => 'RF',
                'no_k' => 0,
            'konteks' => 'Fasilitas, Teknologi dan Peralatan Utama (Infrastruktur)',
                'tahun_konteks' => '2022',
            ),
            81 => 
            array (
                'id_konteks' => 82,
                'id_risk' => 'RF',
                'no_k' => 0,
                'konteks' => 'Tipe Pemasok & Partner',
                'tahun_konteks' => '2022',
            ),
            82 => 
            array (
                'id_konteks' => 83,
                'id_risk' => 'RF',
                'no_k' => 0,
                'konteks' => 'Persyaratan Key Supply Chain',
                'tahun_konteks' => '2022',
            ),
            83 => 
            array (
                'id_konteks' => 84,
                'id_risk' => 'RHU',
                'no_k' => 0,
            'konteks' => 'Tingkat Relatif Penting Produk (Target Penjualan / Sales)',
                'tahun_konteks' => '2022',
            ),
            84 => 
            array (
                'id_konteks' => 85,
                'id_risk' => 'RHU',
                'no_k' => 0,
            'konteks' => 'Core Competensi, Future Core Competensi (Kompetensi Karyawan)',
                'tahun_konteks' => '2022',
            ),
            85 => 
            array (
                'id_konteks' => 86,
                'id_risk' => 'RHU',
                'no_k' => 0,
            'konteks' => 'Profil tenaga kerja (Jumlah Pensiun MPP Pendidikan)',
                'tahun_konteks' => '2022',
            ),
            86 => 
            array (
                'id_konteks' => 87,
                'id_risk' => 'RHU',
                'no_k' => 0,
            'konteks' => 'Persyaratan khusus terkait dengan Kesehatan dan Keselamatan Kerja (HSE)',
                'tahun_konteks' => '2022',
            ),
            87 => 
            array (
                'id_konteks' => 88,
                'id_risk' => 'RHU',
                'no_k' => 0,
            'konteks' => 'Peraturan & Perundangan (Regulasi) Internal & Eksternal',
                'tahun_konteks' => '2022',
            ),
            88 => 
            array (
                'id_konteks' => 89,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Struktur Organisasi',
                'tahun_konteks' => '2022',
            ),
            89 => 
            array (
                'id_konteks' => 90,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Tata Kelola Perusahaan',
                'tahun_konteks' => '2022',
            ),
            90 => 
            array (
                'id_konteks' => 91,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Segmen Pasar Utama',
                'tahun_konteks' => '2022',
            ),
            91 => 
            array (
                'id_konteks' => 92,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            92 => 
            array (
                'id_konteks' => 93,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Persyaratan & Harapan Pelanggan / stake holder',
                'tahun_konteks' => '2022',
            ),
            93 => 
            array (
                'id_konteks' => 94,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Perbedaan Persyaratan & Harapan Pelanggan ',
                'tahun_konteks' => '2022',
            ),
            94 => 
            array (
                'id_konteks' => 95,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Tipe Pemasok & Partner',
                'tahun_konteks' => '2022',
            ),
            95 => 
            array (
                'id_konteks' => 96,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Persyaratan & harapan pemangku kepentingan',
                'tahun_konteks' => '2022',
            ),
            96 => 
            array (
                'id_konteks' => 97,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Posisi Kompotitive dan Market Share',
                'tahun_konteks' => '2022',
            ),
            97 => 
            array (
                'id_konteks' => 98,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Tantangan Strategis',
                'tahun_konteks' => '2022',
            ),
            98 => 
            array (
                'id_konteks' => 99,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Keunggulan Strategis',
                'tahun_konteks' => '2022',
            ),
            99 => 
            array (
                'id_konteks' => 100,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Business Process',
                'tahun_konteks' => '2022',
            ),
            100 => 
            array (
                'id_konteks' => 101,
                'id_risk' => 'RHU',
                'no_k' => 0,
                'konteks' => 'Quality Objective & KPI Korporat',
                'tahun_konteks' => '2022',
            ),
            101 => 
            array (
                'id_konteks' => 102,
                'id_risk' => 'RIF',
                'no_k' => 0,
                'konteks' => 'Teknologi Informasi',
                'tahun_konteks' => '2022',
            ),
            102 => 
            array (
                'id_konteks' => 103,
                'id_risk' => 'RK',
                'no_k' => 0,
                'konteks' => 'Peraturan Perundangan',
                'tahun_konteks' => '2022',
            ),
            103 => 
            array (
                'id_konteks' => 104,
                'id_risk' => 'RK',
                'no_k' => 0,
                'konteks' => 'Harapan Pemangku Kepentingan',
                'tahun_konteks' => '2022',
            ),
            104 => 
            array (
                'id_konteks' => 105,
                'id_risk' => 'RK',
                'no_k' => 0,
                'konteks' => 'Tata Kelola',
                'tahun_konteks' => '2022',
            ),
            105 => 
            array (
                'id_konteks' => 106,
                'id_risk' => 'RK',
                'no_k' => 0,
                'konteks' => 'Finance',
                'tahun_konteks' => '2022',
            ),
            106 => 
            array (
                'id_konteks' => 107,
                'id_risk' => 'RL',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            107 => 
            array (
                'id_konteks' => 108,
                'id_risk' => 'RL',
                'no_k' => 2,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            108 => 
            array (
                'id_konteks' => 109,
                'id_risk' => 'RL',
                'no_k' => 3,
                'konteks' => 'Strategic',
                'tahun_konteks' => '2021',
            ),
            109 => 
            array (
                'id_konteks' => 110,
                'id_risk' => 'RL',
                'no_k' => 4,
                'konteks' => 'Financial',
                'tahun_konteks' => '2021',
            ),
            110 => 
            array (
                'id_konteks' => 111,
                'id_risk' => 'RL',
                'no_k' => 5,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            111 => 
            array (
                'id_konteks' => 112,
                'id_risk' => 'RL',
                'no_k' => 6,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            112 => 
            array (
                'id_konteks' => 113,
                'id_risk' => 'RL',
                'no_k' => 7,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            113 => 
            array (
                'id_konteks' => 114,
                'id_risk' => 'RPP',
                'no_k' => 1,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            114 => 
            array (
                'id_konteks' => 115,
                'id_risk' => 'RPP',
                'no_k' => 2,
                'konteks' => 'Strategic',
                'tahun_konteks' => '2021',
            ),
            115 => 
            array (
                'id_konteks' => 116,
                'id_risk' => 'RPP',
                'no_k' => 3,
                'konteks' => 'Financial',
                'tahun_konteks' => '2021',
            ),
            116 => 
            array (
                'id_konteks' => 117,
                'id_risk' => 'RPP',
                'no_k' => 4,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            117 => 
            array (
                'id_konteks' => 118,
                'id_risk' => 'RBS',
                'no_k' => 1,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            118 => 
            array (
                'id_konteks' => 119,
                'id_risk' => 'RBS',
                'no_k' => 2,
                'konteks' => 'Governance/Tata Kelola Organisasi',
                'tahun_konteks' => '2021',
            ),
            119 => 
            array (
                'id_konteks' => 120,
                'id_risk' => 'RBS',
                'no_k' => 3,
                'konteks' => 'Pengawasan, Pengendalian Internal/Eksternal',
                'tahun_konteks' => '2021',
            ),
            120 => 
            array (
                'id_konteks' => 121,
                'id_risk' => 'RBS',
                'no_k' => 4,
                'konteks' => 'HSE',
                'tahun_konteks' => '2021',
            ),
            121 => 
            array (
                'id_konteks' => 122,
                'id_risk' => 'RBS',
                'no_k' => 5,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            122 => 
            array (
                'id_konteks' => 123,
                'id_risk' => 'RBS',
                'no_k' => 6,
                'konteks' => 'Legal/Compliance',
                'tahun_konteks' => '2021',
            ),
            123 => 
            array (
                'id_konteks' => 124,
                'id_risk' => 'RBS',
                'no_k' => 7,
                'konteks' => 'Strategic',
                'tahun_konteks' => '2021',
            ),
            124 => 
            array (
                'id_konteks' => 125,
                'id_risk' => 'RBS',
                'no_k' => 8,
            'konteks' => 'Komunikasi (Internal/Eksternal)',
                'tahun_konteks' => '2021',
            ),
            125 => 
            array (
                'id_konteks' => 126,
                'id_risk' => 'RBS',
                'no_k' => 9,
                'konteks' => 'Budaya Organisasi',
                'tahun_konteks' => '2021',
            ),
            126 => 
            array (
                'id_konteks' => 127,
                'id_risk' => 'RBS',
                'no_k' => 10,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            127 => 
            array (
                'id_konteks' => 128,
                'id_risk' => 'RP',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            128 => 
            array (
                'id_konteks' => 129,
                'id_risk' => 'RP',
                'no_k' => 2,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            129 => 
            array (
                'id_konteks' => 130,
                'id_risk' => 'RP',
                'no_k' => 3,
                'konteks' => 'Governance/Tata Kelola Organisasi',
                'tahun_konteks' => '2021',
            ),
            130 => 
            array (
                'id_konteks' => 131,
                'id_risk' => 'RP',
                'no_k' => 4,
                'konteks' => 'Pengawasan, Pengendalian Internal/Eksternal',
                'tahun_konteks' => '2021',
            ),
            131 => 
            array (
                'id_konteks' => 132,
                'id_risk' => 'RP',
                'no_k' => 5,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            132 => 
            array (
                'id_konteks' => 133,
                'id_risk' => 'RP',
                'no_k' => 6,
                'konteks' => 'Strategic',
                'tahun_konteks' => '2021',
            ),
            133 => 
            array (
                'id_konteks' => 134,
                'id_risk' => 'RP',
                'no_k' => 7,
                'konteks' => 'Financial',
                'tahun_konteks' => '2021',
            ),
            134 => 
            array (
                'id_konteks' => 135,
                'id_risk' => 'RP',
                'no_k' => 8,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            135 => 
            array (
                'id_konteks' => 136,
                'id_risk' => 'RP',
                'no_k' => 9,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            136 => 
            array (
                'id_konteks' => 137,
                'id_risk' => 'RP',
                'no_k' => 10,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            137 => 
            array (
                'id_konteks' => 138,
                'id_risk' => 'RSD',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            138 => 
            array (
                'id_konteks' => 139,
                'id_risk' => 'RSD',
                'no_k' => 2,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            139 => 
            array (
                'id_konteks' => 140,
                'id_risk' => 'RSD',
                'no_k' => 3,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            140 => 
            array (
                'id_konteks' => 141,
                'id_risk' => 'RSD',
                'no_k' => 4,
                'konteks' => 'Budaya Organisasi',
                'tahun_konteks' => '2021',
            ),
            141 => 
            array (
                'id_konteks' => 142,
                'id_risk' => 'RSD',
                'no_k' => 5,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            142 => 
            array (
                'id_konteks' => 143,
                'id_risk' => 'RTI',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            143 => 
            array (
                'id_konteks' => 144,
                'id_risk' => 'RTI',
                'no_k' => 2,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            144 => 
            array (
                'id_konteks' => 145,
                'id_risk' => 'RTI',
                'no_k' => 3,
            'konteks' => 'Komunikasi (Internal/Eksternal)',
                'tahun_konteks' => '2021',
            ),
            145 => 
            array (
                'id_konteks' => 146,
                'id_risk' => 'RAP',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            146 => 
            array (
                'id_konteks' => 147,
                'id_risk' => 'RAP',
                'no_k' => 2,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            147 => 
            array (
                'id_konteks' => 148,
                'id_risk' => 'RAP',
                'no_k' => 3,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            148 => 
            array (
                'id_konteks' => 149,
                'id_risk' => 'RAP',
                'no_k' => 4,
                'konteks' => 'Governance/Tata Kelola Organisasi',
                'tahun_konteks' => '2021',
            ),
            149 => 
            array (
                'id_konteks' => 150,
                'id_risk' => 'RAP',
                'no_k' => 5,
                'konteks' => 'Pengawasan, Pengendalian Internal/Eksternal',
                'tahun_konteks' => '2021',
            ),
            150 => 
            array (
                'id_konteks' => 151,
                'id_risk' => 'RAP',
                'no_k' => 6,
                'konteks' => 'HSE',
                'tahun_konteks' => '2021',
            ),
            151 => 
            array (
                'id_konteks' => 152,
                'id_risk' => 'RAP',
                'no_k' => 7,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            152 => 
            array (
                'id_konteks' => 153,
                'id_risk' => 'RAP',
                'no_k' => 8,
                'konteks' => 'District Management',
                'tahun_konteks' => '2021',
            ),
            153 => 
            array (
                'id_konteks' => 154,
                'id_risk' => 'RAP',
                'no_k' => 9,
                'konteks' => 'Legal/Compliance',
                'tahun_konteks' => '2021',
            ),
            154 => 
            array (
                'id_konteks' => 155,
                'id_risk' => 'RAP',
                'no_k' => 10,
                'konteks' => 'Strategic',
                'tahun_konteks' => '2021',
            ),
            155 => 
            array (
                'id_konteks' => 156,
                'id_risk' => 'RAP',
                'no_k' => 11,
                'konteks' => 'Financial',
                'tahun_konteks' => '2021',
            ),
            156 => 
            array (
                'id_konteks' => 157,
                'id_risk' => 'RAP',
                'no_k' => 12,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            157 => 
            array (
                'id_konteks' => 158,
                'id_risk' => 'RAP',
                'no_k' => 13,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            158 => 
            array (
                'id_konteks' => 159,
                'id_risk' => 'RAP',
                'no_k' => 14,
            'konteks' => 'Komunikasi (Internal/Eksternal)',
                'tahun_konteks' => '2021',
            ),
            159 => 
            array (
                'id_konteks' => 160,
                'id_risk' => 'RAP',
                'no_k' => 15,
                'konteks' => 'Budaya Organisasi',
                'tahun_konteks' => '2021',
            ),
            160 => 
            array (
                'id_konteks' => 161,
                'id_risk' => 'RAP',
                'no_k' => 16,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            161 => 
            array (
                'id_konteks' => 162,
                'id_risk' => 'RK',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            162 => 
            array (
                'id_konteks' => 163,
                'id_risk' => 'RK',
                'no_k' => 2,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            163 => 
            array (
                'id_konteks' => 164,
                'id_risk' => 'RK',
                'no_k' => 3,
                'konteks' => 'Governance/Tata Kelola Organisasi',
                'tahun_konteks' => '2021',
            ),
            164 => 
            array (
                'id_konteks' => 165,
                'id_risk' => 'RK',
                'no_k' => 4,
                'konteks' => 'Pengawasan, Pengendalian Internal/Eksternal',
                'tahun_konteks' => '2021',
            ),
            165 => 
            array (
                'id_konteks' => 166,
                'id_risk' => 'RK',
                'no_k' => 5,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            166 => 
            array (
                'id_konteks' => 167,
                'id_risk' => 'RK',
                'no_k' => 6,
                'konteks' => 'Financial',
                'tahun_konteks' => '2021',
            ),
            167 => 
            array (
                'id_konteks' => 168,
                'id_risk' => 'RK',
                'no_k' => 7,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            168 => 
            array (
                'id_konteks' => 169,
                'id_risk' => 'RK',
                'no_k' => 8,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            169 => 
            array (
                'id_konteks' => 170,
                'id_risk' => 'RK',
                'no_k' => 9,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            170 => 
            array (
                'id_konteks' => 171,
                'id_risk' => 'RKK',
                'no_k' => 1,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            171 => 
            array (
                'id_konteks' => 172,
                'id_risk' => 'RKK',
                'no_k' => 2,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            172 => 
            array (
                'id_konteks' => 173,
                'id_risk' => 'RKK',
                'no_k' => 3,
                'konteks' => 'Governance/Tata Kelola Organisasi',
                'tahun_konteks' => '2021',
            ),
            173 => 
            array (
                'id_konteks' => 174,
                'id_risk' => 'RKK',
                'no_k' => 4,
                'konteks' => 'Pengawasan, Pengendalian Internal/Eksternal',
                'tahun_konteks' => '2021',
            ),
            174 => 
            array (
                'id_konteks' => 175,
                'id_risk' => 'RKK',
                'no_k' => 5,
                'konteks' => 'HSE',
                'tahun_konteks' => '2021',
            ),
            175 => 
            array (
                'id_konteks' => 176,
                'id_risk' => 'RKK',
                'no_k' => 6,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            176 => 
            array (
                'id_konteks' => 177,
                'id_risk' => 'RKK',
                'no_k' => 7,
                'konteks' => 'District Management',
                'tahun_konteks' => '2021',
            ),
            177 => 
            array (
                'id_konteks' => 178,
                'id_risk' => 'RKK',
                'no_k' => 8,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            178 => 
            array (
                'id_konteks' => 179,
                'id_risk' => 'RKK',
                'no_k' => 9,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            179 => 
            array (
                'id_konteks' => 180,
                'id_risk' => 'RKK',
                'no_k' => 10,
            'konteks' => 'Komunikasi (Internal/Eksternal)',
                'tahun_konteks' => '2021',
            ),
            180 => 
            array (
                'id_konteks' => 181,
                'id_risk' => 'RKK',
                'no_k' => 11,
                'konteks' => 'Budaya Organisasi',
                'tahun_konteks' => '2021',
            ),
            181 => 
            array (
                'id_konteks' => 182,
                'id_risk' => 'RE',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            182 => 
            array (
                'id_konteks' => 183,
                'id_risk' => 'RE',
                'no_k' => 2,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            183 => 
            array (
                'id_konteks' => 184,
                'id_risk' => 'RE',
                'no_k' => 3,
                'konteks' => 'Governance/Tata Kelola Organisasi',
                'tahun_konteks' => '2021',
            ),
            184 => 
            array (
                'id_konteks' => 185,
                'id_risk' => 'RE',
                'no_k' => 4,
                'konteks' => 'Pengawasan, Pengendalian Internal/Eksternal',
                'tahun_konteks' => '2021',
            ),
            185 => 
            array (
                'id_konteks' => 186,
                'id_risk' => 'RE',
                'no_k' => 5,
                'konteks' => 'HSE',
                'tahun_konteks' => '2021',
            ),
            186 => 
            array (
                'id_konteks' => 187,
                'id_risk' => 'RE',
                'no_k' => 6,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            187 => 
            array (
                'id_konteks' => 188,
                'id_risk' => 'RE',
                'no_k' => 7,
                'konteks' => 'District Management',
                'tahun_konteks' => '2021',
            ),
            188 => 
            array (
                'id_konteks' => 189,
                'id_risk' => 'RE',
                'no_k' => 8,
                'konteks' => 'Strategic',
                'tahun_konteks' => '2021',
            ),
            189 => 
            array (
                'id_konteks' => 190,
                'id_risk' => 'RE',
                'no_k' => 9,
            'konteks' => 'Komunikasi (Internal/Eksternal)',
                'tahun_konteks' => '2021',
            ),
            190 => 
            array (
                'id_konteks' => 191,
                'id_risk' => 'RF',
                'no_k' => 10,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            191 => 
            array (
                'id_konteks' => 192,
                'id_risk' => 'RF',
                'no_k' => 11,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            192 => 
            array (
                'id_konteks' => 193,
                'id_risk' => 'RF',
                'no_k' => 12,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            193 => 
            array (
                'id_konteks' => 194,
                'id_risk' => 'RF',
                'no_k' => 13,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            194 => 
            array (
                'id_konteks' => 195,
                'id_risk' => 'RF',
                'no_k' => 14,
                'konteks' => 'District Management',
                'tahun_konteks' => '2021',
            ),
            195 => 
            array (
                'id_konteks' => 196,
                'id_risk' => 'RF',
                'no_k' => 15,
                'konteks' => 'Legal/Compliance',
                'tahun_konteks' => '2021',
            ),
            196 => 
            array (
                'id_konteks' => 197,
                'id_risk' => 'RF',
                'no_k' => 16,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            197 => 
            array (
                'id_konteks' => 198,
                'id_risk' => 'RF',
                'no_k' => 17,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            198 => 
            array (
                'id_konteks' => 199,
                'id_risk' => 'RHU',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            199 => 
            array (
                'id_konteks' => 200,
                'id_risk' => 'RHU',
                'no_k' => 2,
                'konteks' => 'Human Capital Management',
                'tahun_konteks' => '2021',
            ),
            200 => 
            array (
                'id_konteks' => 201,
                'id_risk' => 'RHU',
                'no_k' => 3,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            201 => 
            array (
                'id_konteks' => 202,
                'id_risk' => 'RHU',
                'no_k' => 4,
                'konteks' => 'Governance/Tata Kelola Organisasi',
                'tahun_konteks' => '2021',
            ),
            202 => 
            array (
                'id_konteks' => 203,
                'id_risk' => 'RHU',
                'no_k' => 5,
                'konteks' => 'Pengawasan, Pengendalian Internal/Eksternal',
                'tahun_konteks' => '2021',
            ),
            203 => 
            array (
                'id_konteks' => 204,
                'id_risk' => 'RHU',
                'no_k' => 6,
                'konteks' => 'HSE',
                'tahun_konteks' => '2021',
            ),
            204 => 
            array (
                'id_konteks' => 205,
                'id_risk' => 'RHU',
                'no_k' => 7,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            205 => 
            array (
                'id_konteks' => 206,
                'id_risk' => 'RHU',
                'no_k' => 8,
                'konteks' => 'District Management',
                'tahun_konteks' => '2021',
            ),
            206 => 
            array (
                'id_konteks' => 207,
                'id_risk' => 'RHU',
                'no_k' => 9,
                'konteks' => 'Legal/Compliance',
                'tahun_konteks' => '2021',
            ),
            207 => 
            array (
                'id_konteks' => 208,
                'id_risk' => 'RHU',
                'no_k' => 10,
                'konteks' => 'Strategic',
                'tahun_konteks' => '2021',
            ),
            208 => 
            array (
                'id_konteks' => 209,
                'id_risk' => 'RHU',
                'no_k' => 11,
                'konteks' => 'Financial',
                'tahun_konteks' => '2021',
            ),
            209 => 
            array (
                'id_konteks' => 210,
                'id_risk' => 'RHU',
                'no_k' => 12,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            210 => 
            array (
                'id_konteks' => 211,
                'id_risk' => 'RHU',
                'no_k' => 13,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            211 => 
            array (
                'id_konteks' => 212,
                'id_risk' => 'RHU',
                'no_k' => 14,
            'konteks' => 'Komunikasi (Internal/Eksternal)',
                'tahun_konteks' => '2021',
            ),
            212 => 
            array (
                'id_konteks' => 213,
                'id_risk' => 'RHU',
                'no_k' => 15,
                'konteks' => 'Budaya Organisasi',
                'tahun_konteks' => '2021',
            ),
            213 => 
            array (
                'id_konteks' => 214,
                'id_risk' => 'RHU',
                'no_k' => 16,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
            214 => 
            array (
                'id_konteks' => 215,
                'id_risk' => 'RD',
                'no_k' => 1,
                'konteks' => 'Supply Chain Management',
                'tahun_konteks' => '2021',
            ),
            215 => 
            array (
                'id_konteks' => 216,
                'id_risk' => 'RD',
                'no_k' => 2,
                'konteks' => 'Design Engineering',
                'tahun_konteks' => '2021',
            ),
            216 => 
            array (
                'id_konteks' => 217,
                'id_risk' => 'RD',
                'no_k' => 3,
                'konteks' => 'Production Management',
                'tahun_konteks' => '2021',
            ),
            217 => 
            array (
                'id_konteks' => 218,
                'id_risk' => 'RD',
                'no_k' => 4,
                'konteks' => 'Infrastructure, Facilities, and Tools',
                'tahun_konteks' => '2021',
            ),
            218 => 
            array (
                'id_konteks' => 219,
                'id_risk' => 'RD',
                'no_k' => 5,
                'konteks' => 'Quality Management',
                'tahun_konteks' => '2021',
            ),
            219 => 
            array (
                'id_konteks' => 220,
                'id_risk' => 'RD',
                'no_k' => 6,
                'konteks' => 'Marketing',
                'tahun_konteks' => '2021',
            ),
        ));
        
        
    }
}