<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table = 'validasi';

    // protected $fillable = [
    //     'jenis_permohonan',
    //     'status',
    //     'current_level',
    //     'last_action_at',
    // ];
    protected $fillable = [
        'jenis_permohonan',
        'status',
        'current_level',
        'last_action_at',
        'perizinan_id',   // ⬅ WAJIB
        'non_perizinan_id'
    ];

    public function perizinan()
    {
        return $this->belongsTo(Perizinan2::class, 'perizinan_id');
    }
    public function nonPerizinan()
    {
        return $this->belongsTo(NonPerizinan::class, 'non_perizinan_id');
    }

    public function logs()
    {
        return $this->hasMany(ValidasiLog::class, 'validasi_id');
    }

    public function latestLog()
    {
        return $this->hasOne(ValidasiLog::class, 'validasi_id')
            ->latest('validated_at'); // ambil yg terbaru
    }


}
