<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    protected $table = "dusun";
    protected $guarded = [];

    public function detailDusun()
    {
        return $this->hasMany('App\DetailDusun');
    }
}
