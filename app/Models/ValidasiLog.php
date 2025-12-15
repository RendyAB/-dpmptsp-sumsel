<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidasiLog extends Model
{
    protected $table = 'validasi_log';

    protected $fillable = [
        'validasi_id',
        'admin_id',
        'role',
        'status',
        'catatan',
        'validated_at',
    ];

    public function admin()
    {
        return $this->belongsTo(AdminVerifikator::class, 'admin_id');
    }

    public function validasi()
    {
        return $this->belongsTo(Validasi::class, 'validasi_id');
    }
}
