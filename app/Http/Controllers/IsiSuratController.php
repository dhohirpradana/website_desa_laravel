<?php

namespace App\Http\Controllers;

use App\IsiSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IsiSuratController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isian' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => $validator->errors()->all()
            ]);
        }

        $isiSurat = IsiSurat::create([
            'surat_id'  => $request->surat_id,
            'isi'       => $request->isian,
            'jenis_isi' => $request->jenis_isi,
            'tampilkan' => $request->tampilkan ? 1 : 0,
        ]);

        return response()->json([
            'success'   => true,
            'data'      => $isiSurat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IsiSurat  $isiSurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IsiSurat $isiSurat)
    {
        $validator = Validator::make($request->all(), [
            'isian' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => $validator->errors()->all()
            ]);
        }

        $isiSurat->isi = $request->isian;
        $isiSurat->tampilkan = $request->tampilkan ? 1 : 0;

        $isiSurat->save();

        return response()->json([
            'success'   => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IsiSurat  $isiSurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(IsiSurat $isiSurat)
    {
        $isiSurat->delete();
        return response()->json([
            'success'   => true
        ]);
    }
}
