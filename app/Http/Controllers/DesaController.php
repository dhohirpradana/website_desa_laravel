<?php

namespace App\Http\Controllers;

use App\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desa = Desa::find(1);
        return view('desa.index', compact('desa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        if (request()->ajax()) {
            $validator = Validator::make($request->all(),[
                'logo'   => ['required', 'image', 'max:2048']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error'     => true,
                    'message'   => $validator->errors()->all()
                ]);
            }

            if ($desa->logo != 'logo.png') {
                File::delete(storage_path('app/'.$desa->logo));
            }

            $desa->logo = $request->file('logo')->store('public/logo');
            $desa->save();

            return response()->json([
                'error'     => false,
                'data'      => ['logo'   => $desa->logo]
            ]);
        } else {
            $data = $request->validate([
                'nama_desa'             => ['required', 'max:64', 'string'],
                'nama_kecamatan'        => ['required', 'max:64', 'string'],
                'nama_kabupaten'        => ['required', 'max:64', 'string'],
                'alamat'                => ['required', 'string'],
                'nama_kepala_desa'      => ['required', 'max:64', 'string'],
                'alamat_kepala_desa'    => ['required', 'string']
            ]);

            if ($request->nama_desa != $desa->nama_desa  || $request->nama_kecamatan != $desa->nama_kecamatan || $request->nama_kabupaten != $desa->nama_kabupaten || $request->alamat != $desa->alamat || $request->nama_kepala_desa != $desa->nama_kepala_desa || $request->alamat_kepala_desa != $desa->alamat_kepala_desa) {
                $desa->update($data);
                return redirect()->back()->with('success','Profil desa berhasil di perbarui');
            } else {
                return redirect()->back()->with('error','Tidak ada perubahan yang berhasil disimpan');
            }
        }
    }

}
