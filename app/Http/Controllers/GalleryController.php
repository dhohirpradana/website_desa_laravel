<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Gallery;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desa = Desa::find(1);
        $gallery = Gallery::where('slider', null)->get();
        $videos = Video::all();
        $galleries = array();

        foreach ($gallery as $key => $value) {
            $gambar = [
                'gambar'    => $value->gallery,
                'id'        => $value->id,
                'caption'   => $value->caption,
                'jenis'     => 1,
                'created_at'=> strtotime($value->created_at),
            ];
            array_push($galleries, $gambar);
        }

        foreach ($videos as $key => $value) {
            $gambar = [
                'gambar'    => $value->gambar,
                'id'        => $value->video_id,
                'caption'   => $value->caption,
                'jenis'     => 2,
                'created_at'=> strtotime($value->published_at),
            ];
            array_push($galleries, $gambar);
        }

        usort($galleries, function($a, $b) {
            return $a['created_at'] < $b['created_at'];
        });

        return view('gallery.index', compact('galleries','desa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        $desa = Desa::find(1);
        $gallery = Gallery::where('slider', null)->get();
        $videos = Video::all();
        $galleries = array();

        foreach ($gallery as $key => $value) {
            $gambar = [
                'gambar'    => $value->gallery,
                'id'        => $value->id,
                'caption'   => $value->caption,
                'jenis'     => 1,
                'created_at'=> strtotime($value->created_at),
            ];
            array_push($galleries, $gambar);
        }

        foreach ($videos as $key => $value) {
            $gambar = [
                'gambar'    => $value->gambar,
                'id'        => $value->video_id,
                'caption'   => $value->caption,
                'jenis'     => 2,
                'created_at'=> strtotime($value->published_at),
            ];
            array_push($galleries, $gambar);
        }

        usort($galleries, function($a, $b) {
            return $a['created_at'] < $b['created_at'];
        });

        return view('gallery.gallery', compact('galleries','desa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSlider()
    {
        $gallery = Gallery::where('slider', 1)->latest()->get();
        return view('gallery.slider', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar'    => ['required', 'image', 'max:2048'],
            'caption'   => ['nullable', 'string']
        ]);

        Gallery::create([
            'gallery'   => $request->gambar->store('public/gallery'),
            'caption'   => $request->caption,
            'slider'    => $request->slider
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        File::delete(storage_path('app/'.$gallery->gallery));
        $gallery->delete();
        return back()->with('success', 'Gambar berhasil dihapus');
    }
}
