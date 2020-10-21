<?php

namespace App\Http\Controllers;

use App\Agama;
use App\Darah;
use App\Desa;
use App\Pekerjaan;
use App\Pendidikan;
use App\Penduduk;
use App\StatusPerkawinan;
use Carbon\Carbon;

class GrafikController extends Controller
{
    public function index()
    {
        $desa = Desa::find(1);
        return view('statistik-penduduk.index',compact('desa'));
    }

    public function show()
    {
        return response()->json([
            'totalPenduduk' => Penduduk::count(),
            'pekerjaan'     => $this->grafikPekerjaan(),
            'pendidikan'    => $this->grafikPendidikan(),
            'perkawinan'    => $this->grafikPerkawinan(),
            'agama'         => $this->grafikAgama(),
            'darah'         => $this->grafikDarah(),
            'usia'          => $this->grafikUsia(),
        ]);
    }

    private function grafikPekerjaan()
    {
        $data = array();
        $pekerjaan = Pekerjaan::all();

        foreach ($pekerjaan as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::wherePekerjaanId($item->id)->count()
            ];
        }
        return $data;
    }

    private function grafikPendidikan()
    {
        $data = array();
        $pendidikan = Pendidikan::all();

        foreach ($pendidikan as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::wherePendidikanId($item->id)->count()
            ];
        }
        return $data;
    }

    private function grafikAgama()
    {
        $data = array();
        $agama = Agama::all();

        foreach ($agama as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::whereAgamaId($item->id)->count()
            ];
        }

        return $data;
    }

    private function grafikUsia()
    {
        $kategori = ['0 - 4 tahun','5 - 17 tahun','18 - 30 tahun','31 - 60 tahun','60+ tahun'];
        $laki0 = 0; $laki1 = 0; $laki2 = 0; $laki3 = 0; $laki4 = 0;
        $perempuan0 = 0; $perempuan1 = 0; $perempuan2 = 0; $perempuan3 = 0; $perempuan4 = 0;

        foreach (Penduduk::where('jenis_kelamin',1)->get() as $penduduk) {
            $laki = (int) Carbon::parse($penduduk->tanggal_lahir)->diff(Carbon::now())->format('%y');
            if ($laki >= 0 && $laki <= 4) {
                $laki0 += 1;
            } elseif ($laki >= 5 && $laki <= 17) {
                $laki1 += 1;
            } elseif ($laki >= 18 && $laki <= 30) {
                $laki2 += 1;
            } elseif ($laki >= 31 && $laki <= 60) {
                $laki3 += 1;
            } elseif ($laki > 60) {
                $laki4 += 1;
            }
        }

        foreach (Penduduk::where('jenis_kelamin',2)->get() as $penduduk) {
            $perempuan = (int) Carbon::parse($penduduk->tanggal_lahir)->diff(Carbon::now())->format('%y');
            if ($perempuan >= 0 && $perempuan <= 4) {
                $perempuan0 += 1;
            } elseif ($perempuan >= 5 && $perempuan <= 17) {
                $perempuan1 += 1;
            } elseif ($perempuan >= 18 && $perempuan <= 30) {
                $perempuan2 += 1;
            } elseif ($perempuan >= 31 && $perempuan <= 60) {
                $perempuan3 += 1;
            } elseif ($perempuan > 60) {
                $perempuan4 += 1;
            }
        }

        return [
            'kategori'          => $kategori,
            'laki'              => [$laki0, $laki1, $laki2, $laki3, $laki4],
            'perempuan'         => [$perempuan0, $perempuan1, $perempuan2, $perempuan3, $perempuan4],
        ];
    }

    private function grafikDarah()
    {
        $data = array();
        $darah = Darah::all();

        foreach ($darah as $item) {
            $data[] = [
                'name' => $item->golongan,
                'y' => Penduduk::whereDarahId($item->id)->count()
            ];
        }

        return $data;
    }

    private function grafikPerkawinan()
    {
        $data = array();
        $perkawinan = StatusPerkawinan::all();

        foreach ($perkawinan as $item) {
            $data[] = [
                'name' => $item->nama,
                'y' => Penduduk::whereStatusPerkawinanId($item->id)->count()
            ];
        }

        return $data;
    }
}
