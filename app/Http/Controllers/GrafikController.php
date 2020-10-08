<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Penduduk;

class GrafikController extends Controller
{
    public function index()
    {
        $totalPenduduk = Penduduk::all();
        $pekerjaan = $this->grafikPekerjaan();
        $pendidikan = $this->grafikPendidikan();
        $perkawinan = $this->grafikPerkawinan();
        $agama = $this->grafikAgama();
        $darah = $this->grafikDarah();
        $usia = $this->grafikUsia();
        $desa = Desa::find(1);
        return view('statistik-penduduk.index',compact('desa','totalPenduduk','pekerjaan','pendidikan','perkawinan','agama','darah','usia'));
    }
}
