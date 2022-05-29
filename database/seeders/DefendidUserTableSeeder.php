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
                'name' => 'Risk Officer PT. PAL',
                'username' => 'ptpal',
                'password' => '$2y$10$RmXwiUdUwtz337j3Q27kGuHGa0.30PN9N/pZixCe3gqNpyrQDY2c.',
                'status_user' => 0,
                'is_risk_officer' => 1,
                'is_penilai' => 0,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 0,
                'is_admin' => 0,
                'is_assessment' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id_user' => 2,
                'company_id' => 2,
                'name' => 'ptlen',
                'username' => 'ptlen',
                'password' => '$2y$10$7b4Dm1PdbGup4MXr7RmMS.ROTBZ/VoMlUDnsFHMOGG.ekHyAE44lC',
                'status_user' => 0,
                'is_risk_officer' => 1,
                'is_penilai' => 0,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 0,
                'is_admin' => 0,
                'is_assessment' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id_user' => 3,
                'company_id' => 3,
                'name' => 'ptdi',
                'username' => 'ptdi',
                'password' => '$2y$10$1Y90E8oTZwSKTY6Acg3.oewAcShifU3k8QAxryRXMPfe3cWVl1FMG',
                'status_user' => 0,
                'is_risk_officer' => 1,
                'is_penilai' => 0,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 0,
                'is_admin' => 0,
                'is_assessment' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id_user' => 4,
                'company_id' => 4,
                'name' => 'ptdahana',
                'username' => 'ptdahana',
                'password' => '$2y$10$mgywDtCLf.DklOCKYfGTkeWWVX.vmFe6ZFXStUOddqwdQ5XHPBOZq',
                'status_user' => 0,
                'is_risk_officer' => 1,
                'is_penilai' => 0,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 0,
                'is_admin' => 0,
                'is_assessment' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id_user' => 5,
                'company_id' => 5,
                'name' => 'ptpindad',
                'username' => 'ptpindad',
                'password' => '$2y$10$HzMEYbMq5JbIiSufRijmg..6Z7EzyhVC7dnTfhbJ9qrBf.YdBlwc6',
                'status_user' => 0,
                'is_risk_officer' => 1,
                'is_penilai' => 0,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 0,
                'is_admin' => 0,
                'is_assessment' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id_user' => 6,
                'company_id' => 6,
                'name' => 'Admin Indhan',
                'username' => 'inhan',
                'password' => '$2y$10$WWPDEddKmSCMbi4WuXrsB.b6IxOb1lt82ehCeSVJItANQHrGjk7ve',
                'status_user' => 0,
                'is_risk_officer' => 0,
                'is_penilai' => 0,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 0,
                'is_admin' => 1,
                'is_assessment' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id_user' => 7,
                'company_id' => 1,
                'name' => 'Kepala Divisi TI',
                'username' => 'robaru',
                'password' => '$2y$10$PcVUcQTM0hEGDQkC8RYCZ.67naRl/susuAR/eiYOwg2XgDUS3UDd2',
                'status_user' => 0,
                'is_risk_officer' => 0,
                'is_penilai' => 0,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 1,
                'is_admin' => 0,
                'is_assessment' => 1,
                'created_at' => '2022-05-29 15:12:43',
                'updated_at' => '2022-05-29 15:12:43',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id_user' => 8,
                'company_id' => 1,
                'name' => 'Nama Penilai Indhan',
                'username' => 'rodepartemena',
                'password' => '$2y$10$Egs4/CY4Ye0QI.89TYae1etXIGauQ7LkzZx7zAhEHdZWQiK4Qlfca',
                'status_user' => 0,
                'is_risk_officer' => 0,
                'is_penilai' => 0,
                'is_penilai_indhan' => 1,
                'is_risk_owner' => 0,
                'is_admin' => 0,
                'is_assessment' => 1,
                'created_at' => '2022-05-29 04:07:07',
                'updated_at' => '2022-05-29 04:07:07',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id_user' => 9,
                'company_id' => 1,
                'name' => 'Kepala Departemen A',
                'username' => 'penilaipal',
                'password' => '$2y$10$LkSZOuBDzyd9.B/pHbX47Op8aNBmTvsoHPA3YlitWlniiOtZ6OV.m',
                'status_user' => 0,
                'is_risk_officer' => 0,
                'is_penilai' => 1,
                'is_penilai_indhan' => 0,
                'is_risk_owner' => 0,
                'is_admin' => 0,
                'is_assessment' => 1,
                'created_at' => '2022-05-29 15:12:29',
                'updated_at' => '2022-05-29 15:12:29',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}