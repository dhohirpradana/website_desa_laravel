<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggaranRealisasi extends Model
{
    protected $table = "anggaran_realisasi";
    protected $guarded = [];

    public function detail_jenis_anggaran()
    {
        return $this->belongsTo('App\DetailJenisAnggaran');
    }
}
