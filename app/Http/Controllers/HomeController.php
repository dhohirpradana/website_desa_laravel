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
        $gallery = Gallery::all();
        return view('index', compact('surat', 'desa', 'gallery'));
    }
}
