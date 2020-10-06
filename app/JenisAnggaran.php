<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisAnggaran extends Model
{
    protected $table = "jenis_anggaran";
    protected $guarded = [];

    public function kelompok_jenis_anggaran()
    {
        return $this->hasMany('App\KelompokJenisAnggaran');
    }
}
