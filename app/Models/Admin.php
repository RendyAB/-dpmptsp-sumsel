<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $fillable = [
        'username',
        'password',
        'role',
        'kab_kota',
    ];

    protected $hidden = ['password'];

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class, 'kab_kota_id');
    }
}
