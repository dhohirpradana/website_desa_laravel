<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusHubunganDalamKeluarga extends Model
{
    protected $table = "status_hubungan_dalam_keluarga";
    protected $guarded = [];

    public function penduduk()
    {
        return $this->hasMany('App\Penduduk');
    }
}
