<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(PerusahaanTableSeeder::class);
        $this->call(DefendidUserTableSeeder::class);
        $this->call(DefendidPengukurTableSeeder::class);
        $this->call(KonteksTableSeeder::class);
        $this->call(MitigasiTableSeeder::class);
        $this->call(OfficerTableSeeder::class);
        $this->call(PengukuranTableSeeder::class);
        $this->call(PengukuranKorporasiTableSeeder::class);
        $this->call(RespondenTableSeeder::class);
        $this->call(RiskTableSeeder::class);
        $this->call(RiskDetailTableSeeder::class);
        $this->call(RiskHeaderTableSeeder::class);
        $this->call(RiskHeaderKorporasiTableSeeder::class);
        $this->call(SRisikoTableSeeder::class);
    }
}
