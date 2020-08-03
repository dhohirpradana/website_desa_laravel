<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CetakSurat extends Model
{
    protected $table = 'cetak_surat';
    protected $guarded = [];

    public function surat()
    {
        return $this->belongsTo('App\Surat');
    }

    public function detailCetak()
    {
        return $this->hasMany('App\DetailCetak');
    }
}
