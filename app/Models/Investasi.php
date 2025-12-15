<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    protected $table = 'investasi';
    protected $fillable = [
        'kab_kota_id',
        'kategori_sektor_id',
        'sektor_investasi_id',
        'lkpm_pma',
        'realisasi_pma',
        'tki_pma',
        'tka_pma',
        'lkpm_pmdn',
        'realisasi_pmdn',
        'tki_pmdn',
        'tka_pmdn',
        'triwulan',
        'tahun'
    ];

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class);
    }

    public function sektor()
    {
        return $this->belongsTo(SektorInvestasi::class, 'sektor_investasi_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriSektor::class, 'kategori_sektor_id');
    }
}
