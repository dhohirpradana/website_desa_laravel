<?php

namespace App\Http\Controllers;

use App\AnggaranRealisasi;
use App\DetailJenisAnggaran;
use App\JenisAnggaran;
use App\KelompokJenisAnggaran;
use Illuminate\Http\Request;

class AnggaranRealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggaran_realisasi = AnggaranRealisasi::latest()->paginate(10);
        return view('anggaran-realisasi.index', compact('anggaran_realisasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_anggaran = JenisAnggaran::all();
        return view('anggaran-realisasi.create', compact('jenis_anggaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun'                     => ['required','numeric','min:1900'],
            'jenis_anggaran'            => ['required'],
            'detail_jenis_anggaran_id'  => ['required'],
            'nilai_anggaran'            => ['required','numeric','min:0'],
            'nilai_realisasi'           => ['required','numeric','min:0'],
        ],[
            'detail_jenis_anggaran_id.required' => 'detail jenis anggaran wajib diisi'
        ]);

        AnggaranRealisasi::create($data);
        return redirect()->route('anggaran-realisasi.index')->with('success','Anggaran Realisasi APBDes berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetailJenisAnggaran  $detail_jenis_anggaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(DetailJenisAnggaran::where('jenis_anggaran_id', $id)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetailJenisAnggaran  $detail_jenis_anggaran
     * @return \Illuminate\Http\Response
     */
    public function kelompokJenisAnggaran(KelompokJenisAnggaran $kelompokJenisAnggaran)
    {
        return response()->json($kelompokJenisAnggaran);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnggaranRealisasi  $anggaran_realisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggaranRealisasi $anggaran_realisasi)
    {
        $jenis_anggaran = JenisAnggaran::all();
        return view('anggaran-realisasi.edit', compact('anggaran_realisasi','jenis_anggaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnggaranRealisasi  $anggaran_realisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggaranRealisasi $anggaran_realisasi)
    {
        $data = $request->validate([
            'tahun'                     => ['required','numeric','min:1900'],
            'detail_jenis_anggaran_id'  => ['required','numeric'],
            'nilai_anggaran'            => ['required','numeric','min:0'],
            'nilai_realisasi'           => ['required','numeric','min:0'],
        ],[
            'detail_jenis_anggaran_id.required' => 'detail jenis anggaran wajib diisi'
        ]);

        $anggaran_realisasi->update($data);
        return redirect()->route('anggaran-realisasi.index')->with('success','Anggaran Realisasi APBDes berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnggaranRealisasi  $anggaran_realisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnggaranRealisasi $anggaran_realisasi)
    {
        $anggaran_realisasi->delete();
        return redirect()->route('anggaran-realisasi.index')->with('success','Anggaran Realisasi APBDes berhasil diperbarui');
    }
}
