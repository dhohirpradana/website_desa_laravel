<?php

namespace App\Http\Controllers;

use App\IsiSurat;
use App\Surat;
use Illuminate\Support\Str;
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
        } else {
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

        $surat = Surat::create($dataSurat);

        for ($i = 1; $i < count($request->isian); $i++) {
            if ($request->status[$i] == 1) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'paragraf'  => 1,
                    'kalimat'   => 0,
                    'isian'     => 0,
                    'perihal'   => 0,
                ]);
            } elseif ($request->status[$i] == 2) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'paragraf'  => 0,
                    'kalimat'   => 1,
                    'isian'     => 0,
                    'perihal'   => 0,
                ]);
            } elseif ($request->status[$i] == 3) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'paragraf'  => 0,
                    'kalimat'   => 0,
                    'isian'     => 1,
                    'perihal'   => 0,
                ]);
            } elseif ($request->status[$i] == 4) {
                IsiSurat::create([
                    'surat_id'  => $surat->id,
                    'isi'       => $request->isian[$i],
                    'paragraf'  => 0,
                    'kalimat'   => 0,
                    'isian'     => 0,
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
    public function show(Surat $surat)
    {
        return back();
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
            for ($i = 1; $i <= 5; $i++) {
                $surat->isiSurat[$i - 1]->update([
                    'isi'  => $request->isian[$i],
                ]);
            }
        } else {
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

    public function buat(Request $request, $id, $slug)
    {
        $surat = Surat::find($id);

        if ($slug != Str::slug($surat->nama)) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        return view('surat.buat', compact('surat'));
    }
}
