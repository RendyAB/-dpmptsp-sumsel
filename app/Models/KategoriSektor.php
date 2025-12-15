<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriSektor extends Model
{
    protected $table = 'kategori_sektor';
    protected $fillable = ['nama'];

    public function sektorInvestasi()
    {
        return $this->hasMany(SektorInvestasi::class,'kategori_sektor_id')->orderBy('nama');
    }
}
