<?php

namespace Database\Seeders;

use App\StatusPerkawinan;
use Illuminate\Database\Seeder;

class StatusPerkawinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPerkawinan::create(['nama' => 'Belum Kawin']);
        StatusPerkawinan::create(['nama' => 'Kawin']);
        StatusPerkawinan::create(['nama' => 'Cerai Hidup']);
        StatusPerkawinan::create(['nama' => 'Cerai Mati']);
    }
}
