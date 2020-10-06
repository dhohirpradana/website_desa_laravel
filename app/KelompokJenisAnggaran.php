<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelompokJenisAnggaran extends Model
{
    protected $table = "kelompok_jenis_anggaran";
    protected $guarded = [];

    public function jenis_anggaran()
    {
        return $this->belongsTo('App\JenisAnggaran');
    }

    public function detail_kelompok_jenis_anggaran()
    {
        return $this->hasMany('App\DetailKelompokJenisAnggaran');
    }
}
