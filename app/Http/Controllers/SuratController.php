<?php

namespace App\Http\Controllers;

use App\CetakSurat;
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
        $surat = Surat::all();
        return view('surat.index', compact('surat'));
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
        $validator = Validator::make($request->all(), [
            'nama'      => ['required', 'max:64'],
            'icon'      => ['required', 'max:64'],
            'isian.*'   => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => $validator->errors()->all()
            ]);
        }

        $dataSurat = [
            'nama'      => $request->nama,
            'icon'      => $request->icon,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->perihal) {
            $dataSurat['perihal'] = 1;
        }

        if ($request->tanda_tangan_bersangkutan) {
            $dataSurat['tanda_tangan_bersangkutan'] = 1;
        }

        if ($request->data_kades) {
            $dataSurat['data_kades'] = 1;
        }

        if ($request->tampilkan_surat) {
            $dataSurat['tampilkan'] = 1;
        }

        $surat = Surat::create($dataSurat);

        for ($i = 1; $i < count($request->isian); $i++) {
            try {
                if ($request->tampilkan[$i]) {
                    $tampilkan = 1;
                } else {
                    $tampilkan = 0;
                }
            } catch (\Throwable $th) {
                $tampilkan = 0;
            }

            if ($request->status[$i] == 1) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'paragraf'  => 1,
                    'tampilkan' => $tampilkan,
                ]);
            } elseif ($request->status[$i] == 2) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'kalimat'   => 1,
                    'tampilkan' => $tampilkan,
                ]);
            } elseif ($request->status[$i] == 3) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'isian'     => 1,
                ]);
            } elseif ($request->status[$i] == 4) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'perihal'   => 1,
                ]);
            }
        }

        return response()->json([
            'success'   => true,
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
        $validation = [
            'nama'      => ['required', 'max:64'],
            'icon'      => ['required', 'max:64'],
        ];

        if ($request->perihal) {
            $validation['isian.*'] = ['required'];
        }

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => $validator->errors()->all()
            ]);
        }

        $dataSurat = [
            'nama'      => $request->nama,
            'icon'      => $request->icon,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->perihal) {
            $dataSurat['perihal'] = 1;
            if ($surat->isiSurat->where('perihal',1)->first()) {
                $i = 1;
                foreach ($surat->isiSurat->where('perihal',1) as $isiSurat) {
                    $isiSurat->update([
                        'isi'  => $request->isian[$i],
                    ]);
                    $i++;
                }
            } else {
                for ($i = 1; $i <= 5; $i++) {
                    IsiSurat::create([
                        'surat_id'  => $surat->id,
                        'isi'       => $request->isian[$i],
                        'perihal'   => 1,
                    ]);
                }
            }
        } else {
            if ($surat->isiSurat->where('perihal',1)->first()) {
                foreach ($surat->isiSurat->where('perihal',1) as $isiSurat) {
                    $isiSurat->delete();
                }
            }
            $dataSurat['perihal'] = 0;
        }

        if ($request->tanda_tangan_bersangkutan) {
            $dataSurat['tanda_tangan_bersangkutan'] = 1;
        } else {
            $dataSurat['tanda_tangan_bersangkutan'] = 0;
        }

        if ($request->data_kades) {
            $dataSurat['data_kades'] = 1;
        } else {
            $dataSurat['data_kades'] = 0;
        }

        if ($request->tampilkan_surat) {
            $dataSurat['tampilkan'] = 1;
        } else {
            $dataSurat['tampilkan'] = 0;
        }

        $surat->update($dataSurat);

        return response()->json([
            'success'   => true,
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
}
