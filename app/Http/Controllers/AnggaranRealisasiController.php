<?php

namespace App\Http\Controllers;

use App\AnggaranRealisasi;
use App\Desa;
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
        if (!$request->tahun || !$request->jenis) {
            return redirect('anggaran-realisasi?jenis=pendapatan&tahun='.date('Y'));
        }

        if ($request->jenis == "pendapatan") {
            $anggaran_realisasi = AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($data) {$data->where('jenis_anggaran_id', 4);})->latest()->paginate(10);
        } elseif ($request->jenis == "belanja") {
            $anggaran_realisasi = AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($data) {$data->where('jenis_anggaran_id', 5);})->latest()->paginate(10);
        } elseif ($request->jenis == "pembiayaan") {
            $anggaran_realisasi = AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($data) {$data->where('jenis_anggaran_id', 6);})->latest()->paginate(10);
        } elseif ($request->jenis == "laporan") {
            $detail_jenis_anggaran = DetailJenisAnggaran::all();
            $data = $this->laporan($request);
            return view('anggaran-realisasi.laporan',compact('detail_jenis_anggaran','data'));
        } elseif($request->jenis == "grafik"){
            return view('anggaran-realisasi.grafik');
        } else {
            return redirect('anggaran-realisasi?jenis=pendapatan&tahun='.date('Y'));
        }

        $anggaran_realisasi->appends(request()->input())->links();

        return view('anggaran-realisasi.index', compact('anggaran_realisasi'));
    }

    public function laporan_apbdes(Request $request)
    {
        $detail_jenis_anggaran = DetailJenisAnggaran::all();
        $desa = Desa::find(1);
        $data = $this->laporan($request);

        if (!$request->tahun || !$request->jenis) {
            return redirect('laporan-apbdes?jenis=laporan&tahun='.date('Y'));
        }

        if ($request->jenis == "laporan") {
            return view('anggaran-realisasi.laporan-apbdes',compact('desa','detail_jenis_anggaran','data'));
        } elseif ($request->jenis == "grafik") {
            return view('anggaran-realisasi.grafik-apbdes-umum',compact('desa','detail_jenis_anggaran','data'));
        }else {
            return redirect('laporan-apbdes?jenis=laporan&tahun='.date('Y'));
        }

    }

    public function laporan($request)
    {
        $data['pendapatan_anggaran'] = 0; $data['pendapatan_realisasi'] = 0; $data['belanja_anggaran'] = 0; $data['belanja_realisasi'] = 0; $data['pembiayaan_anggaran'] = 0; $data['pembiayaan_realisasi'] = 0; $data['rincian'] = null;
        $data['penerimaan_biaya_anggaran'] = 0; $data['penerimaan_biaya_realisasi'] = 0; $data['pengeluaran_biaya_anggaran'] = 0; $data['pengeluaran_biaya_realisasi'] = 0;

        foreach (AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($jenis) {$jenis->where('jenis_anggaran_id', 4);})->get() as $item) {
            $data['pendapatan_anggaran'] += $item->nilai_anggaran;
            $data['pendapatan_realisasi'] += $item->nilai_realisasi;
        }

        foreach (AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($jenis) {$jenis->where('jenis_anggaran_id', 5);})->get() as $item) {
            $data['belanja_anggaran'] += $item->nilai_anggaran;
            $data['belanja_realisasi'] += $item->nilai_realisasi;
        }

        foreach (AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($jenis) {$jenis->where('kelompok_jenis_anggaran_id', 61);})->get() as $item) {
            $data['penerimaan_biaya_anggaran'] += $item->nilai_anggaran;
            $data['penerimaan_biaya_realisasi'] += $item->nilai_realisasi;
        }

        foreach (AnggaranRealisasi::whereTahun($request->tahun)->whereHas('detail_jenis_anggaran', function ($jenis) {$jenis->where('kelompok_jenis_anggaran_id', 62);})->get() as $item) {
            $data['pengeluaran_biaya_anggaran'] += $item->nilai_anggaran;
            $data['pengeluaran_biaya_realisasi'] += $item->nilai_realisasi;
        }

        $data['pembiayaan_netto_anggaran'] = $data['penerimaan_biaya_anggaran'] - $data['pengeluaran_biaya_anggaran'];
        $data['pembiayaan_netto_realisasi'] = $data['penerimaan_biaya_realisasi'] - $data['pengeluaran_biaya_realisasi'];

        return $data;
    }

    public function cart(Request $request)
    {
        $pendapatan_anggaran = 0; $pendapatan_realisasi = 0; $belanja_anggaran = 0; $belanja_realisasi = 0; $pembiayaan_anggaran = 0; $pembiayaan_realisasi = 0; $rincian = null;
        $tahun = $request->tahun ? $request->tahun : date('Y');
        foreach (AnggaranRealisasi::whereTahun($tahun)->whereHas('detail_jenis_anggaran', function ($jenis) {$jenis->where('jenis_anggaran_id', 4);})->get() as $item) {
            $pendapatan_anggaran += $item->nilai_anggaran;
            $pendapatan_realisasi += $item->nilai_realisasi;
        }

        foreach (AnggaranRealisasi::whereTahun($tahun)->whereHas('detail_jenis_anggaran', function ($jenis) {$jenis->where('jenis_anggaran_id', 5);})->get() as $item) {
            $belanja_anggaran += $item->nilai_anggaran;
            $belanja_realisasi += $item->nilai_realisasi;
        }

        foreach (AnggaranRealisasi::whereTahun($tahun)->whereHas('detail_jenis_anggaran', function ($jenis) {$jenis->where('jenis_anggaran_id', 6);})->get() as $item) {
            $pembiayaan_anggaran += $item->nilai_anggaran;
            $pembiayaan_realisasi += $item->nilai_realisasi;
        }

        foreach (AnggaranRealisasi::whereTahun($tahun)->get()->groupBy('detail_jenis_anggaran_id') as $value) {
            $anggaran = 0;
            $realisasi = 0;
            foreach ($value as $item) {
                $anggaran += $item->nilai_anggaran;
                $realisasi += $item->nilai_realisasi;
            }
            $rincian[] = $this->cart_rincian($value[0]->detail_jenis_anggaran->jenis_anggaran_id,$realisasi, $anggaran, $value[0]->detail_jenis_anggaran->nama ? $value[0]->detail_jenis_anggaran->nama : $value[0]->detail_jenis_anggaran->kelompok_jenis_anggaran->nama);
        }

        try {
            $pendapatan_persen = number_format((float)($pendapatan_realisasi / $pendapatan_anggaran) * 100, 2, '.', '');
        } catch (\Throwable $th) {
            $pendapatan_persen = 0;
        }

        try {
            $belanja_persen = number_format((float)($belanja_realisasi / $belanja_anggaran) * 100, 2, '.', '');
        } catch (\Throwable $th) {
            $belanja_persen = 0;
        }

        try {
            $pembiayaan_persen = number_format((float)($pembiayaan_realisasi / $pembiayaan_anggaran) * 100, 2, '.', '');
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
            $persen = number_format((float)($realisasi / $anggaran) * 100, 2, '.', '');
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
            'nilai_realisasi'           => ['required','numeric','min:0','max:'.$request->nilai_anggaran],
            'keterangan_lainnya'        => ['nullable']
        ],[
            'detail_jenis_anggaran_id.required' => 'detail jenis anggaran wajib diisi'
        ]);

        $jenis = '';
        if ($request->jenis_anggaran == 4 ) {
            $jenis = 'pendapatan';
        } elseif ($request->jenis_anggaran == 5 ) {
            $jenis = 'belanja';
        } elseif ($request->jenis_anggaran == 6 ) {
            $jenis = 'pembiayaan';
        }

        AnggaranRealisasi::create($data);
        return redirect('/anggaran-realisasi?jenis='.$jenis."&tahun=".$request->tahun)->with('success','Anggaran Realisasi APBDes berhasil ditambahkan');
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
            'nilai_realisasi'           => ['required','numeric','min:0','max:'.$request->nilai_anggaran],
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
