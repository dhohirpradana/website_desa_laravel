<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Desa;
use App\Gallery;
use App\PemerintahanDesa;
use App\Penduduk;
use App\Surat;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $surat = Surat::whereTampilkan(1)->latest()->take(3)->get();
        $desa = Desa::find(1);
        $berita = Berita::latest()->take(3)->get();
        $pemerintahan_desa = PemerintahanDesa::latest()->take(3)->get();
        $gallery = Gallery::where('slider', 1)->latest()->get();
        $galleries = array();
        $videos = Video::all();

        foreach (Gallery::where('slider', null)->get() as $key => $value) {
            $gambar = [
                'gambar'    => $value->gallery,
                'id'        => $value->id,
                'caption'   => $value->caption,
                'jenis'     => 1,
                'created_at'=> strtotime($value->created_at),
            ];
            array_push($galleries, $gambar);
        }

        foreach ($videos as $key => $value) {
            $gambar = [
                'gambar'    => $value->gambar,
                'id'        => $value->video_id,
                'caption'   => $value->caption,
                'jenis'     => 2,
                'created_at'=> strtotime($value->published_at),
            ];
            array_push($galleries, $gambar);
        }

        usort($galleries, function($a, $b) {
            return $a['created_at'] < $b['created_at'];
        });

        return view('index', compact('surat', 'desa', 'gallery','berita','pemerintahan_desa','galleries'));
    }

    public function dashboard()
    {
        $surat = Surat::all();
        $hari = 0;
        $bulan = 0;
        $tahun = 0;
        $totalCetakSurat = 0;
        $totalPenduduk = new Penduduk();

        foreach ($surat as $value) {
            if (count($value->cetakSurat) != 0) {
                foreach ($value->cetakSurat as $cetakSurat) {
                    if (date('Y-m-d', strtotime($cetakSurat->created_at)) == date('Y-m-d')) {
                        $hari = $hari + 1;
                    }
                    if (date('Y-m', strtotime($cetakSurat->created_at)) == date('Y-m')) {
                        $bulan = $bulan + 1;
                    }
                    if (date('Y', strtotime($cetakSurat->created_at)) == date('Y')) {
                        $tahun = $tahun + 1;
                    }
                    $totalCetakSurat = $totalCetakSurat + 1;
                }
            }
        }

        return view('dashboard', compact('surat','hari','bulan','tahun','totalCetakSurat','totalPenduduk'));
    }

    public function suratHarian(Request $request)
    {
        $date = $request->tanggal ? date('Y-m-d',strtotime($request->tanggal)) : date('Y-m-d');
        $surat = Surat::all();
        $data = array();
        foreach ($surat as $value) {
            if (count($value->cetakSurat) == 0) {
                $nilai = 0;
            } else {
                $nilai = 0;
                foreach ($value->cetakSurat as $cetakSurat) {
                    if (date('Y-m-d', strtotime($cetakSurat->created_at)) == $date) {
                        $nilai = $nilai + 1;
                    }
                }
            }

            array_push($data, [$value->nama,$nilai]);
        }

        return response()->json($data);
    }

    public function suratBulanan(Request $request)
    {
        $date = $request->bulan ? date('Y-m',strtotime($request->bulan)) : date('Y-m');
        $surat = Surat::all();
        $data = array();
        foreach ($surat as $value) {
            if (count($value->cetakSurat) == 0) {
                $nilai = 0;
            } else {
                $nilai = 0;
                foreach ($value->cetakSurat as $cetakSurat) {
                    if (date('Y-m', strtotime($cetakSurat->created_at)) == $date) {
                        $nilai = $nilai + 1;
                    }
                }
            }

            array_push($data, [$value->nama,$nilai]);
        }

        return response()->json($data);
    }

    public function suratTahunan(Request $request)
    {
        $date = $request->tahun ? $request->tahun : date('Y');
        $surat = Surat::all();
        $data = array();
        foreach ($surat as $value) {
            if (count($value->cetakSurat) == 0) {
                $nilai = 0;
            } else {
                $nilai = 0;
                foreach ($value->cetakSurat as $cetakSurat) {
                    if (date('Y', strtotime($cetakSurat->created_at)) == $date) {
                        $nilai = $nilai + 1;
                    }
                }
            }

            array_push($data, [$value->nama,$nilai]);
        }

        return response()->json($data);
    }

    public function panduan()
    {
        $desa = Desa::find(1);
        return view('panduan', compact('desa'));
    }
}
