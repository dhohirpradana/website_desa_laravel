<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggaranRealisasi extends Model
{
    protected $table = "anggaran_realisasi";
    protected $fillable = ['tahun','detail_jenis_anggaran_id','nilai_realisasi','nilai_anggaran','keterangan_lainnya'];

    public function detail_jenis_anggaran()
    {
        return $this->belongsTo('App\DetailJenisAnggaran');
    }
}
