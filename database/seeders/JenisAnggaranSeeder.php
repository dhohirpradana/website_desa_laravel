<?php

namespace Database\Seeders;

use App\JenisAnggaran;
use Illuminate\Database\Seeder;

class JenisAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisAnggaran::create([
            'id'    => 4,
            'nama'  => 'PENDAPATAN'
        ]);
        JenisAnggaran::create([
            'id'    => 5,
            'nama'  => 'BELANJA'
        ]);
        JenisAnggaran::create([
            'id'    => 6,
            'nama'  => 'PEMBIAYAAN'
        ]);
    }
}
