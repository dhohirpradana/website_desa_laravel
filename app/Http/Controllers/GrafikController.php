<?php

namespace App\Http\Controllers;

use App\Agama;
use App\Darah;
use App\Pekerjaan;
use App\Pendidikan;
use App\Penduduk;
use App\StatusPerkawinan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    public function pekerjaan()
    {
        $data = array();
        $pekerjaan = Pekerjaan::all();

        foreach ($pekerjaan as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::wherePekerjaanId($item->id)->count()
            ];
        }

        return view('grafik.pekerjaan',compact('data'));
    }

    public function pendidikan()
    {
        $data = array();
        $pendidikan = Pendidikan::all();

        foreach ($pendidikan as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::wherePendidikanId($item->id)->count()
            ];
        }

        return view('grafik.pendidikan',compact('data'));
    }

    public function agama()
    {
        $data = array();
        $agama = Agama::all();

        foreach ($agama as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::whereAgamaId($item->id)->count()
            ];
        }

        return view('grafik.agama',compact('data'));
    }

    public function usia()
    {
        $data = array();
        $penduduk = Penduduk::all();
        $kategori = ['0 - 4 tahun','5 - 9 tahun','10 - 14 tahun','15 - 19 tahun','20 - 24 tahun','25 - 29 tahun','30 - 34 tahun','35 - 39 tahun','40 - 44 tahun','45 - 49 tahun','50 - 54 tahun','55 - 59 tahun','>= 60 tahun'];
        $age0 = 0; $age1 = 0; $age2 = 0; $age3 = 0; $age4 = 0; $age5 = 0; $age6 = 0; $age7 = 0; $age8 = 0; $age9 = 0; $age10 = 0; $age11 = 0; $age12 = 0;

        foreach ($penduduk as $penduduk) {
            $age = (int) Carbon::parse($penduduk->tanggal_lahir)->diff(Carbon::now())->format('%y');
            if ($age >= 0 && $age <= 4) {
                $age0 += 1;
            } elseif ($age >= 5 && $age <= 9) {
                $age1 += 1;
            } elseif ($age >= 10 && $age <= 14) {
                $age2 += 1;
            } elseif ($age >= 15 && $age <= 19) {
                $age3 += 1;
            } elseif ($age >= 20 && $age <= 24) {
                $age4 += 1;
            } elseif ($age >= 25 && $age <= 29) {
                $age5 += 1;
            } elseif ($age >= 30 && $age <= 34) {
                $age6 += 1;
            } elseif ($age >= 35 && $age <= 39) {
                $age7 += 1;
            } elseif ($age >= 40 && $age <= 44) {
                $age8 += 1;
            } elseif ($age >= 45 && $age <= 49) {
                $age9 += 1;
            } elseif ($age >= 50 && $age <= 54) {
                $age10 += 1;
            } elseif ($age >= 55 && $age <= 59) {
                $age11 += 1;
            } elseif ($age >= 60) {
                $age12 += 1;
            }
        }

        $data = [
            $age0, $age1, $age2, $age3, $age4, $age5, $age6, $age7, $age8, $age9, $age10, $age11, $age12
        ];

        return view('grafik.usia',compact('data','kategori'));
    }

    public function darah()
    {
        $data = array();
        $darah = Darah::all();

        foreach ($darah as $item) {
            $data[] = [
                'name' => $item->golongan,
                'y' => Penduduk::whereDarahId($item->id)->count()
            ];
        }

        return view('grafik.darah',compact('data'));
    }

    public function perkawinan()
    {
        $data = array();
        $perkawinan = StatusPerkawinan::all();

        foreach ($perkawinan as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::whereStatusPerkawinanId($item->id)->count()
            ];
        }

        return view('grafik.perkawinan',compact('data'));
    }

    public function kelamin()
    {
        $laki = Penduduk::whereJenisKelamin(1)->count();
        $perempuan = Penduduk::whereJenisKelamin(2)->count();

        return view('grafik.jenis-kelamin',compact('laki','perempuan'));
    }
}
