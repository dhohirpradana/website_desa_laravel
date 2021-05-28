<?php

namespace App\Exports;

use App\Penduduk;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PendudukExport implements FromView, ShouldAutoSize, WithColumnFormatting
{

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_GENERAL,
            'P' => NumberFormat::FORMAT_GENERAL,
            'R' => NumberFormat::FORMAT_GENERAL,
        ];
    }

    public function view(): View
    {
        return view('penduduk.export', [
            'penduduks' => DB::table('penduduk')
                ->join('agama', 'penduduk.agama_id', '=', 'agama.id')
                ->join('pendidikan', 'penduduk.pendidikan_id', '=', 'pendidikan.id')
                ->join('pekerjaan', 'penduduk.pekerjaan_id', '=', 'pekerjaan.id')
                ->join('darah', 'penduduk.darah_id', '=', 'darah.id')
                ->join('status_perkawinan', 'penduduk.status_perkawinan_id', '=', 'status_perkawinan.id')
                ->join('status_hubungan_dalam_keluarga', 'penduduk.status_hubungan_dalam_keluarga_id', '=', 'status_hubungan_dalam_keluarga.id')
                ->join('detail_dusun', 'penduduk.detail_dusun_id', '=', 'detail_dusun.id')
                ->join('dusun', 'detail_dusun.dusun_id', '=', 'dusun.id')
                ->select(
                    'penduduk.nik',
                    'penduduk.kk',
                    'penduduk.nama AS nama',
                    'penduduk.jenis_kelamin',
                    'penduduk.tempat_lahir',
                    'penduduk.tanggal_lahir',
                    'agama.nama AS agama',
                    'pendidikan.nama AS pendidikan',
                    'pekerjaan.nama AS pekerjaan',
                    'darah.golongan AS darah',
                    'status_perkawinan.nama AS status_perkawinan',
                    'status_hubungan_dalam_keluarga.nama AS status_hubungan_dalam_keluarga',
                    'penduduk.kewarganegaraan',
                    'penduduk.nomor_paspor',
                    'penduduk.nomor_kitas_atau_kitap',
                    'penduduk.nik_ayah',
                    'penduduk.nik_ibu',
                    'penduduk.nama_ayah',
                    'penduduk.nama_ibu',
                    'dusun.nama AS dusun',
                    'detail_dusun.rw AS rw',
                    'detail_dusun.rt AS rt',
                    'alamat',
                )
                ->get()
        ]);
    }
}
