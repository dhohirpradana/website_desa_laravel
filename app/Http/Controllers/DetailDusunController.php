<?php

namespace App\Http\Controllers;

use App\DetailDusun;
use Illuminate\Http\Request;

class DetailDusunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $detailDusun = DetailDusun::where('dusun_id', $request->id)->get();
        return response()->json($detailDusun);
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
            'rw'        => ['required','string','max:3'],
            'rt'        => ['required','string','max:3'],
            'dusun_id'  => ['required','numeric'],
        ]);

        $detailDusun = DetailDusun::create($data);
        return response()->json([
            'success'   => true,
            'message'   => 'Detail dusun berhasil ditambahkan',
            'data'      => $detailDusun
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetailDusun  $detailDusun
     * @return \Illuminate\Http\Response
     */
    public function show(DetailDusun $detailDusun)
    {
        return response()->json($detailDusun);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetailDusun  $detailDusun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailDusun $detailDusun)
    {
        $data = $request->validate([
            'rw'        => ['required','string','max:3'],
            'rt'        => ['required','string','max:3'],
        ]);

        $detailDusun->update($data);
        return response()->json([
            'success'   => true,
            'message'   => 'Detail dusun berhasil diperbarui',
            'data'      => $detailDusun
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetailDusun  $detailDusun
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailDusun $detailDusun)
    {
        $detailDusun->delete();
        return redirect()->back()->with('success', 'Detail dusun berhasil dihapus');
    }
}
