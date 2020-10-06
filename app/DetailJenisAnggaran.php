<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailJenisAnggaran extends Model
{
    protected $table = "detail_jenis_anggaran";
    protected $guarded = [];

    public function kelompok_jenis_anggaran()
    {
        return $this->belongsTo('App\JenisAnggaran');
    }
}
