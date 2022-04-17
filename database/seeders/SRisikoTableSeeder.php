<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SRisikoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('s_risiko')->delete();
        
        \DB::table('s_risiko')->insert(array (
            0 => 
            array (
                'id_s_risiko' => 2,
                's_risiko' => 'Pemadaman Listrik',
                'id_konteks' => '149',
                'id_user' => 1,
                'tahun' => '2022',
                'catatan' => ' ',
                'status_s_risiko' => 1,
            ),
            1 => 
            array (
                'id_s_risiko' => 3,
                's_risiko' => 'Adanya Penyuapan',
                'id_konteks' => '152',
                'id_user' => 1,
                'tahun' => '2022',
                'catatan' => ' ',
                'status_s_risiko' => 1,
            ),
            2 => 
            array (
                'id_s_risiko' => 4,
                's_risiko' => 'Ketidak tercapaian Sales',
                'id_konteks' => '124',
                'id_user' => 1,
                'tahun' => '2022',
                'catatan' => ' ',
                'status_s_risiko' => 1,
            ),
            3 => 
            array (
                'id_s_risiko' => 5,
                's_risiko' => 'Risiko Test DI',
                'id_konteks' => '146',
                'id_user' => 3,
                'tahun' => '2022',
                'catatan' => ' ',
                'status_s_risiko' => 1,
            ),
            4 => 
            array (
                'id_s_risiko' => 6,
                's_risiko' => 'Risiko Test 2 DI',
                'id_konteks' => '147',
                'id_user' => 3,
                'tahun' => '2022',
                'catatan' => ' ',
                'status_s_risiko' => 1,
            ),
        ));
        
        
    }
}