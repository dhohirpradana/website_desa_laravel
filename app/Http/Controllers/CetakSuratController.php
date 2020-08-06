<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Surat;
use Barryvdh\DomPDF\Facade as PDF;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\CetakSurat;
use App\DetailCetak;
use Illuminate\Http\Request;

class CetakSuratController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id, $slug)
    {
        $surat = Surat::find($id);

        if ($slug != Str::slug($surat->nama)) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        return view('cetak-surat.create', compact('surat'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'isian.*'  => ['required']
        ]);

        $desa = Desa::find(1);
        $surat = Surat::find($id);
        $image = (string) Image::make(public_path(Storage::url($desa->logo)))->encode('jpg');
        $logo = (string) Image::make($image)->encode('data-url');
        $tanggal = tgl(date('Y-m-d'));
        $pdf = PDF::loadView('cetak-surat.show', compact('surat', 'desa', 'request', 'logo', 'tanggal'))->setPaper(array(0,0,609.449,935.433));
        if ($surat->tampilkan == 1) {
            $cetakSurat = CetakSurat::create([
                'surat_id' => $id
            ]);

            foreach ($request->isian as $isian) {
                DetailCetak::create([
                    'cetak_surat_id'    => $cetakSurat->id,
                    'isian'             => $isian
                ]);
            }

            $surat->jumlah_cetak = CetakSurat::where('surat_id', $id)->count();
            $surat->save();
        }


        return $pdf->stream($surat->nama . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CetakSurat  $cetakSurat
     * @return \Illuminate\Http\Response
     */
    public function show(CetakSurat $cetakSurat)
    {
        $desa = Desa::find(1);
        $surat = Surat::find($cetakSurat->surat_id);
        $image = (string) Image::make(public_path(Storage::url($desa->logo)))->encode('jpg');
        $logo = (string) Image::make($image)->encode('data-url');
        $tanggal = tgl(date('Y-m-d', strtotime($cetakSurat->created_at)));
        $pdf = PDF::loadView('cetak-surat.detail', compact('surat', 'desa', 'cetakSurat', 'logo', 'tanggal'))->setPaper(array(0,0,609.449,935.433));
        return $pdf->stream($surat->nama . '.pdf');
    }
}
