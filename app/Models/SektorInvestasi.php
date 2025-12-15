<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SektorInvestasi extends Model
{
    protected $table = 'sektor_investasi';
    protected $fillable = ['kategori_sektor_id', 'nama'];

    public function kategori()
    {
        return $this->belongsTo(KategoriSektor::class, 'kategori_sektor_id');
    }

    public function investasi()
    {
        return $this->hasMany(Investasi::class);
    }
}
