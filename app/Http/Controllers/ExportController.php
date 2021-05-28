<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PendudukExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new PendudukExport, 'data_penduduk.xlsx');
    }
}
