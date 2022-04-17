<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfficerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('officer')->delete();
        
        \DB::table('officer')->insert(array (
            0 => 
            array (
                'id_officer' => 1,
                'nip' => '44444',
                'nama' => 'Yulis',
                'username' => 'yulis',
                'password' => 'yulis',
                'email' => 'yulis@gmail.com',
                'officer_status' => 0,
            ),
            1 => 
            array (
                'id_officer' => 2,
                'nip' => '55555',
                'nama' => 'Fahru',
                'username' => 'fahru',
                'password' => 'fahru',
                'email' => 'fahru@gmail.com',
                'officer_status' => 0,
            ),
            2 => 
            array (
                'id_officer' => 3,
                'nip' => '66666',
                'nama' => 'Robert',
                'username' => 'robert',
                'password' => 'robert',
                'email' => 'robert@gmail.com',
                'officer_status' => 0,
            ),
            3 => 
            array (
                'id_officer' => 4,
                'nip' => '77777',
                'nama' => 'Hadi',
                'username' => 'hadi',
                'password' => 'hadi',
                'email' => 'hadi@gmail.com',
                'officer_status' => 0,
            ),
            4 => 
            array (
                'id_officer' => 5,
                'nip' => '018086022',
                'nama' => 'Sandy Priyo',
                'username' => 'sandy',
                'password' => 'sandy',
                'email' => 'sandypriyo@gmail.com',
                'officer_status' => 0,
            ),
        ));
        
        
    }
}