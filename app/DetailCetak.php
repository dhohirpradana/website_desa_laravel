<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailCetak extends Model
{
    protected $table = 'detail_cetak';
    protected $guarded = [];

    public function detailCetak()
    {
        return $this->belongsTo('App\CetakSurat');
    }
}
