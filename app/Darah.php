<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Darah extends Model
{
    protected $table = "darah";
    protected $guarded = [];

    public function penduduk()
    {
        return $this->hasMany('App\Penduduk');
    }
}
