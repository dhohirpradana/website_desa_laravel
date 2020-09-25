<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $guarded = [];

    public function isiSurat()
    {
        return $this->hasMany('App\IsiSurat', 'surat_id');
    }

    public function cetakSurat()
    {
        return $this->hasMany('App\CetakSurat', 'surat_id');
    }
}
