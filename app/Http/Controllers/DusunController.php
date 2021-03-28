<?php

namespace App\Http\Controllers;

use App\Dusun;
use Illuminate\Http\Request;

class DusunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dusun.index', ['dusun' => Dusun::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dusun.create');
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
            'nama' => ['required','string','max:16']
        ]);

        $dusun = Dusun::create($data);
        return redirect()->route('dusun.edit',$dusun)->with('success','Dusun berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dusun  $dusun
     * @return \Illuminate\Http\Response
     */
    public function edit(Dusun $dusun)
    {
        return view('dusun.edit', compact('dusun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dusun  $dusun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dusun $dusun)
    {
        $data = $request->validate([
            'nama' => ['required','string','max:16']
        ]);

        $dusun->update($data);
        return redirect()->back()->with('success','Dusun berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dusun  $dusun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dusun $dusun)
    {
        $dusun->delete();
        return redirect()->route('dusun.index')->with('success','Dusun berhasil dihapus');
    }
}
