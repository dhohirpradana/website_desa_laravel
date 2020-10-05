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
        $desa = Desa::find(1);
        if ($slug != Str::slug($surat->nama)) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        return view('cetak-surat.create', compact('surat','desa'));
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
    public function edit(CetakSurat $cetakSurat)
    {
        return view('cetak-surat.edit', compact('cetakSurat'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CetakSurat  $cetakSurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CetakSurat $cetakSurat)
    {
        $request->validate([
            'nomor'     => ['nullable','numeric','min:1'],
            'isian.*'   => ['required']
        ]);

        $cetakSurat->update(['nomor' => $request->nomor]);

        DetailCetak::where('cetak_surat_id', $cetakSurat->id)->delete();

        foreach ($request->isian as $isian) {
            DetailCetak::create([
                'cetak_surat_id'    => $cetakSurat->id,
                'isian'             => $isian
            ]);
        }

        return back()->with('success','Detail cetak surat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CetakSurat  $cetakSurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(CetakSurat $cetakSurat)
    {
        $cetakSurat->delete();
        return back()->with('success','Detail surat berhasil dihapus');
    }
}
