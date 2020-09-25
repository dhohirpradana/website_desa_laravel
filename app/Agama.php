<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = "agama";
    protected $guarded = [];

    public function penduduk()
    {
        return $this->hasMany('App\Penduduk');
    }
}
