<?php
// Our Controller
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintLaporanController extends Controller
{
    public function printPDF($tahun)
    {
        // This  $data array will be passed to our PDF blade
        $data = [
            //PENDAPATAN Asli
            'pendapatan_asli' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select('*', 'detail_jenis_anggaran.nama AS detail_jenis_anggaran', 'kelompok_jenis_anggaran.nama AS kelompok_jenis_anggaran')
                ->where('detail_jenis_anggaran.jenis_anggaran_id', 4)
                ->where('kelompok_jenis_anggaran.id', 41)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'pendapatan_asli_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 41)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('detail_jenis_anggaran.jenis_anggaran_id', 4)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_asli_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 41)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('detail_jenis_anggaran.jenis_anggaran_id', 4)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            //PENDAPATAN Transfer
            'pendapatan_transfer' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select('*', 'detail_jenis_anggaran.nama AS detail_jenis_anggaran', 'kelompok_jenis_anggaran.nama AS kelompok_jenis_anggaran')
                ->where('detail_jenis_anggaran.jenis_anggaran_id', 4)
                ->where('kelompok_jenis_anggaran.id', 42)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'pendapatan_transfer_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 42)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('detail_jenis_anggaran.jenis_anggaran_id', 4)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_transfer_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 42)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('detail_jenis_anggaran.jenis_anggaran_id', 4)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            //PENDAPATAN Lain
            'pendapatan_lain' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select('*', 'detail_jenis_anggaran.nama AS detail_jenis_anggaran', 'kelompok_jenis_anggaran.nama AS kelompok_jenis_anggaran')
                ->where('detail_jenis_anggaran.jenis_anggaran_id', 4)
                ->where('kelompok_jenis_anggaran.id', 43)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'pendapatan_lain_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 43)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_lain_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 43)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            // Asli
            // Hasil Usaha Desa
            'a1' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 411)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // Hasil Aset Desa
            'a2' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 412)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 413
            'a3' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 413)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 414
            'a4' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 414)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 421
            'b1' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 421)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 422
            'b2' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 422)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 423
            'b3' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 423)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 424
            'b4' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 424)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 425
            'b5' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 425)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 431
            'c1' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 431)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 432
            'c2' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 432)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 433
            'c3' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 433)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 434
            'c4' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 434)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 435
            'c5' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 435)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 436
            'c6' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 436)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 439
            'c7' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 439)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'anggaran_belanja51' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 51)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_belanja51' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 51)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'anggaran_belanja52' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 52)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_belanja52' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 52)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'anggaran_belanja53' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 53)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_belanja53' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 53)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'anggaran_belanja54' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 54)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_belanja54' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 54)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'anggaran_belanja55' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 55)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'realisasi_belanja55' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 55)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            //PEMBIAYAAN Terima
            'pembiayaan_masuk_anggaran_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 61)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'pembiayaan_masuk_realisasi_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 61)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            // 611
            'd1' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 611)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 612
            'd2' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 612)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 613
            'd3' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 613)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 614
            'd4' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 614)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            // PEMBIAYAAN Keluar
            'pembiayaan_keluar_anggaran_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 62)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            'pembiayaan_keluar_realisasi_total' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->where('kelompok_jenis_anggaran.id', 62)
                ->select(DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total'))
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),

            // 621
            'e1' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 621)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 622
            'e2' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 622)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(),
            // 623
            'e3' => DB::table('anggaran_realisasi')
                ->join('detail_jenis_anggaran', 'anggaran_realisasi.detail_jenis_anggaran_id', 'detail_jenis_anggaran.id')
                ->join('kelompok_jenis_anggaran', 'detail_jenis_anggaran.kelompok_jenis_anggaran_id', 'kelompok_jenis_anggaran.id')
                ->select(
                    DB::raw('SUM(anggaran_realisasi.nilai_anggaran) AS total_anggaran'),
                    DB::raw('SUM(anggaran_realisasi.nilai_realisasi) AS total_realisasi')
                )
                ->where('anggaran_realisasi.detail_jenis_anggaran_id', 623)
                ->where('anggaran_realisasi.tahun', $tahun)
                ->get(), // 611

            'tahun' => $tahun,
        ];

        $pdf = PDF::loadView('anggaran-realisasi.pdf_view', $data)->setPaper('A4', 'landscape');;
        // return $pdf->download('contoh.pdf');
        return $pdf->stream();
    }
}
