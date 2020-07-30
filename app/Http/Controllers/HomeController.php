<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Gallery;
use App\Surat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $surat = Surat::whereTampilkan(1)->get();
        $desa = Desa::find(1);
        $gallery = Gallery::where('slider', 1)->get();
        return view('index', compact('surat', 'desa', 'gallery'));
    }

    public function panduan()
    {
        $desa = Desa::find(1);
        return view('panduan', compact('desa'));
    }
}
