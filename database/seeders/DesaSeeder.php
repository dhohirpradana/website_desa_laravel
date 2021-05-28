<?php

namespace Database\Seeders;

use App\Desa;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Desa::create([
            'nama_desa'         => 'Mlati Norowito',
            'nama_kecamatan'    => 'Kota Kudus',
            'nama_kabupaten'    => 'Kudus',
            'alamat'            => 'Mlati Norowito, No. 35, RT. 03 RW. 05, Mlati Norowito, Kec. Kota Kudus, Kabupaten Kudus, Jawa Tengah 59319',
            'nama_kepala_desa'  => "Nama Kades Mlati Norowito",
            'alamat_kepala_desa'=> "Alamat Kades Mlati Norowito",
            'logo'              => "logo.png",
        ]);
    }
}
