<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    protected $table = 'perizinan';

    protected $fillable = [
        'kab_kota_id', 
        'sektor_perizinan_id', 
        'jenis_input', 
        'jumlah',  
        'triwulan',
        'tahun',
    ];

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class);
    }

    public function sektor()
    {
        return $this->belongsTo(SektorPerizinan::class);
    }
}
