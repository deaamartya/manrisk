<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefendidUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('defendid_user')->delete();
        
        \DB::table('defendid_user')->insert(array (
            0 => 
            array (
                'id_user' => 1,
                'company_id' => 1,
                'username' => 'ptpal',
                'password' => bcrypt('ptpal'),
                'status_user' => 0,
                'is_risk_officer' => 1,
            ),
            1 => 
            array (
                'id_user' => 2,
                'company_id' => 2,
                'username' => 'ptlen',
                'password' => bcrypt('ptlen'),
                'status_user' => 0,
                'is_risk_officer' => 1,
            ),
            2 => 
            array (
                'id_user' => 3,
                'company_id' => 3,
                'username' => 'ptdi',
                'password' => bcrypt('ptdi'),
                'status_user' => 0,
                'is_risk_officer' => 1,
            ),
            3 => 
            array (
                'id_user' => 4,
                'company_id' => 4,
                'username' => 'ptdahana',
                'password' => bcrypt('ptdahana'),
                'status_user' => 0,
                'is_risk_officer' => 1,
            ),
            4 => 
            array (
                'id_user' => 5,
                'company_id' => 5,
                'username' => 'ptpindad',
                'password' => bcrypt('ptpindad'),
                'status_user' => 0,
                'is_risk_officer' => 1,
            ),
            5 => 
            array (
                'id_user' => 6,
                'company_id' => 6,
                'username' => 'inhan',
                'password' => bcrypt('inhan'),
                'status_user' => 0,
                'is_admin' => 1,
            ),
        ));
        
        
    }
}