<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sejarah = Sejarah::orderBy('id','desc')->paginate(12);

        if ($request->cari) {
            $sejarah = Sejarah::where('judul','like',"%{$request->cari}%")
            ->orWhere('konten','like',"%{$request->cari}%")
            ->orderBy('id','desc')->paginate(12);
        }

        $sejarah->appends($request->only('cari'));
        return view('sejarah.index', compact('sejarah'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sejarah(Request $request)
    {
        $sejarah = Sejarah::orderBy('id','desc')->paginate(12);
        $desa = Desa::find(1);

        if ($request->cari) {
            $sejarah = Sejarah::where('judul','like',"%{$request->cari}%")
            ->orWhere('konten','like',"%{$request->cari}%")
            ->orderBy('id','desc')->paginate(12);
        }

        $sejarah->appends($request->only('cari'));
        return view('sejarah.sejarah', compact('sejarah','desa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sejarah.create');
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

        Sejarah::create($data);

        return redirect()->route('sejarah.index')->with('success','Sejarah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function show(Sejarah $sejarah, $slug)
    {
        $desa = Desa::find(1);
        $sejarahs = Sejarah::where('id','!=', $sejarah->id)->inRandomOrder()->limit(3)->get();
        if ($slug != Str::slug($sejarah->judul)) {
            return abort(404);
        }
        return view('sejarah.show', compact('sejarah','desa','sejarahs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sejarah $sejarah)
    {
        return view('sejarah.edit', compact('sejarah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sejarah $sejarah)
    {
        $data = $request->validate([
            'judul'     => ['required','string','max:191'],
            'konten'    => ['required'],
            'gambar'    => ['nullable','image','max:2048'],
        ]);

        if ($request->gambar) {
            if ($sejarah->gambar) {
                File::delete(storage_path('app/' . $sejarah->gambar));
            }
            $data['gambar'] = $request->gambar->store('public/gallery');
        }

        $sejarah->update($data);

        return back()->with('success','Sejarah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sejarah $sejarah)
    {
        $sejarah->delete();
        return back()->with('success','Sejarah berhasil diperbarui');
    }
}
