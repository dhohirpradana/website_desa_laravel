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
        $this->call(UserSeeder::class);
        $this->call(DesaSeeder::class);
        $this->call(AgamaSeeder::class);
        $this->call(DarahSeeder::class);
        $this->call(PekerjaanSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(StatusHubunganDalamKeluargaSeeder::class);
        $this->call(StatusPerkawinanSeeder::class);
        $this->call(JenisAnggaranSeeder::class);
        $this->call(KelompokJenisAnggaranSeeder::class);
        $this->call(DetailJenisAnggaranSeeder::class);
    }
}
