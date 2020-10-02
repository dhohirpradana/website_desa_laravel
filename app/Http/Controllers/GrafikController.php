<?php

namespace App\Http\Controllers;

use App\Penduduk;
use Carbon\Carbon;

class GrafikController extends Controller
{
    public function pekerjaan()
    {
        $data = $this->grafikPekerjaan();
        $total = Penduduk::all()->count();

        return view('statistik-penduduk.pekerjaan',compact('total','data'));
    }

    public function pendidikan()
    {
        $data = $this->grafikPendidikan();
        $total = Penduduk::all()->count();

        return view('statistik-penduduk.pendidikan',compact('total','data'));
    }

    public function agama()
    {
        $data = $this->grafikAgama();
        $total = Penduduk::all()->count();

        return view('statistik-penduduk.agama', compact('total','data'));
    }

    public function usia()
    {
        $data = $this->grafikUsia();
        $total = Penduduk::all()->count();

        return view('statistik-penduduk.usia',compact('total','data'));
    }

    public function darah()
    {
        $data = $this->grafikDarah();
        $total = Penduduk::all()->count();

        return view('statistik-penduduk.darah',compact('total','data'));
    }

    public function perkawinan()
    {
        $data = $this->grafikPerkawinan();
        $total = Penduduk::all()->count();

        return view('statistik-penduduk.perkawinan',compact('total','data'));
    }
}
