<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Surat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $surat = Surat::all();
        $desa = Desa::find(1);
        return view('index', compact('surat', 'desa'));
    }
}
