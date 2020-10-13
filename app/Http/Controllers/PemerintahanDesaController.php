<?php

namespace App\Http\Controllers;

use App\Desa;
use App\PemerintahanDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PemerintahanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pemerintahan_desa = PemerintahanDesa::orderBy('id','desc')->paginate(12);

        if ($request->cari) {
            $pemerintahan_desa = PemerintahanDesa::where('judul','like',"%{$request->cari}%")
            ->orWhere('konten','like',"%{$request->cari}%")
            ->orderBy('id','desc')->paginate(15);
        }

        $pemerintahan_desa->appends($request->only('cari'));
        return view('pemerintahan-desa.index', compact('pemerintahan_desa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pemerintahan_desa(Request $request)
    {
        $pemerintahan_desa = PemerintahanDesa::orderBy('id','desc')->paginate(12);
        $desa = Desa::find(1);

        if ($request->cari) {
            $pemerintahan_desa = PemerintahanDesa::where('judul','like',"%{$request->cari}%")
            ->orWhere('konten','like',"%{$request->cari}%")
            ->orderBy('id','desc')->paginate(12);
        }

        $pemerintahan_desa->appends($request->only('cari'));
        return view('pemerintahan-desa.pemerintahan-desa', compact('pemerintahan_desa','desa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemerintahan-desa.create');
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
            'judul'     => ['required','string','max:191'],
            'konten'    => ['required'],
            'gambar'    => ['nullable','image','max:2048'],
        ]);

        if ($request->gambar) {
            $data['gambar'] = $request->gambar->store('public/gallery');
        }

        PemerintahanDesa::create($data);

        return redirect()->route('pemerintahan-desa.index')->with('success','Informasi pemerintahan desa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    public function show(PemerintahanDesa $pemerintahan_desa, $slug)
    {
        $desa = Desa::find(1);
        $pemerintahan_desas = PemerintahanDesa::where('id','!=', $pemerintahan_desa->id)->inRandomOrder()->limit(3)->get();
        if ($slug != Str::slug($pemerintahan_desa->judul)) {
            return abort(404);
        }
        $pemerintahan_desa->update(['dilihat' => $pemerintahan_desa->dilihat + 1]);
        return view('pemerintahan-desa.show', compact('pemerintahan_desa','desa','pemerintahan_desas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    public function edit(PemerintahanDesa $pemerintahan_desa)
    {
        return view('pemerintahan-desa.edit', compact('pemerintahan_desa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemerintahanDesa $pemerintahan_desa)
    {
        $data = $request->validate([
            'judul'     => ['required','string','max:191'],
            'konten'    => ['required'],
            'gambar'    => ['nullable','image','max:2048'],
        ]);

        if ($request->gambar) {
            if ($pemerintahan_desa->gambar) {
                File::delete(storage_path('app/' . $pemerintahan_desa->gambar));
            }
            $data['gambar'] = $request->gambar->store('public/gallery');
        }

        $pemerintahan_desa->update($data);

        return back()->with('success','Informasi pemerintahan desa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PemerintahanDesa  $pemerintahan_desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemerintahanDesa $pemerintahan_desa)
    {
        $pemerintahan_desa->delete();
        return back()->with('success','Informasi pemerintahan desa berhasil dihapus');
    }
}
