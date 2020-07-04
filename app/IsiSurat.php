<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IsiSurat extends Model
{
    protected $table = 'isi_surat';

    public function surat()
    {
        return $this->belongsTo('App\Surat', 'surat_id');
    }
}
