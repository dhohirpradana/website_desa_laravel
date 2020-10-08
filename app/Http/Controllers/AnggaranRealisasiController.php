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
    public function index(Request $request)
    {
        $pendapatan = AnggaranRealisasi::whereHas('detail_jenis_anggaran', function ($pendapatan) {$pendapatan->where('jenis_anggaran_id', 4);})->latest()->paginate(20);
        $belanja = AnggaranRealisasi::whereHas('detail_jenis_anggaran', function ($belanja) {$belanja->where('jenis_anggaran_id', 5);})->latest()->paginate(20);
        $pembiayaan = AnggaranRealisasi::whereHas('detail_jenis_anggaran', function ($pembiayaan) {$pembiayaan->where('jenis_anggaran_id', 6);})->latest()->paginate(20);

        if ($request->tahun) {
            $pendapatan = AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($pendapatan) {$pendapatan->where('jenis_anggaran_id', 4);})->latest()->paginate(20);
            $belanja = AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($belanja) {$belanja->where('jenis_anggaran_id', 5);})->latest()->paginate(20);
            $pembiayaan = AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($pembiayaan) {$pembiayaan->where('jenis_anggaran_id', 6);})->latest()->paginate(20);
        }

        $pendapatan->appends(request()->input())->links();
        $belanja->appends(request()->input())->links();
        $pembiayaan->appends(request()->input())->links();

        return view('anggaran-realisasi.index', compact('pendapatan','belanja','pembiayaan'));
    }

    public function cart(Request $request)
    {
        $pendapatan_anggaran = 0; $pendapatan_realisasi = 0; $belanja_anggaran = 0; $belanja_realisasi = 0; $pembiayaan_anggaran = 0; $pembiayaan_realisasi = 0; $rincian = null;

        if ($request->tahun) {
            foreach (AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($belanja) {$belanja->where('jenis_anggaran_id', 4);})->get() as $item) {
                $pendapatan_anggaran += $item->nilai_anggaran;
                $pendapatan_realisasi += $item->nilai_realisasi;
            }

            foreach (AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($belanja) {$belanja->where('jenis_anggaran_id', 5);})->get() as $item) {
                $belanja_anggaran += $item->nilai_anggaran;
                $belanja_realisasi += $item->nilai_realisasi;
            }

            foreach (AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($pembiayaan) {$pembiayaan->where('jenis_anggaran_id', 6);})->get() as $item) {
                $pembiayaan_anggaran += $item->nilai_anggaran;
                $pembiayaan_realisasi += $item->nilai_realisasi;
            }

            foreach (AnggaranRealisasi::whereTahun($request->tahun)->get()->groupBy('detail_jenis_anggaran_id') as $key => $value) {
                $anggaran = 0;
                $realisasi = 0;
                foreach ($value as $item) {
                    $anggaran += $item->nilai_anggaran;
                    $realisasi += $item->nilai_realisasi;
                }
                $rincian[] = $this->cart_rincian($value[0]->detail_jenis_anggaran->jenis_anggaran_id,$realisasi, $anggaran, $value[0]->detail_jenis_anggaran->nama ? $value[0]->detail_jenis_anggaran->nama : $value[0]->detail_jenis_anggaran->kelompok_jenis_anggaran->nama);
            }
        } else {
            foreach (AnggaranRealisasi::whereTahun(date('Y'))->whereHas('detail_jenis_anggaran', function ($belanja) {$belanja->where('jenis_anggaran_id', 4);})->get() as $item) {
                $pendapatan_anggaran += $item->nilai_anggaran;
                $pendapatan_realisasi += $item->nilai_realisasi;
            }

            foreach (AnggaranRealisasi::whereTahun(date('Y'))->whereHas('detail_jenis_anggaran', function ($belanja) {$belanja->where('jenis_anggaran_id', 5);})->get() as $item) {
                $belanja_anggaran += $item->nilai_anggaran;
                $belanja_realisasi += $item->nilai_realisasi;
            }

            foreach (AnggaranRealisasi::whereTahun(date('Y'))->whereHas('detail_jenis_anggaran', function ($pembiayaan) {$pembiayaan->where('jenis_anggaran_id', 6);})->get() as $item) {
                $pembiayaan_anggaran += $item->nilai_anggaran;
                $pembiayaan_realisasi += $item->nilai_realisasi;
            }

            foreach (AnggaranRealisasi::whereTahun(date('Y'))->get()->groupBy('detail_jenis_anggaran_id') as $key => $value) {
                $anggaran = 0;
                $realisasi = 0;
                foreach ($value as $item) {
                    $anggaran += $item->nilai_anggaran;
                    $realisasi += $item->nilai_realisasi;
                }
                $rincian[] = $this->cart_rincian($value[0]->detail_jenis_anggaran->jenis_anggaran_id,$realisasi, $anggaran, $value[0]->detail_jenis_anggaran->nama ? $value[0]->detail_jenis_anggaran->nama : $value[0]->detail_jenis_anggaran->kelompok_jenis_anggaran->nama);
            }
        }

        try {
            $pendapatan_persen = ($pendapatan_realisasi / $pendapatan_anggaran) * 100;
        } catch (\Throwable $th) {
            $pendapatan_persen = 0;
        }

        try {
            $belanja_persen = ($belanja_realisasi / $belanja_anggaran) * 100;
        } catch (\Throwable $th) {
            $belanja_persen = 0;
        }

        try {
            $pembiayaan_persen = ($pembiayaan_realisasi / $pembiayaan_anggaran) * 100;
        } catch (\Throwable $th) {
            $pembiayaan_persen = 0;
        }

        return response()->json([
            'pendapatan'    => [
                'uang'      => 'Rp. ' . substr(number_format($pendapatan_realisasi, 2, ',', '.'),0,-3) . ' | Rp. ' . substr(number_format($pendapatan_anggaran, 2, ',', '.'),0,-3),
                'persen'    => $pendapatan_persen,
            ],
            'belanja'       => [
                'uang'      => 'Rp. ' . substr(number_format($belanja_realisasi, 2, ',', '.'),0,-3) . ' | Rp. ' . substr(number_format($belanja_anggaran, 2, ',', '.'),0,-3),
                'persen'    => $belanja_persen,
            ],
            'pembiayaan'    => [
                'uang'      => 'Rp. ' . substr(number_format($pembiayaan_realisasi, 2, ',', '.'),0,-3) . ' | Rp. ' . substr(number_format($pembiayaan_anggaran, 2, ',', '.'),0,-3),
                'persen'    => $pembiayaan_persen,
            ],
            'detail'        => $rincian
        ]);
    }

    public function cart_rincian($jenis, $realisasi, $anggaran, $rincian)
    {
        try {
            $persen = ($realisasi / $anggaran) * 100;
        } catch (\Throwable $th) {
            $persen = 0;
        }

        return [
            'jenis'     => $jenis,
            'rincian'   => $rincian,
            'uang'      => 'Rp. ' . substr(number_format($realisasi, 2, ',', '.'),0,-3) . ' | Rp. ' . substr(number_format($anggaran, 2, ',', '.'),0,-3),
            'persen'    => $persen
        ];
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
            'keterangan_lainnya'        => ['nullable']
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
            'jenis_anggaran'            => ['required'],
            'detail_jenis_anggaran_id'  => ['required'],
            'nilai_anggaran'            => ['required','numeric','min:0'],
            'nilai_realisasi'           => ['required','numeric','min:0'],
            'keterangan_lainnya'        => ['nullable']
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
