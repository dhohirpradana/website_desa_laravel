<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = "penduduk";
    protected $guarded = [];

    public function pekerjaan()
    {
        return $this->belongsTo('App\Pekerjaan');
    }

    public function pendidikan()
    {
        return $this->belongsTo('App\Pendidikan');
    }

    public function agama()
    {
        return $this->belongsTo('App\Agama');
    }

    public function darah()
    {
        return $this->belongsTo('App\Darah');
    }

    public function detailDusun()
    {
        return $this->belongsTo('App\DetailDusun');
    }

    public function statusHubunganDalamKeluarga()
    {
        return $this->belongsTo('App\StatusHubunganDalamKeluarga');
    }

    public function statusPerkawinan()
    {
        return $this->belongsTo('App\StatusPerkawinan');
    }
}
