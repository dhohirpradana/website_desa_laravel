<?php

namespace Database\Seeders;

use App\Agama;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agama::create(['nama' => 'Islam']);
        Agama::create(['nama' => 'Kristen']);
        Agama::create(['nama' => 'Katholik']);
        Agama::create(['nama' => 'Hindu']);
        Agama::create(['nama' => 'Budha']);
        Agama::create(['nama' => 'Khonghucu']);
        Agama::create(['nama' => 'Lainnya']);
    }
}
