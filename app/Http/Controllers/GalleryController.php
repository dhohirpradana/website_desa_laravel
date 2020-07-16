<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::all();
        return view('gallery.index', compact('gallery'));
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
        $validator = Validator::make($request->all(),[
            'file.*'    => ['required', 'image', 'max:2048']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'     => true,
                'message'   => $validator->errors()->all()
            ], 400);
        }

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        for ($i = 0; $i < count($photos); $i++) {
            Gallery::create([
                'gallery' => $photos[$i]->store('public/gallery'),
            ]);
        }

        return response()->json([
            'message' => 'Gallery berhasil ditambahkan'
        ]);
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
        return back()->with('success', 'Gallery berhasil dihapus');
    }
}
