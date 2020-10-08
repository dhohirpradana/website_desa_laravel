<?php

namespace App\Http\Controllers;

use App\CetakSurat;
use App\Desa;
use App\IsiSurat;
use App\Surat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat = Surat::latest()->get();
        return view('surat.index', compact('surat'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function layanan_surat()
    {
        $surat = Surat::latest()->get();
        $desa = Desa::find(1);
        return view('surat.layanan-surat', compact('surat','desa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validationSurat($request);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => $validator->errors()->all()
            ]);
        }

        $dataSurat = $this->dataSurat($request);

        $surat = Surat::create($dataSurat);

        $this->createIsiSurat($request, $surat);

        return response()->json([
            'success'   => true,
            'message'   => 'Surat berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Surat $surat)
    {
        $cetakSurat = CetakSurat::where('surat_id',$surat->id)->orderBy('id', 'desc')->paginate(25);
        if ($request->cari) {
            $cetakSurat = CetakSurat::where('surat_id',$surat->id)
            ->whereHas('detailCetak', function ($detailCetak) use ($request) {
                $detailCetak->where("isian", "like", "%{$request->cari}%");
            })
            ->orderBy('id', 'desc')->paginate(25);
        }
        $cetakSurat->appends($request->only('cari'));

        return view('surat.show', compact('surat','cetakSurat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        return view('surat.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
        $validator = $this->validationSurat($request);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => $validator->errors()->all()
            ]);
        }

        $dataSurat = $this->dataSurat($request);

        $surat->update($dataSurat);

        IsiSurat::where('surat_id',$surat->id)->delete();

        $this->createIsiSurat($request, $surat);

        return response()->json([
            'success'   => true,
            'message'   => 'Surat berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->back()->with('success', 'Surat berhasil dihapus');
    }

    public function chartSurat(Request $request, $id)
    {
        if ($request->tahun) {
            $cetakSurat = CetakSurat::where('surat_id',$id)->whereYear('created_at',$request->tahun)->get();
        } else {
            $cetakSurat = CetakSurat::where('surat_id',$id)->get();
        }

        $arr = array(
            'Januari'   => 0,
            'Februari'  => 0,
            'Maret'     => 0,
            'April'     => 0,
            'Mei'       => 0,
            'Juni'      => 0,
            'Juli'      => 0,
            'Agustus'   => 0,
            'September' => 0,
            'Oktober'   => 0,
            'November'  => 0,
            'Desember'  => 0,
        );

        foreach ($cetakSurat as $value) {
            if (date('m', strtotime($value->created_at)) == 1) {
                $arr['Januari'] = $arr['Januari'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 2) {
                $arr['Februari'] = $arr['Februari'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 3) {
                $arr['Maret'] = $arr['Maret'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 4) {
                $arr['April'] = $arr['April'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 5) {
                $arr['Mei'] = $arr['Mei'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 6) {
                $arr['Juni'] = $arr['Juni'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 7) {
                $arr['Juli'] = $arr['Juli'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 8) {
                $arr['Agustus'] = $arr['Agustus'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 9) {
                $arr['September'] = $arr['September'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 10) {
                $arr['Oktober'] = $arr['Oktober'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 11) {
                $arr['November'] = $arr['November'] + 1;
            } else if (date('m', strtotime($value->created_at)) == 12) {
                $arr['Desember'] = $arr['Desember'] + 1;
            }
        }

        return response()->json([
            "labels" => array_keys($arr),
            "datasets" => [[
                "label" => "Total Cetak Surat",
                "data" => array_values($arr),
                "backgroundColor" => 'rgb(' . rand(0,255) . ',' . rand(0,255) . ',' . rand(0,255) . ')',
            ]],
        ]);
    }

    public function createIsiSurat($request, $surat)
    {
        for ($i = 1; $i < count($request->isian); $i++) {
            IsiSurat::create([
                'surat_id'  => $surat->id,
                'isi'       => $request->isian[$i],
                'jenis_isi' => $request->jenis_isi[$i],
                'tampilkan' => $request->tampilkan[$i],
            ]);
        }
    }

    public function dataSurat($request)
    {
        $dataSurat = [
            'nama'                      => $request->nama,
            'icon'                      => $request->icon,
            'deskripsi'                 => $request->deskripsi,
            'persyaratan'               => $request->persyaratan,
            'perihal'                   => $request->perihal,
            'data_kades'                => $request->data_kades,
            'tampilkan'                 => $request->tampilkan_surat,
            'tanda_tangan_bersangkutan' => $request->tanda_tangan_bersangkutan,
        ];

        return $dataSurat;
    }

    public function validationSurat($request)
    {
        return Validator::make($request->all(), [
            'nama'      => ['required', 'max:64'],
            'icon'      => ['required', 'max:64'],
            'isian.*'   => ['required']
        ]);
    }
}
